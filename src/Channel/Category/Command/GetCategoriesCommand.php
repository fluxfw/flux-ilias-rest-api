<?php

namespace FluxIliasRestApi\Channel\Category\Command;

use FluxIliasRestApi\Channel\Category\CategoryQuery;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use ilDBInterface;

class GetCategoriesCommand
{

    use CategoryQuery;
    use ObjectQuery;

    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        ilDBInterface $ilias_database
    ) : /*static*/ self
    {
        return new static(
            $ilias_database
        );
    }


    public function getCategories(?bool $in_trash = null) : array
    {
        return array_map([$this, "mapCategoryDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getCategoryQuery(
            null,
            null,
            null,
            $in_trash
        ))));
    }
}
