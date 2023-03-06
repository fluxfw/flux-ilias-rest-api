<?php

namespace FluxIliasRestApi\Adapter\OrganisationalUnit;

class OrganisationalUnitDiffDto
{

    private function __construct(
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?int $type_id,
        public readonly ?string $external_id,
        public readonly ?int $didactic_template_id
    ) {

    }


    public static function new(
        ?string $title = null,
        ?string $description = null,
        ?int $type_id = null,
        ?string $external_id = null,
        ?int $didactic_template_id = null
    ) : static {
        return new static(
            $title,
            $description,
            $type_id,
            $external_id,
            $didactic_template_id
        );
    }


    public static function newFromObject(
        object $diff
    ) : static {
        return static::new(
            $diff->title ?? null,
            $diff->description ?? null,
            $diff->type_id ?? null,
            $diff->external_id ?? null,
            $diff->didactic_template_id ?? null
        );
    }
}
