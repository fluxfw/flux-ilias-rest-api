<?php

namespace FluxIliasRestApi\Service\RestConfig\Port;

use FluxIliasRestApi\Service\Config\Port\ConfigService;
use FluxIliasRestApi\Service\RestConfig\Command\GetRestApiUserLoginCommand;
use FluxIliasRestApi\Service\RestConfig\Command\IsEnableRestApiCommand;
use FluxIliasRestApi\Service\RestConfig\Command\SetEnableRestApiCommand;
use FluxIliasRestApi\Service\RestConfig\Command\SetRestApiUserLoginCommand;

class RestConfigService
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


    public function getRestApiUserLogin() : string
    {
        return GetRestApiUserLoginCommand::new(
            $this->config_service
        )
            ->getRestApiUserLogin();
    }


    public function isEnableRestApi() : bool
    {
        return IsEnableRestApiCommand::new(
            $this->config_service
        )
            ->isEnableRestApi();
    }


    public function setEnableRestApi(bool $enable_rest_api) : void
    {
        SetEnableRestApiCommand::new(
            $this->config_service
        )
            ->setEnableRestApi(
                $enable_rest_api
            );
    }


    public function setRestApiUserLogin(?string $rest_api_user_login) : void
    {
        SetRestApiUserLoginCommand::new(
            $this->config_service
        )
            ->setRestApiUserLogin(
                $rest_api_user_login
            );
    }
}
