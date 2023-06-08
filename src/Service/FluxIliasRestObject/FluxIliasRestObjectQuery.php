<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject;

use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDiffDto;
use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasRestApi\Service\Object\CustomInternalObjectType;
use FluxIliasRestApi\Service\Object\DefaultInternalObjectType;
use FluxIliasRestApi\Service\ObjectConfig\ObjectConfigKey;
use ilDBConstants;
use ilObjflux_ilias_rest_object_helper_plugin;

trait FluxIliasRestObjectQuery
{

    private function getFluxIliasRestObjectContainerSettingQuery(array $ids) : string
    {
        return "SELECT id,keyword,value
FROM container_settings
WHERE " . $this->ilias_database->in("id", $ids, false, ilDBConstants::T_INTEGER) . " AND value IS NOT NULL";
    }


    private function getFluxIliasRestObjectQuery(?int $id = null, ?string $import_id = null, ?int $ref_id = null, ?bool $in_trash = null) : string
    {
        $wheres = [
            "object_data.type=" . $this->ilias_database->quote(DefaultInternalObjectType::XFRO->value, ilDBConstants::T_TEXT)
        ];

        if ($id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->ilias_database->quote($id, ilDBConstants::T_INTEGER);
        }

        if ($import_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->ilias_database->quote($import_id, ilDBConstants::T_TEXT);
        }

        if ($ref_id !== null) {
            $wheres[] = "object_reference.ref_id=" . $this->ilias_database->quote($ref_id, ilDBConstants::T_INTEGER);
        }

        if ($in_trash !== null) {
            $wheres[] = "object_reference.deleted IS" . ($in_trash ? " NOT" : "") . " NULL";
        }

        return "SELECT object_data.*,object_reference.ref_id,object_reference.deleted,object_data_parent.obj_id AS parent_obj_id,object_reference_parent.ref_id AS parent_ref_id,object_data_parent.import_id AS parent_import_id
FROM object_data
LEFT JOIN object_reference ON object_data.obj_id=object_reference.obj_id
LEFT JOIN tree ON object_reference.ref_id=tree.child
LEFT JOIN object_reference AS object_reference_parent ON tree.parent=object_reference_parent.ref_id
LEFT JOIN object_data AS object_data_parent ON object_reference_parent.obj_id=object_data_parent.obj_id
WHERE " . implode(" AND ", $wheres) . "
GROUP BY object_data.obj_id
ORDER BY object_data.title ASC,object_data.create_date ASC,object_reference.ref_id ASC";
    }


    private function getIliasFluxIliasRestObject(int $id, ?int $ref_id = null) : ?ilObjflux_ilias_rest_object_helper_plugin
    {
        if ($ref_id !== null) {
            return new ilObjflux_ilias_rest_object_helper_plugin($ref_id, true);
        } else {
            return new ilObjflux_ilias_rest_object_helper_plugin($id, false);
        }
    }


    private function mapFluxIliasRestObjectDiff(FluxIliasRestObjectDiffDto $diff, ilObjflux_ilias_rest_object_helper_plugin $ilias_flux_ilias_rest_object) : void
    {
        if ($diff->import_id !== null) {
            $ilias_flux_ilias_rest_object->setImportId($diff->import_id);
        }

        if ($diff->title !== null) {
            $ilias_flux_ilias_rest_object->setTitle($diff->title);
        }

        if ($diff->description !== null) {
            $ilias_flux_ilias_rest_object->setDescription($diff->description);
        }

        if ($diff->web_proxy_map_key !== null) {
            $this->flux_ilias_rest_object_service->setFluxIliasRestObjectWebProxyMapKey(
                $ilias_flux_ilias_rest_object->getId(),
                $diff->web_proxy_map_key
            );
        }

        if ($diff->api_proxy_map_key !== null) {
            $this->flux_ilias_rest_object_service->setFluxIliasRestObjectApiProxyMapKey(
                $ilias_flux_ilias_rest_object->getId(),
                $diff->api_proxy_map_key ?: null
            );
        }
    }


    private function mapFluxIliasRestObjectDto(array $object, ?array $container_settings = null) : FluxIliasRestObjectDto
    {
        $getFluxIliasRestObjectContainerSetting = fn(ObjectConfigKey $key) : mixed => $container_settings !== null ? current(array_map(fn(array $container_setting
        ) : mixed => $this->getValueFromJson(
            $container_setting["value"] ?? null
        ),
            array_filter($container_settings, fn(array $container_setting) : bool => $container_setting["id"] === $object["obj_id"]
                && $container_setting["keyword"] === $this->getObjectConfigContainerSettingsPrefix() . $key->value)))
            : null;

        $type = ($type = $object["type"] ?: null) !== null ? CustomInternalObjectType::factory(
            $type
        ) : null;

        return FluxIliasRestObjectDto::new(
            $object["obj_id"] ?: null,
            $object["import_id"] ?: null,
            $object["ref_id"] ?: null,
            $this->convertDateTimeStringToTimestamp(
                $object["create_date"] ?? null
            ),
            $this->convertDateTimeStringToTimestamp(
                $object["last_update"] ?? null
            ),
            $object["parent_obj_id"] ?: null,
            $object["parent_import_id"] ?: null,
            $object["parent_ref_id"] ?: null,
            $this->flux_ilias_rest_object_service->getFluxIliasRestObjectWebProxyLink(
                $object["ref_id"] ?: null,
                $object["obj_id"] ?: null
            ),
            $this->getObjectIconUrl(
                $object["obj_id"] ?: null,
                $type
            ),
            $object["title"] ?? "",
            $object["description"] ?? "",
            $getFluxIliasRestObjectContainerSetting(
                ObjectConfigKey::WEB_PROXY_MAP_KEY
            ),
            $getFluxIliasRestObjectContainerSetting(
                ObjectConfigKey::API_PROXY_MAP_KEY
            ),
            ($object["deleted"] ?? null) !== null
        );
    }


    private function newFluxIliasRestObject() : ilObjflux_ilias_rest_object_helper_plugin
    {
        return new ilObjflux_ilias_rest_object_helper_plugin();
    }
}
