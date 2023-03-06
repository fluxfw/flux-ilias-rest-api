<?php

namespace FluxIliasRestApi\Service\ScormLearningModule\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Adapter\ScormLearningModule\ScormLearningModuleDiffDto;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\ScormLearningModule\ScormLearningModuleQuery;
use ilObjSCORM2004LearningModule;

class CreateScormLearningModuleCommand
{

    use ScormLearningModuleQuery;

    private function __construct(
        private readonly ObjectService $object_service
    ) {

    }


    public static function new(
        ObjectService $object_service
    ) : static {
        return new static(
            $object_service
        );
    }


    public function createScormLearningModuleToId(int $parent_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createScormLearningModule(
            $this->object_service->getObjectById(
                $parent_id,
                false
            ),
            $diff
        );
    }


    public function createScormLearningModuleToImportId(string $parent_import_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createScormLearningModule(
            $this->object_service->getObjectByImportId(
                $parent_import_id,
                false
            ),
            $diff
        );
    }


    public function createScormLearningModuleToRefId(int $parent_ref_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createScormLearningModule(
            $this->object_service->getObjectByRefId(
                $parent_ref_id,
                false
            ),
            $diff
        );
    }


    private function createScormLearningModule(?ObjectDto $parent_object, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        if ($parent_object === null || $parent_object->ref_id === null) {
            return null;
        }

        $ilias_scorm_learning_module = $this->newIliasScormLearningModule(
            $diff->type
        );

        $ilias_scorm_learning_module->setTitle($diff->title ?? "");

        $ilias_scorm_learning_module->create();
        $ilias_scorm_learning_module->createReference();
        $ilias_scorm_learning_module->putInTree($parent_object->ref_id);
        $ilias_scorm_learning_module->setPermissions($parent_object->ref_id);

        $this->mapScormLearningModuleDiff(
            $diff,
            $ilias_scorm_learning_module
        );

        $ilias_scorm_learning_module->setModuleVersion($diff->authoring_mode ? 1 : 0);

        $ilias_scorm_learning_module->createDataDirectory();
        if ($diff->authoring_mode && $ilias_scorm_learning_module instanceof ilObjSCORM2004LearningModule) {
            $ilias_scorm_learning_module->createScorm2004Tree();
        }

        $ilias_scorm_learning_module->update();

        return ObjectIdDto::new(
            $ilias_scorm_learning_module->getId() ?: null,
            $diff->import_id,
            $ilias_scorm_learning_module->getRefId() ?: null
        );
    }
}
