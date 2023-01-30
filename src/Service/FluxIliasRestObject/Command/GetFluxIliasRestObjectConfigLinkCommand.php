<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

class GetFluxIliasRestObjectConfigLinkCommand
{

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function getFluxIliasRestObjectConfigLink(int $ref_id) : string
    {
        return ILIAS_HTTP_PATH . "/flux-ilias-rest-object-config/" . $ref_id;
    }
}
