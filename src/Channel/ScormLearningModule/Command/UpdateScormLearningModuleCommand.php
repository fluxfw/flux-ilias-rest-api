<?php

namespace FluxIliasRestApi\Channel\ScormLearningModule\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDiffDto;
use FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDto;
use FluxIliasRestApi\Channel\ScormLearningModule\Port\ScormLearningModuleService;
use FluxIliasRestApi\Channel\ScormLearningModule\ScormLearningModuleQuery;

class UpdateScormLearningModuleCommand
{

    use ScormLearningModuleQuery;

    private ScormLearningModuleService $scorm_learning_module_service;


    private function __construct(
        /*private readonly*/ ScormLearningModuleService $scorm_learning_module_service
    ) {
        $this->scorm_learning_module_service = $scorm_learning_module_service;
    }


    public static function new(
        ScormLearningModuleService $scorm_learning_module_service
    ) : /*static*/ self
    {
        return new static(
            $scorm_learning_module_service
        );
    }


    public function updateScormLearningModuleById(int $id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateScormLearningModule(
            $this->scorm_learning_module_service->getScormLearningModuleById(
                $id,
                false
            ),
            $diff
        );
    }


    public function updateScormLearningModuleByImportId(string $import_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateScormLearningModule(
            $this->scorm_learning_module_service->getScormLearningModuleByImportId(
                $import_id,
                false
            ),
            $diff
        );
    }


    public function updateScormLearningModuleByRefId(int $ref_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateScormLearningModule(
            $this->scorm_learning_module_service->getScormLearningModuleByRefId(
                $ref_id,
                false
            ),
            $diff
        );
    }


    private function updateScormLearningModule(?ScormLearningModuleDto $scorm_learning_module, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        if ($scorm_learning_module === null) {
            return null;
        }

        $ilias_scorm_learning_module = $this->getIliasScormLearningModule(
            $scorm_learning_module->getId(),
            $scorm_learning_module->getRefId()
        );
        if ($ilias_scorm_learning_module === null) {
            return null;
        }

        $this->mapScormLearningModuleDiff(
            $diff,
            $ilias_scorm_learning_module
        );

        $ilias_scorm_learning_module->update();

        return ObjectIdDto::new(
            $scorm_learning_module->getId(),
            $diff->getImportId() ?? $scorm_learning_module->getImportId(),
            $scorm_learning_module->getRefId()
        );
    }
}
