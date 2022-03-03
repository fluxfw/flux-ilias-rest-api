<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Change\ChangeQuery;
use ilDBConstants;
use ilDBInterface;

class CreateChangeDatabaseCommand
{

    use ChangeQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function createChangeDatabase() : void
    {
        if (!$this->changeDatabaseExists()) {
            $this->database->createTable($this->getChangeDatabaseTable(), [
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

            $this->database->addPrimaryKey($this->getChangeDatabaseTable(), ["id"]);

            $this->database->manipulate('ALTER TABLE ' . $this->database->quoteIdentifier($this->getChangeDatabaseTable()) . ' MODIFY COLUMN ' . $this->database->quoteIdentifier("id")
                . ' BIGINT NOT NULL AUTO_INCREMENT');
        }
    }
}
