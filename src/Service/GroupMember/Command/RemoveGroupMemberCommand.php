<?php

namespace FluxIliasRestApi\Service\GroupMember\Command;

use FluxIliasRestApi\Adapter\Group\GroupDto;
use FluxIliasRestApi\Adapter\GroupMember\GroupMemberIdDto;
use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\Group\GroupQuery;
use FluxIliasRestApi\Service\Group\Port\GroupService;
use FluxIliasRestApi\Service\User\Port\UserService;

class RemoveGroupMemberCommand
{

    use GroupQuery;

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


    public function removeGroupMemberByIdByUserId(int $id, int $user_id) : ?GroupMemberIdDto
    {
        return $this->removeGroupMember(
            $this->group_service->getGroupById(
                $id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            )
        );
    }


    public function removeGroupMemberByIdByUserImportId(int $id, string $user_import_id) : ?GroupMemberIdDto
    {
        return $this->removeGroupMember(
            $this->group_service->getGroupById(
                $id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            )
        );
    }


    public function removeGroupMemberByImportIdByUserId(string $import_id, int $user_id) : ?GroupMemberIdDto
    {
        return $this->removeGroupMember(
            $this->group_service->getGroupByImportId(
                $import_id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            )
        );
    }


    public function removeGroupMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?GroupMemberIdDto
    {
        return $this->removeGroupMember(
            $this->group_service->getGroupByImportId(
                $import_id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            )
        );
    }


    public function removeGroupMemberByRefIdByUserId(int $ref_id, int $user_id) : ?GroupMemberIdDto
    {
        return $this->removeGroupMember(
            $this->group_service->getGroupByRefId(
                $ref_id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            )
        );
    }


    public function removeGroupMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?GroupMemberIdDto
    {
        return $this->removeGroupMember(
            $this->group_service->getGroupByRefId(
                $ref_id,
                false
            ),
            $this->user_service->getUserByImportId(
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
            $group->id,
            $group->ref_id
        );
        if ($ilias_group === null) {
            return null;
        }

        if ($ilias_group->getMembersObject()->isAssigned($user->id)) {
            $ilias_group->getMembersObject()->delete($user->id);
        }

        return GroupMemberIdDto::new(
            $group->id,
            $group->import_id,
            $group->ref_id,
            $user->id,
            $user->import_id
        );
    }
}
