<?php

namespace FluxIliasRestApi\Channel\File\Port;

use FluxIliasRestApi\Adapter\Api\File\FileDiffDto;
use FluxIliasRestApi\Adapter\Api\File\FileDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\File\Command\CreateFileCommand;
use FluxIliasRestApi\Channel\File\Command\GetFileCommand;
use FluxIliasRestApi\Channel\File\Command\GetFilesCommand;
use FluxIliasRestApi\Channel\File\Command\UpdateFileCommand;
use FluxIliasRestApi\Channel\File\Command\UploadFileCommand;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilDBInterface;
use ILIAS\FileUpload\FileUpload;

class FileService
{

    private ilDBInterface $database;
    private ObjectService $object;
    private FileUpload $upload;


    public static function new(ilDBInterface $database, FileUpload $upload, ObjectService $object) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->upload = $upload;
        $service->object = $object;

        return $service;
    }


    public function createFileToId(int $parent_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return CreateFileCommand::new(
            $this->object
        )
            ->createFileToId(
                $parent_id,
                $diff
            );
    }


    public function createFileToImportId(string $parent_import_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return CreateFileCommand::new(
            $this->object
        )
            ->createFileToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createFileToRefId(int $parent_ref_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return CreateFileCommand::new(
            $this->object
        )
            ->createFileToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getFileById(int $id) : ?FileDto
    {
        return GetFileCommand::new(
            $this->database
        )
            ->getFileById(
                $id
            );
    }


    public function getFileByImportId(string $import_id) : ?FileDto
    {
        return GetFileCommand::new(
            $this->database
        )
            ->getFileByImportId(
                $import_id
            );
    }


    public function getFileByRefId(int $ref_id) : ?FileDto
    {
        return GetFileCommand::new(
            $this->database
        )
            ->getFileByRefId(
                $ref_id
            );
    }


    public function getFiles() : array
    {
        return GetFilesCommand::new(
            $this->database
        )
            ->getFiles();
    }


    public function updateFileById(int $id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateFileCommand::new(
            $this
        )
            ->updateFileById(
                $id,
                $diff
            );
    }


    public function updateFileByImportId(string $import_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateFileCommand::new(
            $this
        )
            ->updateFileByImportId(
                $import_id,
                $diff
            );
    }


    public function updateFileByRefId(int $ref_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateFileCommand::new(
            $this
        )
            ->updateFileByRefId(
                $ref_id,
                $diff
            );
    }


    public function uploadFileById(int $id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return UploadFileCommand::new(
            $this,
            $this->upload
        )
            ->uploadFileById(
                $id,
                $title,
                $replace
            );
    }


    public function uploadFileByImportId(string $import_id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return UploadFileCommand::new(
            $this,
            $this->upload
        )
            ->uploadFileByImportId(
                $import_id,
                $title,
                $replace
            );
    }


    public function uploadFileByRefId(int $ref_id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return UploadFileCommand::new(
            $this,
            $this->upload
        )
            ->uploadFileByRefId(
                $ref_id,
                $title,
                $replace
            );
    }
}
