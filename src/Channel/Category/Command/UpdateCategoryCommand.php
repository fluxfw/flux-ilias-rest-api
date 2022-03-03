<?php

namespace FluxIliasRestApi\Channel\Category\Command;

use FluxIliasRestApi\Adapter\Api\Category\CategoryDiffDto;
use FluxIliasRestApi\Adapter\Api\Category\CategoryDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Category\CategoryQuery;
use FluxIliasRestApi\Channel\Category\Port\CategoryService;

class UpdateCategoryCommand
{

    use CategoryQuery;

    private CategoryService $category;


    public static function new(CategoryService $category) : /*static*/ self
    {
        $command = new static();

        $command->category = $category;

        return $command;
    }


    public function updateCategoryById(int $id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCategory(
            $this->category->getCategoryById(
                $id,
                false
            ),
            $diff
        );
    }


    public function updateCategoryByImportId(string $import_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCategory(
            $this->category->getCategoryByImportId(
                $import_id,
                false
            ),
            $diff
        );
    }


    public function updateCategoryByRefId(int $ref_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCategory(
            $this->category->getCategoryByRefId(
                $ref_id,
                false
            ),
            $diff
        );
    }


    private function updateCategory(?CategoryDto $category, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        if ($category === null) {
            return null;
        }

        $ilias_category = $this->getIliasCategory(
            $category->getId(),
            $category->getRefId()
        );
        if ($ilias_category === null) {
            return null;
        }

        $this->mapCategoryDiff(
            $diff,
            $ilias_category
        );

        $ilias_category->update();

        return ObjectIdDto::new(
            $category->getId(),
            $diff->getImportId() ?? $category->getImportId(),
            $category->getRefId()
        );
    }
}
