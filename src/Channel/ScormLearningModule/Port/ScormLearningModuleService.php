<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule\Port;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
use Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule\Command\CreateScormLearningModuleCommand;
use Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule\Command\GetScormLearningModuleCommand;
use Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule\Command\GetScormLearningModulesCommand;
use Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule\Command\UpdateScormLearningModuleCommand;
use Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule\Command\UploadScormLearningModuleCommand;
use ilDBInterface;

class ScormLearningModuleService
{

    private ilDBInterface $database;
    private ObjectService $object;


    public static function new(ilDBInterface $database, ObjectService $object) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->object = $object;

        return $service;
    }


    public function createScormLearningModuleToId(int $parent_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateScormLearningModuleCommand::new(
            $this->object
        )
            ->createScormLearningModuleToId(
                $parent_id,
                $diff
            );
    }


    public function createScormLearningModuleToImportId(string $parent_import_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateScormLearningModuleCommand::new(
            $this->object
        )
            ->createScormLearningModuleToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createScormLearningModuleToRefId(int $parent_ref_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateScormLearningModuleCommand::new(
            $this->object
        )
            ->createScormLearningModuleToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getScormLearningModuleById(int $id) : ?ScormLearningModuleDto
    {
        return GetScormLearningModuleCommand::new(
            $this->database
        )
            ->getScormLearningModuleById(
                $id
            );
    }


    public function getScormLearningModuleByImportId(string $import_id) : ?ScormLearningModuleDto
    {
        return GetScormLearningModuleCommand::new(
            $this->database
        )
            ->getScormLearningModuleByImportId(
                $import_id
            );
    }


    public function getScormLearningModuleByRefId(int $ref_id) : ?ScormLearningModuleDto
    {
        return GetScormLearningModuleCommand::new(
            $this->database
        )
            ->getScormLearningModuleByRefId(
                $ref_id
            );
    }


    public function getScormLearningModules() : array
    {
        return GetScormLearningModulesCommand::new(
            $this->database
        )
            ->getScormLearningModules();
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
