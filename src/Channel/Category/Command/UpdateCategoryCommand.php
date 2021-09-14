<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Category\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Category\CategoryDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Category\CategoryDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Category\CategoryQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Category\Port\CategoryService;

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
                $id
            ),
            $diff
        );
    }


    public function updateCategoryByImportId(string $import_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCategory(
            $this->category->getCategoryByImportId(
                $import_id
            ),
            $diff
        );
    }


    public function updateCategoryByRefId(int $ref_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCategory(
            $this->category->getCategoryByRefId(
                $ref_id
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
            $category->getRefId()
        );
        if ($ilias_category === null) {
            return null;
        }

        $this->mapDiff(
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
