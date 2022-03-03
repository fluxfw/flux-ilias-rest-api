<?php

namespace FluxIliasRestApi\Channel\ObjectLearningProgress\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\LegacyObjectLearningProgress;
use FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\ObjectLearningProgressIdDto;
use FluxIliasRestApi\Adapter\Api\User\UserDto;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use FluxIliasRestApi\Channel\ObjectLearningProgress\ObjectLearningProgressMapping;
use FluxIliasRestApi\Channel\ObjectLearningProgress\ObjectLearningProgressQuery;
use FluxIliasRestApi\Channel\User\Port\UserService;
use ilLPStatus;

class UpdateObjectLearningProgressCommand
{

    use ObjectLearningProgressQuery;

    private ObjectService $object;
    private UserService $user;


    public static function new(ObjectService $object, UserService $user) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;
        $command->user = $user;

        return $command;
    }


    public function updateObjectLearningProgressByIdByUserId(int $id, int $user_id, LegacyObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->updateObjectLearningProgress(
            $this->object->getObjectById(
                $id,
                false
            ),
            $this->user->getUserById(
                $user_id
            ),
            $learning_progress
        );
    }


    public function updateObjectLearningProgressByIdByUserImportId(int $id, string $user_import_id, LegacyObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->updateObjectLearningProgress(
            $this->object->getObjectById(
                $id,
                false
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $learning_progress
        );
    }


    public function updateObjectLearningProgressByImportIdByUserId(string $import_id, int $user_id, LegacyObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->updateObjectLearningProgress(
            $this->object->getObjectByImportId(
                $import_id,
                false
            ),
            $this->user->getUserById(
                $user_id
            ),
            $learning_progress
        );
    }


    public function updateObjectLearningProgressByImportIdByUserImportId(string $import_id, string $user_import_id, LegacyObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->updateObjectLearningProgress(
            $this->object->getObjectByImportId(
                $import_id,
                false
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $learning_progress
        );
    }


    public function updateObjectLearningProgressByRefIdByUserId(int $ref_id, int $user_id, LegacyObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->updateObjectLearningProgress(
            $this->object->getObjectByRefId(
                $ref_id,
                false
            ),
            $this->user->getUserById(
                $user_id
            ),
            $learning_progress
        );
    }


    public function updateObjectLearningProgressByRefIdByUserImportId(int $ref_id, string $user_import_id, LegacyObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->updateObjectLearningProgress(
            $this->object->getObjectByRefId(
                $ref_id,
                false
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $learning_progress
        );
    }


    private function updateObjectLearningProgress(?ObjectDto $object, ?UserDto $user, LegacyObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        if ($object === null || $user === null) {
            return null;
        }

        ilLPStatus::writeStatus($object->getId(), $user->getId(), ObjectLearningProgressMapping::mapExternalToInternal($learning_progress)->value);

        return ObjectLearningProgressIdDto::new(
            $object->getId(),
            $object->getImportId(),
            $object->getRefId(),
            $user->getId(),
            $user->getImportId()
        );
    }
}
