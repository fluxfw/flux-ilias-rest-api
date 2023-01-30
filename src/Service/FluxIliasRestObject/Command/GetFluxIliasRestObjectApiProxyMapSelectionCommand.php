<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasBaseApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectApiProxyMapDto;
use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;

class GetFluxIliasRestObjectApiProxyMapSelectionCommand
{

    private function __construct(
        private readonly FluxIliasRestObjectService $flux_ilias_rest_object_service
    ) {

    }


    public static function new(
        FluxIliasRestObjectService $flux_ilias_rest_object_service
    ) : static {
        return new static(
            $flux_ilias_rest_object_service
        );
    }


    public function getFluxIliasRestObjectApiProxyMapSelection(FluxIliasRestObjectDto $object) : object
    {
        return (object) [
            "value"  => $object->api_proxy_map_key,
            "values" => array_map(fn(FluxIliasRestObjectApiProxyMapDto $api_proxy_map) : string => $api_proxy_map->key,
                $this->flux_ilias_rest_object_service->getFluxIliasRestObjectApiProxyMaps())
        ];
    }
}
