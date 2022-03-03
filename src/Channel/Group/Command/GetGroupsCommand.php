<?php

namespace FluxIliasRestApi\Channel\Group\Command;

use FluxIliasRestApi\Channel\Group\GroupQuery;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use ilDBInterface;

class GetGroupsCommand
{

    use GroupQuery;
    use ObjectQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getGroups(?bool $in_trash = null) : array
    {
        return array_map([$this, "mapGroupDto"], $this->database->fetchAll($this->database->query($this->getGroupQuery(
            null,
            null,
            null,
            $in_trash
        ))));
    }
}
