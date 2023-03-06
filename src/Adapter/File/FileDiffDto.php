<?php

namespace FluxIliasRestApi\Adapter\File;

class FileDiffDto
{

    private function __construct(
        public readonly ?string $import_id,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?int $didactic_template_id
    ) {

    }


    public static function new(
        ?string $import_id = null,
        ?string $title = null,
        ?string $description = null,
        ?int $didactic_template_id = null
    ) : static {
        return new static(
            $import_id,
            $title,
            $description,
            $didactic_template_id
        );
    }


    public static function newFromObject(
        object $diff
    ) : static {
        return static::new(
            $diff->import_id ?? null,
            $diff->title ?? null,
            $diff->description ?? null,
            $diff->didactic_template_id ?? null
        );
    }
}
