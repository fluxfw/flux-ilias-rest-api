<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\UserFavourite;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\UserFavourite\FavouriteDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\InternalObjectType;
use ilDBConstants;

trait UserFavouriteQuery
{

    private function getUserFavouriteQuery(?int $user_id = null, ?string $user_import_id = null, ?int $object_id = null, ?string $object_import_id = null, ?int $object_ref_id = null) : string
    {
        $wheres = [
            "object_data_user.type=" . $this->database->quote(InternalObjectType::USR, ilDBConstants::T_TEXT),
            "object_reference.deleted IS NULL"
        ];

        if ($user_id !== null) {
            $wheres[] = "object_data_user.obj_id=" . $this->database->quote($user_id, ilDBConstants::T_INTEGER);
        }

        if ($user_import_id !== null) {
            $wheres[] = "object_data_user.import_id=" . $this->database->quote($user_import_id, ilDBConstants::T_TEXT);
        }

        if ($object_id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->database->quote($object_id, ilDBConstants::T_INTEGER);
        }

        if ($object_import_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->database->quote($object_import_id, ilDBConstants::T_TEXT);
        }

        if ($object_ref_id !== null) {
            $wheres[] = "object_reference.ref_id=" . $this->database->quote($object_ref_id, ilDBConstants::T_INTEGER);
        }

        return "SELECT desktop_item.*,object_data.obj_id,object_data.import_id,object_reference.ref_id,object_data_user.obj_id AS usr_id,object_data_user.import_id AS user_import_id
FROM desktop_item
INNER JOIN object_data AS object_data_user ON desktop_item.user_id=object_data_user.obj_id
INNER JOIN object_reference ON desktop_item.item_id=object_reference.ref_id
INNER JOIN object_data ON object_reference.obj_id=object_data.obj_id
WHERE " . implode(" AND ", $wheres) . "
ORDER BY object_data_user.obj_id ASC,object_data.obj_id ASC";
    }


    private function mapUserFavouriteDto(array $user_favourite) : FavouriteDto
    {
        return FavouriteDto::new(
            $user_favourite["usr_id"] ?: null,
            $user_favourite["user_import_id"] ?: null,
            $user_favourite["obj_id"] ?: null,
            $user_favourite["import_id"] ?: null,
            $user_favourite["ref_id"] ?: null
        );
    }
}
