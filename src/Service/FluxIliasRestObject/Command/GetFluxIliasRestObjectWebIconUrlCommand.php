<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use ilUtil;

class GetFluxIliasRestObjectWebIconUrlCommand
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


    public function getFluxIliasRestObjectWebIconUrl(?int $id = null) : string
    {
        if ($id !== null) {
            $web_proxy_map_key = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyMapKey(
                $id
            );

            if ($web_proxy_map_key !== null) {
                $web_proxy_map = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyMapByKey(
                    $web_proxy_map_key
                );

                if ($web_proxy_map !== null && $web_proxy_map->icon_url !== null) {
                    return $web_proxy_map->icon_url;
                }
            }
        }

        $default_icon_url = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectDefaultIconUrl();
        if ($default_icon_url !== null) {
            return $default_icon_url;
        }

        return ilUtil::getImagePath("icon_webr.svg");
    }
}
