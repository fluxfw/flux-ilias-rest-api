<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use Exception;
use FluxIliasRestApi\Channel\Change\ChangeQuery;
use FluxIliasRestApi\Channel\Change\Port\ChangeService;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Body\LegacyDefaultBodyType;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Header\LegacyDefaultHeader;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\LegacyDefaultMethod;
use ilDBInterface;

class TransferChangesCommand
{

    use ChangeQuery;

    private ChangeService $change_service;
    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ChangeService $change_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->change_service = $change_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        ChangeService $change_service
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $change_service
        );
    }


    public function transferChanges() : ?int
    {
        if (!$this->changeDatabaseExists()) {
            return null;
        }

        $changes = $this->change_service->getChanges(
            null,
            null,
            $this->change_service->getLastTransferredChangeTime()
        );

        $curl = null;
        try {
            $curl = curl_init($this->change_service->getTransferChangesPostUrl());

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
            $this->change_service->setLastTransferredChangeTime(
                $changes[$count - 1]->getTime()
            );
        }

        return $count;
    }
}
