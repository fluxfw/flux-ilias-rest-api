<?php

namespace FluxIliasRestApi\Channel\ObjectLearningProgress\Command;

use FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\LegacyObjectLearningProgress;
use FluxIliasRestApi\Channel\ObjectLearningProgress\ObjectLearningProgressQuery;
use ilDBInterface;

class GetObjectLearningProgressCommand
{

    use ObjectLearningProgressQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getObjectLearningProgress(
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?LegacyObjectLearningProgress $learning_progress = null
    ) : array {
        return array_map([$this, "mapObjectLearningProgressDto"], $this->database->fetchAll($this->database->query($this->getObjectLearningProgressQuery(
            $object_id,
            $object_import_id,
            $object_ref_id,
            $user_id,
            $user_import_id,
            $learning_progress
        ))));
    }
}
