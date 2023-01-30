<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class SetFluxIliasRestObjectMultipleTypeTitleCommand
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


    public function setFluxIliasRestObjectMultipleTypeTitle(?string $multiple_type_title) : void
    {
        $this->config_service->setConfig(
            ConfigKey::FLUX_ILIAS_REST_OBJECT_MULTIPLE_TYPE_TITLE,
            $multiple_type_title
        );
    }
}
