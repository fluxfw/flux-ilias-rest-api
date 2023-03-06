<?php

namespace FluxIliasRestApi\Service\ObjectLearningProgress\Port;

use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;
use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgressDto;
use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgressIdDto;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\ObjectLearningProgress\Command\GetObjectLearningProgressCommand;
use FluxIliasRestApi\Service\ObjectLearningProgress\Command\UpdateObjectLearningProgressCommand;
use FluxIliasRestApi\Service\User\Port\UserService;
use ilDBInterface;

class ObjectLearningProgressService
{

    private function __construct(
        private readonly ilDBInterface $ilias_database,
        private readonly ObjectService $object_service,
        private readonly UserService $user_service
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database,
        ObjectService $object_service,
        UserService $user_service
    ) : static {
        return new static(
            $ilias_database,
            $object_service,
            $user_service
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
        return GetObjectLearningProgressCommand::new(
            $this->ilias_database
        )
            ->getObjectLearningProgress(
                $object_id,
                $object_import_id,
                $object_ref_id,
                $user_id,
                $user_import_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByIdByUserId(int $id, int $user_id, ObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return UpdateObjectLearningProgressCommand::new(
            $this->object_service,
            $this->user_service
        )
            ->updateObjectLearningProgressByIdByUserId(
                $id,
                $user_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByIdByUserImportId(int $id, string $user_import_id, ObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return UpdateObjectLearningProgressCommand::new(
            $this->object_service,
            $this->user_service
        )
            ->updateObjectLearningProgressByIdByUserImportId(
                $id,
                $user_import_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByImportIdByUserId(string $import_id, int $user_id, ObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return UpdateObjectLearningProgressCommand::new(
            $this->object_service,
            $this->user_service
        )
            ->updateObjectLearningProgressByImportIdByUserId(
                $import_id,
                $user_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByImportIdByUserImportId(string $import_id, string $user_import_id, ObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return UpdateObjectLearningProgressCommand::new(
            $this->object_service,
            $this->user_service
        )
            ->updateObjectLearningProgressByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByRefIdByUserId(int $ref_id, int $user_id, ObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return UpdateObjectLearningProgressCommand::new(
            $this->object_service,
            $this->user_service
        )
            ->updateObjectLearningProgressByRefIdByUserId(
                $ref_id,
                $user_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByRefIdByUserImportId(int $ref_id, string $user_import_id, ObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return UpdateObjectLearningProgressCommand::new(
            $this->object_service,
            $this->user_service
        )
            ->updateObjectLearningProgressByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $learning_progress
            );
    }
}
