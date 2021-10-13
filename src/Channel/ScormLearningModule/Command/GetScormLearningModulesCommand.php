<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule\Command;

use Fluxlabs\FluxIliasRestApi\Channel\Object\ObjectQuery;
use Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule\ScormLearningModuleQuery;
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


    public function getScormLearningModules() : array
    {
        return array_map([$this, "mapScormLearningModuleDto"], $this->database->fetchAll($this->database->query($this->getScormLearningModuleQuery())));
    }
}
