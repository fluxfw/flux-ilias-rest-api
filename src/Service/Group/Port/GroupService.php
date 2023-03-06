<?php

namespace FluxIliasRestApi\Service\Group\Port;

use FluxIliasRestApi\Adapter\Group\GroupDiffDto;
use FluxIliasRestApi\Adapter\Group\GroupDto;
use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Service\Group\Command\CreateGroupCommand;
use FluxIliasRestApi\Service\Group\Command\GetGroupCommand;
use FluxIliasRestApi\Service\Group\Command\GetGroupsCommand;
use FluxIliasRestApi\Service\Group\Command\UpdateGroupCommand;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use ilDBInterface;

class GroupService
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


    public function createGroupToId(int $parent_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return CreateGroupCommand::new(
            $this->object_service,
            $this->ilias_database
        )
            ->createGroupToId(
                $parent_id,
                $diff
            );
    }


    public function createGroupToImportId(string $parent_import_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return CreateGroupCommand::new(
            $this->object_service,
            $this->ilias_database
        )
            ->createGroupToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createGroupToRefId(int $parent_ref_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return CreateGroupCommand::new(
            $this->object_service,
            $this->ilias_database
        )
            ->createGroupToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getGroupById(int $id, ?bool $in_trash = null) : ?GroupDto
    {
        return GetGroupCommand::new(
            $this->ilias_database
        )
            ->getGroupById(
                $id,
                $in_trash
            );
    }


    public function getGroupByImportId(string $import_id, ?bool $in_trash = null) : ?GroupDto
    {
        return GetGroupCommand::new(
            $this->ilias_database
        )
            ->getGroupByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getGroupByRefId(int $ref_id, ?bool $in_trash = null) : ?GroupDto
    {
        return GetGroupCommand::new(
            $this->ilias_database
        )
            ->getGroupByRefId(
                $ref_id,
                $in_trash
            );
    }


    /**
     * @return GroupDto[]
     */
    public function getGroups(?bool $in_trash = null) : array
    {
        return GetGroupsCommand::new(
            $this->ilias_database
        )
            ->getGroups(
                $in_trash
            );
    }


    public function updateGroupById(int $id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateGroupCommand::new(
            $this,
            $this->ilias_database
        )
            ->updateGroupById(
                $id,
                $diff
            );
    }


    public function updateGroupByImportId(string $import_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateGroupCommand::new(
            $this,
            $this->ilias_database
        )
            ->updateGroupByImportId(
                $import_id,
                $diff
            );
    }


    public function updateGroupByRefId(int $ref_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateGroupCommand::new(
            $this,
            $this->ilias_database
        )
            ->updateGroupByRefId(
                $ref_id,
                $diff
            );
    }
}
