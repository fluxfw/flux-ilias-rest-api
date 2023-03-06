<?php

namespace FluxIliasRestApi\Service\Object\Command;

use FluxIliasRestApi\Adapter\Permission\Permission;
use FluxIliasRestApi\Service\Object\Port\ObjectService;

class HasAccessByRefIdsByUserIdCommand
{

    private function __construct(
        private readonly ObjectService $object_service
    ) {

    }


    public static function new(
        ObjectService $object_service
    ) : static {
        return new static(
            $object_service
        );
    }


    /**
     * @param int[] $ref_ids
     * @return int[]
     */
    public function hasAccessByRefIdsByUserId(array $ref_ids, int $user_id, Permission $permission) : array
    {
        $has_access_ref_ids = [];

        foreach ($ref_ids as $ref_id) {
            if ($this->object_service->hasAccessByRefIdByUserId($ref_id, $user_id, $permission)) {
                $has_access_ref_ids[] = $ref_id;
            }
        }

        return array_unique($has_access_ref_ids);
    }
}
