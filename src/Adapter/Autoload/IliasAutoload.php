<?php

namespace FluxIliasRestApi\Adapter\Autoload;

use FluxAutoloadApi\Autoload\Autoload;

class IliasAutoload implements Autoload
{

    private string $folder;


    public static function new(string $folder) : /*static*/ self
    {
        $handler = new static();

        $handler->folder = $folder;

        return $handler;
    }


    public function autoload() : void
    {
        chdir($this->folder);

        require_once $this->folder . "/libs/composer/vendor/autoload.php";
        require_once $this->folder . "/webservice/soap/include/inc.soap_functions.php";
    }
}
