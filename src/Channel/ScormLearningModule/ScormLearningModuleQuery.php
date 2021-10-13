<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleType;
use Fluxlabs\FluxIliasRestApi\Channel\Object\InternalObjectType;
use ilDBConstants;
use ilObjSAHSLearningModule;
use ilObjSCORM2004LearningModule;
use ilObjSCORMLearningModule;
use LogicException;

trait ScormLearningModuleQuery
{

    private function getIliasScormLearningModule(int $id, ?int $ref_id = null) : ?ilObjSCORMLearningModule
    {
        $class = ilObjSAHSLearningModule::_lookupSubType($id) === InternalScormLearningModuleType::SCORM_2004 ? ilObjSCORM2004LearningModule::class : ilObjSCORMLearningModule::class;

        if ($ref_id !== null) {
            return new $class($ref_id, true);
        } else {
            return new $class($id, false);
        }
    }


    private function getScormLearningModuleQuery(?int $id = null, ?string $import_id = null, ?int $ref_id = null) : string
    {
        $wheres = [
            "object_data.type=" . $this->database->quote(InternalObjectType::SAHS, ilDBConstants::T_TEXT),
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

        return "SELECT object_data.*,object_reference.ref_id,didactic_tpl_objs.tpl_id,sahs_lm.*,object_data_parent.obj_id AS parent_obj_id,object_reference_parent.ref_id AS parent_ref_id,object_data_parent.import_id AS parent_import_id
FROM object_data
LEFT JOIN object_reference ON object_data.obj_id=object_reference.obj_id
LEFT JOIN didactic_tpl_objs ON object_data.obj_id=didactic_tpl_objs.obj_id
LEFT JOIN sahs_lm ON object_data.obj_id=sahs_lm.id
LEFT JOIN tree ON object_reference.ref_id=tree.child
LEFT JOIN object_reference AS object_reference_parent ON tree.parent=object_reference_parent.ref_id
LEFT JOIN object_data AS object_data_parent ON object_reference_parent.obj_id=object_data_parent.obj_id
WHERE " . implode(" AND ", $wheres) . "
ORDER BY object_data.title ASC,object_data.create_date ASC";
    }


    private function mapScormLearningModuleDiff(ScormLearningModuleDiffDto $diff, ilObjSCORMLearningModule $ilias_scorm_learning_module) : void
    {
        if ($diff->getImportId() !== null) {
            $ilias_scorm_learning_module->setImportId($diff->getImportId());
        }

        if ($diff->getType() !== null) {
            $ilias_scorm_learning_module->setSubType(ScormLearningModuleTypeMapping::mapExternalToInternal(
                $diff->getType()
            ));
        }

        if ($diff->isAuthoringMode() !== null) {
            if ($diff->isAuthoringMode() && $ilias_scorm_learning_module->getSubType() !== InternalScormLearningModuleType::SCORM_2004) {
                throw new LogicException("Can only enable authoring mode for type " . ScormLearningModuleType::SCORM_2004);
            }

            $ilias_scorm_learning_module->setEditable($diff->isAuthoringMode());
        }

        if ($diff->isSequencingExpertMode() !== null) {
            $ilias_scorm_learning_module->setSequencingExpertMode($diff->isSequencingExpertMode());
        }

        if ($diff->isOnline() !== null) {
            $ilias_scorm_learning_module->setOfflineStatus(!$diff->isOnline());
        }

        if ($diff->getTitle() !== null) {
            $ilias_scorm_learning_module->setTitle($diff->getTitle());
        }

        if ($diff->getDescription() !== null) {
            $ilias_scorm_learning_module->setDescription($diff->getDescription());
        }

        if ($diff->getDidacticTemplateId() !== null) {
            $ilias_scorm_learning_module->applyDidacticTemplate(!$diff->getDidacticTemplateId());
        }
    }


    private function mapScormLearningModuleDto(array $scorm_learning_module) : ScormLearningModuleDto
    {
        return ScormLearningModuleDto::new(
            $scorm_learning_module["obj_id"] ?: null,
            $scorm_learning_module["import_id"] ?: null,
            $scorm_learning_module["ref_id"] ?: null,
            strtotime($scorm_learning_module["create_date"] ?? null) ?: null,
            strtotime($scorm_learning_module["last_update"] ?? null) ?: null,
            $scorm_learning_module["parent_obj_id"] ?: null,
            $scorm_learning_module["parent_import_id"] ?: null,
            $scorm_learning_module["parent_ref_id"] ?: null,
            $this->getObjectUrl($scorm_learning_module["ref_id"] ?: null, $scorm_learning_module["type"] ?: null),
            $this->getObjectIconUrl($scorm_learning_module["obj_id"] ?: null, $scorm_learning_module["type"] ?: null),
            $scorm_learning_module["title"] ?? "",
            $scorm_learning_module["description"] ?? "",
            ScormLearningModuleTypeMapping::mapInternalToExternal(
                $scorm_learning_module["c_type"] ?? null
            ),
            $scorm_learning_module["module_version"] ?: null,
            !($scorm_learning_module["offline"] ?? null),
            $scorm_learning_module["editable"] ?? false,
            $scorm_learning_module["seq_exp_mode"] ?? false,
            $scorm_learning_module["tpl_id"] ?: null
        );
    }


    private function newIliasScormLearningModule(?string $type = null) : ilObjSCORMLearningModule
    {
        if ($type === ScormLearningModuleType::SCORM_2004) {
            return new ilObjSCORM2004LearningModule();
        } else {
            return new ilObjSCORMLearningModule();
        }
    }
}
