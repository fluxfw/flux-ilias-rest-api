<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Category\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Category\CategoryDto;
use Fluxlabs\FluxIliasRestApi\Channel\Category\CategoryQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Object\ObjectQuery;
use ilDBInterface;
use LogicException;

class GetCategoryCommand
{

    use CategoryQuery;
    use ObjectQuery;

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
        while (($category_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCategoryQuery(
                $id
            )))) !== null) {
            if ($category !== null) {
                throw new LogicException("Multiple categories found with the id " . $id);
            }
            $category = $this->mapCategoryDto(
                $category_
            );
        }

        return $category;
    }


    public function getCategoryByImportId(string $import_id) : ?CategoryDto
    {
        $category = null;
        while (($category_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCategoryQuery(
                null,
                $import_id
            )))) !== null) {
            if ($category !== null) {
                throw new LogicException("Multiple categories found with the import id " . $import_id);
            }
            $category = $this->mapCategoryDto(
                $category_
            );
        }

        return $category;
    }


    public function getCategoryByRefId(int $ref_id) : ?CategoryDto
    {
        $category = null;
        while (($category_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCategoryQuery(
                null,
                null,
                $ref_id
            )))) !== null) {
            if ($category !== null) {
                throw new LogicException("Multiple categories found with the ref id " . $ref_id);
            }
            $category = $this->mapCategoryDto(
                $category_
            );
        }

        return $category;
    }
}
