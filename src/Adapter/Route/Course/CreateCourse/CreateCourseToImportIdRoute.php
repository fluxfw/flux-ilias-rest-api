<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\Course\CreateCourse;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseDiffDto;
use Fluxlabs\FluxRestApi\Body\BodyType;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Body\TextBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;
use Fluxlabs\FluxRestApi\Status\Status;

class CreateCourseToImportIdRoute implements Route
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
        return "/course/create/to-import-id/{parent_import_id}";
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

        $id = $this->api->createCourseToImportId(
            $request->getParam(
                "parent_import_id"
            ),
            CourseDiffDto::new(
                $request->getParsedBody()->getData()->import_id ?? null,
                $request->getParsedBody()->getData()->title ?? null,
                $request->getParsedBody()->getData()->description ?? null,
                $request->getParsedBody()->getData()->period_start ?? null,
                $request->getParsedBody()->getData()->period_end ?? null,
                $request->getParsedBody()->getData()->period_unset ?? null,
                $request->getParsedBody()->getData()->period_time_indication ?? null,
                $request->getParsedBody()->getData()->online ?? null,
                $request->getParsedBody()->getData()->availability_start ?? null,
                $request->getParsedBody()->getData()->availability_end ?? null,
                $request->getParsedBody()->getData()->availability_always_visible ?? null,
                $request->getParsedBody()->getData()->calendar ?? null,
                $request->getParsedBody()->getData()->calendar_block ?? null,
                $request->getParsedBody()->getData()->news ?? null,
                $request->getParsedBody()->getData()->custom_metadata ?? null,
                $request->getParsedBody()->getData()->tag_cloud ?? null,
                $request->getParsedBody()->getData()->default_object_rating ?? null,
                $request->getParsedBody()->getData()->badges ?? null,
                $request->getParsedBody()->getData()->resources ?? null,
                $request->getParsedBody()->getData()->mail_subject_prefix ?? null,
                $request->getParsedBody()->getData()->show_members ?? null,
                $request->getParsedBody()->getData()->show_members_participants_list ?? null,
                $request->getParsedBody()->getData()->mail_to_members_type ?? null,
                $request->getParsedBody()->getData()->send_welcome_email ?? null,
                $request->getParsedBody()->getData()->add_to_favourites ?? null,
                $request->getParsedBody()->getData()->important_information ?? null,
                $request->getParsedBody()->getData()->syllabus ?? null,
                $request->getParsedBody()->getData()->target_group ?? null,
                $request->getParsedBody()->getData()->contact_name ?? null,
                $request->getParsedBody()->getData()->contact_responsibility ?? null,
                $request->getParsedBody()->getData()->contact_phone ?? null,
                $request->getParsedBody()->getData()->contact_email ?? null,
                $request->getParsedBody()->getData()->contact_consultation ?? null,
                $request->getParsedBody()->getData()->didactic_template_id ?? null
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
                    "Object not found"
                ),
                Status::_404
            );
        }
    }
}
