<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\File\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\File\FileDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\File\FileQuery;
use Fluxlabs\FluxIliasRestApi\Channel\File\Port\FileService;
use ilCountPDFPagesPreProcessors;
use ILIAS\FileUpload\FileUpload;

class UploadFileCommand
{

    use FileQuery;

    private FileService $file;
    private FileUpload $upload;


    public static function new(FileService $file, FileUpload $upload) : /*static*/ self
    {
        $command = new static();

        $command->file = $file;
        $command->upload = $upload;

        return $command;
    }


    public function uploadFileById(int $id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return $this->uploadFile(
            $this->file->getFileById(
                $id
            ),
            $title,
            $replace
        );
    }


    public function uploadFileByImportId(string $import_id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return $this->uploadFile(
            $this->file->getFileByImportId(
                $import_id
            ),
            $title,
            $replace
        );
    }


    public function uploadFileByRefId(int $ref_id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return $this->uploadFile(
            $this->file->getFileByRefId(
                $ref_id
            ),
            $title,
            $replace
        );
    }


    private function uploadFile(?FileDto $file, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        if ($file === null) {
            return null;
        }

        $ilias_file = $this->getIliasFile(
            $file->getId(),
            $file->getRefId()
        );
        if ($ilias_file === null) {
            return null;
        }

        $this->upload->register(new ilCountPDFPagesPreProcessors());

        if (!$this->upload->hasUploads()) {
            return null;
        }

        if (!$this->upload->hasBeenProcessed()) {
            $this->upload->process();
        }

        $result_key = array_key_first($this->upload->getResults());
        $result = $this->upload->getResults()[$result_key];
        if (!$result->isOK()) {
            return null;
        }

        $version_title = (($title ?: $result->getName()) ?: $file->getTitle()) ?? "";

        if ($replace) {
            if (method_exists($ilias_file, "replaceWithUpload")) {
                $ilias_file->replaceWithUpload($result, $version_title);
            } else {
                $ilias_file->deleteVersions();
                $ilias_file->clearDataDirectory();
                $ilias_file->replaceFile($result_key, $version_title);
            }
        } else {
            if (method_exists($ilias_file, "appendUpload")) {
                $ilias_file->appendUpload($result, $version_title);
            } else {
                $ilias_file->addFileVersion($result_key, $version_title);
            }
        }

        return ObjectIdDto::new(
            $file->getId(),
            $file->getImportId(),
            $file->getRefId()
        );
    }
}
