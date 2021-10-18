<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Group;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Group\GroupDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Group\GroupDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\InternalObjectType;
use ilDBConstants;
use ilObjGroup;

trait GroupQuery
{

    private function getGroupQuery(?int $id = null, ?string $import_id = null, ?int $ref_id = null) : string
    {
        $wheres = [
            "object_data.type=" . $this->database->quote(InternalObjectType::GRP, ilDBConstants::T_TEXT),
            "object_reference.deleted IS NULL"
        ];

        if ($id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->database->quote($id, ilDBConstants::T_INTEGER);
        }

        if ($import_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->database->quote($import_id, ilDBConstants::T_TEXT);
        }

        if ($ref_id !== null) {
            $wheres[] = "object_reference.ref_id=" . $this->database->quote($ref_id, ilDBConstants::T_INTEGER);
        }

        return "SELECT object_data.*,object_reference.ref_id,didactic_tpl_objs.tpl_id,object_data_parent.obj_id AS parent_obj_id,object_reference_parent.ref_id AS parent_ref_id,object_data_parent.import_id AS parent_import_id
FROM object_data
LEFT JOIN object_reference ON object_data.obj_id=object_reference.obj_id
LEFT JOIN didactic_tpl_objs ON object_data.obj_id=didactic_tpl_objs.obj_id
LEFT JOIN tree ON object_reference.ref_id=tree.child
LEFT JOIN object_reference AS object_reference_parent ON tree.parent=object_reference_parent.ref_id
LEFT JOIN object_data AS object_data_parent ON object_reference_parent.obj_id=object_data_parent.obj_id
WHERE " . implode(" AND ", $wheres) . "
ORDER BY object_data.title ASC,object_data.create_date ASC";
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
        if ($diff->getImportId() !== null) {
            $ilias_group->setImportId($diff->getImportId());
        }

        if ($diff->getTitle() !== null) {
            $ilias_group->setTitle($diff->getTitle());
        }

        if ($diff->getDescription() !== null) {
            $ilias_group->setDescription($diff->getDescription());
        }

        if ($diff->getDidacticTemplateId() !== null) {
            $ilias_group->applyDidacticTemplate($diff->getDidacticTemplateId());
        }
    }


    private function mapGroupDto(array $group) : GroupDto
    {
        return GroupDto::new(
            $group["obj_id"] ?: null,
            $group["import_id"] ?: null,
            $group["ref_id"] ?: null,
            strtotime($group["create_date"] ?? null) ?: null,
            strtotime($group["last_update"] ?? null) ?: null,
            $group["parent_obj_id"] ?: null,
            $group["parent_import_id"] ?: null,
            $group["parent_ref_id"] ?: null,
            $this->getObjectUrl($group["ref_id"] ?: null, $group["type"] ?: null),
            $this->getObjectIconUrl($group["obj_id"] ?: null, $group["type"] ?: null),
            $group["title"] ?? "",
            $group["description"] ?? "",
            $group["tpl_id"] ?: null
        );
    }


    private function newIliasGroup() : ilObjGroup
    {
        return new ilObjGroup();
    }
}
