<?php

namespace FluxIliasRestApi\Service\ScormLearningModule\Command;

use FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
use FluxIliasBaseApi\Adapter\ScormLearningModule\ScormLearningModuleDiffDto;
use FluxIliasBaseApi\Adapter\ScormLearningModule\ScormLearningModuleDto;
use FluxIliasRestApi\Service\ScormLearningModule\Port\ScormLearningModuleService;
use FluxIliasRestApi\Service\ScormLearningModule\ScormLearningModuleQuery;

class UpdateScormLearningModuleCommand
{

    use ScormLearningModuleQuery;

    private function __construct(
        private readonly ScormLearningModuleService $scorm_learning_module_service
    ) {

    }


    public static function new(
        ScormLearningModuleService $scorm_learning_module_service
    ) : static {
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
            $scorm_learning_module->id,
            $scorm_learning_module->ref_id
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
            $scorm_learning_module->id,
            $diff->import_id ?? $scorm_learning_module->import_id,
            $scorm_learning_module->ref_id
        );
    }
}
