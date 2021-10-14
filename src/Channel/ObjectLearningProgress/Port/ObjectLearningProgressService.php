<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\ObjectLearningProgress\Port;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\ObjectLearningProgressIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
use Fluxlabs\FluxIliasRestApi\Channel\ObjectLearningProgress\Command\GetObjectLearningProgressCommand;
use Fluxlabs\FluxIliasRestApi\Channel\ObjectLearningProgress\Command\UpdateObjectLearningProgressCommand;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use ilDBInterface;

class ObjectLearningProgressService
{

    private ilDBInterface $database;
    private ObjectService $object;
    private UserService $user;


    public static function new(ilDBInterface $database, ObjectService $object, UserService $user) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->object = $object;
        $service->user = $user;

        return $service;
    }


    public function getObjectLearningProgress(
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?string $learning_progress = null
    ) : array {
        return GetObjectLearningProgressCommand::new(
            $this->database
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


    public function updateObjectLearningProgressByIdByUserId(int $id, int $user_id, string $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return UpdateObjectLearningProgressCommand::new(
            $this->object,
            $this->user
        )
            ->updateObjectLearningProgressByIdByUserId(
                $id,
                $user_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByIdByUserImportId(int $id, string $user_import_id, string $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return UpdateObjectLearningProgressCommand::new(
            $this->object,
            $this->user
        )
            ->updateObjectLearningProgressByIdByUserImportId(
                $id,
                $user_import_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByImportIdByUserId(string $import_id, int $user_id, string $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return UpdateObjectLearningProgressCommand::new(
            $this->object,
            $this->user
        )
            ->updateObjectLearningProgressByImportIdByUserId(
                $import_id,
                $user_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByImportIdByUserImportId(string $import_id, string $user_import_id, string $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return UpdateObjectLearningProgressCommand::new(
            $this->object,
            $this->user
        )
            ->updateObjectLearningProgressByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByRefIdByUserId(int $ref_id, int $user_id, string $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return UpdateObjectLearningProgressCommand::new(
            $this->object,
            $this->user
        )
            ->updateObjectLearningProgressByRefIdByUserId(
                $ref_id,
                $user_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByRefIdByUserImportId(int $ref_id, string $user_import_id, string $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return UpdateObjectLearningProgressCommand::new(
            $this->object,
            $this->user
        )
            ->updateObjectLearningProgressByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $learning_progress
            );
    }
}
