<?php

namespace FluxIliasRestApi\Service\Object\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectType;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\Timestamp\TimestampQuery;
use ilDBInterface;

class GetChildrenCommand
{

    use ObjectQuery;
    use TimestampQuery;

    private function __construct(
        private readonly ObjectService $object_service,
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ObjectService $object_service,
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $object_service,
            $ilias_database
        );
    }


    /**
     * @param ObjectType[]|null $types
     * @return ObjectDto[]|null
     */
    public function getChildrenById(int $id, ?int $children_id = null, ?string $children_import_id = null, ?int $children_ref_id = null, ?array $children_types = null, ?float $children_created = null, ?float $children_created_from = null, ?float $children_created_to = null, ?float $children_created_after = null, ?float $children_created_before = null, ?float $children_updated = null, ?float $children_updated_from = null, ?float $children_updated_to = null, ?float $children_updated_after = null, ?float $children_updated_before = null, ?string $children_title = null, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        $object = $this->object_service->getObjectById(
            $id,
            $in_trash
        );
        if ($object === null) {
            return null;
        }

        return $this->getChildren(
            $object->id,
            null,
            null,
            $children_id,
            $children_import_id,
            $children_ref_id,
            $children_types,
            $children_created,
            $children_created_from,
            $children_created_to,
            $children_created_after,
            $children_created_before,
            $children_updated,
            $children_updated_from,
            $children_updated_to,
            $children_updated_after,
            $children_updated_before,
            $children_title,
            $ref_ids,
            $in_trash
        );
    }


    /**
     * @param ObjectType[]|null $types
     * @return ObjectDto[]|null
     */
    public function getChildrenByImportId(string $import_id, ?int $children_id = null, ?string $children_import_id = null, ?int $children_ref_id = null, ?array $children_types = null, ?float $children_created = null, ?float $children_created_from = null, ?float $children_created_to = null, ?float $children_created_after = null, ?float $children_created_before = null, ?float $children_updated = null, ?float $children_updated_from = null, ?float $children_updated_to = null, ?float $children_updated_after = null, ?float $children_updated_before = null, ?string $children_title = null, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        $object = $this->object_service->getObjectByImportId(
            $import_id,
            $in_trash
        );
        if ($object === null) {
            return null;
        }

        return $this->getChildren(
            null,
            $object->import_id,
            null,
            $children_id,
            $children_import_id,
            $children_ref_id,
            $children_types,
            $children_created,
            $children_created_from,
            $children_created_to,
            $children_created_after,
            $children_created_before,
            $children_updated,
            $children_updated_from,
            $children_updated_to,
            $children_updated_after,
            $children_updated_before,
            $children_title,
            $ref_ids,
            $in_trash
        );
    }


    /**
     * @param ObjectType[]|null $types
     * @return ObjectDto[]|null
     */
    public function getChildrenByRefId(int $ref_id, ?int $children_id = null, ?string $children_import_id = null, ?int $children_ref_id = null, ?array $children_types = null, ?float $children_created = null, ?float $children_created_from = null, ?float $children_created_to = null, ?float $children_created_after = null, ?float $children_created_before = null, ?float $children_updated = null, ?float $children_updated_from = null, ?float $children_updated_to = null, ?float $children_updated_after = null, ?float $children_updated_before = null, ?string $children_title = null, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        $object = $this->object_service->getObjectByRefId(
            $ref_id,
            $in_trash
        );
        if ($object === null) {
            return null;
        }

        return $this->getChildren(
            null,
            null,
            $object->ref_id,
            $children_id,
            $children_import_id,
            $children_ref_id,
            $children_types,
            $children_created,
            $children_created_from,
            $children_created_to,
            $children_created_after,
            $children_created_before,
            $children_updated,
            $children_updated_from,
            $children_updated_to,
            $children_updated_after,
            $children_updated_before,
            $children_title,
            $ref_ids,
            $in_trash
        );
    }


    /**
     * @param ObjectType[]|null $types
     * @return ObjectDto[]
     */
    private function getChildren(?int $id = null, ?string $import_id = null, ?int $ref_id = null, ?int $children_id = null, ?string $children_import_id = null, ?int $children_ref_id = null, ?array $children_types = null, ?float $children_created = null, ?float $children_created_from = null, ?float $children_created_to = null, ?float $children_created_after = null, ?float $children_created_before = null, ?float $children_updated = null, ?float $children_updated_from = null, ?float $children_updated_to = null, ?float $children_updated_after = null, ?float $children_updated_before = null, ?string $children_title = null, bool $ref_ids = false, ?bool $in_trash = null) : array
    {
        $objects = $this->ilias_database->fetchAll($this->ilias_database->query($this->getObjectChildrenQuery(
            $id,
            $import_id,
            $ref_id,
            $children_id,
            $children_import_id,
            $children_ref_id,
            $children_types,
            $children_created,
            $children_created_from,
            $children_created_to,
            $children_created_after,
            $children_created_before,
            $children_updated,
            $children_updated_from,
            $children_updated_to,
            $children_updated_after,
            $children_updated_before,
            $children_title,
            null,
            $in_trash
        )));
        $object_ids = array_map(fn(array $object) : int => $object["obj_id"], $objects);

        $ref_ids_ = $ref_ids ? $this->ilias_database->fetchAll($this->ilias_database->query($this->getObjectRefIdsQuery($object_ids))) : null;

        return array_map(fn(array $object) : ObjectDto => $this->mapObjectDto(
            $object,
            $ref_ids_
        ), $objects);
    }
}
