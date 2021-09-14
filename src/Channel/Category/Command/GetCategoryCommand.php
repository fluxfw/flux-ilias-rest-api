<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Category\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Category\CategoryDto;
use Fluxlabs\FluxIliasRestApi\Channel\Category\CategoryQuery;
use ilDBInterface;
use LogicException;

class GetCategoryCommand
{

    use CategoryQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getCategoryById(int $id) : ?CategoryDto
    {
        $category = null;
        while (($category_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCategoriesQuery(
                $id
            )))) !== null) {
            if ($category !== null) {
                throw new LogicException("Multiple categories found with the id " . $id);
            }
            $category = $this->mapDto($category_);
        }

        return $category;
    }


    public function getCategoryByImportId(string $import_id) : ?CategoryDto
    {
        $category = null;
        while (($category_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCategoriesQuery(
                null,
                $import_id
            )))) !== null) {
            if ($category !== null) {
                throw new LogicException("Multiple categories found with the import id " . $import_id);
            }
            $category = $this->mapDto($category_);
        }

        return $category;
    }


    public function getCategoryByRefId(int $ref_id) : ?CategoryDto
    {
        $category = null;
        while (($category_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCategoriesQuery(
                null,
                null,
                $ref_id
            )))) !== null) {
            if ($category !== null) {
                throw new LogicException("Multiple categories found with the ref id " . $ref_id);
            }
            $category = $this->mapDto($category_);
        }

        return $category;
    }
}
