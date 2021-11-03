<?php

namespace FluxIliasRestApi\Adapter\Authorization;

use Exception;
use FluxRestApi\Adapter\Authorization\HttpBasic\HttpBasicAuthorization;
use FluxRestApi\Authorization\Authorization;
use FluxRestApi\Request\RawRequestDto;
use FluxRestApi\Response\ResponseDto;
use ilBrowser;
use ilCronStartUp;
use ilHelpGUI;
use ILIAS\DI\Container;
use ilLocatorGUI;
use ilMainMenuGUI;
use ilNavigationHistory;
use ilStyleDefinition;
use ilTabsGUI;
use ilTemplate;
use ilToolbarGUI;
use ilUtil;

class IliasAuthorization implements Authorization
{

    const SPLIT_CLIENT_USER = "/";
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

        if (!str_contains($authorization->getUser(), static::SPLIT_CLIENT_USER)) {
            throw new Exception("Missing client and user");
        }

        $user = explode(static::SPLIT_CLIENT_USER, $authorization->getUser());
        $client = array_shift($user);
        $user = implode(static::SPLIT_CLIENT_USER, $user);

        if (empty($client) || empty($user)) {
            throw new Exception("Missing client or user");
        }

        ini_set("session.use_cookies", 0);

        (new ilCronStartUp($client, $user, $authorization->getPassword()))->authenticate();

        global $DIC;
        if (!$DIC->rbac()->review()->isAssigned($DIC->user()->getId(), SYSTEM_ROLE_ID)) {
            throw new Exception("Only admin users are allowed");
        }

        $this->fixDicUI(
            $DIC
        );

        $this->fixHttpPath();

        return null;
    }


    private function fixDicUI(Container $dic) : void
    {
        foreach (
            [
                "ilBrowser"           => ilBrowser::class,
                "ilHelp"              => ilHelpGUI::class,
                "ilLocator"           => ilLocatorGUI::class,
                "ilMainMenu"          => ilMainMenuGUI::class,
                "ilNavigationHistory" => ilNavigationHistory::class,
                "ilTabs"              => ilTabsGUI::class,
                "ilToolbar"           => ilToolbarGUI::class,
                "styleDefinition"     => ilStyleDefinition::class,
                "tpl"                 => ilTemplate::class
            ] as $key => $class
        ) {
            if ($dic->offsetExists($key)) {
                if (!isset($GLOBALS[$key])) {
                    $GLOBALS[$key] = $dic->offsetGet($key);
                }
            } else {
                if (!isset($GLOBALS[$key])) {
                    switch ($class) {
                        case ilStyleDefinition::class:
                            $GLOBALS[$key] = new ilStyleDefinition();
                            break;
                        default:
                            $GLOBALS[$key] = eval('return new class() extends ' . $class . ' { public function __construct() {} };');
                            break;
                    }
                }
                $dic->offsetSet($key, $GLOBALS[$key]);
            }
        }
    }


    private function fixHttpPath() : void
    {
        if (!defined("ILIAS_HTTP_PATH")) {
            define("ILIAS_HTTP_PATH", ilUtil::_getHttpPath());
        }
    }
}
