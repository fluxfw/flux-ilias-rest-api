<?php

namespace FluxIliasRestApi\Adapter\Authorization;

use FluxIliasRestApi\Adapter\Server\ServerRawRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;

interface Authorization
{

    public function authorize(ServerRawRequestDto $request) : ?ServerResponseDto;
}
