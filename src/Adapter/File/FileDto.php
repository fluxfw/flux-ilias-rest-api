<?php

namespace FluxIliasRestApi\Adapter\File;

use JsonSerializable;

class FileDto implements JsonSerializable
{

    private function __construct(
        public readonly ?int $id,
        public readonly ?string $import_id,
        public readonly ?int $ref_id,
        public readonly ?int $created,
        public readonly ?int $updated,
        public readonly ?int $parent_id,
        public readonly ?string $parent_import_id,
        public readonly ?int $parent_ref_id,
        public readonly ?string $url,
        public readonly ?string $download_url,
        public readonly ?string $icon_url,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?int $version,
        public readonly ?string $name,
        public readonly ?int $size,
        public readonly ?string $mime_type,
        public readonly ?int $didactic_template_id,
        public readonly ?bool $in_trash
    ) {

    }


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
    ) : static {
        return new static(
            $id,
            $import_id,
            $ref_id,
            $created,
            $updated,
            $parent_id,
            $parent_import_id,
            $parent_ref_id,
            $url,
            $download_url,
            $icon_url,
            $title,
            $description,
            $version,
            $name,
            $size,
            $mime_type,
            $didactic_template_id,
            $in_trash
        );
    }


    public static function newFromObject(
        object $file
    ) : static {
        return static::new(
            $file->id ?? null,
            $file->import_id ?? null,
            $file->ref_id ?? null,
            $file->created ?? null,
            $file->updated ?? null,
            $file->parent_id ?? null,
            $file->parent_import_id ?? null,
            $file->parent_ref_id ?? null,
            $file->url ?? null,
            $file->download_url ?? null,
            $file->icon_url ?? null,
            $file->title ?? null,
            $file->description ?? null,
            $file->version ?? null,
            $file->name ?? null,
            $file->size ?? null,
            $file->mime_type ?? null,
            $file->didactic_template_id ?? null,
            $file->in_trash ?? null
        );
    }


    public function jsonSerialize() : object
    {
        $data = get_object_vars($this);

        unset($data["in_trash"]);

        return (object) $data;
    }
}
