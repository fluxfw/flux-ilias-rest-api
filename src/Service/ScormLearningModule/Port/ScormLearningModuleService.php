<?php

namespace FluxIliasRestApi\Service\ScormLearningModule\Port;

use FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
use FluxIliasBaseApi\Adapter\ScormLearningModule\ScormLearningModuleDiffDto;
use FluxIliasBaseApi\Adapter\ScormLearningModule\ScormLearningModuleDto;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\ScormLearningModule\Command\CreateScormLearningModuleCommand;
use FluxIliasRestApi\Service\ScormLearningModule\Command\GetScormLearningModuleCommand;
use FluxIliasRestApi\Service\ScormLearningModule\Command\GetScormLearningModulesCommand;
use FluxIliasRestApi\Service\ScormLearningModule\Command\UpdateScormLearningModuleCommand;
use FluxIliasRestApi\Service\ScormLearningModule\Command\UploadScormLearningModuleCommand;
use ilDBInterface;

class ScormLearningModuleService
{

    private function __construct(
        private readonly ilDBInterface $ilias_database,
        private readonly ObjectService $object_service
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database,
        ObjectService $object_service
    ) : static {
        return new static(
            $ilias_database,
            $object_service
        );
    }


    public function createScormLearningModuleToId(int $parent_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateScormLearningModuleCommand::new(
            $this->object_service
        )
            ->createScormLearningModuleToId(
                $parent_id,
                $diff
            );
    }


    public function createScormLearningModuleToImportId(string $parent_import_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateScormLearningModuleCommand::new(
            $this->object_service
        )
            ->createScormLearningModuleToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createScormLearningModuleToRefId(int $parent_ref_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateScormLearningModuleCommand::new(
            $this->object_service
        )
            ->createScormLearningModuleToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getScormLearningModuleById(int $id, ?bool $in_trash = null) : ?ScormLearningModuleDto
    {
        return GetScormLearningModuleCommand::new(
            $this->ilias_database
        )
            ->getScormLearningModuleById(
                $id,
                $in_trash
            );
    }


    public function getScormLearningModuleByImportId(string $import_id, ?bool $in_trash = null) : ?ScormLearningModuleDto
    {
        return GetScormLearningModuleCommand::new(
            $this->ilias_database
        )
            ->getScormLearningModuleByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getScormLearningModuleByRefId(int $ref_id, ?bool $in_trash = null) : ?ScormLearningModuleDto
    {
        return GetScormLearningModuleCommand::new(
            $this->ilias_database
        )
            ->getScormLearningModuleByRefId(
                $ref_id,
                $in_trash
            );
    }


    /**
     * @return ScormLearningModuleDto[]
     */
    public function getScormLearningModules(?bool $in_trash = null) : array
    {
        return GetScormLearningModulesCommand::new(
            $this->ilias_database
        )
            ->getScormLearningModules(
                $in_trash
            );
    }


    public function updateScormLearningModuleById(int $id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateScormLearningModuleCommand::new(
            $this
        )
            ->updateScormLearningModuleById(
                $id,
                $diff
            );
    }


    public function updateScormLearningModuleByImportId(string $import_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateScormLearningModuleCommand::new(
            $this
        )
            ->updateScormLearningModuleByImportId(
                $import_id,
                $diff
            );
    }


    public function updateScormLearningModuleByRefId(int $ref_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateScormLearningModuleCommand::new(
            $this
        )
            ->updateScormLearningModuleByRefId(
                $ref_id,
                $diff
            );
    }


    public function uploadScormLearningModuleById(int $id, string $file) : ?ObjectIdDto
    {
        return UploadScormLearningModuleCommand::new(
            $this
        )
            ->uploadScormLearningModuleById(
                $id,
                $file
            );
    }


    public function uploadScormLearningModuleByImportId(string $import_id, string $file) : ?ObjectIdDto
    {
        return UploadScormLearningModuleCommand::new(
            $this
        )
            ->uploadScormLearningModuleByImportId(
                $import_id,
                $file
            );
    }


    public function uploadScormLearningModuleByRefId(int $ref_id, string $file) : ?ObjectIdDto
    {
        return UploadScormLearningModuleCommand::new(
            $this
        )
            ->uploadScormLearningModuleByRefId(
                $ref_id,
                $file
            );
    }
}
