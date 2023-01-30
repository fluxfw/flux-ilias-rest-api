<?php

namespace FluxIliasRestApi;

require_once __DIR__ . "/../libs/polyfill-php80/vendor/autoload.php";
require_once __DIR__ . "/../libs/polyfill-php81/vendor/autoload.php";
require_once __DIR__ . "/../libs/polyfill-php82/vendor/autoload.php";
require_once __DIR__ . "/../libs/flux-ilias-base-api/autoload.php";
require_once __DIR__ . "/../libs/flux-legacy-enum/autoload.php";
require_once __DIR__ . "/../libs/flux-rest-api/autoload.php";

spl_autoload_register(function (string $class) : void {
    if (str_starts_with($class, __NAMESPACE__ . "\\")) {
        require_once __DIR__ . str_replace("\\", "/", substr($class, strlen(__NAMESPACE__))) . ".php";
    }
});
