<?php

namespace FluxIliasRestApi\Service\Group\Command;

use FluxIliasRestApi\Adapter\Group\GroupDto;
use FluxIliasRestApi\Service\CustomMetadata\CustomMetadataQuery;
use FluxIliasRestApi\Service\Group\GroupQuery;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use ilDBInterface;
use LogicException;

class GetGroupCommand
{

    use CustomMetadataQuery;
    use GroupQuery;
    use ObjectQuery;

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


    public function getGroupById(int $id, ?bool $in_trash = null) : ?GroupDto
    {
        $group = null;
        while (($group_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getGroupQuery(
                $id,
                null,
                null,
                $in_trash
            )))) !== null) {
            if ($group !== null) {
                throw new LogicException("Multiple groups found with the id " . $id);
            }
            $group = $this->mapGroupDto(
                $group_,
                true
            );
        }

        return $group;
    }


    public function getGroupByImportId(string $import_id, ?bool $in_trash = null) : ?GroupDto
    {
        $group = null;
        while (($group_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getGroupQuery(
                null,
                $import_id,
                null,
                $in_trash
            )))) !== null) {
            if ($group !== null) {
                throw new LogicException("Multiple groups found with the import id " . $import_id);
            }
            $group = $this->mapGroupDto(
                $group_,
                true
            );
        }

        return $group;
    }


    public function getGroupByRefId(int $ref_id, ?bool $in_trash = null) : ?GroupDto
    {
        $group = null;
        while (($group_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getGroupQuery(
                null,
                null,
                $ref_id,
                $in_trash
            )))) !== null) {
            if ($group !== null) {
                throw new LogicException("Multiple groups found with the ref id " . $ref_id);
            }
            $group = $this->mapGroupDto(
                $group_,
                true
            );
        }

        return $group;
    }
}
