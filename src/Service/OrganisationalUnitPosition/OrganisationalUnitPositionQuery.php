<?php

namespace FluxIliasRestApi\Service\OrganisationalUnitPosition;

use Exception;
use FluxIliasBaseApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionAuthorityDto;
use FluxIliasBaseApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionCoreIdentifier;
use FluxIliasBaseApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionDiffDto;
use FluxIliasBaseApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use ilDBConstants;
use ilOrgUnitAuthority;
use ilOrgUnitPosition;
use LogicException;

trait OrganisationalUnitPositionQuery
{

    private function getIliasOrganisationalUnitPosition(int $id) : ?ilOrgUnitPosition
    {
        return ilOrgUnitPosition::find($id);
    }


    private function getIliasOrganisationalUnitPositionAuthority(int $id) : ?ilOrgUnitAuthority
    {
        return ilOrgUnitAuthority::find($id);
    }


    private function getOrganisationalUnitPositionAuthorityQuery(array $position_ids) : string
    {
        return "SELECT *
FROM il_orgu_authority
WHERE " . $this->ilias_database->in("position_id", $position_ids, false, ilDBConstants::T_INTEGER);
    }


    private function getOrganisationalUnitPositionQuery(?int $id = null, ?OrganisationalUnitPositionCoreIdentifier $core_identifier = null) : string
    {
        $wheres = [];

        if ($id !== null) {
            $wheres[] = "id=" . $this->ilias_database->quote($id, ilDBConstants::T_INTEGER);
        }

        if ($core_identifier !== null) {
            $wheres[] = "id=" . $this->ilias_database->quote(OrganisationalUnitPositionCoreIdentifierMapping::mapExternalToInternal($core_identifier)->value, ilDBConstants::T_INTEGER);
        }

        return "SELECT *
FROM il_orgu_positions
" . (!empty($wheres) ? "WHERE " . implode(" AND ", $wheres) : "") . "
ORDER BY title ASC";
    }


    private function mapOrganisationalUnitPositionDiff(OrganisationalUnitPositionDiffDto $diff, ilOrgUnitPosition $ilias_organisational_unit_position) : void
    {
        if ($diff->title !== null) {
            $ilias_organisational_unit_position->setTitle($diff->title);
        }

        if ($diff->description !== null) {
            $ilias_organisational_unit_position->setDescription($diff->description);
        }

        if ($diff->authorities !== null) {
            $ilias_authorities = [];
            foreach ($diff->authorities as $authority) {
                if ($authority->id !== null) {
                    $ilias_authority = $this->getIliasOrganisationalUnitPositionAuthority(
                        $authority->id
                    );
                    if ($ilias_authority === null) {
                        throw new Exception("Authority id " . $authority->id . " does not exists");
                    }

                    if ($ilias_authority->getPositionId() !== $ilias_organisational_unit_position->getId()) {
                        throw new LogicException("Authority id " . $authority->id . " is not of the organisational unit position");
                    }

                    if ($authority->over_position_id === null && $authority->scope_in === null) {
                        continue;
                    }
                } else {
                    $ilias_authority = $this->newIliasOrganisationalUnitPositionAuthority();
                }

                if ($authority->over_position_id !== null) {
                    $ilias_authority->setOver($authority->over_position_id);
                }

                if ($authority->scope_in !== null) {
                    $ilias_authority->setScope(OrganisationalUnitPositionAuthorityScopeInMapping::mapExternalToInternal($authority->scope_in)->value);
                }

                $ilias_authorities[] = $ilias_authority;
            }
            $ilias_organisational_unit_position->setAuthorities($ilias_authorities);
        }
    }


    private function mapOrganisationalUnitPositionDto(array $organisational_unit_position, ?array $authorities = null) : OrganisationalUnitPositionDto
    {
        return OrganisationalUnitPositionDto::new(
            $organisational_unit_position["id"] ?: null,
            $organisational_unit_position["core_position"] ?? false,
            ($core_identifier = $organisational_unit_position["core_identifier"] ?: null) !== null
                ? OrganisationalUnitPositionCoreIdentifierMapping::mapInternalToExternal(InternalOrganisationalUnitPositionCoreIdentifier::from($core_identifier)) : null,
            $organisational_unit_position["title"] ?? "",
            $organisational_unit_position["description"] ?? "",
            $authorities !== null ? array_values(array_map(fn(array $authority) : OrganisationalUnitPositionAuthorityDto => OrganisationalUnitPositionAuthorityDto::new(
                $authority["id"] ?: null,
                $authority["over"] ?: null,
                ($scope_in = $authority["scope"] ?: null) !== null
                    ? OrganisationalUnitPositionAuthorityScopeInMapping::mapInternalToExternal(InternalOrganisationalUnitPositionAuthorityScopeIn::from($scope_in)) : null
            ), array_filter($authorities, fn(array $authority) : bool => $authority["position_id"] === $organisational_unit_position["id"]))) : null
        );
    }


    private function newIliasOrganisationalUnitPosition() : ilOrgUnitPosition
    {
        return new ilOrgUnitPosition();
    }


    private function newIliasOrganisationalUnitPositionAuthority() : ilOrgUnitAuthority
    {
        return new ilOrgUnitAuthority();
    }
}
