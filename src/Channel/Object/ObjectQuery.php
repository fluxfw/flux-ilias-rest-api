<?php

namespace FluxIliasRestApi\Channel\Object;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDiffDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectType;
use ilCopyWizardOptions;
use ilDBConstants;
use ilLink;
use ilObject;
use ilObjectFactory;
use ilSession;
use ilSoapFunctions;
use LogicException;

trait ObjectQuery
{

    private function cloneIliasObject(ilObject $ilias_object, ObjectDto $parent_object, bool $link = false, bool $prefer_link = false) : ?ilObject
    {
        if (!$this->ilias_object_definition->allowCopy($ilias_object->getType())) {
            throw new LogicException("Can't clone object type " . $ilias_object->getType());
        }

        $wizard_options = ilCopyWizardOptions::_getInstance(ilCopyWizardOptions::_allocateCopyId());

        $wizard_options->saveOwner($this->ilias_user->getId());
        $wizard_options->saveRoot($ilias_object->getRefId());

        $wizard_options->initContainer($ilias_object->getRefId(), $parent_object->getRefId());
        foreach ($this->ilias_tree->getSubTree($this->tree->getNodeData($ilias_object->getRefId())) as $child) {
            if (intval($child["ref_id"]) === intval($ilias_object->getRefId())) {
                continue;
            }

            $copy_types = [];
            if ($this->ilias_object_definition->allowCopy($child["type"])) {
                $copy_types[] = ilCopyWizardOptions::COPY_WIZARD_COPY;
            }

            if ($link && $this->ilias_object_definition->allowLink($child["type"])) {
                $copy_types[] = ilCopyWizardOptions::COPY_WIZARD_LINK;
            }
            if (empty($copy_types)) {
                continue;
            }

            if ($prefer_link) {
                $copy_types = array_reverse($copy_types);
            }

            $wizard_options->addEntry($child["ref_id"], ["type" => current($copy_types)]);
        }
        $wizard_options->read();
        $wizard_options->storeTree($ilias_object->getRefId());

        $wizard_options->disableSOAP();
        $wizard_options->read();

        $new_ref_id = ilSoapFunctions::ilClone(ilSession::_duplicate(session_id()) . "::" . CLIENT_ID, $wizard_options->getCopyId());
        if (empty($new_ref_id)) {
            return null;
        }

        return $this->getIliasObject(
            0,
            $new_ref_id
        );
    }


    private function getIliasObject(int $id, ?int $ref_id = null) : ?ilObject
    {
        if ($ref_id !== null) {
            return ilObjectFactory::getInstanceByRefId($ref_id, false) ?: null;
        } else {
            return ilObjectFactory::getInstanceByObjId($id, false) ?: null;
        }
    }


    private function getObjectChildrenQuery(?int $id = null, ?string $import_id = null, ?int $ref_id = null, ?bool $in_trash = null) : string
    {
        $wheres = [];

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
            $wheres[] = "object_reference_child.deleted IS" . ($in_trash ? " NOT" : "") . " NULL";
        }

        return "SELECT object_data_child.*,object_reference_child.ref_id,object_reference_child.deleted,object_data.obj_id AS parent_obj_id,object_reference.ref_id AS parent_ref_id,object_data.import_id AS parent_import_id
FROM object_data
INNER JOIN object_reference ON object_data.obj_id=object_reference.obj_id
INNER JOIN tree ON object_reference.ref_id=tree.parent
INNER JOIN object_reference AS object_reference_child ON tree.child=object_reference_child.ref_id
INNER JOIN object_data AS object_data_child ON object_reference_child.obj_id=object_data_child.obj_id
" . (!empty($wheres) ? "WHERE " . implode(" AND ", $wheres) : "") . "
GROUP BY object_data_child.obj_id
ORDER BY object_data_child.title ASC,object_data_child.create_date ASC,object_reference_child.ref_id ASC";
    }


    private function getObjectIconUrl(int $id, ?InternalObjectType $type = null) : string
    {
        $icon = ilObject::_getIcon($id, "big", $type !== null ? $type->value : "");

        if (str_starts_with($icon, "./")) {
            $icon = substr($icon, 2);
        }

        return ILIAS_HTTP_PATH . "/" . $icon;
    }


    private function getObjectQuery(?ObjectType $type = null, ?int $id = null, ?string $import_id = null, ?int $ref_id = null, ?array $ref_ids = null, ?bool $in_trash = null) : string
    {
        $wheres = [];

        if ($type !== null) {
            $wheres[] = "object_data.type=" . $this->ilias_database->quote(ObjectTypeMapping::mapExternalToInternal($type)->value, ilDBConstants::T_TEXT);
        }

        if ($id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->ilias_database->quote($id, ilDBConstants::T_INTEGER);
        }

        if ($import_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->ilias_database->quote($import_id, ilDBConstants::T_TEXT);
        }

        if ($ref_id !== null) {
            $wheres[] = "object_reference.ref_id=" . $this->ilias_database->quote($ref_id, ilDBConstants::T_INTEGER);
        }

        if ($ref_ids !== null) {
            $wheres[] = $this->ilias_database->in("object_reference.ref_id", $ref_ids, false, ilDBConstants::T_INTEGER);
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
" . (!empty($wheres) ? "WHERE " . implode(" AND ", $wheres) : "") . "
GROUP BY object_data.obj_id
ORDER BY object_data.title ASC,object_data.create_date ASC,object_reference.ref_id ASC";
    }


    private function getObjectRefIdsQuery(array $ids) : string
    {
        return "SELECT object_data.obj_id,object_reference.ref_id
FROM object_data
INNER JOIN object_reference ON object_data.obj_id=object_reference.obj_id
WHERE " . $this->ilias_database->in("object_data.obj_id", $ids, false, ilDBConstants::T_INTEGER) . "
ORDER BY object_reference.ref_id ASC";
    }


    private function getObjectUrl(?int $ref_id, ?InternalObjectType $type = null) : ?string
    {
        if ($ref_id === null) {
            return null;
        }

        return ilLink::_getStaticLink($ref_id, $type !== null ? $type->value : "");
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


    private function mapObjectDto(array $object, ?array $ref_ids = null) : ObjectDto
    {
        $type = ($type = $object["type"] ?: null) !== null ? CustomInternalObjectType::factory($type) : null;

        return ObjectDto::new(
            $object["obj_id"] ?: null,
            $object["import_id"] ?: null,
            $object["ref_id"] ?: null,
            $ref_ids !== null ? array_values(array_map(fn(array $object_ref_id) : int => $object_ref_id["ref_id"] ?: null,
                array_filter($ref_ids, fn(array $object_ref_id) : bool => $object_ref_id["obj_id"] === $object["obj_id"]))) : null,
            $type !== null ? ObjectTypeMapping::mapInternalToExternal($type) : null,
            strtotime($object["create_date"] ?? null) ?: null,
            strtotime($object["last_update"] ?? null) ?: null,
            $object["parent_obj_id"] ?: null,
            $object["parent_import_id"] ?: null,
            $object["parent_ref_id"] ?: null,
            $this->getObjectUrl($object["ref_id"] ?: null, $type),
            $this->getObjectIconUrl($object["obj_id"] ?: null, $type),
            !($object["offline"] ?? null),
            $object["title"] ?? "",
            $object["description"] ?? "",
            $object["tpl_id"] ?: null,
            ($object["deleted"] ?? null) !== null
        );
    }


    private function newIliasObject(ObjectType $type) : ilObject
    {
        $class = ilObjectFactory::getClassByType(ObjectTypeMapping::mapExternalToInternal($type)->value);

        return new $class();
    }
}
