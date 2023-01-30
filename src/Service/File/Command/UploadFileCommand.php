<?php

namespace FluxIliasRestApi\Service\File\Command;

use FluxIliasBaseApi\Adapter\File\FileDto;
use FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Service\File\FileQuery;
use FluxIliasRestApi\Service\File\Port\FileService;
use ilCountPDFPagesPreProcessors;
use ILIAS\FileUpload\FileUpload;

class UploadFileCommand
{

    use FileQuery;

    private function __construct(
        private readonly FileService $file_service,
        private readonly FileUpload $ilias_upload
    ) {

    }


    public static function new(
        FileService $file_service,
        FileUpload $ilias_upload
    ) : static {
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
            $file->id,
            $file->ref_id
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

        $version_title = (($title ?: $result->getName()) ?: $file->title) ?? "";

        if ($replace) {
            $ilias_file->replaceWithUpload($result, $version_title);
        } else {
            $ilias_file->appendUpload($result, $version_title);
        }

        return ObjectIdDto::new(
            $file->id,
            $file->import_id,
            $file->ref_id
        );
    }
}
