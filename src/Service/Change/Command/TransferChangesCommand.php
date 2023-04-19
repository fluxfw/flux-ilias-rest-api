<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Service\Change\ChangeQuery;
use FluxIliasRestApi\Service\Change\Port\ChangeService;
use FluxRestApi\Adapter\Api\RestApi;
use FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxRestApi\Adapter\Client\ClientRequestDto;
use FluxRestApi\Adapter\Method\DefaultMethod;
use ilDBInterface;

class TransferChangesCommand
{

    use ChangeQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database,
        private readonly ChangeService $change_service,
        private readonly RestApi $rest_api
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database,
        ChangeService $change_service,
        RestApi $rest_api
    ) : static {
        return new static(
            $ilias_database,
            $change_service,
            $rest_api
        );
    }


    public function transferChanges() : ?int
    {
        if (empty($this->change_service->getTransferChangesPostUrl())) {
            return null;
        }

        $changes = $this->change_service->getChanges(
            null,
            null,
            $this->change_service->getLastTransferredChangeTime()
        );

        $this->rest_api->makeRequest(
            ClientRequestDto::new(
                $this->change_service->getTransferChangesPostUrl(),
                DefaultMethod::POST,
                null,
                null,
                null,
                JsonBodyDto::new(
                    $changes
                ),
                null,
                null,
                false,
                true,
                false,
                false,
                false
            )
        );

        $count = count($changes);
        if ($count > 0) {
            $this->change_service->setLastTransferredChangeTime(
                $changes[$count - 1]->time
            );
        }

        return $count;
    }
}
