<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasBaseApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDiffDto;
use FluxIliasBaseApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Service\FluxIliasRestObject\FluxIliasRestObjectQuery;
use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use ilDBInterface;

class UpdateFluxIliasRestObjectCommand
{

    use FluxIliasRestObjectQuery;

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


    public function updateFluxIliasRestObjectById(int $id, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateFluxIliasRestObject(
            $this->flux_ilias_rest_object_service->getFluxIliasRestObjectById(
                $id,
                false
            ),
            $diff
        );
    }


    public function updateFluxIliasRestObjectByImportId(string $import_id, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateFluxIliasRestObject(
            $this->flux_ilias_rest_object_service->getFluxIliasRestObjectByImportId(
                $import_id,
                false
            ),
            $diff
        );
    }


    public function updateFluxIliasRestObjectByRefId(int $ref_id, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateFluxIliasRestObject(
            $this->flux_ilias_rest_object_service->getFluxIliasRestObjectByRefId(
                $ref_id,
                false
            ),
            $diff
        );
    }


    private function updateFluxIliasRestObject(?FluxIliasRestObjectDto $object, FluxIliasRestObjectDiffDto $diff) : ?ObjectIdDto
    {
        if ($object === null) {
            return null;
        }

        $ilias_flux_ilias_rest_object = $this->getIliasFluxIliasRestObject(
            $object->id,
            $object->ref_id
        );
        if ($ilias_flux_ilias_rest_object === null) {
            return null;
        }

        $this->mapFluxIliasRestObjectDiff(
            $diff,
            $ilias_flux_ilias_rest_object
        );

        $ilias_flux_ilias_rest_object->update();

        return ObjectIdDto::new(
            $object->id,
            $diff->import_id ?? $object->import_id,
            $object->ref_id
        );
    }
}
