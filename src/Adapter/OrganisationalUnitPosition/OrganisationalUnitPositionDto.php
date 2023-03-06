<?php

namespace FluxIliasRestApi\Adapter\OrganisationalUnitPosition;

class OrganisationalUnitPositionDto
{

    /**
     * @param OrganisationalUnitPositionAuthorityDto[]|null $authorities
     */
    private function __construct(
        public readonly ?int $id,
        public readonly ?bool $core_position,
        public readonly ?OrganisationalUnitPositionCoreIdentifier $core_identifier,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?array $authorities
    ) {

    }


    /**
     * @param OrganisationalUnitPositionAuthorityDto[]|null $authorities
     */
    public static function new(
        ?int $id = null,
        ?bool $core_position = null,
        ?OrganisationalUnitPositionCoreIdentifier $core_identifier = null,
        ?string $title = null,
        ?string $description = null,
        ?array $authorities = null
    ) : static {
        return new static(
            $id,
            $core_position,
            $core_identifier,
            $title,
            $description,
            $authorities
        );
    }


    public static function newFromObject(
        object $organisational_unit_position
    ) : static {
        return static::new(
            $organisational_unit_position->id ?? null,
            $organisational_unit_position->core_position ?? null,
            ($core_identifier = $organisational_unit_position->core_identifier ?? null) !== null ? OrganisationalUnitPositionCoreIdentifier::from($core_identifier) : null,
            $organisational_unit_position->title ?? null,
            $organisational_unit_position->description ?? null,
            ($authorities = $organisational_unit_position->authorities ?? null) !== null ? array_map([OrganisationalUnitPositionAuthorityDto::class, "newFromObject"], $authorities) : null
        );
    }
}
