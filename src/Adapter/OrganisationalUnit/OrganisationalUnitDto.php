<?php

namespace FluxIliasRestApi\Adapter\OrganisationalUnit;

class OrganisationalUnitDto
{

    private function __construct(
        public readonly ?int $id,
        public readonly ?int $ref_id,
        public readonly ?int $created,
        public readonly ?int $updated,
        public readonly ?int $parent_id,
        public readonly ?string $parent_external_id,
        public readonly ?int $parent_ref_id,
        public readonly ?string $url,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?int $type_id,
        public readonly ?string $external_id,
        public readonly ?int $didactic_template_id
    ) {

    }


    public static function new(
        ?int $id = null,
        ?int $ref_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $parent_id = null,
        ?string $parent_external_id = null,
        ?int $parent_ref_id = null,
        ?string $url = null,
        ?string $title = null,
        ?string $description = null,
        ?int $type_id = null,
        ?string $external_id = null,
        ?int $didactic_template_id = null
    ) : static {
        return new static(
            $id,
            $ref_id,
            $created,
            $updated,
            $parent_id,
            $parent_external_id,
            $parent_ref_id,
            $url,
            $title,
            $description,
            $type_id,
            $external_id,
            $didactic_template_id
        );
    }


    public static function newFromObject(
        object $organisational_unit
    ) : static {
        return static::new(
            $organisational_unit->id ?? null,
            $organisational_unit->ref_id ?? null,
            $organisational_unit->created ?? null,
            $organisational_unit->updated ?? null,
            $organisational_unit->parent_id ?? null,
            $organisational_unit->parent_external_id ?? null,
            $organisational_unit->parent_ref_id ?? null,
            $organisational_unit->url ?? null,
            $organisational_unit->title ?? null,
            $organisational_unit->description ?? null,
            $organisational_unit->type_id ?? null,
            $organisational_unit->external_id ?? null,
            $organisational_unit->didactic_template_id ?? null
        );
    }
}
