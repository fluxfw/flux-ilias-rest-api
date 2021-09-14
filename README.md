# FluxIliasRestApi

Experimental Alpha Version

## Installation

Start at your ILIAS root directory

```shell
mkdir -p Customizing/global/FluxIliasRestApi && cd Customizing/global/FluxIliasRestApi
wget -O - https://github.com/fluxapps/FluxIliasRestApi/archive/main.tar.gz | tar -xz --strip-components=1
composer install
```

## Call route

`https://%host%/Customizing/global/FluxIliasRestApi?/path/to/some/route`

With query params

`https://%host%/Customizing/global/FluxIliasRestApi?/path/to/some/route&query_param=xyz`

## Authorization

The API uses the basic authorization with ILIAS users

You need to prefix the ILIAS client to the user

The `Authorization` header looks like (Base64 encoded)

`Basic %client%/%user%:%password%`

## Permissions

Only admin users can use the api

## Get available routes

With the follow route you can get all available routes

`https://%host%/Customizing/global/FluxIliasRestApi?/routes`

## Custom routes location

You can either place custom routes in [routes](routes)

And/or each ILIAS plugin can also have custom routes in its own `src/Adapter/Route` folder

The folders are scanned recursive

## Examples

### Code

[examples](https://github.com/fluxapps/FluxRestApi/tree/main/examples/routes)

### Request

[examples](examples)
