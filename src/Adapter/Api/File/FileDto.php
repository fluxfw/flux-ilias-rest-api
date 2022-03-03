<?php

namespace FluxIliasRestApi\Adapter\Api\File;

use JsonSerializable;

class FileDto implements JsonSerializable
{

    private ?int $created;
    private ?string $description;
    private ?int $didactic_template_id;
    private ?string $download_url;
    private ?string $icon_url;
    private ?int $id;
    private ?string $import_id;
    private ?bool $in_trash;
    private ?string $mime_type;
    private ?string $name;
    private ?int $parent_id;
    private ?string $parent_import_id;
    private ?int $parent_ref_id;
    private ?int $ref_id;
    private ?int $size;
    private ?string $title;
    private ?int $updated;
    private ?string $url;
    private ?int $version;


    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $parent_id = null,
        ?string $parent_import_id = null,
        ?int $parent_ref_id = null,
        ?string $url = null,
        ?string $download_url = null,
        ?string $icon_url = null,
        ?string $title = null,
        ?string $description = null,
        ?int $version = null,
        ?string $name = null,
        ?int $size = null,
        ?string $mime_type = null,
        ?int $didactic_template_id = null,
        ?bool $in_trash = null
    ) : /*static*/ self
    {
        $dto = new static();

        $dto->id = $id;
        $dto->import_id = $import_id;
        $dto->ref_id = $ref_id;
        $dto->created = $created;
        $dto->updated = $updated;
        $dto->parent_id = $parent_id;
        $dto->parent_import_id = $parent_import_id;
        $dto->parent_ref_id = $parent_ref_id;
        $dto->url = $url;
        $dto->download_url = $download_url;
        $dto->icon_url = $icon_url;
        $dto->title = $title;
        $dto->description = $description;
        $dto->version = $version;
        $dto->name = $name;
        $dto->size = $size;
        $dto->mime_type = $mime_type;
        $dto->didactic_template_id = $didactic_template_id;
        $dto->in_trash = $in_trash;

        return $dto;
    }


    public function getCreated() : ?int
    {
        return $this->created;
    }


    public function getDescription() : ?string
    {
        return $this->description;
    }


    public function getDidacticTemplateId() : ?int
    {
        return $this->didactic_template_id;
    }


    public function getDownloadUrl() : ?string
    {
        return $this->download_url;
    }


    public function getIconUrl() : ?string
    {
        return $this->icon_url;
    }


    public function getId() : ?int
    {
        return $this->id;
    }


    public function getImportId() : ?string
    {
        return $this->import_id;
    }


    public function getMimeType() : ?string
    {
        return $this->mime_type;
    }


    public function getName() : ?string
    {
        return $this->name;
    }


    public function getParentId() : ?int
    {
        return $this->parent_id;
    }


    public function getParentImportId() : ?string
    {
        return $this->parent_import_id;
    }


    public function getParentRefId() : ?int
    {
        return $this->parent_ref_id;
    }


    public function getRefId() : ?int
    {
        return $this->ref_id;
    }


    public function getSize() : ?int
    {
        return $this->size;
    }


    public function getTitle() : ?string
    {
        return $this->title;
    }


    public function getUpdated() : ?int
    {
        return $this->updated;
    }


    public function getUrl() : ?string
    {
        return $this->url;
    }


    public function getVersion() : ?int
    {
        return $this->version;
    }


    public function isInTrash() : ?bool
    {
        return $this->in_trash;
    }


    public function jsonSerialize() : array
    {
        $data = get_object_vars($this);

        unset($data["in_trash"]);

        return $data;
    }
}
