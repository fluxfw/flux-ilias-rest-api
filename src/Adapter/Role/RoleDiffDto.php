<?php

namespace FluxIliasRestApi\Adapter\Role;

class RoleDiffDto
{

    private ?string $description;
    private ?string $import_id;
    private ?string $title;


    private function __construct(
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description
    ) {
        $this->import_id = $import_id;
        $this->title = $title;
        $this->description = $description;
    }


    public static function new(
        ?string $import_id = null,
        ?string $title = null,
        ?string $description = null
    ) : /*static*/ self
    {
        return new static(
            $import_id,
            $title,
            $description
        );
    }


    public static function newFromData(
        object $data
    ) : /*static*/ self
    {
        return static::new(
            $data->import_id ?? null,
            $data->title ?? null,
            $data->description ?? null
        );
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
