<?php

namespace FluxIliasRestApi\Channel\ScormLearningModule\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDiffDto;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use FluxIliasRestApi\Channel\ScormLearningModule\ScormLearningModuleQuery;
use ilObjSCORM2004LearningModule;

class CreateScormLearningModuleCommand
{

    use ScormLearningModuleQuery;

    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ObjectService $object_service
    ) {
        $this->object_service = $object_service;
    }


    public static function new(
        ObjectService $object_service
    ) : /*static*/ self
    {
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
        if ($parent_object === null || $parent_object->getRefId() === null) {
            return null;
        }

        $ilias_scorm_learning_module = $this->newIliasScormLearningModule(
            $diff->getType()
        );

        $ilias_scorm_learning_module->setTitle($diff->getTitle() ?? "");

        $ilias_scorm_learning_module->create();
        $ilias_scorm_learning_module->createReference();
        $ilias_scorm_learning_module->putInTree($parent_object->getRefId());
        $ilias_scorm_learning_module->setPermissions($parent_object->getRefId());

        $this->mapScormLearningModuleDiff(
            $diff,
            $ilias_scorm_learning_module
        );

        $ilias_scorm_learning_module->setModuleVersion($diff->isAuthoringMode() ? 1 : 0);

        $ilias_scorm_learning_module->createDataDirectory();
        if ($diff->isAuthoringMode() && $ilias_scorm_learning_module instanceof ilObjSCORM2004LearningModule) {
            $ilias_scorm_learning_module->createScorm2004Tree();
        }

        $ilias_scorm_learning_module->update();

        return ObjectIdDto::new(
            $ilias_scorm_learning_module->getId() ?: null,
            $diff->getImportId(),
            $ilias_scorm_learning_module->getRefId() ?: null
        );
    }
}
