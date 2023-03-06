<?php

namespace FluxIliasRestApi\Service\File\Command;

use FluxIliasRestApi\Adapter\File\FileDiffDto;
use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Service\File\FileQuery;
use FluxIliasRestApi\Service\Object\Port\ObjectService;

class CreateFileCommand
{

    use FileQuery;

    private function __construct(
        private readonly ObjectService $object_service
    ) {

    }


    public static function new(
        ObjectService $object_service
    ) : static {
        return new static(
            $object_service
        );
    }


    public function createFileToId(int $parent_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createFile(
            $this->object_service->getObjectById(
                $parent_id,
                false
            ),
            $diff
        );
    }


    public function createFileToImportId(string $parent_import_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createFile(
            $this->object_service->getObjectByImportId(
                $parent_import_id,
                false
            ),
            $diff
        );
    }


    public function createFileToRefId(int $parent_ref_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createFile(
            $this->object_service->getObjectByRefId(
                $parent_ref_id,
                false
            ),
            $diff
        );
    }


    private function createFile(?ObjectDto $parent_object, FileDiffDto $diff) : ?ObjectIdDto
    {
        if ($parent_object === null || $parent_object->ref_id === null) {
            return null;
        }

        $ilias_file = $this->newIliasFile();

        $ilias_file->setTitle($diff->title ?? "");

        $ilias_file->create();
        $ilias_file->createReference();
        $ilias_file->putInTree($parent_object->ref_id);
        $ilias_file->setPermissions($parent_object->ref_id);

        $this->mapFileDiff(
            $diff,
            $ilias_file
        );

        $ilias_file->update();

        return ObjectIdDto::new(
            $ilias_file->getId() ?: null,
            $diff->import_id,
            $ilias_file->getRefId() ?: null
        );
    }
}
