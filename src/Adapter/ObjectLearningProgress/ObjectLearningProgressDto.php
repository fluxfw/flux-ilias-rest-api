<?php

namespace FluxIliasRestApi\Adapter\ObjectLearningProgress;

class ObjectLearningProgressDto
{

    private function __construct(
        public readonly ?int $object_id,
        public readonly ?string $object_import_id,
        public readonly ?int $object_ref_id,
        public readonly ?int $user_id,
        public readonly ?string $user_import_id,
        public readonly ?ObjectLearningProgress $learning_progress
    ) {

    }


    public static function new(
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?ObjectLearningProgress $learning_progress = null
    ) : static {
        return new static(
            $object_id,
            $object_import_id,
            $object_ref_id,
            $user_id,
            $user_import_id,
            $learning_progress
        );
    }


    public static function newFromObject(
        object $object_learning_progress
    ) : static {
        return static::new(
            $object_learning_progress->object_id ?? null,
            $object_learning_progress->object_import_id ?? null,
            $object_learning_progress->object_ref_id ?? null,
            $object_learning_progress->user_id ?? null,
            $object_learning_progress->user_import_id ?? null,
            ($learning_progress = $object_learning_progress->learning_progress ?? null) !== null ? ObjectLearningProgress::from($learning_progress) : null
        );
    }
}
