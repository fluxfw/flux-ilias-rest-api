# flux-ilias-rest-api

ILIAS Rest Api

*This is not a ILIAS plugin*

## Installation

### flux-ilias-rest-api

#### In [flux-ilias](https://github.com/flux-caps/flux-ilias)

```dockerfile
COPY --from=docker-registry.fluxpublisher.ch/flux-ilias-api/rest-api:latest /flux-ilias-rest-api $ILIAS_WEB_DIR/Customizing/global/flux-ilias-rest-api
```

#### Other

Download https://docker-registry.fluxpublisher.ch/api/get-build-archive/flux-ilias-api/rest-api and extract to %web_root%/Customizing/global/flux-ilias-rest-api

### nginx

#### In [flux-ilias-nginx-base](https://github.com/flux-caps/flux-ilias-nginx-base)

```dockerfile
RUN $ILIAS_WEB_DIR/Customizing/global/flux-ilias-rest-api/bin/install-to-flux-ilias-nginx-base.sh
```

#### Other

```nginx
include %web_root%/Customizing/global/flux-ilias-rest-api/src/Adapter/Server/Config/nginx.conf
```

### apache

```apache
RewriteEngine On
Include %web_root%/Customizing/global/flux-ilias-rest-api/src/Adapter/Server/Config/apache.conf
```

### Helper Plugin

If you need additional features like changes or proxy, you need to install [flux-ilias-rest-helper-plugin](https://github.com/flux-caps/flux-ilias-rest-helper-plugin) too

## Rest api

### Call route

`https://%host%/flux-ilias-rest-api/path/to/some/route`

### Authorization

The API uses the basic HTTP authorization

It uses the ILIAS "cron context" for login in ILIAS

You need to prefix the ILIAS client to the user

The `Authorization` header looks like (Base64 encoded)

`Basic %client%/%user%:%password%`

### Permissions

Only admin users can use the api

You should create/use a separate ILIAS user

### Get available routes

With the follow route you can get all available routes

`https://%host%/flux-ilias-rest-api/routes`

### Custom routes location

You can either place custom routes in `routes`

And/or each ILIAS plugin can also have custom routes in its own `src/Adapter/Route` folder

The folders are scanned recursive

### Example

[examples](examples)

## Proxy

There is no need, but may you should enable ILIAS public area for avoid some problems

### Web

#### nginx

##### In [flux-ilias](https://github.com/flux-caps/flux-ilias)

In [flux-ilias-ilias-base](https://github.com/flux-caps/flux-ilias-ilias-base)

```yaml
FLUX_ILIAS_API_PROXY_WEB_MAP_%key%=https://%host%/%name%-code
```

In [flux-ilias-nginx-base](https://github.com/flux-caps/flux-ilias-nginx-base)

```dockerfile
RUN echo "rewrite ^/%name%($|/.*$) /goto.php?target=flilre_web_proxy_%key%&route=\$1;" > /flux-ilias-nginx-base/src/custom/%name%.conf
```

```dockerfile
RUN echo "rewrite ^/%name%-code($|/(.*)$) /Customizing/global/%name%/\$2;" > /flux-ilias-nginx-base/src/custom/%name%-code.conf
```

##### Other

```nginx
fastcgi_param FLUX_ILIAS_API_PROXY_WEB_MAP_%key% https://%host%/%name%-code;
```

```nginx
rewrite ^/%name%($|/.*$) /goto.php?target=flilre_web_proxy_%key%&route=$1;
```

```nginx
rewrite ^/%name%-code($|/(.*)$) /Customizing/global/%name%/$2;
```

#### apache

```apache
SetEnv FLUX_ILIAS_API_PROXY_WEB_MAP_%key% https://%host%/%name%-code
```

```apache
RewriteEngine On
RewriteRule ^/%name%($|/.*$) /goto.php?target=flilre_web_proxy_%key%&route=$1 [QSA]
```

```apache
RewriteEngine On
RewriteRule ^/%name%-code($|/(.*)$) /Customizing/global/%name%/$2 [QSA]
```

#### Usage

Add a manual ILIAS main menu link item with the url `https://%host%/%name%`

### Api

#### nginx

##### In [flux-ilias](https://github.com/flux-caps/flux-ilias)

In [flux-ilias-ilias-base](https://github.com/flux-caps/flux-ilias-ilias-base)

```yaml
FLUX_ILIAS_API_PROXY_API_MAP_%key%=http://some-other-service
```

In [flux-ilias-nginx-base](https://github.com/flux-caps/flux-ilias-nginx-base)

```dockerfile
RUN echo "rewrite ^/%name%($|/.*$) /goto.php?target=flilre_api_proxy_%key%&route=\$1;" > /flux-ilias-nginx-base/src/custom/%name%.conf
```

##### Other

```nginx
fastcgi_param FLUX_ILIAS_API_PROXY_API_MAP_%key% http://some-other-service;
```

```nginx
rewrite ^/%name%($|/.*$) /goto.php?target=flilre_api_proxy_%key%&route=$1;
```

#### apache

```apache
SetEnv FLUX_ILIAS_API_PROXY_API_MAP_%key% http://some-other-service
```

```apache
RewriteEngine On
RewriteRule ^/%name%($|/.*$) /goto.php?target=flilre_api_proxy_%key%&route=$1 [QSA]
```

#### Usage

Make requests to `https://%host%/%name%/...` in your web code

If the ILIAS public area is enabled, you get the 401 HTTP status code in your web code, if the user is not logged in ILIAS

On your api you can get the logged ILIAS user in the custom HTTP header `X-Flux-Ilias-Api-User-Id` or `X-Flux-Ilias-Api-User-Import-Id`
