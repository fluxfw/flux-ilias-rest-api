<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api\Category;

class CategoryDiffDto
{

    private ?string $description;
    private ?int $didactic_template_id;
    private ?string $import_id;
    private ?string $title;


    public static function new(?string $import_id = null, ?string $title = null, ?string $description = null, ?int $didactic_template_id = null) : /*static*/ self
    {
        $dto = new static();

        $dto->import_id = $import_id;
        $dto->title = $title;
        $dto->description = $description;
        $dto->didactic_template_id = $didactic_template_id;

        return $dto;
    }


    public function getDescription() : ?string
    {
        return $this->description;
    }


    public function getDidacticTemplateId() : ?int
    {
        return $this->didactic_template_id;
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
