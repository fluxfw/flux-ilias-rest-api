<?php

namespace FluxIliasRestApi;

if (version_compare(PHP_VERSION, ($min_php_version = "7.4"), "<")) {
    die(__NAMESPACE__ . " needs at least PHP " . $min_php_version);
}

require_once __DIR__ . "/../libs/FluxRestApi/autoload.php";

spl_autoload_register(function (string $class) : void {
    if (str_starts_with($class, __NAMESPACE__ . "\\")) {
        require_once __DIR__ . str_replace("\\", "/", substr($class, strlen(__NAMESPACE__))) . ".php";
    }
});
