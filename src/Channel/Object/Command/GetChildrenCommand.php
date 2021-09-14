<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Object\Command;

use Fluxlabs\FluxIliasRestApi\Channel\Object\ObjectQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilDBInterface;

class GetChildrenCommand
{

    use ObjectQuery;

    private ilDBInterface $database;
    private ObjectService $object;


    public static function new(ObjectService $object, ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;
        $command->database = $database;

        return $command;
    }


    public function getChildrenById(int $id) : ?array
    {
        $object = $this->object->getObjectById(
            $id
        );
        if ($object === null) {
            return null;
        }

        return array_map([$this, "mapDto"], $this->database->fetchAll($this->database->query($this->getChildrenQuery(
            $object->getId()
        ))));
    }


    public function getChildrenByImportId(string $import_id) : ?array
    {
        $object = $this->object->getObjectByImportId(
            $import_id
        );
        if ($object === null) {
            return null;
        }

        return array_map([$this, "mapDto"], $this->database->fetchAll($this->database->query($this->getChildrenQuery(
            null,
            $object->getImportId()
        ))));
    }


    public function getChildrenByRefId(int $ref_id) : ?array
    {
        $object = $this->object->getObjectByRefId(
            $ref_id
        );
        if ($object === null) {
            return null;
        }

        return array_map([$this, "mapDto"], $this->database->fetchAll($this->database->query($this->getChildrenQuery(
            null,
            null,
            $object->getRefId()
        ))));
    }
}
