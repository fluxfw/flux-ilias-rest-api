<?php

namespace FluxIliasRestApi\Channel\File\Command;

use FluxIliasRestApi\Adapter\Api\File\FileDiffDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\File\FileQuery;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;

class CreateFileCommand
{

    use FileQuery;

    private ObjectService $object;


    public static function new(ObjectService $object) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;

        return $command;
    }


    public function createFileToId(int $parent_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createFile(
            $this->object->getObjectById(
                $parent_id
            ),
            $diff
        );
    }


    public function createFileToImportId(string $parent_import_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createFile(
            $this->object->getObjectByImportId(
                $parent_import_id
            ),
            $diff
        );
    }


    public function createFileToRefId(int $parent_ref_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createFile(
            $this->object->getObjectByRefId(
                $parent_ref_id
            ),
            $diff
        );
    }


    private function createFile(?ObjectDto $parent_object, FileDiffDto $diff) : ?ObjectIdDto
    {
        if ($parent_object === null || $parent_object->getRefId() === null) {
            return null;
        }

        $ilias_file = $this->newIliasFile();

        $ilias_file->setTitle($diff->getTitle() ?? "");

        $ilias_file->create();
        $ilias_file->createReference();
        $ilias_file->putInTree($parent_object->getRefId());
        $ilias_file->setPermissions($parent_object->getRefId());

        $this->mapFileDiff(
            $diff,
            $ilias_file
        );

        $ilias_file->update();

        return ObjectIdDto::new(
            $ilias_file->getId() ?: null,
            $diff->getImportId(),
            $ilias_file->getRefId() ?: null
        );
    }
}
