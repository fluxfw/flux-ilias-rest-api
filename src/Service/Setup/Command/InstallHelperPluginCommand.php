<?php

namespace FluxIliasRestApi\Service\Setup\Command;

use FluxIliasRestApi\Service\Change\Port\ChangeService;

class InstallHelperPluginCommand
{

    private function __construct(
        private readonly ChangeService $change_service
    ) {

    }


    public static function new(
        ChangeService $change_service
    ) : static {
        return new static(
            $change_service
        );
    }


    public function installHelperPlugin() : void
    {
        $this->change_service->createChangeDatabase();
    }
}
