<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasRestApi\Service\ObjectConfig\ObjectConfigKey;
use FluxIliasRestApi\Service\ObjectConfig\Port\ObjectConfigService;

class SetFluxIliasRestObjectApiProxyMapKeyCommand
{

    private function __construct(
        private readonly ObjectConfigService $object_config_service
    ) {

    }


    public static function new(
        ObjectConfigService $object_config_service
    ) : static {
        return new static(
            $object_config_service
        );
    }


    public function setFluxIliasRestObjectApiProxyMapKey(int $id, ?string $api_proxy_map_key) : void
    {
        $this->object_config_service->setObjectConfig(
            $id,
            ObjectConfigKey::API_PROXY_MAP_KEY,
            $api_proxy_map_key
        );
    }
}
