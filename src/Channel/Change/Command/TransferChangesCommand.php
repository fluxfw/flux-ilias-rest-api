<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use Exception;
use FluxIliasRestApi\Channel\Change\ChangeQuery;
use FluxIliasRestApi\Channel\Change\Port\ChangeService;
use FluxRestBaseApi\Body\LegacyDefaultBodyType;
use FluxRestBaseApi\Header\LegacyDefaultHeader;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use ilDBInterface;

class TransferChangesCommand
{

    use ChangeQuery;

    private ChangeService $change;
    private ilDBInterface $database;


    public static function new(ilDBInterface $database, ChangeService $change) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;
        $command->change = $change;

        return $command;
    }


    public function transferChanges() : ?int
    {
        if (!$this->changeDatabaseExists()) {
            return null;
        }

        $changes = $this->change->getChanges(
            null,
            null,
            $this->change->getLastTransferredChangeTime()
        );

        $curl = null;
        try {
            $curl = curl_init($this->change->getTransferChangesPostUrl());

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, LegacyDefaultMethod::POST()->value);

            $headers = [
                LegacyDefaultHeader::CONTENT_TYPE()->value => LegacyDefaultBodyType::JSON()->value,
                LegacyDefaultHeader::USER_AGENT()->value   => "flux-ilias-rest-api"
            ];
            curl_setopt($curl, CURLOPT_HTTPHEADER, array_map(fn(string $key, string $value) : string => $key . ": " . $value, array_keys($headers), $headers));

            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($changes, JSON_UNESCAPED_SLASHES));

            curl_setopt($curl, CURLOPT_FAILONERROR, true);

            curl_exec($curl);

            if (curl_errno($curl) !== 0) {
                throw new Exception(curl_error($curl));
            }
        } finally {
            if ($curl !== null) {
                curl_close($curl);
            }
        }

        $count = count($changes);
        if ($count > 0) {
            $this->change->setLastTransferredChangeTime(
                $changes[$count - 1]->getTime()
            );
        }

        return $count;
    }
}
