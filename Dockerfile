FROM composer:latest AS build

RUN (mkdir -p /flux-namespace-changer && cd /flux-namespace-changer && wget -O - https://github.com/fluxfw/flux-namespace-changer/releases/download/v2022-07-12-1/flux-namespace-changer-v2022-07-12-1-build.tar.gz | tar -xz --strip-components=1)

RUN (mkdir -p /flux-php-backport && cd /flux-php-backport && wget -O - https://github.com/fluxfw/flux-php-backport/releases/download/v2022-12-12-2/flux-php-backport-v2022-12-12-2-build.tar.gz | tar -xz --strip-components=1)

RUN (mkdir -p /build/flux-ilias-rest-api/libs/polyfill-php80 && cd /build/flux-ilias-rest-api/libs/polyfill-php80 && composer require symfony/polyfill-php80:v1.27.0 --ignore-platform-reqs)

RUN (mkdir -p /build/flux-ilias-rest-api/libs/polyfill-php81 && cd /build/flux-ilias-rest-api/libs/polyfill-php81 && composer require symfony/polyfill-php81:v1.27.0 --ignore-platform-reqs)

RUN (mkdir -p /build/flux-ilias-rest-api/libs/polyfill-php82 && cd /build/flux-ilias-rest-api/libs/polyfill-php82 && composer require symfony/polyfill-php82:v1.27.0 --ignore-platform-reqs)

RUN (mkdir -p /build/flux-ilias-rest-api/libs/flux-autoload-api && cd /build/flux-ilias-rest-api/libs/flux-autoload-api && wget -O - https://github.com/fluxfw/flux-autoload-api/releases/download/v2022-12-12-1/flux-autoload-api-v2022-12-12-1-build.tar.gz | tar -xz --strip-components=1 && /flux-namespace-changer/bin/change-namespace.php . FluxAutoloadApi FluxIliasRestApi\\Libs\\FluxAutoloadApi)

RUN (mkdir -p /build/flux-ilias-rest-api/libs/flux-ilias-api && cd /build/flux-ilias-rest-api/libs/flux-ilias-api && wget -O - https://github.com/fluxfw/flux-ilias-api/releases/download/v2022-12-13-1/flux-ilias-api-v2022-12-13-1-build.tar.gz | tar -xz --strip-components=1 && /flux-namespace-changer/bin/change-namespace.php . FluxIliasApi FluxIliasRestApi\\Libs\\FluxIliasApi)

RUN (mkdir -p /build/flux-ilias-rest-api/libs/flux-legacy-enum && cd /build/flux-ilias-rest-api/libs/flux-legacy-enum && wget -O - https://github.com/fluxfw/flux-legacy-enum/releases/download/v2022-12-12-1/flux-legacy-enum-v2022-12-12-1-build.tar.gz | tar -xz --strip-components=1 && /flux-namespace-changer/bin/change-namespace.php . FluxLegacyEnum FluxIliasRestApi\\Libs\\FluxLegacyEnum)

RUN (mkdir -p /build/flux-ilias-rest-api/libs/flux-rest-api && cd /build/flux-ilias-rest-api/libs/flux-rest-api && wget -O - https://github.com/fluxfw/flux-rest-api/releases/download/v2022-12-12-1/flux-rest-api-v2022-12-12-1-build.tar.gz | tar -xz --strip-components=1 && /flux-namespace-changer/bin/change-namespace.php . FluxRestApi FluxIliasRestApi\\Libs\\FluxRestApi)

COPY . /build/flux-ilias-rest-api

RUN /flux-php-backport/bin/php-backport.php /build/flux-ilias-rest-api FluxIliasRestApi\\Libs\\FluxLegacyEnum

FROM scratch

COPY --from=build /build /
