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

    private GroupService $group_service;
    private UserService $user_service;


    private function __construct(
        /*private readonly*/ GroupService $group_service,
        /*private readonly*/ UserService $user_service
    ) {
        $this->group_service = $group_service;
        $this->user_service = $user_service;
    }


    public static function new(
        GroupService $group_service,
        UserService $user_service
    ) : /*static*/ self
    {
        return new static(
            $group_service,
            $user_service
        );
    }


    public function addGroupMemberByIdByUserId(int $id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->addGroupMember(
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


    public function addGroupMemberByIdByUserImportId(int $id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->addGroupMember(
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


    public function addGroupMemberByImportIdByUserId(string $import_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->addGroupMember(
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


    public function addGroupMemberByImportIdByUserImportId(string $import_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->addGroupMember(
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


    public function addGroupMemberByRefIdByUserId(int $ref_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->addGroupMember(
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


    public function addGroupMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->addGroupMember(
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
