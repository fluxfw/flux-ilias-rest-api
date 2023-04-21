<?php

namespace FluxIliasRestApi\Service\Object\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Service\CustomMetadata\CustomMetadataQuery;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use ilDBInterface;
use LogicException;

class GetObjectCommand
{

    use CustomMetadataQuery;
    use ObjectQuery;

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


    public function getObjectById(int $id, ?bool $in_trash = null) : ?ObjectDto
    {
        $object = null;
        while (($object_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getObjectQuery(
                $id,
                null,
                null,
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
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getObjectRefIdsQuery([$object_["obj_id"]]))),
                true
            );
        }

        return $object;
    }


    public function getObjectByImportId(string $import_id, ?bool $in_trash = null) : ?ObjectDto
    {
        $object = null;
        while (($object_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getObjectQuery(
                null,
                $import_id,
                null,
                null,
                null,
                null,
                $in_trash
            )))) !== null) {
            if ($object !== null) {
                throw new LogicException("Multiple objects found with the import id " . $import_id);
            }
            $object = $this->mapObjectDto(
                $object_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getObjectRefIdsQuery([$object_["obj_id"]]))),
                true
            );
        }

        return $object;
    }


    public function getObjectByRefId(int $ref_id, ?bool $in_trash = null) : ?ObjectDto
    {
        $object = null;
        while (($object_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getObjectQuery(
                null,
                null,
                $ref_id,
                null,
                null,
                null,
                $in_trash
            )))) !== null) {
            if ($object !== null) {
                throw new LogicException("Multiple objects found with the ref id " . $ref_id);
            }
            $object = $this->mapObjectDto(
                $object_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getObjectRefIdsQuery([$object_["obj_id"]]))),
                true
            );
        }

        return $object;
    }
}
