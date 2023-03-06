<?php

namespace FluxIliasRestApi\Service\GroupMember\Command;

use FluxIliasRestApi\Adapter\Group\GroupDto;
use FluxIliasRestApi\Adapter\GroupMember\GroupMemberDiffDto;
use FluxIliasRestApi\Adapter\GroupMember\GroupMemberIdDto;
use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\Group\GroupQuery;
use FluxIliasRestApi\Service\Group\Port\GroupService;
use FluxIliasRestApi\Service\GroupMember\GroupMemberQuery;
use FluxIliasRestApi\Service\User\Port\UserService;

class UpdateGroupMemberCommand
{

    use GroupQuery;
    use GroupMemberQuery;

    private function __construct(
        private readonly GroupService $group_service,
        private readonly UserService $user_service
    ) {

    }


    public static function new(
        GroupService $group_service,
        UserService $user_service
    ) : static {
        return new static(
            $group_service,
            $user_service
        );
    }


    public function updateGroupMemberByIdByUserId(int $id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->updateGroupMember(
            $this->group_service->getGroupById(
                $id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function updateGroupMemberByIdByUserImportId(int $id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->updateGroupMember(
            $this->group_service->getGroupById(
                $id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function updateGroupMemberByImportIdByUserId(string $import_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->updateGroupMember(
            $this->group_service->getGroupByImportId(
                $import_id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function updateGroupMemberByImportIdByUserImportId(string $import_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->updateGroupMember(
            $this->group_service->getGroupByImportId(
                $import_id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function updateGroupMemberByRefIdByUserId(int $ref_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->updateGroupMember(
            $this->group_service->getGroupByRefId(
                $ref_id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function updateGroupMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->updateGroupMember(
            $this->group_service->getGroupByRefId(
                $ref_id,
                false
            ),
            $this->user_service->getUserByImportId(
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
            $group->id,
            $group->ref_id
        );
        if ($ilias_group === null) {
            return null;
        }

        if (!$ilias_group->getMembersObject()->isAssigned($user->id)) {
            return null;
        }

        $this->mapGroupMemberDiff(
            $diff,
            $user->id,
            $ilias_group
        );

        return GroupMemberIdDto::new(
            $group->id,
            $group->import_id,
            $group->ref_id,
            $user->id,
            $user->import_id
        );
    }
}
