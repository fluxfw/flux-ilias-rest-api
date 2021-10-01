<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition;

class OrganisationalUnitPositionDiffDto
{

    private ?array $authorities;
    private ?string $description;
    private ?string $title;


    public static function newFromData(object $data) : /*static*/ self
    {
        return static::new(
            $data->title ?? null,
            $data->description ?? null,
            ($authorities = $data->authorities ?? null) !== null ? array_map(fn(object $authority
            ) : OrganisationalUnitPositionAuthorityDto => OrganisationalUnitPositionAuthorityDto::new(
                $authority->id ?? null,
                $authority->over_position_id ?? null,
                $authority->scope_in ?? null
            ), $authorities) : null,
        );
    }


    private static function new(?string $title = null, ?string $description = null, ?array $authorities = null) : /*static*/ self
    {
        $dto = new static();

        $dto->title = $title;
        $dto->description = $description;
        $dto->authorities = $authorities;

        return $dto;
    }


    public function getAuthorities() : ?array
    {
        return $this->authorities;
    }


    public function getDescription() : ?string
    {
        return $this->description;
    }


    public function getTitle() : ?string
    {
        return $this->title;
    }
}
