<?php

namespace FluxIliasRestApi\Adapter\Autoload;

use Exception;

class IliasAutoload
{

    private function __construct(
        private readonly string $folder
    ) {

    }


    public static function new(
        string $folder
    ) : static {
        return new static(
            $folder
        );
    }


    public function autoload() : void
    {
        $folder = $this->getIliasFolder(
            $this->folder
        );

        chdir($folder);

        require_once $folder . "/libs/composer/vendor/autoload.php";

        require_once $folder . "/webservice/soap/include/inc.soap_functions.php";
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
