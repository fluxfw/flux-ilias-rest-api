<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\User\UpdateUser;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDefinedFieldDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDiffDto;
use Fluxlabs\FluxRestApi\Body\BodyType;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Body\TextBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;
use Fluxlabs\FluxRestApi\Status\Status;
use stdClass;

class UpdateUserByImportIdRoute implements Route
{

    private Api $api;


    public static function new(Api $api) : /*static*/ self
    {
        $route = new static();

        $route->api = $api;

        return $route;
    }


    public function getDocuRequestBodyTypes() : ?array
    {
        return [
            BodyType::JSON
        ];
    }


    public function getDocuRequestQueryParams() : ?array
    {
        return null;
    }


    public function getMethod() : string
    {
        return Method::POST;
    }


    public function getRoute() : string
    {
        return "/user/by-import-id/{import_id}/update";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        if (!($request->getParsedBody() instanceof JsonBodyDto)) {
            return ResponseDto::new(
                TextBodyDto::new(
                    "No json body"
                ),
                Status::_400
            );
        }

        $id = $this->api->updateUserByImportId(
            $request->getParam("import_id"),
            UserDiffDto::new(
                $request->getParsedBody()->getData()->import_id ?? null,
                $request->getParsedBody()->getData()->external_account ?? null,
                $request->getParsedBody()->getData()->authentication_mode ?? null,
                $request->getParsedBody()->getData()->login ?? null,
                $request->getParsedBody()->getData()->password ?? null,
                $request->getParsedBody()->getData()->active ?? null,
                $request->getParsedBody()->getData()->access_unlimited ?? null,
                $request->getParsedBody()->getData()->access_limited_from ?? null,
                $request->getParsedBody()->getData()->access_limited_until ?? null,
                $request->getParsedBody()->getData()->access_limited_object_id ?? null,
                $request->getParsedBody()->getData()->access_limited_object_import_id ?? null,
                $request->getParsedBody()->getData()->access_limited_object_ref_id ?? null,
                $request->getParsedBody()->getData()->access_limited_message ?? null,
                $request->getParsedBody()->getData()->gender ?? null,
                $request->getParsedBody()->getData()->first_name ?? null,
                $request->getParsedBody()->getData()->last_name ?? null,
                $request->getParsedBody()->getData()->title ?? null,
                $request->getParsedBody()->getData()->avatar ?? null,
                $request->getParsedBody()->getData()->birthday ?? null,
                $request->getParsedBody()->getData()->institution ?? null,
                $request->getParsedBody()->getData()->department ?? null,
                $request->getParsedBody()->getData()->street ?? null,
                $request->getParsedBody()->getData()->city ?? null,
                $request->getParsedBody()->getData()->zip_code ?? null,
                $request->getParsedBody()->getData()->country ?? null,
                $request->getParsedBody()->getData()->selected_country ?? null,
                $request->getParsedBody()->getData()->phone_office ?? null,
                $request->getParsedBody()->getData()->phone_home ?? null,
                $request->getParsedBody()->getData()->phone_mobile ?? null,
                $request->getParsedBody()->getData()->fax ?? null,
                $request->getParsedBody()->getData()->email ?? null,
                $request->getParsedBody()->getData()->second_email ?? null,
                $request->getParsedBody()->getData()->hobbies ?? null,
                $request->getParsedBody()->getData()->heard_about_ilias ?? null,
                $request->getParsedBody()->getData()->general_interests ?? null,
                $request->getParsedBody()->getData()->offering_helps ?? null,
                $request->getParsedBody()->getData()->looking_for_helps ?? null,
                $request->getParsedBody()->getData()->matriculation_number ?? null,
                $request->getParsedBody()->getData()->client_ip ?? null,
                $request->getParsedBody()->getData()->location_latitude ?? null,
                $request->getParsedBody()->getData()->location_longitude ?? null,
                $request->getParsedBody()->getData()->location_zoom ?? null,
                ($user_defined_fields = $request->getParsedBody()->getData()->user_defined_fields ?? null) !== null ? array_map(fn(stdClass $user_defined_field
                ) : UserDefinedFieldDto => UserDefinedFieldDto::new(
                    $user_defined_field->id ?? null,
                    $user_defined_field->name ?? null,
                    $user_defined_field->value ?? null
                ), $user_defined_fields) : null,
                $request->getParsedBody()->getData()->language ?? null
            )
        );

        if ($id !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $id
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "User not found"
                ),
                Status::_404
            );
        }
    }
}
