<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api\Group;

class GroupDiffDto
{

    private ?string $description;
    private ?int $didactic_template_id;
    private ?string $import_id;
    private ?string $title;


    public static function newFromData(object $data) : /*static*/ self
    {
        return static::new(
            $data->import_id ?? null,
            $data->title ?? null,
            $data->description ?? null,
            $data->didactic_template_id ?? null
        );
    }


    private static function new(?string $import_id = null, ?string $title = null, ?string $description = null, ?int $didactic_template_id = null) : /*static*/ self
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
