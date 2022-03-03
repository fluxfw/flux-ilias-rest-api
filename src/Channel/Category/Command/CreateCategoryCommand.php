<?php

namespace FluxIliasRestApi\Channel\Category\Command;

use FluxIliasRestApi\Adapter\Api\Category\CategoryDiffDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Category\CategoryQuery;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;

class CreateCategoryCommand
{

    use CategoryQuery;

    private ObjectService $object;


    public static function new(ObjectService $object) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;

        return $command;
    }


    public function createCategoryToId(int $parent_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createCategory(
            $this->object->getObjectById(
                $parent_id,
                false
            ),
            $diff
        );
    }


    public function createCategoryToImportId(string $parent_import_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createCategory(
            $this->object->getObjectByImportId(
                $parent_import_id,
                false
            ),
            $diff
        );
    }


    public function createCategoryToRefId(int $parent_ref_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createCategory(
            $this->object->getObjectByRefId(
                $parent_ref_id,
                false
            ),
            $diff
        );
    }


    private function createCategory(?ObjectDto $parent_object, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        if ($parent_object === null || $parent_object->getRefId() === null) {
            return null;
        }

        $ilias_category = $this->newIliasCategory();

        $ilias_category->setTitle($diff->getTitle() ?? "");

        $ilias_category->create();
        $ilias_category->createReference();
        $ilias_category->putInTree($parent_object->getRefId());
        $ilias_category->setPermissions($parent_object->getRefId());

        $this->mapCategoryDiff(
            $diff,
            $ilias_category
        );

        $ilias_category->update();

        return ObjectIdDto::new(
            $ilias_category->getId() ?: null,
            $diff->getImportId(),
            $ilias_category->getRefId() ?: null
        );
    }
}
