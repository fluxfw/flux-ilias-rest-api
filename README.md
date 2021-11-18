# flux-ilias-rest-api

Experimental Alpha Version

## Installation

In [flux-ilias](https://github.com/fluxapps/flux-ilias)

```dockerfile
COPY --from=docker-registry.fluxpublisher.ch/flux-ilias-rest/api:latest /flux-ilias-rest-api "$ILIAS_WEB_DIR/Customizing/global/flux-ilias-rest-api"
```

## Call route

`https://%host%/Customizing/global/flux-ilias-rest-api?/path/to/some/route`

With query params

`https://%host%/Customizing/global/flux-ilias-rest-api?/path/to/some/route&query_param=xyz`

## Authorization

The API uses the basic authorization with ILIAS users

You need to prefix the ILIAS client to the user

The `Authorization` header looks like (Base64 encoded)

`Basic %client%/%user%:%password%`

## Permissions

Only admin users can use the api

## Get available routes

With the follow route you can get all available routes

`https://%host%/Customizing/global/flux-ilias-rest-api?/routes`

## Custom routes location

You can either place custom routes in `routes`

And/or each ILIAS plugin can also have custom routes in its own `src/Adapter/Route` folder

The folders are scanned recursive

## Examples

### Code

[flux-rest-api](https://github.com/fluxapps/flux-rest-api/tree/main/examples/routes)

### Request

[examples](examples)
