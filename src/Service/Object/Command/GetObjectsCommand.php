<?php

namespace FluxIliasRestApi\Service\Object\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectType;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use FluxIliasRestApi\Service\Timestamp\TimestampQuery;
use ilDBInterface;

class GetObjectsCommand
{

    use ObjectQuery;
    use TimestampQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $ilias_database
        );
    }


    /**
     * @param ObjectType[]|null $types
     * @return ObjectDto[]
     */
    public function getObjects(?int $id = null, ?string $import_id = null, int $ref_id = null, ?array $types = null, ?float $created = null, ?float $created_from = null, ?float $created_to = null, ?float $created_after = null, ?float $created_before = null, ?float $updated = null, ?float $updated_from = null, ?float $updated_to = null, ?float $updated_after = null, ?float $updated_before = null, ?string $title = null, ?string $title_contains = null, bool $ref_ids = false, ?bool $in_trash = null) : array
    {
        $objects = $this->ilias_database->fetchAll($this->ilias_database->query($this->getObjectQuery(
            $id,
            $import_id,
            $ref_id,
            $types,
            $created,
            $created_from,
            $created_to,
            $created_after,
            $created_before,
            $updated,
            $updated_from,
            $updated_to,
            $updated_after,
            $updated_before,
            $title,
            $title_contains,
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
