<?php

namespace FluxIliasRestApi\Channel\GroupMember\Command;

use FluxIliasRestApi\Adapter\Api\Group\GroupDto;
use FluxIliasRestApi\Adapter\Api\GroupMember\GroupMemberDiffDto;
use FluxIliasRestApi\Adapter\Api\GroupMember\GroupMemberIdDto;
use FluxIliasRestApi\Adapter\Api\User\UserDto;
use FluxIliasRestApi\Channel\Group\GroupQuery;
use FluxIliasRestApi\Channel\Group\Port\GroupService;
use FluxIliasRestApi\Channel\GroupMember\GroupMemberQuery;
use FluxIliasRestApi\Channel\User\Port\UserService;

class UpdateGroupMemberCommand
{

    use GroupQuery;
    use GroupMemberQuery;

    private GroupService $group;
    private UserService $user;


    public static function new(GroupService $group, UserService $user) : /*static*/ self
    {
        $command = new static();

        $command->group = $group;
        $command->user = $user;

        return $command;
    }


    public function updateGroupMemberByIdByUserId(int $id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->updateGroupMember(
            $this->group->getGroupById(
                $id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function updateGroupMemberByIdByUserImportId(int $id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->updateGroupMember(
            $this->group->getGroupById(
                $id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function updateGroupMemberByImportIdByUserId(string $import_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->updateGroupMember(
            $this->group->getGroupByImportId(
                $import_id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function updateGroupMemberByImportIdByUserImportId(string $import_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->updateGroupMember(
            $this->group->getGroupByImportId(
                $import_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function updateGroupMemberByRefIdByUserId(int $ref_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->updateGroupMember(
            $this->group->getGroupByRefId(
                $ref_id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function updateGroupMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->updateGroupMember(
            $this->group->getGroupByRefId(
                $ref_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    private function updateGroupMember(?GroupDto $group, ?UserDto $user, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        if ($group === null || $user === null) {
            return null;
        }

        $ilias_group = $this->getIliasGroup(
            $group->getId(),
            $group->getRefId()
        );
        if ($ilias_group === null) {
            return null;
        }

        if (!$ilias_group->getMembersObject()->isAssigned($user->getId())) {
            return null;
        }

        $this->mapGroupMemberDiff(
            $diff,
            $user->getId(),
            $ilias_group
        );

        return GroupMemberIdDto::new(
            $group->getId(),
            $group->getImportId(),
            $group->getRefId(),
            $user->getId(),
            $user->getImportId()
        );
    }
}
