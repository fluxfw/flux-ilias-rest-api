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


    public static function new(
        ?int $id = null,
        ?bool $core_position = null,
        ?LegacyOrganisationalUnitPositionCoreIdentifier $core_identifier = null,
        ?string $title = null,
        ?string $description = null,
        ?array $authorities = null
    ) : /*static*/ self
    {
        $dto = new static();

        $dto->id = $id;
        $dto->core_position = $core_position;
        $dto->core_identifier = $core_identifier;
        $dto->title = $title;
        $dto->description = $description;
        $dto->authorities = $authorities;

        return $dto;
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
