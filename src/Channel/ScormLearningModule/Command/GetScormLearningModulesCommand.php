<?php

namespace FluxIliasRestApi\Channel\ScormLearningModule\Command;

use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\ScormLearningModule\ScormLearningModuleQuery;
use ilDBInterface;

class GetScormLearningModulesCommand
{

    use ObjectQuery;
    use ScormLearningModuleQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getScormLearningModules(?bool $in_trash = null) : array
    {
        return array_map([$this, "mapScormLearningModuleDto"], $this->database->fetchAll($this->database->query($this->getScormLearningModuleQuery(
            null,
            null,
            null,
            $in_trash
        ))));
    }
}
