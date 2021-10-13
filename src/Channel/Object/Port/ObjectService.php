<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Object\Port;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\CloneObjectCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\CreateObjectCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\DeleteObjectCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\GetChildrenCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\GetObjectCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\GetObjectsCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\GetPathCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\GetRootObjectCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\MoveObjectCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\UpdateObjectCommand;
use ilDBInterface;
use ilTree;

class ObjectService
{

    private ilDBInterface $database;
    private ilTree $tree;


    public static function new(ilDBInterface $database, ilTree $tree) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->tree = $tree;

        return $service;
    }


    public function cloneObjectByIdToId(int $id, int $new_parent_id) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this
        )
            ->cloneObjectByIdToId(
                $id,
                $new_parent_id
            );
    }


    public function cloneObjectByIdToImportId(int $id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this
        )
            ->cloneObjectByIdToImportId(
                $id,
                $new_parent_import_id
            );
    }


    public function cloneObjectByIdToRefId(int $id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this
        )
            ->cloneObjectByIdToRefId(
                $id,
                $new_parent_ref_id
            );
    }


    public function cloneObjectByImportIdToId(string $import_id, int $new_parent_id) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this
        )
            ->cloneObjectByImportIdToId(
                $import_id,
                $new_parent_id
            );
    }


    public function cloneObjectByImportIdToImportId(string $import_id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this
        )
            ->cloneObjectByImportIdToImportId(
                $import_id,
                $new_parent_import_id
            );
    }


    public function cloneObjectByImportIdToRefId(string $import_id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this
        )
            ->cloneObjectByImportIdToRefId(
                $import_id,
                $new_parent_ref_id
            );
    }


    public function cloneObjectByRefIdToId(int $ref_id, int $new_parent_id) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this
        )
            ->cloneObjectByRefIdToId(
                $ref_id,
                $new_parent_id
            );
    }


    public function cloneObjectByRefIdToImportId(int $ref_id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this
        )
            ->cloneObjectByRefIdToImportId(
                $ref_id,
                $new_parent_import_id
            );
    }


    public function cloneObjectByRefIdToRefId(int $ref_id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this
        )
            ->cloneObjectByRefIdToRefId(
                $ref_id,
                $new_parent_ref_id
            );
    }


    public function createObjectToId(string $type, int $parent_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return CreateObjectCommand::new(
            $this
        )
            ->createObjectToId(
                $type,
                $parent_id,
                $diff
            );
    }


    public function createObjectToImportId(string $type, string $parent_import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return CreateObjectCommand::new(
            $this
        )
            ->createObjectToImportId(
                $type,
                $parent_import_id,
                $diff
            );
    }


    public function createObjectToRefId(string $type, int $parent_ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return CreateObjectCommand::new(
            $this
        )
            ->createObjectToRefId(
                $type,
                $parent_ref_id,
                $diff
            );
    }


    public function deleteObjectById(int $id) : ?ObjectIdDto
    {
        return DeleteObjectCommand::new(
            $this
        )
            ->deleteObjectById(
                $id
            );
    }


    public function deleteObjectByImportId(string $import_id) : ?ObjectIdDto
    {
        return DeleteObjectCommand::new(
            $this
        )
            ->deleteObjectByImportId(
                $import_id
            );
    }


    public function deleteObjectByRefId(int $ref_id) : ?ObjectIdDto
    {
        return DeleteObjectCommand::new(
            $this
        )
            ->deleteObjectByRefId(
                $ref_id
            );
    }


    public function getChildrenById(int $id) : ?array
    {
        return GetChildrenCommand::new(
            $this,
            $this->database
        )
            ->getChildrenById(
                $id
            );
    }


    public function getChildrenByImportId(string $import_id) : ?array
    {
        return GetChildrenCommand::new(
            $this,
            $this->database
        )
            ->getChildrenByImportId(
                $import_id
            );
    }


    public function getChildrenByRefId(int $ref_id) : ?array
    {
        return GetChildrenCommand::new(
            $this,
            $this->database
        )
            ->getChildrenByRefId(
                $ref_id
            );
    }


    public function getObjectById(int $id) : ?ObjectDto
    {
        return GetObjectCommand::new(
            $this->database
        )
            ->getObjectById(
                $id
            );
    }


    public function getObjectByImportId(string $import_id) : ?ObjectDto
    {
        return GetObjectCommand::new(
            $this->database
        )
            ->getObjectByImportId(
                $import_id
            );
    }


    public function getObjectByRefId(int $ref_id) : ?ObjectDto
    {
        return GetObjectCommand::new(
            $this->database
        )
            ->getObjectByRefId(
                $ref_id
            );
    }


    public function getObjects(string $type) : array
    {
        return GetObjectsCommand::new(
            $this->database
        )
            ->getObjects(
                $type
            );
    }


    public function getPathById(int $id) : ?array
    {
        return GetPathCommand::new(
            $this,
            $this->tree
        )
            ->getPathById(
                $id
            );
    }


    public function getPathByImportId(string $import_id) : ?array
    {
        return GetPathCommand::new(
            $this,
            $this->tree
        )
            ->getPathByImportId(
                $import_id
            );
    }


    public function getPathByRefId(int $ref_id) : ?array
    {
        return GetPathCommand::new(
            $this,
            $this->tree
        )
            ->getPathByRefId(
                $ref_id
            );
    }


    public function getRootObject() : ?ObjectDto
    {
        return GetRootObjectCommand::new(
            $this
        )
            ->getRootObject();
    }


    public function moveObjectByIdToId(int $id, int $new_parent_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByIdToId(
                $id,
                $new_parent_id
            );
    }


    public function moveObjectByIdToImportId(int $id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByIdToImportId(
                $id,
                $new_parent_import_id
            );
    }


    public function moveObjectByIdToRefId(int $id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByIdToRefId(
                $id,
                $new_parent_ref_id
            );
    }


    public function moveObjectByImportIdToId(string $import_id, int $new_parent_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByImportIdToId(
                $import_id,
                $new_parent_id
            );
    }


    public function moveObjectByImportIdToImportId(string $import_id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByImportIdToImportId(
                $import_id,
                $new_parent_import_id
            );
    }


    public function moveObjectByImportIdToRefId(string $import_id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByImportIdToRefId(
                $import_id,
                $new_parent_ref_id
            );
    }


    public function moveObjectByRefIdToId(int $ref_id, int $new_parent_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByRefIdToId(
                $ref_id,
                $new_parent_id
            );
    }


    public function moveObjectByRefIdToImportId(int $ref_id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByRefIdToImportId(
                $ref_id,
                $new_parent_import_id
            );
    }


    public function moveObjectByRefIdToRefId(int $ref_id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByRefIdToRefId(
                $ref_id,
                $new_parent_ref_id
            );
    }


    public function updateObjectById(int $id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateObjectCommand::new(
            $this
        )
            ->updateObjectById(
                $id,
                $diff
            );
    }


    public function updateObjectByImportId(string $import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateObjectCommand::new(
            $this
        )
            ->updateObjectByImportId(
                $import_id,
                $diff
            );
    }


    public function updateObjectByRefId(int $ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateObjectCommand::new(
            $this
        )
            ->updateObjectByRefId(
                $ref_id,
                $diff
            );
    }
}
