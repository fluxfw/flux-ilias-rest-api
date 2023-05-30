<?php

namespace FluxIliasRestApi\Service\Proxy\Command;

use FluxIliasRestApi\Service\Proxy\ProxyTarget;
use FluxIliasRestApi\Service\Rest\Port\RestService;

class HandleIliasRedirectCommand
{

    private function __construct(
        private readonly RestService $rest_service
    ) {

    }


    public static function new(
        RestService $rest_service
    ) : static {
        return new static(
            $rest_service
        );
    }


    public function handleIliasRedirect(string $url) : ?string
    {
        if (str_contains($url, "/Customizing/") || str_ends_with($url, "/Customizing")) {
            return null;
        }

        $request = $this->rest_service->getDefaultRequest();

        $target = $request->getQueryParam(
            "target"
        );
        switch (true) {
            case $target === ProxyTarget::CONFIG->value:
            case $target === ProxyTarget::LOGIN->value:
            case str_starts_with($target, ProxyTarget::API_PROXY->value):
            case str_starts_with($target, ProxyTarget::OBJECT_API_PROXY->value):
            case str_starts_with($target, ProxyTarget::OBJECT_CONFIG->value):
            case str_starts_with($target, ProxyTarget::OBJECT_WEB_PROXY->value):
            case str_starts_with($target, ProxyTarget::WEB_PROXY->value):
                $is_ilias_entrypoint = false;
                foreach (
                    [
                        "error.php",
                        "goto.php",
                        "ilias.php",
                        "index.php",
                        "login.php",
                        "logout.php"
                    ] as $ilias_entrypoint
                ) {
                    if (str_contains($url, "/" . $ilias_entrypoint . "?") || str_ends_with($url, "/" . $ilias_entrypoint)) {
                        $is_ilias_entrypoint = true;
                        break;
                    }
                }
                if (!$is_ilias_entrypoint) {
                    return null;
                }

                return substr($url, strpos($url, "/" . $ilias_entrypoint));

            default:
                return null;
        }
    }
}
