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

class AddGroupMemberCommand
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


    public function addGroupMemberByIdByUserId(int $id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->addGroupMember(
            $this->group->getGroupById(
                $id,
                false
            ),
            $this->user->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function addGroupMemberByIdByUserImportId(int $id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->addGroupMember(
            $this->group->getGroupById(
                $id,
                false
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function addGroupMemberByImportIdByUserId(string $import_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->addGroupMember(
            $this->group->getGroupByImportId(
                $import_id,
                false
            ),
            $this->user->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function addGroupMemberByImportIdByUserImportId(string $import_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->addGroupMember(
            $this->group->getGroupByImportId(
                $import_id,
                false
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function addGroupMemberByRefIdByUserId(int $ref_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->addGroupMember(
            $this->group->getGroupByRefId(
                $ref_id,
                false
            ),
            $this->user->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function addGroupMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->addGroupMember(
            $this->group->getGroupByRefId(
                $ref_id,
                false
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    private function addGroupMember(?GroupDto $group, ?UserDto $user, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
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
            $this->mapGroupMemberDiff(
                $diff,
                $user->getId(),
                $ilias_group
            );
        }

        return GroupMemberIdDto::new(
            $group->getId(),
            $group->getImportId(),
            $group->getRefId(),
            $user->getId(),
            $user->getImportId()
        );
    }
}
