<?php

namespace FluxIliasRestApi\Channel\Object\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use ilDBInterface;
use LogicException;

class GetObjectCommand
{

    use ObjectQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getObjectById(int $id, ?bool $in_trash = null) : ?ObjectDto
    {
        $object = null;
        while (($object_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getObjectQuery(
                null,
                $id,
                null,
                null,
                null,
                $in_trash
            )))) !== null) {
            if ($object !== null) {
                throw new LogicException("Multiple objects found with the id " . $id);
            }
            $object = $this->mapObjectDto(
                $object_,
                $this->database->fetchAll($this->database->query($this->getObjectRefIdsQuery([$object_["obj_id"]])))
            );
        }

        return $object;
    }


    public function getObjectByImportId(string $import_id, ?bool $in_trash = null) : ?ObjectDto
    {
        $object = null;
        while (($object_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getObjectQuery(
                null,
                null,
                $import_id,
                null,
                null,
                $in_trash
            )))) !== null) {
            if ($object !== null) {
                throw new LogicException("Multiple objects found with the import id " . $import_id);
            }
            $object = $this->mapObjectDto(
                $object_,
                $this->database->fetchAll($this->database->query($this->getObjectRefIdsQuery([$object_["obj_id"]])))
            );
        }

        return $object;
    }


    public function getObjectByRefId(int $ref_id, ?bool $in_trash = null) : ?ObjectDto
    {
        $object = null;
        while (($object_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getObjectQuery(
                null,
                null,
                null,
                $ref_id,
                null,
                $in_trash
            )))) !== null) {
            if ($object !== null) {
                throw new LogicException("Multiple objects found with the ref id " . $ref_id);
            }
            $object = $this->mapObjectDto(
                $object_,
                $this->database->fetchAll($this->database->query($this->getObjectRefIdsQuery([$object_["obj_id"]])))
            );
        }

        return $object;
    }
}
