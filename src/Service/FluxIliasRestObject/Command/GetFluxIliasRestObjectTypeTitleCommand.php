<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class GetFluxIliasRestObjectTypeTitleCommand
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


    public function getFluxIliasRestObjectTypeTitle() : ?string
    {
        return $this->config_service->getConfig(
            ConfigKey::FLUX_ILIAS_REST_OBJECT_TYPE_TITLE
        );
    }
}
