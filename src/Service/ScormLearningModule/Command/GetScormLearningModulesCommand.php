<?php

namespace FluxIliasRestApi\Service\ScormLearningModule\Command;

use FluxIliasRestApi\Adapter\ScormLearningModule\ScormLearningModuleDto;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use FluxIliasRestApi\Service\ScormLearningModule\ScormLearningModuleQuery;
use FluxIliasRestApi\Service\Timestamp\TimestampQuery;
use ilDBInterface;

class GetScormLearningModulesCommand
{

    use ObjectQuery;
    use ScormLearningModuleQuery;
    use TimestampQuery;

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
     * @return ScormLearningModuleDto[]
     */
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
