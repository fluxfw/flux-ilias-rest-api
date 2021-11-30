<?php

namespace FluxIliasRestApi\Adapter\Api\ObjectLearningProgress;

use JsonSerializable;

class ObjectLearningProgressDto implements JsonSerializable
{

    private ?LegacyObjectLearningProgress $learning_progress;
    private ?int $object_id;
    private ?string $object_import_id;
    private ?int $object_ref_id;
    private ?int $user_id;
    private ?string $user_import_id;


    public static function new(
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?LegacyObjectLearningProgress $learning_progress = null
    ) : /*static*/ self
    {
        $dto = new static();

        $dto->object_id = $object_id;
        $dto->object_import_id = $object_import_id;
        $dto->object_ref_id = $object_ref_id;
        $dto->user_id = $user_id;
        $dto->user_import_id = $user_import_id;
        $dto->learning_progress = $learning_progress;

        return $dto;
    }


    public function getLearningProgress() : ?LegacyObjectLearningProgress
    {
        return $this->learning_progress;
    }


    public function getObjectId() : ?int
    {
        return $this->object_id;
    }


    public function getObjectImportId() : ?string
    {
        return $this->object_import_id;
    }


    public function getObjectRefId() : ?int
    {
        return $this->object_ref_id;
    }


    public function getUserId() : ?int
    {
        return $this->user_id;
    }


    public function getUserImportId() : ?string
    {
        return $this->user_import_id;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
