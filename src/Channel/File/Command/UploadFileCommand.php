<?php

namespace FluxIliasRestApi\Channel\File\Command;

use FluxIliasRestApi\Adapter\Api\File\FileDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\File\FileQuery;
use FluxIliasRestApi\Channel\File\Port\FileService;
use ilCountPDFPagesPreProcessors;
use ILIAS\FileUpload\FileUpload;

class UploadFileCommand
{

    use FileQuery;

    private FileService $file_service;
    private FileUpload $ilias_upload;


    private function __construct(
        /*private readonly*/ FileService $file_service,
        /*private readonly*/ FileUpload $ilias_upload
    ) {
        $this->file_service = $file_service;
        $this->ilias_upload = $ilias_upload;
    }


    public static function new(
        FileService $file_service,
        FileUpload $ilias_upload
    ) : /*static*/ self
    {
        return new static(
            $file_service,
            $ilias_upload
        );
    }


    public function uploadFileById(int $id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return $this->uploadFile(
            $this->file_service->getFileById(
                $id,
                false
            ),
            $title,
            $replace
        );
    }


    public function uploadFileByImportId(string $import_id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return $this->uploadFile(
            $this->file_service->getFileByImportId(
                $import_id,
                false
            ),
            $title,
            $replace
        );
    }


    public function uploadFileByRefId(int $ref_id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return $this->uploadFile(
            $this->file_service->getFileByRefId(
                $ref_id,
                false
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

        $this->ilias_upload->register(new ilCountPDFPagesPreProcessors());

        if (!$this->ilias_upload->hasUploads()) {
            return null;
        }

        if (!$this->ilias_upload->hasBeenProcessed()) {
            $this->ilias_upload->process();
        }

        $result_key = array_key_first($this->ilias_upload->getResults());
        $result = $this->ilias_upload->getResults()[$result_key];
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
