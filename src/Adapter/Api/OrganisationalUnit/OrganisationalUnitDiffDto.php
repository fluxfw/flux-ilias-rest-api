<?php

namespace FluxIliasRestApi\Adapter\Api\OrganisationalUnit;

class OrganisationalUnitDiffDto
{

    private ?string $description;
    private ?int $didactic_template_id;
    private ?string $external_id;
    private ?string $title;
    private ?int $type_id;


    private function __construct(
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?int $type_id,
        /*public readonly*/ ?string $external_id,
        /*public readonly*/ ?int $didactic_template_id
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->type_id = $type_id;
        $this->external_id = $external_id;
        $this->didactic_template_id = $didactic_template_id;
    }


    public static function new(
        ?string $title = null,
        ?string $description = null,
        ?int $type_id = null,
        ?string $external_id = null,
        ?int $didactic_template_id = null
    ) : /*static*/ self
    {
        return new static(
            $title,
            $description,
            $type_id,
            $external_id,
            $didactic_template_id
        );
    }


    public static function newFromData(
        object $data
    ) : /*static*/ self
    {
        return static::new(
            $data->title ?? null,
            $data->description ?? null,
            $data->type_id ?? null,
            $data->external_id ?? null,
            $data->didactic_template_id ?? null
        );
    }


    public function getDescription() : ?string
    {
        return $this->description;
    }


    public function getDidacticTemplateId() : ?int
    {
        return $this->didactic_template_id;
    }


    public function getExternalId() : ?string
    {
        return $this->external_id;
    }


    public function getTitle() : ?string
    {
        return $this->title;
    }


    public function getTypeId() : ?int
    {
        return $this->type_id;
    }
}
