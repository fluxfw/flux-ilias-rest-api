<?php

namespace FluxIliasRestApi\Service\RestConfig\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class SetEnableRestApiCommand
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


    public function setEnableRestApi(bool $enable_rest_api) : void
    {
        $this->config_service->setConfig(
            ConfigKey::ENABLE_REST_API,
            $enable_rest_api
        );
    }
}
