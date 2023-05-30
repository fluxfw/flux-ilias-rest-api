<?php

namespace FluxIliasRestApi\Service\Body\Command;

use FluxIliasRestApi\Adapter\Method\CustomMethod;
use FluxIliasRestApi\Adapter\Server\ServerRawRequestDto;

class GetDefaultRequestCommand
{

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function getDefaultRequest() : ServerRawRequestDto
    {
        $query_params = $_GET;

        $route = explode("&", $_SERVER["QUERY_STRING"])[0];
        unset($query_params[$route]);

        return ServerRawRequestDto::new(
            $route,
            explode("?", $_SERVER["REQUEST_URI"])[0],
            CustomMethod::factory(
                $_SERVER["REQUEST_METHOD"]
            ),
            $query_params,
            file_get_contents("php://input") ?: null,
            $_POST,
            $_FILES,
            getallheaders(),
            $_COOKIE
        );
    }
}
