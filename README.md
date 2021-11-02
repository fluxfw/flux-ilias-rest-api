# FluxIliasRestApi

Experimental Alpha Version

## Installation

In [FluxIlias](https://github.com/fluxapps/FluxIlias)

```dockerfile
COPY --from=docker-registry.fluxpublisher.ch/flux-ilias-rest/api:latest /FluxIliasRestApi "$ILIAS_WEB_DIR/Customizing/global/FluxIliasRestApi"
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
