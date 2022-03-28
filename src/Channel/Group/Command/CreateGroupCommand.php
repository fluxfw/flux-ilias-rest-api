<?php

namespace FluxIliasRestApi\Channel\Group\Command;

use FluxIliasRestApi\Adapter\Group\GroupDiffDto;
use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Group\GroupQuery;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;

class CreateGroupCommand
{

    use GroupQuery;

    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ObjectService $object_service
    ) {
        $this->object_service = $object_service;
    }


    public static function new(
        ObjectService $object_service
    ) : /*static*/ self
    {
        return new static(
            $object_service
        );
    }


    public function createGroupToId(int $parent_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createGroup(
            $this->object_service->getObjectById(
                $parent_id,
                false
            ),
            $diff
        );
    }


    public function createGroupToImportId(string $parent_import_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createGroup(
            $this->object_service->getObjectByImportId(
                $parent_import_id,
                false
            ),
            $diff
        );
    }


    public function createGroupToRefId(int $parent_ref_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createGroup(
            $this->object_service->getObjectByRefId(
                $parent_ref_id,
                false
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
