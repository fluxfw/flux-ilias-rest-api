<?php

require_once __DIR__ . "/../autoload.php";

use FluxIliasRestApi\Adapter\Server\IliasRestApiServer;

IliasRestApiServer::new()
    ->handle();
