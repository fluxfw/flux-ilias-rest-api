<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Object;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use ilDBConstants;
use ilLink;
use ilObject;
use ilObjectFactory;

trait ObjectQuery
{

    private function getChildrenQuery(?int $id = null, ?string $import_id = null, ?int $ref_id = null) : string
    {
        $wheres = [
            "object_reference.deleted IS NULL",
            "object_reference_child.deleted IS NULL"
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

        return "SELECT object_data_child.*,object_reference_child.ref_id,object_data.obj_id AS parent_obj_id,object_reference.ref_id AS parent_ref_id,object_data.import_id AS parent_import_id
FROM object_data
INNER JOIN object_reference ON object_data.obj_id=object_reference.obj_id
INNER JOIN tree ON object_reference.ref_id=tree.parent
INNER JOIN object_reference AS object_reference_child ON tree.child=object_reference_child.ref_id
INNER JOIN object_data AS object_data_child ON object_reference_child.obj_id=object_data_child.obj_id
WHERE " . implode(" AND ", $wheres) . "
ORDER BY object_data_child.title ASC,object_data_child.create_date ASC";
    }


    private function getIliasObject(int $id, ?int $ref_id = null) : ?ilObject
    {
        if ($ref_id !== null) {
            return ilObjectFactory::getInstanceByRefId($ref_id, false) ?: null;
        } else {
            return ilObjectFactory::getInstanceByObjId($id, false) ?: null;
        }
    }


    private function getObjectIconUrl(int $id, ?string $type = null) : string
    {
        $icon = ilObject::_getIcon($id, "big", $type ?? "");

        if (str_starts_with($icon, "./")) {
            $icon = substr($icon, 2);
        }

        return ILIAS_HTTP_PATH . "/" . $icon;
    }


    private function getObjectQuery(?string $type = null, ?int $id = null, ?string $import_id = null, ?int $ref_id = null, ?array $ref_ids = null) : string
    {
        $wheres = [
            "object_reference.deleted IS NULL"
        ];

        if ($type !== null) {
            $wheres[] = "object_data.type=" . $this->database->quote(ObjectTypeMapping::mapExternalToInternal(
                    $type
                ), ilDBConstants::T_TEXT);
        }

        if ($id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->database->quote($id, ilDBConstants::T_INTEGER);
        }

        if ($import_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->database->quote($import_id, ilDBConstants::T_TEXT);
        }

        if ($ref_id !== null) {
            $wheres[] = "object_reference.ref_id=" . $this->database->quote($ref_id, ilDBConstants::T_INTEGER);
        }

        if ($ref_ids !== null) {
            $wheres[] = $this->database->in("object_reference.ref_id", $ref_ids, false, ilDBConstants::T_INTEGER);
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


    private function getObjectUrl(?int $ref_id, ?string $type = null) : ?string
    {
        if ($ref_id === null) {
            return null;
        }

        return ilLink::_getStaticLink($ref_id, $type ?? "");
    }


    private function mapObjectDiff(ObjectDiffDto $diff, ilObject $ilias_object) : void
    {
        if ($diff->getImportId() !== null) {
            $ilias_object->setImportId($diff->getImportId());
        }

        if ($diff->isOnline() !== null) {
            $ilias_object->setOfflineStatus(!$diff->isOnline());
        }

        if ($diff->getTitle() !== null) {
            $ilias_object->setTitle($diff->getTitle());
        }

        if ($diff->getDescription() !== null) {
            $ilias_object->setDescription($diff->getDescription());
        }

        if ($diff->getDidacticTemplateId() !== null) {
            $ilias_object->applyDidacticTemplate($diff->getDidacticTemplateId());
        }
    }


    private function mapObjectDto(array $object) : ObjectDto
    {
        return ObjectDto::new(
            $object["obj_id"] ?: null,
            $object["import_id"] ?: null,
            $object["ref_id"] ?: null,
            ObjectTypeMapping::mapInternalToExternal(
                $object["type"] ?? null
            ),
            strtotime($object["create_date"] ?? null) ?: null,
            strtotime($object["last_update"] ?? null) ?: null,
            $object["parent_obj_id"] ?: null,
            $object["parent_import_id"] ?: null,
            $object["parent_ref_id"] ?: null,
            $this->getObjectUrl($object["ref_id"] ?: null, $object["type"] ?: null),
            $this->getObjectIconUrl($object["obj_id"] ?: null, $object["type"] ?: null),
            !($object["offline"] ?? null),
            $object["title"] ?? "",
            $object["description"] ?? "",
            $object["tpl_id"] ?: null
        );
    }


    private function newIliasObject(string $type) : ilObject
    {
        $class = ilObjectFactory::getClassByType(ObjectTypeMapping::mapExternalToInternal(
            $type
        ));

        return new $class;
    }
}
