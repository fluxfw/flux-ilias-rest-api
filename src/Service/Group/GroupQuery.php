<?php

namespace FluxIliasRestApi\Service\Group;

use FluxIliasBaseApi\Adapter\Group\GroupDiffDto;
use FluxIliasBaseApi\Adapter\Group\GroupDto;
use FluxIliasRestApi\Service\Object\CustomInternalObjectType;
use FluxIliasRestApi\Service\Object\DefaultInternalObjectType;
use ilDBConstants;
use ilObjGroup;

trait GroupQuery
{

    private function getGroupQuery(?int $id = null, ?string $import_id = null, ?int $ref_id = null, ?bool $in_trash = null) : string
    {
        $wheres = [
            "object_data.type=" . $this->ilias_database->quote(DefaultInternalObjectType::GRP->value, ilDBConstants::T_TEXT)
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

        return "SELECT object_data.*,object_reference.ref_id,object_reference.deleted,didactic_tpl_objs.tpl_id,object_data_parent.obj_id AS parent_obj_id,object_reference_parent.ref_id AS parent_ref_id,object_data_parent.import_id AS parent_import_id
FROM object_data
LEFT JOIN object_reference ON object_data.obj_id=object_reference.obj_id
LEFT JOIN didactic_tpl_objs ON object_data.obj_id=didactic_tpl_objs.obj_id
LEFT JOIN tree ON object_reference.ref_id=tree.child
LEFT JOIN object_reference AS object_reference_parent ON tree.parent=object_reference_parent.ref_id
LEFT JOIN object_data AS object_data_parent ON object_reference_parent.obj_id=object_data_parent.obj_id
WHERE " . implode(" AND ", $wheres) . "
GROUP BY object_data.obj_id
ORDER BY object_data.title ASC,object_data.create_date ASC,object_reference.ref_id ASC";
    }


    private function getIliasGroup(int $id, ?int $ref_id = null) : ?ilObjGroup
    {
        if ($ref_id !== null) {
            return new ilObjGroup($ref_id, true);
        } else {
            return new ilObjGroup($id, false);
        }
    }


    private function mapGroupDiff(GroupDiffDto $diff, ilObjGroup $ilias_group) : void
    {
        if ($diff->import_id !== null) {
            $ilias_group->setImportId($diff->import_id);
        }

        if ($diff->title !== null) {
            $ilias_group->setTitle($diff->title);
        }

        if ($diff->description !== null) {
            $ilias_group->setDescription($diff->description);
        }

        if ($diff->didactic_template_id !== null) {
            $ilias_group->applyDidacticTemplate($diff->didactic_template_id);
        }

        if ($diff->custom_metadata !== null) {
            $this->updateCustomMetadata(
                $ilias_group->getId(),
                $diff->custom_metadata
            );
        }
    }


    private function mapGroupDto(array $group, bool $custom_metadata = false) : GroupDto
    {
        $type = ($type = $group["type"] ?: null) !== null ? CustomInternalObjectType::factory(
            $type
        ) : null;

        return GroupDto::new(
            $group["obj_id"] ?: null,
            $group["import_id"] ?: null,
            $group["ref_id"] ?: null,
            strtotime($group["create_date"] ?? null) ?: null,
            strtotime($group["last_update"] ?? null) ?: null,
            $group["parent_obj_id"] ?: null,
            $group["parent_import_id"] ?: null,
            $group["parent_ref_id"] ?: null,
            $this->getObjectUrl(
                $group["ref_id"] ?: null,
                $type
            ),
            $this->getObjectIconUrl(
                $group["obj_id"] ?: null,
                $type
            ),
            $group["title"] ?? "",
            $group["description"] ?? "",
            $group["tpl_id"] ?: null,
            ($group["deleted"] ?? null) !== null,
            $custom_metadata ? $this->getCustomMetadata(
                $group["obj_id"] ?: null
            ) : null
        );
    }


    private function newIliasGroup() : ilObjGroup
    {
        return new ilObjGroup();
    }
}
