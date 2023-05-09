<?php

namespace FluxIliasRestApi\Service\Object\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDiffDto;
use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Service\Constants\Port\ConstantsService;
use FluxIliasRestApi\Service\CustomMetadata\CustomMetadataQuery;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use ilDBInterface;

class UpdateObjectCommand
{

    use CustomMetadataQuery;
    use ObjectQuery;

    private function __construct(
        private readonly ConstantsService $constants_service,
        private readonly ilDBInterface $ilias_database,
        private readonly ObjectService $object_service
    ) {

    }


    public static function new(
        ConstantsService $constants_service,
        ilDBInterface $ilias_database,
        ObjectService $object_service
    ) : static {
        return new static(
            $constants_service,
            $ilias_database,
            $object_service
        );
    }


    public function updateObjectById(int $id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateObject(
            $this->object_service->getObjectById(
                $id,
                false
            ),
            $diff
        );
    }


    public function updateObjectByImportId(string $import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateObject(
            $this->object_service->getObjectByImportId(
                $import_id,
                false
            ),
            $diff
        );
    }


    public function updateObjectByRefId(int $ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateObject(
            $this->object_service->getObjectByRefId(
                $ref_id,
                false
            ),
            $diff
        );
    }


    private function updateObject(?ObjectDto $object, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        $constants = $this->constants_service->getConstants();

        if ($object === null || $object->id === $constants->root_user_id || $object->id === $constants->rest_user_user_id) {
            return null;
        }

        $ilias_object = $this->getIliasObject(
            $object->id,
            $object->ref_id
        );
        if ($ilias_object === null) {
            return null;
        }

        $this->mapObjectDiff(
            $diff,
            $ilias_object
        );

        $ilias_object->update();

        return ObjectIdDto::new(
            $object->id,
            $diff->import_id ?? $object->import_id,
            $object->ref_id
        );
    }
}
