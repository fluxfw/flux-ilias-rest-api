# flux-ilias-rest-api

ILIAS Rest Api

*This is not a ILIAS plugin*

## Installation

### flux-ilias-rest-api

#### In [flux-ilias](https://github.com/flux-caps/flux-ilias)

```dockerfile
COPY --from=docker-registry.fluxpublisher.ch/flux-ilias-api/rest-api:latest /flux-ilias-rest-api $ILIAS_WEB_DIR/Customizing/global/flux-ilias-rest-api
```

or

```dockerfile
RUN (mkdir -p $ILIAS_WEB_DIR/Customizing/global/flux-ilias-rest-api && cd $ILIAS_WEB_DIR/Customizing/global/flux-ilias-rest-api && wget -O - https://docker-registry.fluxpublisher.ch/api/get-build-archive/flux-ilias-api/rest-api | tar -xz --strip-components=1)
```

#### Other

Download https://docker-registry.fluxpublisher.ch/api/get-build-archive/flux-ilias-api/rest-api and extract it to %web_root%/Customizing/global/flux-ilias-rest-api

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

You need to install [flux-ilias-rest-helper-plugin](https://github.com/flux-caps/flux-ilias-rest-helper-plugin) too

### Config

Open `Administration` > `flux-ilias-rest-config` in ILIAS

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

### Example

[examples](examples)

## Proxy

There is no need, but may you should enable ILIAS public area for avoid some problems

### Web

#### nginx

##### In [flux-ilias](https://github.com/flux-caps/flux-ilias)

###### flux-ilias-rest-helper-plugin

In [flux-ilias-nginx-base](https://github.com/flux-caps/flux-ilias-nginx-base)

```dockerfile
RUN echo "rewrite ^/%key%($|/.*$) /goto.php?target=flilre_web_proxy_%key%&route=\$1;" > /flux-ilias-nginx-base/src/custom/%key%.conf
```

###### Other service

In [flux-ilias-nginx-base](https://github.com/flux-caps/flux-ilias-nginx-base)

```dockerfile
RUN echo "location /%key%-code/ {\n    proxy_pass http://%some-other-service%/;\n}" > /flux-ilias-nginx-base/src/custom/%key%-code.conf
```

or

```dockerfile
RUN echo "rewrite ^/%key%-code($|/(.*)$) /Customizing/global/%key%/\$2;" > /flux-ilias-nginx-base/src/custom/%key%-code.conf
```

##### Other

###### flux-ilias-rest-helper-plugin

```nginx
rewrite ^/%key%($|/.*$) /goto.php?target=flilre_web_proxy_%key%&route=$1;
```

###### Other service

```nginx
location /%key%-code/ {
    proxy_pass http://%some-other-service%/;
}
```

or

```nginx
rewrite ^/%key%-code($|/(.*)$) /Customizing/global/%key%/$2;
```

#### apache

##### flux-ilias-rest-helper-plugin

```apache
RewriteEngine On
RewriteRule ^/%key%($|/.*$) /goto.php?target=flilre_web_proxy_%key%&route=$1 [QSA]
```

##### Other service

```apache
ProxyPass /%key%-code http://%some-other-service%
ProxyPassReverse /%key%-code http://%some-other-service%
```

or

```apache
RewriteEngine On
RewriteRule ^/%key%-code($|/(.*)$) /Customizing/global/%key%/$2 [QSA]
```

#### Usage

Add a manual ILIAS main menu link item with the url `https://%host%/%key%`

### Api

#### nginx

##### In [flux-ilias](https://github.com/flux-caps/flux-ilias)

###### flux-ilias-rest-helper-plugin

In [flux-ilias-nginx-base](https://github.com/flux-caps/flux-ilias-nginx-base)

```dockerfile
RUN echo "rewrite ^/%key%($|/.*$) /goto.php?target=flilre_api_proxy_%key%&route=\$1;" > /flux-ilias-nginx-base/src/custom/%key%.conf
```

##### Other

###### flux-ilias-rest-helper-plugin

```nginx
rewrite ^/%key%($|/.*$) /goto.php?target=flilre_api_proxy_%key%&route=$1;
```

#### apache

##### flux-ilias-rest-helper-plugin

```apache
RewriteEngine On
RewriteRule ^/%key%($|/.*$) /goto.php?target=flilre_api_proxy_%key%&route=$1 [QSA]
```

#### Usage

Make requests to `https://%host%/%key%/...` in your web code

If the ILIAS public area is enabled, you get the 401 HTTP status code in your web code, if the user is not logged in ILIAS

On your api you can get the logged ILIAS user in the custom HTTP header `X-Flux-Ilias-Api-User-Id` or `X-Flux-Ilias-Api-User-Import-Id`
