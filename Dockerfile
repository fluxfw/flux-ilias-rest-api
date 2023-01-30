FROM php:8.2-cli-alpine AS build

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN (mkdir -p /flux-php-backport && cd /flux-php-backport && wget -O - https://github.com/fluxfw/flux-php-backport/archive/refs/tags/v2023-01-30-1.tar.gz | tar -xz --strip-components=1)

RUN (mkdir -p /build/flux-ilias-rest-api/libs/polyfill-php80 && cd /build/flux-ilias-rest-api/libs/polyfill-php80 && composer require symfony/polyfill-php80:v1.27.0 --ignore-platform-reqs)

RUN (mkdir -p /build/flux-ilias-rest-api/libs/polyfill-php81 && cd /build/flux-ilias-rest-api/libs/polyfill-php81 && composer require symfony/polyfill-php81:v1.27.0 --ignore-platform-reqs)

RUN (mkdir -p /build/flux-ilias-rest-api/libs/polyfill-php82 && cd /build/flux-ilias-rest-api/libs/polyfill-php82 && composer require symfony/polyfill-php82:v1.27.0 --ignore-platform-reqs)

RUN (mkdir -p /build/flux-ilias-rest-api/libs/flux-ilias-base-api && cd /build/flux-ilias-rest-api/libs/flux-ilias-base-api && wget -O - https://github.com/fluxfw/flux-ilias-base-api/archive/refs/tags/v2023-01-30-1.tar.gz | tar -xz --strip-components=1)

RUN (mkdir -p /build/flux-ilias-rest-api/libs/flux-legacy-enum && cd /build/flux-ilias-rest-api/libs/flux-legacy-enum && wget -O - https://github.com/fluxfw/flux-legacy-enum/archive/refs/tags/v2023-01-30-1.tar.gz | tar -xz --strip-components=1)

RUN (mkdir -p /build/flux-ilias-rest-api/libs/flux-rest-api && cd /build/flux-ilias-rest-api/libs/flux-rest-api && wget -O - https://github.com/fluxfw/flux-rest-api/archive/refs/tags/v2023-01-30-1.tar.gz | tar -xz --strip-components=1)

RUN (mkdir -p /tmp/flux-authentication-frontend-api && cd /tmp/flux-authentication-frontend-api && wget -O - https://github.com/fluxfw/flux-authentication-frontend-api/archive/refs/tags/v2022-12-20-1.tar.gz | tar -xz --strip-components=1) && mkdir -p /build/flux-ilias-rest-api/src/Service/Login/Command/static && cp /tmp/flux-authentication-frontend-api/src/Adapter/Authentication/AuthenticationSuccess.html /build/flux-ilias-rest-api/src/Service/Login/Command/static/AuthenticationSuccess.html && cp /tmp/flux-authentication-frontend-api/src/Adapter/Authentication/AuthenticationSuccess.mjs /build/flux-ilias-rest-api/src/Service/Login/Command/static/AuthenticationSuccess.mjs && cp /tmp/flux-authentication-frontend-api/src/Adapter/Authentication/AUTHENTICATION_SUCCESS.mjs /build/flux-ilias-rest-api/src/Service/Login/Command/static/AUTHENTICATION_SUCCESS.mjs && rm -rf /tmp/flux-authentication-frontend-api

COPY . /build/flux-ilias-rest-api

RUN /flux-php-backport/bin/php-backport.php /build/flux-ilias-rest-api

FROM scratch

COPY --from=build /build /
