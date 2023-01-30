<?php

namespace FluxIliasRestApi\Service\Group\Command;

use FluxIliasBaseApi\Adapter\Group\GroupDiffDto;
use FluxIliasBaseApi\Adapter\Group\GroupDto;
use FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Service\CustomMetadata\CustomMetadataQuery;
use FluxIliasRestApi\Service\Group\GroupQuery;
use FluxIliasRestApi\Service\Group\Port\GroupService;
use ilDBInterface;

class UpdateGroupCommand
{

    use CustomMetadataQuery;
    use GroupQuery;

    private function __construct(
        private readonly GroupService $group_service,
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        GroupService $group_service,
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $group_service,
            $ilias_database
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
            $group->id,
            $group->ref_id
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
            $group->id,
            $diff->import_id ?? $group->import_id,
            $group->ref_id
        );
    }
}
