<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasBaseApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasRestApi\Service\Config\ConfigQuery;
use FluxIliasRestApi\Service\FluxIliasRestObject\FluxIliasRestObjectQuery;
use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use FluxIliasRestApi\Service\ObjectConfig\ObjectConfigQuery;
use ilDBInterface;
use LogicException;

class GetFluxIliasRestObjectCommand
{

    use ConfigQuery;
    use FluxIliasRestObjectQuery;
    use ObjectConfigQuery;
    use ObjectQuery;

    private function __construct(
        private readonly FluxIliasRestObjectService $flux_ilias_rest_object_service,
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        FluxIliasRestObjectService $flux_ilias_rest_object_service,
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $flux_ilias_rest_object_service,
            $ilias_database
        );
    }


    public function getFluxIliasRestObjectById(int $id, ?bool $in_trash = null) : ?FluxIliasRestObjectDto
    {
        $object = null;
        while (($object_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getFluxIliasRestObjectQuery(
                $id,
                null,
                null,
                $in_trash
            )))) !== null) {
            if ($object !== null) {
                throw new LogicException("Multiple categories found with the id " . $id);
            }
            $object = $this->mapFluxIliasRestObjectDto(
                $object_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getFluxIliasRestObjectContainerSettingQuery([$object_["obj_id"]])))
            );
        }

        return $object;
    }


    public function getFluxIliasRestObjectByImportId(string $import_id, ?bool $in_trash = null) : ?FluxIliasRestObjectDto
    {
        $object = null;
        while (($object_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getFluxIliasRestObjectQuery(
                null,
                $import_id,
                null,
                $in_trash
            )))) !== null) {
            if ($object !== null) {
                throw new LogicException("Multiple categories found with the import id " . $import_id);
            }
            $object = $this->mapFluxIliasRestObjectDto(
                $object_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getFluxIliasRestObjectContainerSettingQuery([$object_["obj_id"]])))
            );
        }

        return $object;
    }


    public function getFluxIliasRestObjectByRefId(int $ref_id, ?bool $in_trash = null) : ?FluxIliasRestObjectDto
    {
        $object = null;
        while (($object_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getFluxIliasRestObjectQuery(
                null,
                null,
                $ref_id,
                $in_trash
            )))) !== null) {
            if ($object !== null) {
                throw new LogicException("Multiple categories found with the ref id " . $ref_id);
            }
            $object = $this->mapFluxIliasRestObjectDto(
                $object_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getFluxIliasRestObjectContainerSettingQuery([$object_["obj_id"]])))
            );
        }

        return $object;
    }
}
