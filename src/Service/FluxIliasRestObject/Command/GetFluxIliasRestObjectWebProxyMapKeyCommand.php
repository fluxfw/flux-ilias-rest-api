<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasRestApi\Service\ObjectConfig\ObjectConfigKey;
use FluxIliasRestApi\Service\ObjectConfig\Port\ObjectConfigService;

class GetFluxIliasRestObjectWebProxyMapKeyCommand
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


    public function getFluxIliasRestObjectWebProxyMapKey(int $id) : ?string
    {
        return $this->object_config_service->getObjectConfig(
            $id,
            ObjectConfigKey::WEB_PROXY_MAP_KEY
        );
    }
}
