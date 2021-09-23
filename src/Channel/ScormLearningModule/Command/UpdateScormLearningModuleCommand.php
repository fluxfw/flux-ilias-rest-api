<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDto;
use Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule\Port\ScormLearningModuleService;
use Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule\ScormLearningModuleQuery;

class UpdateScormLearningModuleCommand
{

    use ScormLearningModuleQuery;

    private ScormLearningModuleService $scorm_learning_module;


    public static function new(ScormLearningModuleService $scorm_learning_module) : /*static*/ self
    {
        $command = new static();

        $command->scorm_learning_module = $scorm_learning_module;

        return $command;
    }


    public function updateScormLearningModuleById(int $id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateScormLearningModule(
            $this->scorm_learning_module->getScormLearningModuleById(
                $id
            ),
            $diff
        );
    }


    public function updateScormLearningModuleByImportId(string $import_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateScormLearningModule(
            $this->scorm_learning_module->getScormLearningModuleByImportId(
                $import_id
            ),
            $diff
        );
    }


    public function updateScormLearningModuleByRefId(int $ref_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateScormLearningModule(
            $this->scorm_learning_module->getScormLearningModuleByRefId(
                $ref_id
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
            $scorm_learning_module->getRefId(),
            $scorm_learning_module->getId()
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
