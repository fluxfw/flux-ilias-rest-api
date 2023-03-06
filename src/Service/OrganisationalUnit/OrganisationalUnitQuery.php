<?php

namespace FluxIliasRestApi\Service\OrganisationalUnit;

use FluxIliasRestApi\Adapter\OrganisationalUnit\OrganisationalUnitDiffDto;
use FluxIliasRestApi\Adapter\OrganisationalUnit\OrganisationalUnitDto;
use FluxIliasRestApi\Service\Object\CustomInternalObjectType;
use FluxIliasRestApi\Service\Object\DefaultInternalObjectType;
use ilDBConstants;
use ilObjOrgUnit;

trait OrganisationalUnitQuery
{

    private function getIliasOrganisationalUnit(int $id, ?int $ref_id = null) : ?ilObjOrgUnit
    {
        if ($ref_id !== null) {
            return new ilObjOrgUnit($ref_id, true);
        } else {
            return new ilObjOrgUnit($id, false);
        }
    }


    private function getOrganisationalUnitQuery(?int $id = null, ?string $external_id = null, ?int $ref_id = null) : string
    {
        $wheres = [
            "object_data.type=" . $this->ilias_database->quote(DefaultInternalObjectType::ORGU->value, ilDBConstants::T_TEXT)
        ];

        if ($id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->ilias_database->quote($id, ilDBConstants::T_INTEGER);
        }

        if ($external_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->ilias_database->quote($external_id, ilDBConstants::T_TEXT);
        }

        if ($ref_id !== null) {
            $wheres[] = "object_reference.ref_id=" . $this->ilias_database->quote($ref_id, ilDBConstants::T_INTEGER);
        }

        return "SELECT object_data.*,object_reference.ref_id,orgu_data.*,didactic_tpl_objs.tpl_id,object_data_parent.obj_id AS parent_obj_id,object_reference_parent.ref_id AS parent_ref_id,object_data_parent.import_id AS parent_external_id
FROM object_data
LEFT JOIN object_reference ON object_data.obj_id=object_reference.obj_id
LEFT JOIN orgu_data ON object_data.obj_id=orgu_data.orgu_id
LEFT JOIN didactic_tpl_objs ON object_data.obj_id=didactic_tpl_objs.obj_id
LEFT JOIN tree ON object_reference.ref_id=tree.child
LEFT JOIN object_reference AS object_reference_parent ON tree.parent=object_reference_parent.ref_id
LEFT JOIN object_data AS object_data_parent ON object_reference_parent.obj_id=object_data_parent.obj_id
WHERE " . implode(" AND ", $wheres) . "
GROUP BY object_data.obj_id
ORDER BY object_data.title ASC,object_data.create_date ASC,object_reference.ref_id ASC";
    }


    private function mapOrganisationalUnitDiff(OrganisationalUnitDiffDto $diff, ilObjOrgUnit $ilias_organisational_unit) : void
    {
        if ($diff->external_id !== null) {
            $ilias_organisational_unit->setImportId($diff->external_id);
        }

        if ($diff->title !== null) {
            $ilias_organisational_unit->setTitle($diff->title);
        }

        if ($diff->description !== null) {
            $ilias_organisational_unit->setDescription($diff->description);
        }

        if ($diff->type_id !== null) {
            $ilias_organisational_unit->setOrgUnitTypeId($diff->type_id);
        }

        if ($diff->didactic_template_id !== null) {
            $ilias_organisational_unit->applyDidacticTemplate($diff->didactic_template_id);
        }
    }


    private function mapOrganisationalUnitDto(array $organisational_unit) : OrganisationalUnitDto
    {
        $type = ($type = $organisational_unit["type"] ?: null) !== null ? CustomInternalObjectType::factory(
            $type
        ) : null;

        return OrganisationalUnitDto::new(
            $organisational_unit["obj_id"] ?: null,
            $organisational_unit["ref_id"] ?: null,
            strtotime($organisational_unit["create_date"] ?? null) ?: null,
            strtotime($organisational_unit["last_update"] ?? null) ?: null,
            $organisational_unit["parent_obj_id"] ?: null,
            $organisational_unit["parent_external_id"] ?? "",
            $organisational_unit["parent_ref_id"] ?: null,
            $this->getObjectUrl(
                $organisational_unit["ref_id"] ?: null,
                $type
            ),
            $organisational_unit["title"] ?? "",
            $organisational_unit["description"] ?? "",
            $organisational_unit["orgu_type_id"] ?: null,
            $organisational_unit["import_id"] ?? "",
            $organisational_unit["tpl_id"] ?: null
        );
    }


    private function newIliasOrganisationalUnit() : ilObjOrgUnit
    {
        return new ilObjOrgUnit();
    }
}
