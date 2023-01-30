<?php

namespace FluxIliasRestApi\Service\ObjectLearningProgress\Command;

use FluxIliasBaseApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;
use FluxIliasBaseApi\Adapter\ObjectLearningProgress\ObjectLearningProgressDto;
use FluxIliasRestApi\Service\ObjectLearningProgress\ObjectLearningProgressQuery;
use ilDBInterface;

class GetObjectLearningProgressCommand
{

    use ObjectLearningProgressQuery;

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
     * @return ObjectLearningProgressDto[]
     */
    public function getObjectLearningProgress(
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?ObjectLearningProgress $learning_progress = null
    ) : array {
        return array_map([$this, "mapObjectLearningProgressDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getObjectLearningProgressQuery(
            $object_id,
            $object_import_id,
            $object_ref_id,
            $user_id,
            $user_import_id,
            $learning_progress
        ))));
    }
}
