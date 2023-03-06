<?php

namespace FluxIliasRestApi;

require_once __DIR__ . "/Libs/polyfill-php80/autoload.php";

require_once __DIR__ . "/Libs/polyfill-php81/autoload.php";

require_once __DIR__ . "/Libs/polyfill-php82/autoload.php";

require_once __DIR__ . "/Libs/flux-legacy-enum/autoload.php";

require_once __DIR__ . "/Libs/flux-rest-api/autoload.php";

spl_autoload_register(function (string $class) : void {
    if (str_starts_with($class, __NAMESPACE__ . "\\")) {
        require_once __DIR__ . str_replace("\\", "/", substr($class, strlen(__NAMESPACE__))) . ".php";
    }
});
