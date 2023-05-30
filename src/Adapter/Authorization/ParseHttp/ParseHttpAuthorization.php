<?php

namespace FluxIliasRestApi\Adapter\Authorization\ParseHttp;

use FluxIliasRestApi\Adapter\Authorization\Schema\CustomAuthorizationSchema;
use FluxIliasRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Adapter\Header\DefaultHeaderKey;
use FluxIliasRestApi\Adapter\Server\ServerRawRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;

trait ParseHttpAuthorization
{

    private function parseHttpAuthorization(ServerRawRequestDto $request, HttpAuthorizationDto $www_authenticate_header) : HttpAuthorizationDto|ServerResponseDto
    {
        $authorization = $request->getHeader(
            DefaultHeaderKey::AUTHORIZATION
        );

        if (empty($authorization)) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Authorization needed"
                ),
                DefaultStatus::_401,
                [
                    DefaultHeaderKey::WWW_AUTHENTICATE->value => $www_authenticate_header->schema->value . (!empty($www_authenticate_header->parameters)
                            ? ParseHttpAuthorization_::SPLIT_SCHEMA_PARAMETERS
                            . $www_authenticate_header->parameters : "")
                ]
            );
        }

        if (!str_contains($authorization, ParseHttpAuthorization_::SPLIT_SCHEMA_PARAMETERS)) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Missing authorization schema or parameters"
                ),
                DefaultStatus::_400
            );
        }

        $parameters = explode(ParseHttpAuthorization_::SPLIT_SCHEMA_PARAMETERS, $authorization);
        $schema = array_shift($parameters);
        $parameters = implode(ParseHttpAuthorization_::SPLIT_SCHEMA_PARAMETERS, $parameters);

        if (empty($schema) || empty($parameters)) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Missing authorization schema or parameters"
                ),
                DefaultStatus::_400
            );
        }

        return HttpAuthorizationDto::new(
            CustomAuthorizationSchema::factory(
                $schema
            ),
            $parameters
        );
    }
}
