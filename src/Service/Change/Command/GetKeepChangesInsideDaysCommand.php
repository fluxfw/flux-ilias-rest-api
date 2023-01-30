<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class GetKeepChangesInsideDaysCommand
{

    public const DEFAULT_VALUE = 7;


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


    public function getKeepChangesInsideDays() : int
    {
        return intval($this->config_service->getConfig(
            ConfigKey::KEEP_CHANGES_INSIDE_DAYS
        ) ?? static::DEFAULT_VALUE);
    }
}
