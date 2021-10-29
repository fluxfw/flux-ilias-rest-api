<?php

namespace FluxIliasRestApi\Channel\Group\Port;

use FluxIliasRestApi\Adapter\Api\Group\GroupDiffDto;
use FluxIliasRestApi\Adapter\Api\Group\GroupDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Group\Command\CreateGroupCommand;
use FluxIliasRestApi\Channel\Group\Command\GetGroupCommand;
use FluxIliasRestApi\Channel\Group\Command\GetGroupsCommand;
use FluxIliasRestApi\Channel\Group\Command\UpdateGroupCommand;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilDBInterface;

class GroupService
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


    public function createGroupToId(int $parent_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return CreateGroupCommand::new(
            $this->object
        )
            ->createGroupToId(
                $parent_id,
                $diff
            );
    }


    public function createGroupToImportId(string $parent_import_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return CreateGroupCommand::new(
            $this->object
        )
            ->createGroupToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createGroupToRefId(int $parent_ref_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return CreateGroupCommand::new(
            $this->object
        )
            ->createGroupToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getGroupById(int $id) : ?GroupDto
    {
        return GetGroupCommand::new(
            $this->database
        )
            ->getGroupById(
                $id
            );
    }


    public function getGroupByImportId(string $import_id) : ?GroupDto
    {
        return GetGroupCommand::new(
            $this->database
        )
            ->getGroupByImportId(
                $import_id
            );
    }


    public function getGroupByRefId(int $ref_id) : ?GroupDto
    {
        return GetGroupCommand::new(
            $this->database
        )
            ->getGroupByRefId(
                $ref_id
            );
    }


    public function getGroups() : array
    {
        return GetGroupsCommand::new(
            $this->database
        )
            ->getGroups();
    }


    public function updateGroupById(int $id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateGroupCommand::new(
            $this
        )
            ->updateGroupById(
                $id,
                $diff
            );
    }


    public function updateGroupByImportId(string $import_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateGroupCommand::new(
            $this
        )
            ->updateGroupByImportId(
                $import_id,
                $diff
            );
    }


    public function updateGroupByRefId(int $ref_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateGroupCommand::new(
            $this
        )
            ->updateGroupByRefId(
                $ref_id,
                $diff
            );
    }
}
