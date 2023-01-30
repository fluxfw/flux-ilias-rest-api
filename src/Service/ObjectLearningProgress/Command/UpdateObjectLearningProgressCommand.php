<?php

namespace FluxIliasRestApi\Service\ObjectLearningProgress\Command;

use FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasBaseApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;
use FluxIliasBaseApi\Adapter\ObjectLearningProgress\ObjectLearningProgressIdDto;
use FluxIliasBaseApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\ObjectLearningProgress\ObjectLearningProgressMapping;
use FluxIliasRestApi\Service\ObjectLearningProgress\ObjectLearningProgressQuery;
use FluxIliasRestApi\Service\User\Port\UserService;
use ilLPStatus;

class UpdateObjectLearningProgressCommand
{

    use ObjectLearningProgressQuery;

    private function __construct(
        private readonly ObjectService $object_service,
        private readonly UserService $user_service
    ) {

    }


    public static function new(
        ObjectService $object_service,
        UserService $user_service
    ) : static {
        return new static(
            $object_service,
            $user_service
        );
    }


    public function updateObjectLearningProgressByIdByUserId(int $id, int $user_id, ObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->updateObjectLearningProgress(
            $this->object_service->getObjectById(
                $id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $learning_progress
        );
    }


    public function updateObjectLearningProgressByIdByUserImportId(int $id, string $user_import_id, ObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->updateObjectLearningProgress(
            $this->object_service->getObjectById(
                $id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $learning_progress
        );
    }


    public function updateObjectLearningProgressByImportIdByUserId(string $import_id, int $user_id, ObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->updateObjectLearningProgress(
            $this->object_service->getObjectByImportId(
                $import_id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $learning_progress
        );
    }


    public function updateObjectLearningProgressByImportIdByUserImportId(string $import_id, string $user_import_id, ObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->updateObjectLearningProgress(
            $this->object_service->getObjectByImportId(
                $import_id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $learning_progress
        );
    }


    public function updateObjectLearningProgressByRefIdByUserId(int $ref_id, int $user_id, ObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->updateObjectLearningProgress(
            $this->object_service->getObjectByRefId(
                $ref_id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $learning_progress
        );
    }


    public function updateObjectLearningProgressByRefIdByUserImportId(int $ref_id, string $user_import_id, ObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->updateObjectLearningProgress(
            $this->object_service->getObjectByRefId(
                $ref_id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $learning_progress
        );
    }


    private function updateObjectLearningProgress(?ObjectDto $object, ?UserDto $user, ObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        if ($object === null || $user === null) {
            return null;
        }

        ilLPStatus::writeStatus($object->id, $user->id, ObjectLearningProgressMapping::mapExternalToInternal($learning_progress)->value);

        return ObjectLearningProgressIdDto::new(
            $object->id,
            $object->import_id,
            $object->ref_id,
            $user->id,
            $user->import_id
        );
    }
}
