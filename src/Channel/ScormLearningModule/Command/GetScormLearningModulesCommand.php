<?php

namespace FluxIliasRestApi\Channel\ScormLearningModule\Command;

use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\ScormLearningModule\ScormLearningModuleQuery;
use ilDBInterface;

class GetScormLearningModulesCommand
{

    use ObjectQuery;
    use ScormLearningModuleQuery;

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


    public function getScormLearningModules(?bool $in_trash = null) : array
    {
        return array_map([$this, "mapScormLearningModuleDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getScormLearningModuleQuery(
            null,
            null,
            null,
            $in_trash
        ))));
    }
}
