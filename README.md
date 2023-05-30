# flux-ilias-rest-api

ILIAS Rest Api

*This is not a ILIAS plugin*

## Installation

### flux-ilias-rest-api

#### In [flux-ilias-ilias-base](https://github.com/fluxfw/flux-ilias-ilias-base)

```dockerfile
RUN /flux-ilias-ilias-base/bin/install-flux-ilias-rest-api.sh %tag%
```

#### Other

```dockerfile
RUN (mkdir -p %web_root%/Customizing/global/flux-ilias-rest-api && cd %web_root%/Customizing/global/flux-ilias-rest-api && wget -O - https://github.com/fluxfw/flux-ilias-rest-api/releases/download/%tag%/flux-ilias-rest-api-%tag%-build.tar.gz | tar -xz --strip-components=1)
```

or

Download https://github.com/fluxfw/flux-ilias-rest-api/releases/download/%tag%/flux-ilias-rest-api-%tag%-build.tar.gz and extract it to `%web_root%/Customizing/global/flux-ilias-rest-api`

### nginx

#### In [flux-ilias-nginx-base](https://github.com/fluxfw/flux-ilias-nginx-base)

```dockerfile
RUN /flux-ilias-nginx-base/bin/install-flux-ilias-rest-api.sh
```

#### Other

```nginx
include %web_root%/Customizing/global/flux-ilias-rest-api/src/nginx.conf
```

### Helper Plugin

You need to install [flux-ilias-rest-helper-plugin](https://github.com/fluxfw/flux-ilias-rest-helper-plugin)

### Config

Open `Administration` > `flux-ilias-rest-config` in ILIAS for get more informations (Only accessible with the `root` user)

### Example

[examples](examples)
