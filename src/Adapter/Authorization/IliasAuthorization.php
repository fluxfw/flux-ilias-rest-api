<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Authorization;

use Exception;
use Fluxlabs\FluxRestApi\Adapter\Authorization\HttpBasic\HttpBasicAuthorization;
use Fluxlabs\FluxRestApi\Authorization\Authorization;
use Fluxlabs\FluxRestApi\Request\RawRequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use ilCronStartUp;

class IliasAuthorization implements Authorization
{

    use HttpBasicAuthorization;

    public static function new() : /*static*/ self
    {
        $auth = new static();

        return $auth;
    }


    public function authorize(RawRequestDto $request) : ?ResponseDto
    {
        $authorization = $this->parseHttpBasicAuthorization(
            $request
        );
        if ($authorization instanceof ResponseDto) {
            return $authorization;
        }

        if (!str_contains($authorization->getUser(), "/")) {
            throw new Exception("Missing client and user");
        }

        $user = explode("/", $authorization->getUser());
        $client = array_shift($user);
        $user = implode("/", $user);

        if (empty($client) || empty($user)) {
            throw new Exception("Missing client or user");
        }

        ini_set("session.use_cookies", 0);

        chdir(__DIR__ . "/../../../../../..");
        require_once __DIR__ . "/../../../../../../libs/composer/vendor/autoload.php";
        (new ilCronStartUp($client, $user, $authorization->getPassword()))->authenticate();

        global $DIC;
        if (!$DIC->rbac()->review()->isAssigned($DIC->user()->getId(), SYSTEM_ROLE_ID)) {
            throw new Exception("Only admin users are allowed");
        }

        return null;
    }
}
