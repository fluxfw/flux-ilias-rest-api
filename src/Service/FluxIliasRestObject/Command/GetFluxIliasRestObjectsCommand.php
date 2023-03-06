<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasRestApi\Service\Config\ConfigQuery;
use FluxIliasRestApi\Service\FluxIliasRestObject\FluxIliasRestObjectQuery;
use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use FluxIliasRestApi\Service\ObjectConfig\ObjectConfigQuery;
use ilDBInterface;

class GetFluxIliasRestObjectsCommand
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


    /**
     * @return FluxIliasRestObjectDto[]
     */
    public function getFluxIliasRestObjects(bool $container_settings = false, ?bool $in_trash = null) : array
    {
        $objects = $this->ilias_database->fetchAll($this->ilias_database->query($this->getFluxIliasRestObjectQuery(
            null,
            null,
            null,
            $in_trash
        )));
        $object_ids = array_map(fn(array $object) : int => $object["obj_id"], $objects);

        $container_settings_ = $container_settings ? $this->ilias_database->fetchAll($this->ilias_database->query($this->getFluxIliasRestObjectContainerSettingQuery($object_ids)))
            : null;

        return array_map(fn(array $object) : FluxIliasRestObjectDto => $this->mapFluxIliasRestObjectDto(
            $object,
            $container_settings_
        ), $objects);
    }
}
