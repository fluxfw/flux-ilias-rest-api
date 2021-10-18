<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\GroupMember\Command;

use Fluxlabs\FluxIliasRestApi\Channel\GroupMember\GroupMemberQuery;
use ilDBInterface;

class GetGroupMembersCommand
{

    use GroupMemberQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getGroupMembers(
        ?int $group_id = null,
        ?string $group_import_id = null,
        ?int $group_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?bool $member_role = null,
        ?bool $administrator_role = null,
        ?string $learning_progress = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : array {
        return array_map([$this, "mapGroupMemberDto"], $this->database->fetchAll($this->database->query($this->getGroupMemberQuery(
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
