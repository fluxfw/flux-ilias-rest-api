<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Service\Change\ChangeQuery;
use FluxIliasRestApi\Service\Change\Port\ChangeService;
use FluxRestApi\Adapter\Api\RestApi;
use FluxRestApi\Adapter\Authorization\ParseHttp\ParseHttpAuthorization_;
use FluxRestApi\Adapter\Authorization\ParseHttpBasic\ParseHttpBasicAuthorization_;
use FluxRestApi\Adapter\Authorization\Schema\DefaultAuthorizationSchema;
use FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxRestApi\Adapter\Client\ClientRequestDto;
use FluxRestApi\Adapter\Header\DefaultHeaderKey;
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
        $post_url = $this->change_service->getTransferChangesPostUrl();

        if (empty($post_url)) {
            return null;
        }

        $changes = $this->change_service->getChanges(
            null,
            null,
            $this->change_service->getLastTransferredChangeTime()
        );

        $count = count($changes);

        if ($count > 0) {
            $user = $this->change_service->getTransferChangesUser();
            $password = $this->change_service->getTransferChangesPassword();

            $this->rest_api->makeRequest(
                ClientRequestDto::new(
                    $post_url,
                    DefaultMethod::POST,
                    null,
                    null,
                    (($user !== null || $password !== null) ? [
                        DefaultHeaderKey::AUTHORIZATION->value => DefaultAuthorizationSchema::BASIC->value . ParseHttpAuthorization_::SPLIT_SCHEMA_PARAMETERS . base64_encode(($user ?? "") . ParseHttpBasicAuthorization_::SPLIT_USER_PASSWORD . ($password ?? ""))
                    ] : []),
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

            $this->change_service->setLastTransferredChangeTime(
                $changes[$count - 1]->time
            );
        }

        return $count;
    }
}
