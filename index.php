<?php

require_once __DIR__ . "/vendor/autoload.php";

use Fluxlabs\FluxIliasRestApi\Config\IliasConfig;
use Fluxlabs\FluxRestApi\Handler\DefaultHandler;

DefaultHandler::new(
    IliasConfig::new()
)
    ->handle();
