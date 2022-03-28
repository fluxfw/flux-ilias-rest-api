<?php

namespace FluxIliasRestApi\Adapter\Object;

class ObjectDiffDto
{

    private ?string $description;
    private ?int $didactic_template_id;
    private ?string $import_id;
    private ?bool $online;
    private ?string $title;


    private function __construct(
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?bool $online,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?int $didactic_template_id
    ) {
        $this->import_id = $import_id;
        $this->online = $online;
        $this->title = $title;
        $this->description = $description;
        $this->didactic_template_id = $didactic_template_id;
    }


    public static function new(
        ?string $import_id = null,
        ?bool $online = null,
        ?string $title = null,
        ?string $description = null,
        ?int $didactic_template_id = null
    ) : /*static*/ self
    {
        return new static(
            $import_id,
            $online,
            $title,
            $description,
            $didactic_template_id
        );
    }


    public static function newFromData(
        object $data
    ) : /*static*/ self
    {
        return static::new(
            $data->import_id ?? null,
            $data->online ?? null,
            $data->title ?? null,
            $data->description ?? null,
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


    public function getImportId() : ?string
    {
        return $this->import_id;
    }


    public function getTitle() : ?string
    {
        return $this->title;
    }


    public function isOnline() : ?bool
    {
        return $this->online;
    }
}
