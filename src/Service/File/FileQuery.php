<?php

namespace FluxIliasRestApi\Service\File;

use FluxIliasRestApi\Adapter\File\FileDiffDto;
use FluxIliasRestApi\Adapter\File\FileDto;
use FluxIliasRestApi\Service\Object\CustomInternalObjectType;
use FluxIliasRestApi\Service\Object\DefaultInternalObjectType;
use ilDBConstants;
use ilObjFile;
use ilObjFileAccess;

trait FileQuery
{

    private function getFileDownloadUrl(int $ref_id) : string
    {
        return ilObjFileAccess::_getPermanentDownloadLink($ref_id);
    }


    private function getFileQuery(?int $id = null, ?string $import_id = null, ?int $ref_id = null, ?bool $in_trash = null) : string
    {
        $wheres = [
            "object_data.type=" . $this->ilias_database->quote(DefaultInternalObjectType::FILE->value, ilDBConstants::T_TEXT)
        ];

        if ($id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->ilias_database->quote($id, ilDBConstants::T_INTEGER);
        }

        if ($import_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->ilias_database->quote($import_id, ilDBConstants::T_TEXT);
        }

        if ($ref_id !== null) {
            $wheres[] = "object_reference.ref_id=" . $this->ilias_database->quote($ref_id, ilDBConstants::T_INTEGER);
        }

        if ($in_trash !== null) {
            $wheres[] = "object_reference.deleted IS" . ($in_trash ? " NOT" : "") . " NULL";
        }

        return "SELECT object_data.*,object_reference.ref_id,object_reference.deleted,didactic_tpl_objs.tpl_id,file_data.*,object_data_parent.obj_id AS parent_obj_id,object_reference_parent.ref_id AS parent_ref_id,object_data_parent.import_id AS parent_import_id
FROM object_data
LEFT JOIN object_reference ON object_data.obj_id=object_reference.obj_id
LEFT JOIN didactic_tpl_objs ON object_data.obj_id=didactic_tpl_objs.obj_id
LEFT JOIN file_data ON object_data.obj_id=file_data.file_id
LEFT JOIN tree ON object_reference.ref_id=tree.child
LEFT JOIN object_reference AS object_reference_parent ON tree.parent=object_reference_parent.ref_id
LEFT JOIN object_data AS object_data_parent ON object_reference_parent.obj_id=object_data_parent.obj_id
WHERE " . implode(" AND ", $wheres) . "
GROUP BY object_data.obj_id
ORDER BY object_data.title ASC,object_data.create_date ASC,object_reference.ref_id ASC";
    }


    private function getIliasFile(int $id, ?int $ref_id = null) : ?ilObjFile
    {
        if ($ref_id !== null) {
            return new ilObjFile($ref_id, true);
        } else {
            return new ilObjFile($id, false);
        }
    }


    private function mapFileDiff(FileDiffDto $diff, ilObjFile $ilias_file) : void
    {
        if ($diff->import_id !== null) {
            $ilias_file->setImportId($diff->import_id);
        }

        if ($diff->title !== null) {
            $ilias_file->setTitle($diff->title);
        }

        if ($diff->description !== null) {
            $ilias_file->setDescription($diff->description);
        }

        if ($diff->didactic_template_id !== null) {
            $ilias_file->applyDidacticTemplate($diff->didactic_template_id);
        }
    }


    private function mapFileDto(array $file) : FileDto
    {
        $type = ($type = $file["type"] ?: null) !== null ? CustomInternalObjectType::factory(
            $type
        ) : null;

        return FileDto::new(
            $file["obj_id"] ?: null,
            $file["import_id"] ?: null,
            $file["ref_id"] ?: null,
            strtotime($file["create_date"] ?? null) ?: null,
            strtotime($file["last_update"] ?? null) ?: null,
            $file["parent_obj_id"] ?: null,
            $file["parent_import_id"] ?: null,
            $file["parent_ref_id"] ?: null,
            $this->getObjectUrl(
                $file["ref_id"] ?: null,
                $type
            ),
            $this->getFileDownloadUrl(
                $file["ref_id"] ?: null
            ),
            $this->getObjectIconUrl(
                $file["obj_id"] ?: null,
                $type
            ),
            $file["title"] ?? "",
            $file["description"] ?? "",
            $file["version"] ?: null,
            $file["file_name"] ?: null,
            $file["file_size"] ?: null,
            $file["file_type"] ?: null,
            $file["tpl_id"] ?: null,
            ($file["deleted"] ?? null) !== null
        );
    }


    private function newIliasFile() : ilObjFile
    {
        return new ilObjFile();
    }
}
