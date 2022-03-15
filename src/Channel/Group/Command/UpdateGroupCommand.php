<?php

namespace FluxIliasRestApi\Channel\Group\Command;

use FluxIliasRestApi\Adapter\Api\Group\GroupDiffDto;
use FluxIliasRestApi\Adapter\Api\Group\GroupDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Group\GroupQuery;
use FluxIliasRestApi\Channel\Group\Port\GroupService;

class UpdateGroupCommand
{

    use GroupQuery;

    private GroupService $group_service;


    private function __construct(
        /*private readonly*/ GroupService $group_service
    ) {
        $this->group_service = $group_service;
    }


    public static function new(
        GroupService $group_service
    ) : /*static*/ self
    {
        return new static(
            $group_service
        );
    }


    public function updateGroupById(int $id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateGroup(
            $this->group_service->getGroupById(
                $id,
                false
            ),
            $diff
        );
    }


    public function updateGroupByImportId(string $import_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateGroup(
            $this->group_service->getGroupByImportId(
                $import_id,
                false
            ),
            $diff
        );
    }


    public function updateGroupByRefId(int $ref_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateGroup(
            $this->group_service->getGroupByRefId(
                $ref_id,
                false
            ),
            $diff
        );
    }


    private function updateGroup(?GroupDto $group, GroupDiffDto $diff) : ?ObjectIdDto
    {
        if ($group === null) {
            return null;
        }

        $ilias_group = $this->getIliasGroup(
            $group->getId(),
            $group->getRefId()
        );
        if ($ilias_group === null) {
            return null;
        }

        $this->mapGroupDiff(
            $diff,
            $ilias_group
        );

        $ilias_group->update();

        return ObjectIdDto::new(
            $group->getId(),
            $diff->getImportId() ?? $group->getImportId(),
            $group->getRefId()
        );
    }
}
