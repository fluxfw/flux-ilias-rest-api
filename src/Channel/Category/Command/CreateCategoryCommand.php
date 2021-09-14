<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Category\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Category\CategoryDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Category\CategoryQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;

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
                $parent_id
            ),
            $diff
        );
    }


    public function createCategoryToImportId(string $parent_import_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createCategory(
            $this->object->getObjectByImportId(
                $parent_import_id
            ),
            $diff
        );
    }


    public function createCategoryToRefId(int $parent_ref_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createCategory(
            $this->object->getObjectByRefId(
                $parent_ref_id
            ),
            $diff
        );
    }


    private function createCategory(?ObjectDto $parent_object, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        if ($parent_object === null) {
            return null;
        }

        $ilias_category = $this->newIliasCategory();

        $this->mapDiff(
            $diff,
            $ilias_category
        );

        $ilias_category->create();
        $ilias_category->createReference();
        $ilias_category->putInTree($parent_object->getRefId());

        return ObjectIdDto::new(
            $ilias_category->getId() ?: null,
            $diff->getImportId(),
            $ilias_category->getRefId() ?: null
        );
    }
}
