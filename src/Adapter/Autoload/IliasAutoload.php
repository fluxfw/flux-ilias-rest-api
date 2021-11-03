<?php

namespace FluxIliasRestApi\Adapter\Autoload;

class IliasAutoload
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
