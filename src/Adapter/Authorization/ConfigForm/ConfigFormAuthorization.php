<?php

namespace FluxIliasRestApi\Adapter\Authorization\ConfigForm;

use FluxIliasBaseApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\ConfigForm\Port\ConfigFormService;
use FluxRestApi\Adapter\Authorization\Authorization;
use FluxRestApi\Adapter\Body\TextBodyDto;
use FluxRestApi\Adapter\Server\ServerRawRequestDto;
use FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxRestApi\Adapter\Status\DefaultStatus;

class ConfigFormAuthorization implements Authorization
{

    private function __construct(
        private readonly ConfigFormService $config_form_service,
        private readonly ?UserDto $user
    ) {

    }


    public static function new(
        ConfigFormService $config_form_service,
        ?UserDto $user
    ) : static {
        return new static(
            $config_form_service,
            $user
        );
    }


    public function authorize(ServerRawRequestDto $request) : ?ServerResponseDto
    {
        if ($request->route === "/") {
            return null;
        }

        if ($this->user === null) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Authorization in ILIAS needed"
                ),
                DefaultStatus::_401
            );
        }

        if (!$this->config_form_service->hasAccessToConfigForm(
            $this->user
        )
        ) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "No access"
                ),
                DefaultStatus::_403
            );
        }

        return null;
    }
}
