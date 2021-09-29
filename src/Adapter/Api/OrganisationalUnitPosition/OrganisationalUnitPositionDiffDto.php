<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition;

class OrganisationalUnitPositionDiffDto
{

    private ?string $description;
    private ?string $title;


    public static function newFromData(object $data) : /*static*/ self
    {
        return static::new(
            $data->title ?? null,
            $data->description ?? null
        );
    }


    private static function new(?string $title = null, ?string $description = null) : /*static*/ self
    {
        $dto = new static();

        $dto->title = $title;
        $dto->description = $description;

        return $dto;
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
