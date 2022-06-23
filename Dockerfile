ARG FLUX_AUTOLOAD_API_IMAGE=docker-registry.fluxpublisher.ch/flux-autoload/api
ARG FLUX_ILIAS_API_IMAGE=docker-registry.fluxpublisher.ch/flux-ilias-api/api
ARG FLUX_LEGACY_ENUM_IMAGE=docker-registry.fluxpublisher.ch/flux-enum/legacy
ARG FLUX_NAMESPACE_CHANGER_IMAGE=docker-registry.fluxpublisher.ch/flux-namespace-changer
ARG FLUX_PHP_BACKPORT_IMAGE=docker-registry.fluxpublisher.ch/flux-php-backport
ARG FLUX_REST_API_IMAGE=docker-registry.fluxpublisher.ch/flux-rest/api

FROM $FLUX_AUTOLOAD_API_IMAGE:v2022-06-22-1 AS flux_autoload_api
FROM $FLUX_ILIAS_API_IMAGE:v2022-06-23-1 AS flux_ilias_api
FROM $FLUX_LEGACY_ENUM_IMAGE:v2022-06-22-1 AS flux_legacy_enum
FROM $FLUX_REST_API_IMAGE:v2022-06-22-1 AS flux_rest_api

FROM composer:latest AS composer

RUN (mkdir -p /code/polyfill-php80 && cd /code/polyfill-php80 && composer require symfony/polyfill-php80:v1.26.0 --ignore-platform-reqs)
RUN (mkdir -p /code/polyfill-php81 && cd /code/polyfill-php81 && composer require symfony/polyfill-php81:v1.26.0 --ignore-platform-reqs)

FROM $FLUX_NAMESPACE_CHANGER_IMAGE:v2022-06-23-1 AS build_namespaces

COPY --from=flux_autoload_api /flux-autoload-api /code/flux-autoload-api
RUN change-namespace /code/flux-autoload-api FluxAutoloadApi FluxIliasRestApi\\Libs\\FluxAutoloadApi

COPY --from=flux_ilias_api /flux-ilias-api /code/flux-ilias-api
RUN change-namespace /code/flux-ilias-api FluxIliasApi FluxIliasRestApi\\Libs\\FluxIliasApi

COPY --from=flux_legacy_enum /flux-legacy-enum /code/flux-legacy-enum
RUN change-namespace /code/flux-legacy-enum FluxLegacyEnum FluxIliasRestApi\\Libs\\FluxLegacyEnum

COPY --from=flux_rest_api /flux-rest-api /code/flux-rest-api
RUN change-namespace /code/flux-rest-api FluxRestApi FluxIliasRestApi\\Libs\\FluxRestApi

FROM $FLUX_PHP_BACKPORT_IMAGE:v2022-06-23-1 AS build

COPY --from=build_namespaces /code/flux-autoload-api /build/flux-ilias-rest-api/libs/flux-autoload-api
COPY --from=build_namespaces /code/flux-ilias-api /build/flux-ilias-rest-api/libs/flux-ilias-api
COPY --from=build_namespaces /code/flux-legacy-enum /build/flux-ilias-rest-api/libs/flux-legacy-enum
COPY --from=build_namespaces /code/flux-rest-api /build/flux-ilias-rest-api/libs/flux-rest-api
COPY --from=composer /code/polyfill-php80 /build/flux-ilias-rest-api/libs/polyfill-php80
COPY --from=composer /code/polyfill-php81 /build/flux-ilias-rest-api/libs/polyfill-php81
COPY . /build/flux-ilias-rest-api

RUN php-backport /build/flux-ilias-rest-api FluxIliasRestApi\\Libs\\FluxLegacyEnum

RUN (cd /build && tar -czf flux-ilias-rest-api.tar.gz flux-ilias-rest-api)

FROM scratch

LABEL org.opencontainers.image.source="https://github.com/flux-caps/flux-ilias-rest-api"
LABEL maintainer="fluxlabs <support@fluxlabs.ch> (https://fluxlabs.ch)"
LABEL flux-docker-registry-rest-api-build-path="/flux-ilias-rest-api.tar.gz"

COPY --from=build /build /

ARG COMMIT_SHA
LABEL org.opencontainers.image.revision="$COMMIT_SHA"
