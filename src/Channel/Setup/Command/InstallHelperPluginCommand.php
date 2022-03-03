<?php

namespace FluxIliasRestApi\Channel\Setup\Command;

use FluxIliasRestApi\Channel\Change\Port\ChangeService;

class InstallHelperPluginCommand
{

    private ChangeService $change;


    public static function new(ChangeService $change) : /*static*/ self
    {
        $command = new static();

        $command->change = $change;

        return $command;
    }


    public function installHelperPlugin() : void
    {
        $this->change->createChangeDatabase();
    }
}
