<?php

namespace FluxIliasRestApi\Service\RestConfig\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class SetRestApiUserLoginCommand
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


    public function setRestApiUserLogin(?string $rest_api_user_login) : void
    {
        $this->config_service->setConfig(
            ConfigKey::REST_API_USER_LOGIN,
            $rest_api_user_login ?? GetRestApiUserLoginCommand::DEFAULT_VALUE
        );
    }
}
