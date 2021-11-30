<?php

namespace FluxIliasRestApi\Channel\UserRole;

use FluxIliasRestApi\Adapter\Api\UserRole\UserRoleDto;
use FluxIliasRestApi\Channel\Object\LegacyDefaultInternalObjectType;
use ilDBConstants;

trait UserRoleQuery
{

    private function getUserRoleQuery(?int $user_id = null, ?string $user_import_id = null, ?int $role_id = null, ?string $role_import_id = null) : string
    {
        $wheres = [
            "object_data.type=" . $this->database->quote(LegacyDefaultInternalObjectType::ROLE()->value, ilDBConstants::T_TEXT),
            "object_data_user.type=" . $this->database->quote(LegacyDefaultInternalObjectType::USR()->value, ilDBConstants::T_TEXT)
        ];

        if ($user_id !== null) {
            $wheres[] = "object_data_user.obj_id=" . $this->database->quote($user_id, ilDBConstants::T_INTEGER);
        }

        if ($user_import_id !== null) {
            $wheres[] = "object_data_user.import_id=" . $this->database->quote($user_import_id, ilDBConstants::T_TEXT);
        }

        if ($role_id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->database->quote($role_id, ilDBConstants::T_INTEGER);
        }

        if ($role_import_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->database->quote($role_import_id, ilDBConstants::T_TEXT);
        }

        return "SELECT object_data.obj_id,object_data.import_id,object_data_user.obj_id AS usr_id,object_data_user.import_id AS user_import_id
FROM rbac_ua
INNER JOIN object_data ON rbac_ua.rol_id=object_data.obj_id
INNER JOIN object_data AS object_data_user ON rbac_ua.usr_id=object_data_user.obj_id
WHERE " . implode(" AND ", $wheres) . "
ORDER BY object_data.obj_id ASC,object_data_user.obj_id ASC";
    }


    private function mapUserRoleDto(array $user_role) : UserRoleDto
    {
        return UserRoleDto::new(
            $user_role["usr_id"] ?: null,
            $user_role["user_import_id"] ?: null,
            $user_role["obj_id"] ?: null,
            $user_role["import_id"] ?: null
        );
    }
}
