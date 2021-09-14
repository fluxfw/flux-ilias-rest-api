<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api\Category;

class CategoryDiffDto
{

    private ?string $description;
    private ?string $import_id;
    private ?string $title;


    public static function new(?string $import_id = null, ?string $title = null, ?string $description = null) : /*static*/ self
    {
        $dto = new static();

        $dto->import_id = $import_id;
        $dto->title = $title;
        $dto->description = $description;

        return $dto;
    }


    public function getDescription() : ?string
    {
        return $this->description;
    }


    public function getImportId() : ?string
    {
        return $this->import_id;
    }


    public function getTitle() : ?string
    {
        return $this->title;
    }
}
