<?php

namespace FluxIliasRestApi\Adapter\Body;

use FluxIliasRestApi\Adapter\Body\Type\BodyType;

interface BodyDto
{

    public function getType() : BodyType;
}
