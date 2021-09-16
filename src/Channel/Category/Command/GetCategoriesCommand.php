<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Category\Command;

use Fluxlabs\FluxIliasRestApi\Channel\Category\CategoryQuery;
use ilDBInterface;

class GetCategoriesCommand
{

    use CategoryQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getCategories() : array
    {
        return array_map([$this, "mapDto"], $this->database->fetchAll($this->database->query($this->getCategoryQuery())));
    }
}
