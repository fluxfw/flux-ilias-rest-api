<?php

namespace FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition;

use JsonSerializable;

class OrganisationalUnitPositionDto implements JsonSerializable
{

    private ?array $authorities;
    private ?LegacyOrganisationalUnitPositionCoreIdentifier $core_identifier;
    private ?bool $core_position;
    private ?string $description;
    private ?int $id;
    private ?string $title;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?bool $core_position,
        /*public readonly*/ ?LegacyOrganisationalUnitPositionCoreIdentifier $core_identifier,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?array $authorities
    ) {
        $this->id = $id;
        $this->core_position = $core_position;
        $this->core_identifier = $core_identifier;
        $this->title = $title;
        $this->description = $description;
        $this->authorities = $authorities;
    }


    public static function new(
        ?int $id = null,
        ?bool $core_position = null,
        ?LegacyOrganisationalUnitPositionCoreIdentifier $core_identifier = null,
        ?string $title = null,
        ?string $description = null,
        ?array $authorities = null
    ) : /*static*/ self
    {
        return new static(
            $id,
            $core_position,
            $core_identifier,
            $title,
            $description,
            $authorities
        );
    }


    public function getAuthorities() : ?array
    {
        return $this->authorities;
    }


    public function getCoreIdentifier() : ?LegacyOrganisationalUnitPositionCoreIdentifier
    {
        return $this->core_identifier;
    }


    public function getDescription() : ?string
    {
        return $this->description;
    }


    public function getId() : ?int
    {
        return $this->id;
    }


    public function getTitle() : ?string
    {
        return $this->title;
    }


    public function isCorePosition() : ?bool
    {
        return $this->core_position;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
