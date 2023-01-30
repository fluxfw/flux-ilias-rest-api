<?php

namespace FluxIliasRestApi\Service\Config;

trait ConfigQuery
{

    private function getConfigSettingsModule() : string
    {
        return "flilre";
    }


    private function getValueAsJson(mixed $value) : string
    {
        return json_encode($value, JSON_UNESCAPED_SLASHES);
    }


    private function getValueFromJson(?string $value) : mixed
    {
        if ($value === null || $value === "") {
            return null;
        }

        return json_decode($value);
    }
}
