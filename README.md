# FluxIliasRestApi

## Installation

Start at your ILIAS root directory

```bash
cd Customizing/global
git clone https://github.com/fluxapps/FluxIliasRestApi.git FluxIliasRestApi
cd FluxIliasRestApi
composer install --no-dev
```

## Call route

`https://%host%/Customizing/global/FluxIliasRestApi?/path/to/some/route`

With query params

`https://%host%/Customizing/global/FluxIliasRestApi?/path/to/some/route&query_param=xyz`

## Authorization

The API uses the basic authorization with ILIAS users

You need to prefix the ILIAS client to the user

The `Authorization` header looks like (Base64 encoded)

`%client%/%user%:%password%`

## Permissions

All ILIAS users are allowed, so each route needs to implement an access self for avoid unprivileged actions

## Routes location

You can either place routes in [routes](routes)

And/or each ILIAS plugin can also have routes in its own `routes` root folder

The folders are scanned recursive

## Get Routes

With the follow built-in route you can get all available routes

`https://%host%/Customizing/global/FluxIliasRestApi?/routes`

## Example routes

[examples](https://github.com/fluxapps/FluxRestApi/tree/main/examples/routes)
