<?php

namespace Fluxlabs\FluxIliasRestApi\Authorization;

use Exception;
use Fluxlabs\FluxRestApi\Authorization\Authorization;
use Fluxlabs\FluxRestApi\Authorization\HttpBasicAuthorization\HttpBasicAuthorization;
use Fluxlabs\FluxRestApi\Request\RawRequestDto;
use ilCronStartUp;

class IliasAuthorization implements Authorization
{

    use HttpBasicAuthorization;

    public static function new() : /*static*/ self
    {
        $auth = new static();

        return $auth;
    }


    public function authorize(RawRequestDto $request) : void
    {
        $authorization = $this->parseHttpBasicAuthorization(
            $request
        );

        if (!str_contains($authorization->getUser(), "/")) {
            throw new Exception("Missing client and user");
        }

        $user = explode("/", $authorization->getUser());
        $client = array_shift($user);
        $user = implode("/", $user);

        if (empty($client) || empty($user)) {
            throw new Exception("Missing client or user");
        }

        $this->initIlias();

        (new ilCronStartUp($client, $user, $authorization->getPassword()))->authenticate();
    }


    private function initIlias() : void
    {
        chdir(__DIR__ . "/../../../../..");

        require_once __DIR__ . "/../../../../../libs/composer/vendor/autoload.php";
    }
}
