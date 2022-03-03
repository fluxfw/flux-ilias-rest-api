<?php

namespace FluxIliasRestApi\Channel\Category\Command;

use FluxIliasRestApi\Channel\Category\CategoryQuery;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use ilDBInterface;

class GetCategoriesCommand
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


    public function getCategories(?bool $in_trash = null) : array
    {
        return array_map([$this, "mapCategoryDto"], $this->database->fetchAll($this->database->query($this->getCategoryQuery(
            null,
            null,
            null,
            $in_trash
        ))));
    }
}
