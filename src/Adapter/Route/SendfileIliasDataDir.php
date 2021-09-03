<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route;

use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Server\Server;
use ILIAS\FileDelivery\FileDeliveryTypes\XAccel;

trait SendfileIliasDataDir
{

    private function sendfileIliasDataDir(RequestDto $request, string $sendfile) : string
    {
        // TODO: Auto in DefaultHandler and Ilias custom

        if ($request->getServer() === Server::NGINX) {
            if (str_starts_with($sendfile, getcwd() . "/" . ILIAS_WEB_DIR . "/")) {
                $sendfile = "/" . XAccel::SECURED_DATA . substr($sendfile, strlen(getcwd() . "/" . ILIAS_WEB_DIR));
            }
        }

        return $sendfile;
    }
}
