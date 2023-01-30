<?php

namespace FluxIliasRestApi\Service\Group\Command;

use FluxIliasBaseApi\Adapter\Group\GroupDiffDto;
use FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Service\CustomMetadata\CustomMetadataQuery;
use FluxIliasRestApi\Service\Group\GroupQuery;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use ilDBInterface;

class CreateGroupCommand
{

    use CustomMetadataQuery;
    use GroupQuery;

    private function __construct(
        private readonly ObjectService $object_service,
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ObjectService $object_service,
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $object_service,
            $ilias_database
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
        if ($parent_object === null || $parent_object->ref_id === null) {
            return null;
        }

        $ilias_group = $this->newIliasGroup();

        $ilias_group->setTitle($diff->title ?? "");

        $ilias_group->create();
        $ilias_group->createReference();
        $ilias_group->putInTree($parent_object->ref_id);
        $ilias_group->setPermissions($parent_object->ref_id);

        $this->mapGroupDiff(
            $diff,
            $ilias_group
        );

        $ilias_group->update();

        return ObjectIdDto::new(
            $ilias_group->getId() ?: null,
            $diff->import_id,
            $ilias_group->getRefId() ?: null
        );
    }
}
