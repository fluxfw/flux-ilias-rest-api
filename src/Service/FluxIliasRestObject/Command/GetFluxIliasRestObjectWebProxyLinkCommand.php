<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;

class GetFluxIliasRestObjectWebProxyLinkCommand
{

    private function __construct(
        private readonly FluxIliasRestObjectService $flux_ilias_rest_object_service
    ) {

    }


    public static function new(
        FluxIliasRestObjectService $flux_ilias_rest_object_service
    ) : static {
        return new static(
            $flux_ilias_rest_object_service
        );
    }


    public function getFluxIliasRestObjectWebProxyLink(int $ref_id, int $id, ?int $user_id = null) : string
    {
        $rewrite_url = null;
        $web_proxy_map = null;

        $web_proxy_map_key = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyMapKey(
            $id
        );

        if ($web_proxy_map_key !== null) {
            $web_proxy_map = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyMapByKey(
                $web_proxy_map_key
            );

            if ($web_proxy_map !== null) {
                $rewrite_url = $web_proxy_map->rewrite_url;
            }
        }

        if ($web_proxy_map === null && $user_id !== null) {
            if ($this->flux_ilias_rest_object_service->hasAccessToFluxIliasRestObjectConfigForm(
                $ref_id,
                $user_id
            )
            ) {
                return $this->flux_ilias_rest_object_service->getFluxIliasRestObjectConfigLink(
                    $ref_id
                );
            }
        }

        return str_replace("%ref_id%", $ref_id, ($rewrite_url ?? ILIAS_HTTP_PATH . "/flux-ilias-rest-object-web-proxy/%ref_id%"));
    }
}
