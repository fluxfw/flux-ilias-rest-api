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

You need to install [flux-ilias-rest-helper-plugin](https://github.com/flux-caps/flux-ilias-rest-helper-plugin) and [flux-ilias-rest-object-helper-plugin](https://github.com/flux-caps/flux-ilias-rest-object-helper-plugin) too

### Config

Open `Administration` > `flux-ilias-rest-config` in ILIAS

### Example

[examples](examples)
