<?php

namespace FluxIliasRestApi\Service\RestConfig\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class GetRestApiUserLoginCommand
{

    public const DEFAULT_VALUE = "rest";

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


    public function getRestApiUserLogin() : string
    {
        return $this->config_service->getConfig(
            ConfigKey::REST_API_USER_LOGIN
        ) ?? static::DEFAULT_VALUE;
    }
}
