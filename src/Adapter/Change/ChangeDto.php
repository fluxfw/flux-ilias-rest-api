<?php

namespace FluxIliasRestApi\Adapter\Change;

class ChangeDto
{

    private function __construct(
        public readonly ?int $id,
        public readonly ?ChangeType $type,
        public readonly ?float $time,
        public readonly ?int $user_id,
        public readonly ?string $user_import_id,
        public readonly ?object $data
    ) {

    }


    public static function new(
        ?int $id = null,
        ?ChangeType $type = null,
        ?float $time = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?object $data = null
    ) : static {
        return new static(
            $id,
            $type,
            $time,
            $user_id,
            $user_import_id,
            $data
        );
    }


    public static function newFromObject(
        object $change
    ) : static {
        return static::new(
            $change->id ?? null,
            ($type = $change->type ?? null) !== null ? ChangeType::from(
                $type
            ) : null,
            $change->time ?? null,
            $change->user_id ?? null,
            $change->user_import_id ?? null,
            $change->data ?? null
        );
    }
}
