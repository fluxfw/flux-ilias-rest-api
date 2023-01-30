<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Service\Change\ChangeQuery;
use ilDBConstants;
use ilDBInterface;

class CreateChangeDatabaseCommand
{

    use ChangeQuery;

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


    public function createChangeDatabase() : void
    {
        if (!$this->changeDatabaseExists()) {
            $this->ilias_database->createTable($this->getChangeDatabaseTable(), [
                "id"             => [
                    "type"    => ilDBConstants::T_INTEGER,
                    "length"  => 8,
                    "notnull" => true
                ],
                "type"           => [
                    "type"    => ilDBConstants::T_TEXT,
                    "length"  => 255,
                    "notnull" => true
                ],
                "time"           => [
                    "type"    => ilDBConstants::T_FLOAT,
                    "notnull" => true
                ],
                "user_id"        => [
                    "type"    => ilDBConstants::T_INTEGER,
                    "length"  => 8,
                    "notnull" => false
                ],
                "user_import_id" => [
                    "type"    => ilDBConstants::T_TEXT,
                    "length"  => 255,
                    "notnull" => false
                ],
                "data"           => [
                    "type"    => ilDBConstants::T_BLOB,
                    "notnull" => false
                ]
            ]);

            $this->ilias_database->addPrimaryKey($this->getChangeDatabaseTable(), ["id"]);

            $this->ilias_database->manipulate('ALTER TABLE ' . $this->ilias_database->quoteIdentifier($this->getChangeDatabaseTable()) . ' MODIFY COLUMN '
                . $this->ilias_database->quoteIdentifier("id")
                . ' BIGINT NOT NULL AUTO_INCREMENT');
        }
    }
}
