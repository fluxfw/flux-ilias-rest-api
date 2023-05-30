<?php

require_once __DIR__ . "/../autoload.php";

use FluxIliasRestApi\Adapter\Api\IliasRestApi;

IliasRestApi::new()
    ->handleRequest();
