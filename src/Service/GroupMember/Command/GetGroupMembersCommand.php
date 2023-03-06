<?php

namespace FluxIliasRestApi\Service\GroupMember\Command;

use FluxIliasRestApi\Adapter\GroupMember\GroupMemberDto;
use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;
use FluxIliasRestApi\Service\GroupMember\GroupMemberQuery;
use ilDBInterface;

class GetGroupMembersCommand
{

    use GroupMemberQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $ilias_database
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
        return array_map([$this, "mapGroupMemberDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getGroupMemberQuery(
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
        ))));
    }
}
