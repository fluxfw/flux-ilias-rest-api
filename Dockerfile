FROM php:8.2-cli-alpine AS build

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY bin/install-libraries.sh /build/flux-ilias-rest-api-build/libs/flux-ilias-rest-api/bin/install-libraries.sh
RUN /build/flux-ilias-rest-api-build/libs/flux-ilias-rest-api/bin/install-libraries.sh

COPY . /build/flux-ilias-rest-api-build/libs/flux-ilias-rest-api

RUN /build/flux-ilias-rest-api-build/libs/flux-ilias-rest-api/bin/php-backport.sh

RUN cp -L -R /build/flux-ilias-rest-api-build/libs/flux-ilias-rest-api /build/flux-ilias-rest-api && rm -rf /build/flux-ilias-rest-api/bin && rm -rf /build/flux-ilias-rest-api-build

RUN (cd /build && tar -czf build.tar.gz flux-ilias-rest-api && rm -rf flux-ilias-rest-api)

FROM scratch

COPY --from=build /build /
