<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasBaseApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectWebProxyMapDto;
use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;

class GetFluxIliasRestObjectWebProxyMapSelectionCommand
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


    public function getFluxIliasRestObjectWebProxyMapSelection(FluxIliasRestObjectDto $object) : object
    {
        return (object) [
            "value"  => $object->web_proxy_map_key,
            "values" => array_map(fn(FluxIliasRestObjectWebProxyMapDto $web_proxy_map) : string => $web_proxy_map->key,
                $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyMaps())
        ];
    }
}
