<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\ObjectLearningProgress;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\ObjectLearningProgressDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\InternalObjectType;
use ilDBConstants;

trait ObjectLearningProgressQuery
{

    private function getObjectLearningProgressQuery(
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?string $learning_progress = null
    ) : string {
        $wheres = [
            "object_data_user.type=" . $this->database->quote(InternalObjectType::USR, ilDBConstants::T_TEXT),
            "object_reference.deleted IS NULL"
        ];

        if ($object_id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->database->quote($object_id, ilDBConstants::T_INTEGER);
        }

        if ($object_import_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->database->quote($object_import_id, ilDBConstants::T_TEXT);
        }

        if ($object_ref_id !== null) {
            $wheres[] = "object_reference.ref_id=" . $this->database->quote($object_ref_id, ilDBConstants::T_INTEGER);
        }

        if ($user_id !== null) {
            $wheres[] = "object_data_user.obj_id=" . $this->database->quote($user_id, ilDBConstants::T_INTEGER);
        }

        if ($user_import_id !== null) {
            $wheres[] = "object_data_user.import_id=" . $this->database->quote($user_import_id, ilDBConstants::T_TEXT);
        }

        if ($learning_progress !== null) {
            $wheres[] = "status=" . $this->database->quote(ObjectLearningProgressMapping::mapExternalToInternal(
                    $learning_progress
                ), ilDBConstants::T_INTEGER);
        }

        return "SELECT ut_lp_marks.*,object_data.obj_id,object_data.import_id,object_reference.ref_id,object_data_user.obj_id AS usr_id,object_data_user.import_id AS user_import_id
FROM ut_lp_marks
INNER JOIN object_data ON ut_lp_marks.obj_id=object_data.obj_id
LEFT JOIN object_reference ON object_data.obj_id=object_reference.obj_id
INNER JOIN object_data AS object_data_user ON ut_lp_marks.usr_id=object_data_user.obj_id
WHERE " . implode(" AND ", $wheres) . "
ORDER BY object_data.obj_id ASC,object_data_user.obj_id ASC";
    }


    private function mapObjectLearningProgressDto(array $object_learning_progress) : ObjectLearningProgressDto
    {
        return ObjectLearningProgressDto::new(
            $object_learning_progress["obj_id"] ?: null,
            $object_learning_progress["import_id"] ?: null,
            $object_learning_progress["ref_id"] ?: null,
            $object_learning_progress["usr_id"] ?: null,
            $object_learning_progress["user_import_id"] ?: null,
            ObjectLearningProgressMapping::mapInternalToExternal(
                $object_learning_progress["status"] ?? null
            )
        );
    }
}
