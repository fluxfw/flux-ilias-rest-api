<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasRestApi\Service\ObjectConfig\ObjectConfigKey;
use FluxIliasRestApi\Service\ObjectConfig\Port\ObjectConfigService;

class SetFluxIliasRestObjectWebProxyMapKeyCommand
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


    public function setFluxIliasRestObjectWebProxyMapKey(int $id, ?string $web_proxy_map_key) : void
    {
        $this->object_config_service->setObjectConfig(
            $id,
            ObjectConfigKey::WEB_PROXY_MAP_KEY,
            $web_proxy_map_key
        );
    }
}
