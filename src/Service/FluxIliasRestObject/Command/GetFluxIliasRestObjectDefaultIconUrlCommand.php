<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class GetFluxIliasRestObjectDefaultIconUrlCommand
{

    private function __construct(
        private readonly ConfigService $config_service
    ) {

    }


    public static function new(
        ConfigService $config_service
    ) : static {
        return new static(
            $config_service
        );
    }


    public function getFluxIliasRestObjectDefaultIconUrl() : ?string
    {
        return $this->config_service->getConfig(
            ConfigKey::FLUX_ILIAS_REST_OBJECT_DEFAULT_ICON_URL
        );
    }
}
