<?php

namespace FluxIliasRestApi\Channel\Category;

use FluxIliasRestApi\Adapter\Api\Category\CategoryDiffDto;
use FluxIliasRestApi\Adapter\Api\Category\CategoryDto;
use FluxIliasRestApi\Channel\Object\CustomInternalObjectType;
use FluxIliasRestApi\Channel\Object\LegacyDefaultInternalObjectType;
use ilDBConstants;
use ilObjCategory;

trait CategoryQuery
{

    private function getCategoryQuery(?int $id = null, ?string $import_id = null, ?int $ref_id = null) : string
    {
        $wheres = [
            "object_data.type=" . $this->database->quote(LegacyDefaultInternalObjectType::CAT()->value, ilDBConstants::T_TEXT),
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
GROUP BY object_data.obj_id
ORDER BY object_data.title ASC,object_data.create_date ASC,object_reference.ref_id ASC";
    }


    private function getIliasCategory(int $id, ?int $ref_id = null) : ?ilObjCategory
    {
        if ($ref_id !== null) {
            return new ilObjCategory($ref_id, true);
        } else {
            return new ilObjCategory($id, false);
        }
    }


    private function mapCategoryDiff(CategoryDiffDto $diff, ilObjCategory $ilias_category) : void
    {
        if ($diff->getImportId() !== null) {
            $ilias_category->setImportId($diff->getImportId());
        }

        if ($diff->getTitle() !== null) {
            $ilias_category->setTitle($diff->getTitle());
        }

        if ($diff->getDescription() !== null) {
            $ilias_category->setDescription($diff->getDescription());
        }

        if ($diff->getDidacticTemplateId() !== null) {
            $ilias_category->applyDidacticTemplate($diff->getDidacticTemplateId());
        }
    }


    private function mapCategoryDto(array $category) : CategoryDto
    {
        $type = ($type = $category["type"] ?: null) !== null ? CustomInternalObjectType::factory($type) : null;

        return CategoryDto::new(
            $category["obj_id"] ?: null,
            $category["import_id"] ?: null,
            $category["ref_id"] ?: null,
            strtotime($category["create_date"] ?? null) ?: null,
            strtotime($category["last_update"] ?? null) ?: null,
            $category["parent_obj_id"] ?: null,
            $category["parent_import_id"] ?: null,
            $category["parent_ref_id"] ?: null,
            $this->getObjectUrl($category["ref_id"] ?: null, $type),
            $this->getObjectIconUrl($category["obj_id"] ?: null, $type),
            $category["title"] ?? "",
            $category["description"] ?? "",
            $category["tpl_id"] ?: null
        );
    }


    private function newIliasCategory() : ilObjCategory
    {
        return new ilObjCategory();
    }
}
