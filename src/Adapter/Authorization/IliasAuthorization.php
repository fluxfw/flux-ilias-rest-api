<?php

namespace FluxIliasRestApi\Adapter\Authorization;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Autoload\IliasAutoload;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Authorization\Authorization;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Authorization\ParseHttpBasic\ParseHttpBasicAuthorization;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerRawRequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Status\DefaultStatus;
use ilBrowser;
use ilCronException;
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

    private const SPLIT_CLIENT_USER = "/";
    use ParseHttpBasicAuthorization;

    private function __construct(
        private readonly IliasApi $ilias_api
    ) {

    }


    public static function new(
        IliasApi $ilias_api
    ) : static {
        return new static(
            $ilias_api
        );
    }


    public function authorize(ServerRawRequestDto $request) : ?ServerResponseDto
    {
        if (
            $request->route === "/"
            /*|| $request->route === "/routes"
            || $request->route === "/routes/"*/
            || $request->route === "/routes/ui"
            || $request->route === "/routes/ui/"
            || str_starts_with($request->route, "/routes/ui/")
        ) {
            return null;
        }

        $authorization = $this->parseHttpBasicAuthorization(
            $request
        );
        if ($authorization instanceof ServerResponseDto) {
            return $authorization;
        }

        if (!str_contains($authorization->user, static::SPLIT_CLIENT_USER)) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Missing authorization client or user"
                ),
                DefaultStatus::_400
            );
        }

        $user = explode(static::SPLIT_CLIENT_USER, $authorization->user);
        $client = array_shift($user);
        $user = implode(static::SPLIT_CLIENT_USER, $user);

        if (empty($client) || empty($user)) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Missing authorization client or user"
                ),
                DefaultStatus::_400
            );
        }

        ini_set("session.use_cookies", 0);

        IliasAutoload::new(
            __DIR__ . "/../../.."
        )
            ->autoload();

        try {
            (new ilCronStartUp($client, $user, $authorization->password))->authenticate();
        } catch (ilCronException $ex) {
            file_put_contents("php://stdout", $ex);

            return ServerResponseDto::new(
                TextBodyDto::new(
                    "No access"
                ),
                DefaultStatus::_403
            );
        }

        $user = $this->ilias_api->getCurrentApiUser();
        if ($user === null || $user->id === intval(SYSTEM_USER_ID)) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "No access"
                ),
                DefaultStatus::_403
            );
        }
        if (empty($this->ilias_api->getUserRoles($user->id, null, SYSTEM_ROLE_ID))) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "No access"
                ),
                DefaultStatus::_403
            );
        }

        if (!$this->ilias_api->isEnableRestApi()) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Not enabled"
                ),
                DefaultStatus::_403
            );
        }

        global $DIC;
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
            if (!class_exists($class)) {
                continue;
            }
            if ($dic->offsetExists($key)) {
                if (!isset($GLOBALS[$key])) {
                    $GLOBALS[$key] = $dic->offsetGet($key);
                }
            } else {
                if (!isset($GLOBALS[$key])) {
                    switch ($class) {
                        case ilStyleDefinition::class:
                            $GLOBALS[$key] = new $class();
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
