<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class SetKeepChangesInsideDaysCommand
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


    public function setKeepChangesInsideDays(?int $keep_changes_inside_days) : void
    {
        $this->config_service->setConfig(
            ConfigKey::KEEP_CHANGES_INSIDE_DAYS,
            max(0, $keep_changes_inside_days ?? GetKeepChangesInsideDaysCommand::DEFAULT_VALUE)
        );
    }
}
