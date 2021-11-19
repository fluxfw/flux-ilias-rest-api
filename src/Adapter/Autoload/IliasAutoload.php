<?php

namespace FluxIliasRestApi\Adapter\Autoload;

use Exception;
use FluxAutoloadApi\Adapter\Autoload\ComposerAutoload;
use FluxAutoloadApi\Adapter\Autoload\FileAutoload;
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
        $folder = $this->getIliasFolder(
            $this->folder
        );

        chdir($folder);

        ComposerAutoload::new(
            $folder
        )
            ->autoload();

        FileAutoload::new(
            $folder . "/webservice/soap/include/inc.soap_functions.php"
        )
            ->autoload();
    }


    private function getIliasFolder(string $folder) : string
    {
        $pos = strpos($folder, "/Customizing/");
        if ($pos === false) {
            throw new Exception("Can't detect ILIAS folder because not in Customizing");
        }

        return substr($folder, 0, $pos);
    }
}
