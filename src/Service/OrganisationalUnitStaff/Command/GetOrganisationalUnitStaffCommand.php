<?php

namespace FluxIliasRestApi\Service\OrganisationalUnitStaff\Command;

use FluxIliasRestApi\Adapter\OrganisationalUnitStaff\OrganisationalUnitStaffDto;
use FluxIliasRestApi\Service\OrganisationalUnitStaff\OrganisationalUnitStaffQuery;
use ilDBInterface;

class GetOrganisationalUnitStaffCommand
{

    use OrganisationalUnitStaffQuery;

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
     * @return OrganisationalUnitStaffDto[]
     */
    public function getOrganisationalUnitStaff(
        ?int $organisational_unit_id = null,
        ?string $organisational_unit_external_id = null,
        ?int $organisational_unit_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?int $position_id = null
    ) : array {
        return array_map([$this, "mapOrganisationalUnitStaffDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getOrganisationalUnitStaffQuery(
            $organisational_unit_id,
            $organisational_unit_external_id,
            $organisational_unit_ref_id,
            $user_id,
            $user_import_id,
            $position_id
        ))));
    }
}
