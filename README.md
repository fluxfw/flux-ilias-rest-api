# flux-ilias-rest-api

ILIAS Rest Api

## Installation

In [flux-ilias](https://github.com/fluxapps/flux-ilias)

```dockerfile
COPY --from=docker-registry.fluxpublisher.ch/flux-ilias-api/rest-api:latest /flux-ilias-rest-api "$ILIAS_WEB_DIR/Customizing/global/flux-ilias-rest-api"
```

*You can install it somewhere in `Customizing` even with a different name*

*But may you should not install it in `Customizing/global/plugins` for avoid conflicts with ILIAS core*

*This is not a ILIAS plugin*

### Helper Plugin

If you need additional features like changes, you need to install [flux-ilias-rest-helper-plugin](https://github.com/fluxapps/flux-ilias-rest-helper-plugin) too

## Call route

`https://%host%/Customizing/global/flux-ilias-rest-api?/path/to/some/route`

With query params

`https://%host%/Customizing/global/flux-ilias-rest-api?/path/to/some/route&query_param=xyz`

## Authorization

The API uses the basic HTTP authorization

It uses the ILIAS "cron context" for login in ILIAS

You need to prefix the ILIAS client to the user

The `Authorization` header looks like (Base64 encoded)

`Basic %client%/%user%:%password%`

## Permissions

Only admin users can use the api

You should create/use a separate ILIAS user

## Get available routes

With the follow route you can get all available routes

`https://%host%/Customizing/global/flux-ilias-rest-api?/routes`

## Custom routes location

You can either place custom routes in `routes`

And/or each ILIAS plugin can also have custom routes in its own `src/Adapter/Route` folder

The folders are scanned recursive

## Example

[examples](examples)
