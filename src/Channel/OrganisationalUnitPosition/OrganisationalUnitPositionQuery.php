<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use ilDBConstants;
use ilOrgUnitPosition;

trait OrganisationalUnitPositionQuery
{

    private function getIliasOrganisationalUnitPosition(int $id) : ?ilOrgUnitPosition
    {
        return ilOrgUnitPosition::find($id);
    }


    private function getOrganisationalUnitPositionQuery(?int $id = null, ?string $core_identifier = null) : string
    {
        $wheres = [];

        if ($id !== null) {
            $wheres[] = "id=" . $this->database->quote($id, ilDBConstants::T_INTEGER);
        }

        if ($core_identifier !== null) {
            $wheres[] = "id=" . $this->database->quote(OrganisationalUnitPositionCoreIdentifierMapping::mapExternalToInternal(
                    $core_identifier
                ), ilDBConstants::T_INTEGER);
        }

        return "SELECT *
FROM il_orgu_positions
" . (!empty($wheres) ? "WHERE " . implode(" AND ", $wheres) : "") . "
ORDER BY title ASC";
    }


    private function mapOrganisationalUnitPositionDiff(OrganisationalUnitPositionDiffDto $diff, ilOrgUnitPosition $ilias_organisational_unit_position) : void
    {
        if ($diff->getTitle() !== null) {
            $ilias_organisational_unit_position->setTitle($diff->getTitle());
        }

        if ($diff->getDescription() !== null) {
            $ilias_organisational_unit_position->setDescription($diff->getDescription());
        }
    }


    private function mapOrganisationalUnitPositionDto(array $organisational_unit_position) : OrganisationalUnitPositionDto
    {
        return OrganisationalUnitPositionDto::new(
            $organisational_unit_position["id"] ?: null,
            $organisational_unit_position["core_position"] ?? false,
            OrganisationalUnitPositionCoreIdentifierMapping::mapInternalToExternal(
                $organisational_unit_position["core_identifier"] ?: null
            ),
            $organisational_unit_position["title"] ?? "",
            $organisational_unit_position["description"] ?? ""
        );
    }


    private function newIliasOrganisationalUnitPosition() : ilOrgUnitPosition
    {
        return new ilOrgUnitPosition();
    }
}
