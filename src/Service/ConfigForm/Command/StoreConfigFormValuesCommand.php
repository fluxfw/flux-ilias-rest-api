<?php

namespace FluxIliasRestApi\Service\ConfigForm\Command;

use FluxIliasRestApi\Adapter\CronConfig\CustomScheduleTypeCronConfig;
use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectApiProxyMapDto;
use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectWebProxyMapDto;
use FluxIliasRestApi\Adapter\Proxy\ApiProxyMapDto;
use FluxIliasRestApi\Adapter\Proxy\WebProxyMapDto;
use FluxIliasRestApi\Service\Change\Port\ChangeService;
use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasRestApi\Service\ProxyConfig\Port\ProxyConfigService;
use FluxIliasRestApi\Service\RestConfig\Port\RestConfigService;

class StoreConfigFormValuesCommand
{

    private function __construct(
        private readonly ChangeService $change_service,
        private readonly FluxIliasRestObjectService $flux_ilias_rest_object_service,
        private readonly ProxyConfigService $proxy_config_service,
        private readonly RestConfigService $rest_config_service
    ) {

    }


    public static function new(
        ChangeService $change_service,
        FluxIliasRestObjectService $flux_ilias_rest_object_service,
        ProxyConfigService $proxy_config_service,
        RestConfigService $rest_config_service
    ) : static {
        return new static(
            $change_service,
            $flux_ilias_rest_object_service,
            $proxy_config_service,
            $rest_config_service
        );
    }


    public function storeConfigFormValues(object $values) : bool
    {
        $this->proxy_config_service->setApiProxyMap(
            array_map([ApiProxyMapDto::class, "newFromObject"], (array) ($values->{ConfigKey::API_PROXY_MAP->value} ?? null))
        );

        $this->change_service->setEnableLogChanges(
            boolval($values->{ConfigKey::ENABLE_LOG_CHANGES->value} ?? null)
        );

        $this->change_service->setEnablePurgeChanges(
            boolval($values->{ConfigKey::ENABLE_PURGE_CHANGES->value} ?? null)
        );

        $this->rest_config_service->setEnableRestApi(
            boolval($values->{ConfigKey::ENABLE_REST_API->value} ?? null)
        );

        $this->change_service->setEnableTransferChanges(
            boolval($values->{ConfigKey::ENABLE_TRANSFER_CHANGES->value} ?? null)
        );

        $this->flux_ilias_rest_object_service->setFluxIliasRestObjectApiProxyMaps(
            array_map([FluxIliasRestObjectApiProxyMapDto::class, "newFromObject"], (array) ($values->{ConfigKey::FLUX_ILIAS_REST_OBJECT_API_PROXY_MAPS->value} ?? null))
        );

        $this->flux_ilias_rest_object_service->setFluxIliasRestObjectDefaultIconUrl(
            ($values->{ConfigKey::FLUX_ILIAS_REST_OBJECT_DEFAULT_ICON_URL->value} ?? null) ?: null
        );

        $this->flux_ilias_rest_object_service->setFluxIliasRestObjectMultipleTypeTitle(
            ($values->{ConfigKey::FLUX_ILIAS_REST_OBJECT_MULTIPLE_TYPE_TITLE->value} ?? null) ?: null
        );

        $this->flux_ilias_rest_object_service->setFluxIliasRestObjectTypeTitle(
            ($values->{ConfigKey::FLUX_ILIAS_REST_OBJECT_TYPE_TITLE->value} ?? null) ?: null
        );

        $this->flux_ilias_rest_object_service->setFluxIliasRestObjectWebProxyMaps(
            array_map([FluxIliasRestObjectWebProxyMapDto::class, "newFromObject"], (array) ($values->{ConfigKey::FLUX_ILIAS_REST_OBJECT_WEB_PROXY_MAPS->value} ?? null))
        );

        $this->change_service->setKeepChangesInsideDays(
            ($keep_changes_inside_days = $values->{ConfigKey::KEEP_CHANGES_INSIDE_DAYS->value} ?? null) !== null ? intval($keep_changes_inside_days) : null
        );

        $this->change_service->setPurgeChangesSchedule(
            CustomScheduleTypeCronConfig::factory(
                $values->{ConfigKey::PURGE_CHANGES_SCHEDULE->value}->type ?? null
            ),
            ($interval = $values->{ConfigKey::PURGE_CHANGES_SCHEDULE->value}->interval ?? null) !== null ? intval($interval) : null
        );

        $this->change_service->setTransferChangesPassword(
            ($values->{ConfigKey::TRANSFER_CHANGES_PASSWORD->value} ?? null) ?: null
        );

        $this->change_service->setTransferChangesPostUrl(
            strval($values->{ConfigKey::TRANSFER_CHANGES_POST_URL->value} ?? null)
        );

        $this->change_service->setTransferChangesSchedule(
            CustomScheduleTypeCronConfig::factory(
                $values->{ConfigKey::TRANSFER_CHANGES_SCHEDULE->value}->type ?? null
            ),
            ($interval = $values->{ConfigKey::TRANSFER_CHANGES_SCHEDULE->value}->interval ?? null) !== null ? intval($interval) : null
        );

        $this->change_service->setTransferChangesUser(
            ($values->{ConfigKey::TRANSFER_CHANGES_USER->value} ?? null) ?: null
        );

        $this->proxy_config_service->setWebProxyIframeHeightOffset(
            ($web_proxy_iframe_height_offset = $values->{ConfigKey::WEB_PROXY_IFRAME_HEIGHT_OFFSET->value} ?? null) !== null ? intval($web_proxy_iframe_height_offset) : null
        );

        $this->proxy_config_service->setWebProxyMap(
            array_map([WebProxyMapDto::class, "newFromObject"], (array) ($values->{ConfigKey::WEB_PROXY_MAP->value} ?? null))
        );

        return true;
    }
}
