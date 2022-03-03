<?php

namespace FluxIliasRestApi\Channel\Category\Port;

use FluxIliasRestApi\Adapter\Api\Category\CategoryDiffDto;
use FluxIliasRestApi\Adapter\Api\Category\CategoryDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Category\Command\CreateCategoryCommand;
use FluxIliasRestApi\Channel\Category\Command\GetCategoriesCommand;
use FluxIliasRestApi\Channel\Category\Command\GetCategoryCommand;
use FluxIliasRestApi\Channel\Category\Command\UpdateCategoryCommand;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilDBInterface;

class CategoryService
{

    private ilDBInterface $database;
    private ObjectService $object;


    public static function new(ilDBInterface $database, ObjectService $object) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->object = $object;

        return $service;
    }


    public function createCategoryToId(int $parent_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCategoryCommand::new(
            $this->object
        )
            ->createCategoryToId(
                $parent_id,
                $diff
            );
    }


    public function createCategoryToImportId(string $parent_import_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCategoryCommand::new(
            $this->object
        )
            ->createCategoryToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createCategoryToRefId(int $parent_ref_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCategoryCommand::new(
            $this->object
        )
            ->createCategoryToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getCategories(?bool $in_trash = null) : array
    {
        return GetCategoriesCommand::new(
            $this->database
        )
            ->getCategories(
                $in_trash
            );
    }


    public function getCategoryById(int $id, ?bool $in_trash = null) : ?CategoryDto
    {
        return GetCategoryCommand::new(
            $this->database
        )
            ->getCategoryById(
                $id,
                $in_trash
            );
    }


    public function getCategoryByImportId(string $import_id, ?bool $in_trash = null) : ?CategoryDto
    {
        return GetCategoryCommand::new(
            $this->database
        )
            ->getCategoryByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getCategoryByRefId(int $ref_id, ?bool $in_trash = null) : ?CategoryDto
    {
        return GetCategoryCommand::new(
            $this->database
        )
            ->getCategoryByRefId(
                $ref_id,
                $in_trash
            );
    }


    public function updateCategoryById(int $id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateCategoryCommand::new(
            $this
        )
            ->updateCategoryById(
                $id,
                $diff
            );
    }


    public function updateCategoryByImportId(string $import_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateCategoryCommand::new(
            $this
        )
            ->updateCategoryByImportId(
                $import_id,
                $diff
            );
    }


    public function updateCategoryByRefId(int $ref_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateCategoryCommand::new(
            $this
        )
            ->updateCategoryByRefId(
                $ref_id,
                $diff
            );
    }
}
