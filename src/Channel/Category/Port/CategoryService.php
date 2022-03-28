<?php

namespace FluxIliasRestApi\Channel\Category\Port;

use FluxIliasRestApi\Adapter\Category\CategoryDiffDto;
use FluxIliasRestApi\Adapter\Category\CategoryDto;
use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Category\Command\CreateCategoryCommand;
use FluxIliasRestApi\Channel\Category\Command\GetCategoriesCommand;
use FluxIliasRestApi\Channel\Category\Command\GetCategoryCommand;
use FluxIliasRestApi\Channel\Category\Command\UpdateCategoryCommand;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilDBInterface;

class CategoryService
{

    private ilDBInterface $ilias_database;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ObjectService $object_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->object_service = $object_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        ObjectService $object_service
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $object_service
        );
    }


    public function createCategoryToId(int $parent_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCategoryCommand::new(
            $this->object_service
        )
            ->createCategoryToId(
                $parent_id,
                $diff
            );
    }


    public function createCategoryToImportId(string $parent_import_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCategoryCommand::new(
            $this->object_service
        )
            ->createCategoryToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createCategoryToRefId(int $parent_ref_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCategoryCommand::new(
            $this->object_service
        )
            ->createCategoryToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getCategories(?bool $in_trash = null) : array
    {
        return GetCategoriesCommand::new(
            $this->ilias_database
        )
            ->getCategories(
                $in_trash
            );
    }


    public function getCategoryById(int $id, ?bool $in_trash = null) : ?CategoryDto
    {
        return GetCategoryCommand::new(
            $this->ilias_database
        )
            ->getCategoryById(
                $id,
                $in_trash
            );
    }


    public function getCategoryByImportId(string $import_id, ?bool $in_trash = null) : ?CategoryDto
    {
        return GetCategoryCommand::new(
            $this->ilias_database
        )
            ->getCategoryByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getCategoryByRefId(int $ref_id, ?bool $in_trash = null) : ?CategoryDto
    {
        return GetCategoryCommand::new(
            $this->ilias_database
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
