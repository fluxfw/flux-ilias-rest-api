<?php

namespace FluxIliasRestApi\Adapter\Autoload;

use FluxAutoloadApi\Adapter\Autoload\ComposerAutoload;
use FluxAutoloadApi\Adapter\Autoload\RequireAutoload;
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

        ComposerAutoload::new(
            $this->folder
        )
            ->autoload();

        RequireAutoload::new(
            $this->folder . "/webservice/soap/include/inc.soap_functions.php"
        )
            ->autoload();
    }
}
