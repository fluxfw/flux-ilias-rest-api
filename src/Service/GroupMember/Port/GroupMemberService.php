<?php

namespace FluxIliasRestApi\Service\GroupMember\Port;

use FluxIliasRestApi\Adapter\GroupMember\GroupMemberDiffDto;
use FluxIliasRestApi\Adapter\GroupMember\GroupMemberDto;
use FluxIliasRestApi\Adapter\GroupMember\GroupMemberIdDto;
use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;
use FluxIliasRestApi\Service\Group\Port\GroupService;
use FluxIliasRestApi\Service\GroupMember\Command\AddGroupMemberCommand;
use FluxIliasRestApi\Service\GroupMember\Command\GetGroupMembersCommand;
use FluxIliasRestApi\Service\GroupMember\Command\RemoveGroupMemberCommand;
use FluxIliasRestApi\Service\GroupMember\Command\UpdateGroupMemberCommand;
use FluxIliasRestApi\Service\User\Port\UserService;
use ilDBInterface;

class GroupMemberService
{

    private function __construct(
        private readonly ilDBInterface $ilias_database,
        private readonly GroupService $group_service,
        private readonly UserService $user_service
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database,
        GroupService $group_service,
        UserService $user_service
    ) : static {
        return new static(
            $ilias_database,
            $group_service,
            $user_service
        );
    }


    public function addGroupMemberByIdByUserId(int $id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return AddGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->addGroupMemberByIdByUserId(
                $id,
                $user_id,
                $diff
            );
    }


    public function addGroupMemberByIdByUserImportId(int $id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return AddGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->addGroupMemberByIdByUserImportId(
                $id,
                $user_import_id,
                $diff
            );
    }


    public function addGroupMemberByImportIdByUserId(string $import_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return AddGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->addGroupMemberByImportIdByUserId(
                $import_id,
                $user_id,
                $diff
            );
    }


    public function addGroupMemberByImportIdByUserImportId(string $import_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return AddGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->addGroupMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $diff
            );
    }


    public function addGroupMemberByRefIdByUserId(int $ref_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return AddGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->addGroupMemberByRefIdByUserId(
                $ref_id,
                $user_id,
                $diff
            );
    }


    public function addGroupMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return AddGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->addGroupMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $diff
            );
    }


    /**
     * @return GroupMemberDto[]
     */
    public function getGroupMembers(
        ?int $group_id = null,
        ?string $group_import_id = null,
        ?int $group_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?bool $member_role = null,
        ?bool $administrator_role = null,
        ?ObjectLearningProgress $learning_progress = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : array {
        return GetGroupMembersCommand::new(
            $this->ilias_database
        )
            ->getGroupMembers(
                $group_id,
                $group_import_id,
                $group_ref_id,
                $user_id,
                $user_import_id,
                $member_role,
                $administrator_role,
                $learning_progress,
                $tutorial_support,
                $notification
            );
    }


    public function removeGroupMemberByIdByUserId(int $id, int $user_id) : ?GroupMemberIdDto
    {
        return RemoveGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->removeGroupMemberByIdByUserId(
                $id,
                $user_id
            );
    }


    public function removeGroupMemberByIdByUserImportId(int $id, string $user_import_id) : ?GroupMemberIdDto
    {
        return RemoveGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->removeGroupMemberByIdByUserImportId(
                $id,
                $user_import_id
            );
    }


    public function removeGroupMemberByImportIdByUserId(string $import_id, int $user_id) : ?GroupMemberIdDto
    {
        return RemoveGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->removeGroupMemberByImportIdByUserId(
                $import_id,
                $user_id
            );
    }


    public function removeGroupMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?GroupMemberIdDto
    {
        return RemoveGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->removeGroupMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id
            );
    }


    public function removeGroupMemberByRefIdByUserId(int $ref_id, int $user_id) : ?GroupMemberIdDto
    {
        return RemoveGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->removeGroupMemberByRefIdByUserId(
                $ref_id,
                $user_id
            );
    }


    public function removeGroupMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?GroupMemberIdDto
    {
        return RemoveGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->removeGroupMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id
            );
    }


    public function updateGroupMemberByIdByUserId(int $id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return UpdateGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->updateGroupMemberByIdByUserId(
                $id,
                $user_id,
                $diff
            );
    }


    public function updateGroupMemberByIdByUserImportId(int $id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return UpdateGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->updateGroupMemberByIdByUserImportId(
                $id,
                $user_import_id,
                $diff
            );
    }


    public function updateGroupMemberByImportIdByUserId(string $import_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return UpdateGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->updateGroupMemberByImportIdByUserId(
                $import_id,
                $user_id,
                $diff
            );
    }


    public function updateGroupMemberByImportIdByUserImportId(string $import_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return UpdateGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->updateGroupMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $diff
            );
    }


    public function updateGroupMemberByRefIdByUserId(int $ref_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return UpdateGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->updateGroupMemberByRefIdByUserId(
                $ref_id,
                $user_id,
                $diff
            );
    }


    public function updateGroupMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return UpdateGroupMemberCommand::new(
            $this->group_service,
            $this->user_service
        )
            ->updateGroupMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $diff
            );
    }
}
