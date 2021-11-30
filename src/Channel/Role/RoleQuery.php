<?php

namespace FluxIliasRestApi\Channel\Role;

use FluxIliasRestApi\Adapter\Api\Role\RoleDiffDto;
use FluxIliasRestApi\Adapter\Api\Role\RoleDto;
use FluxIliasRestApi\Channel\Object\LegacyDefaultInternalObjectType;
use ilDBConstants;
use ilObjRole;

trait RoleQuery
{

    private function getIliasRole(int $id) : ?ilObjRole
    {
        return new ilObjRole($id);
    }


    private function getRoleQuery(?int $id = null, ?string $import_id = null) : string
    {
        $wheres = [
            "object_data.type=" . $this->database->quote(LegacyDefaultInternalObjectType::ROLE()->value, ilDBConstants::T_TEXT)
        ];

        if ($id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->database->quote($id, ilDBConstants::T_INTEGER);
        }

        if ($import_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->database->quote($import_id, ilDBConstants::T_TEXT);
        }

        return "SELECT object_data.*,object_data_parent.obj_id AS parent_obj_id,object_reference_parent.ref_id AS parent_ref_id,object_data_parent.import_id AS parent_import_id
FROM object_data
LEFT JOIN rbac_fa ON object_data.obj_id=rbac_fa.rol_id
LEFT JOIN object_reference AS object_reference_parent ON rbac_fa.parent=object_reference_parent.ref_id
LEFT JOIN object_data AS object_data_parent ON object_reference_parent.obj_id=object_data_parent.obj_id
WHERE " . implode(" AND ", $wheres) . "
GROUP BY object_data.obj_id
ORDER BY object_data.title ASC,object_data.create_date ASC,object_data_parent.obj_id ASC";
    }


    private function mapRoleDiff(RoleDiffDto $diff, ilObjRole $ilias_role) : void
    {
        if ($diff->getImportId() !== null) {
            $ilias_role->setImportId($diff->getImportId());
        }

        if ($diff->getTitle() !== null) {
            $ilias_role->setTitle($diff->getTitle());
        }

        if ($diff->getDescription() !== null) {
            $ilias_role->setDescription($diff->getDescription());
        }
    }


    private function mapRoleDto(array $role) : RoleDto
    {
        return RoleDto::new(
            $role["obj_id"] ?: null,
            $role["import_id"] ?: null,
            strtotime($role["create_date"] ?? null) ?: null,
            strtotime($role["last_update"] ?? null) ?: null,
            $role["parent_obj_id"] ?: null,
            $role["parent_import_id"] ?: null,
            $role["parent_ref_id"] ?: null,
            $role["title"] ?? "",
            $role["description"] ?? ""
        );
    }


    private function newIliasRole() : ilObjRole
    {
        return new ilObjRole();
    }
}
