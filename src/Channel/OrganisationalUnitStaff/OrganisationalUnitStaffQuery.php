<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitStaff;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitStaff\StaffDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\InternalObjectType;
use ilDBConstants;

trait OrganisationalUnitStaffQuery
{

    private function getOrganisationalUnitStaffQuery(
        ?int $organisational_unit_id = null,
        ?string $organisational_unit_external_id = null,
        ?int $organisational_unit_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?int $position_id = null
    ) : string {
        $wheres = [
            "object_data.type=" . $this->database->quote(InternalObjectType::ORGU, ilDBConstants::T_TEXT),
            "object_data_user.type=" . $this->database->quote(InternalObjectType::USR, ilDBConstants::T_TEXT),
            "object_reference.deleted IS NULL"
        ];

        if ($organisational_unit_id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->database->quote($organisational_unit_id, ilDBConstants::T_INTEGER);
        }

        if ($organisational_unit_external_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->database->quote($organisational_unit_external_id, ilDBConstants::T_TEXT);
        }

        if ($organisational_unit_ref_id !== null) {
            $wheres[] = "object_reference.ref_id=" . $this->database->quote($organisational_unit_ref_id, ilDBConstants::T_INTEGER);
        }

        if ($user_id !== null) {
            $wheres[] = "object_data_user.obj_id=" . $this->database->quote($user_id, ilDBConstants::T_INTEGER);
        }

        if ($user_import_id !== null) {
            $wheres[] = "object_data_user.import_id=" . $this->database->quote($user_import_id, ilDBConstants::T_TEXT);
        }

        if ($position_id !== null) {
            $wheres[] = "position_id=" . $this->database->quote($position_id, ilDBConstants::T_INTEGER);
        }

        return "SELECT il_orgu_ua.*,object_data.obj_id,object_data.import_id,object_reference.ref_id,object_data_user.obj_id AS usr_id,object_data_user.import_id AS user_import_id
FROM il_orgu_ua
INNER JOIN object_reference ON il_orgu_ua.orgu_id=object_reference.ref_id
INNER JOIN object_data ON object_reference.obj_id=object_data.obj_id
INNER JOIN object_data AS object_data_user ON il_orgu_ua.user_id=object_data_user.obj_id
WHERE " . implode(" AND ", $wheres) . "
ORDER BY object_data.obj_id ASC,object_data_user.obj_id ASC,position_id ASC";
    }


    private function mapOrganisationalUnitStaffDto(array $organisational_unit_staff) : StaffDto
    {
        return StaffDto::new(
            $organisational_unit_staff["obj_id"] ?: null,
            $organisational_unit_staff["import_id"] ?? "",
            $organisational_unit_staff["ref_id"] ?: null,
            $organisational_unit_staff["usr_id"] ?: null,
            $organisational_unit_staff["user_import_id"] ?: null,
            $organisational_unit_staff["position_id"] ?: null
        );
    }
}
