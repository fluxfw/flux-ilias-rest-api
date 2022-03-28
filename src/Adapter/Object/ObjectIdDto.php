<?php

namespace FluxIliasRestApi\Adapter\Object;

use JsonSerializable;

class ObjectIdDto implements JsonSerializable
{

    private ?int $id;
    private ?string $import_id;
    private ?int $ref_id;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?int $ref_id
    ) {
        $this->id = $id;
        $this->import_id = $import_id;
        $this->ref_id = $ref_id;
    }


    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null
    ) : /*static*/ self
    {
        return new static(
            $id,
            $import_id,
            $ref_id
        );
    }


    public function getId() : ?int
    {
        return $this->id;
    }


    public function getImportId() : ?string
    {
        return $this->import_id;
    }


    public function getRefId() : ?int
    {
        return $this->ref_id;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
