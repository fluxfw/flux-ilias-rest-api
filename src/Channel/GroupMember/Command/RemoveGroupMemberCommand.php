<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\GroupMember\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Group\GroupDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\GroupMember\GroupMemberIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Channel\Group\GroupQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Group\Port\GroupService;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;

class RemoveGroupMemberCommand
{

    use GroupQuery;

    private GroupService $group;
    private UserService $user;


    public static function new(GroupService $group, UserService $user) : /*static*/ self
    {
        $command = new static();

        $command->group = $group;
        $command->user = $user;

        return $command;
    }


    public function removeGroupMemberByIdByUserId(int $id, int $user_id) : ?GroupMemberIdDto
    {
        return $this->removeGroupMember(
            $this->group->getGroupById(
                $id
            ),
            $this->user->getUserById(
                $user_id
            )
        );
    }


    public function removeGroupMemberByIdByUserImportId(int $id, string $user_import_id) : ?GroupMemberIdDto
    {
        return $this->removeGroupMember(
            $this->group->getGroupById(
                $id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            )
        );
    }


    public function removeGroupMemberByImportIdByUserId(string $import_id, int $user_id) : ?GroupMemberIdDto
    {
        return $this->removeGroupMember(
            $this->group->getGroupByImportId(
                $import_id
            ),
            $this->user->getUserById(
                $user_id
            )
        );
    }


    public function removeGroupMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?GroupMemberIdDto
    {
        return $this->removeGroupMember(
            $this->group->getGroupByImportId(
                $import_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            )
        );
    }


    public function removeGroupMemberByRefIdByUserId(int $ref_id, int $user_id) : ?GroupMemberIdDto
    {
        return $this->removeGroupMember(
            $this->group->getGroupByRefId(
                $ref_id
            ),
            $this->user->getUserById(
                $user_id
            )
        );
    }


    public function removeGroupMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?GroupMemberIdDto
    {
        return $this->removeGroupMember(
            $this->group->getGroupByRefId(
                $ref_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            )
        );
    }


    private function removeGroupMember(?GroupDto $group, ?UserDto $user) : ?GroupMemberIdDto
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

        if ($ilias_group->getMembersObject()->isAssigned($user->getId())) {
            $ilias_group->getMembersObject()->delete($user->getId());
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
