<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Group\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Group\GroupDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Group\GroupQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;

class CreateGroupCommand
{

    use GroupQuery;

    private ObjectService $object;


    public static function new(ObjectService $object) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;

        return $command;
    }


    public function createGroupToId(int $parent_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createGroup(
            $this->object->getObjectById(
                $parent_id
            ),
            $diff
        );
    }


    public function createGroupToImportId(string $parent_import_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createGroup(
            $this->object->getObjectByImportId(
                $parent_import_id
            ),
            $diff
        );
    }


    public function createGroupToRefId(int $parent_ref_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createGroup(
            $this->object->getObjectByRefId(
                $parent_ref_id
            ),
            $diff
        );
    }


    private function createGroup(?ObjectDto $parent_object, GroupDiffDto $diff) : ?ObjectIdDto
    {
        if ($parent_object === null || $parent_object->getRefId() === null) {
            return null;
        }

        $ilias_group = $this->newIliasGroup();

        $ilias_group->setTitle($diff->getTitle() ?? "");

        $ilias_group->create();
        $ilias_group->createReference();
        $ilias_group->putInTree($parent_object->getRefId());
        $ilias_group->setPermissions($parent_object->getRefId());

        $this->mapGroupDiff(
            $diff,
            $ilias_group
        );

        $ilias_group->update();

        return ObjectIdDto::new(
            $ilias_group->getId() ?: null,
            $diff->getImportId(),
            $ilias_group->getRefId() ?: null
        );
    }
}
