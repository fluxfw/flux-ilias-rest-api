<?php

namespace FluxIliasRestApi\Service\ScormLearningModule\Command;

use FluxIliasRestApi\Adapter\ScormLearningModule\ScormLearningModuleDto;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use FluxIliasRestApi\Service\ScormLearningModule\ScormLearningModuleQuery;
use ilDBInterface;
use LogicException;

class GetScormLearningModuleCommand
{

    use ObjectQuery;
    use ScormLearningModuleQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $ilias_database
        );
    }


    public function getScormLearningModuleById(int $id, ?bool $in_trash = null) : ?ScormLearningModuleDto
    {
        $scorm_learning_module = null;
        while (($scorm_learning_module_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getScormLearningModuleQuery(
                $id,
                null,
                null,
                $in_trash
            )))) !== null) {
            if ($scorm_learning_module !== null) {
                throw new LogicException("Multiple scorm learning modules found with the id " . $id);
            }
            $scorm_learning_module = $this->mapScormLearningModuleDto(
                $scorm_learning_module_
            );
        }

        return $scorm_learning_module;
    }


    public function getScormLearningModuleByImportId(string $import_id, ?bool $in_trash = null) : ?ScormLearningModuleDto
    {
        $scorm_learning_module = null;
        while (($scorm_learning_module_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getScormLearningModuleQuery(
                null,
                $import_id,
                null,
                $in_trash
            )))) !== null) {
            if ($scorm_learning_module !== null) {
                throw new LogicException("Multiple scorm learning modules found with the import id " . $import_id);
            }
            $scorm_learning_module = $this->mapScormLearningModuleDto(
                $scorm_learning_module_
            );
        }

        return $scorm_learning_module;
    }


    public function getScormLearningModuleByRefId(int $ref_id, ?bool $in_trash = null) : ?ScormLearningModuleDto
    {
        $scorm_learning_module = null;
        while (($scorm_learning_module_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getScormLearningModuleQuery(
                null,
                null,
                $ref_id,
                $in_trash
            )))) !== null) {
            if ($scorm_learning_module !== null) {
                throw new LogicException("Multiple scorm learning modules found with the ref id " . $ref_id);
            }
            $scorm_learning_module = $this->mapScormLearningModuleDto(
                $scorm_learning_module_
            );
        }

        return $scorm_learning_module;
    }
}
