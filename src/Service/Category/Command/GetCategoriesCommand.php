<?php

namespace FluxIliasRestApi\Service\Category\Command;

use FluxIliasRestApi\Adapter\Category\CategoryDto;
use FluxIliasRestApi\Service\Category\CategoryQuery;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use ilDBInterface;

class GetCategoriesCommand
{

    use CategoryQuery;
    use ObjectQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $ilias_database
        );
    }


    /**
     * @return CategoryDto[]
     */
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
