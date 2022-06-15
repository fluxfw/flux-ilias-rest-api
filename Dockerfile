ARG FLUX_AUTOLOAD_API_IMAGE=docker-registry.fluxpublisher.ch/flux-autoload/api
ARG FLUX_ILIAS_API_IMAGE=docker-registry.fluxpublisher.ch/flux-ilias-api/api
ARG FLUX_NAMESPACE_CHANGER_IMAGE=docker-registry.fluxpublisher.ch/flux-namespace-changer
ARG FLUX_PHP_BACKPORT_IMAGE=docker-registry.fluxpublisher.ch/flux-php-backport
ARG FLUX_REST_API_IMAGE=docker-registry.fluxpublisher.ch/flux-rest/api

FROM $FLUX_AUTOLOAD_API_IMAGE:latest AS flux_autoload_api
FROM $FLUX_ILIAS_API_IMAGE:latest AS flux_ilias_api
FROM $FLUX_PHP_BACKPORT_IMAGE AS flux_php_backport
FROM $FLUX_REST_API_IMAGE:latest AS flux_rest_api

FROM $FLUX_NAMESPACE_CHANGER_IMAGE:latest AS build_namespaces

COPY --from=flux_autoload_api /flux-autoload-api /code/flux-autoload-api
RUN change-namespace /code/flux-autoload-api FluxAutoloadApi FluxIliasRestApi\\Libs\\FluxAutoloadApi

COPY --from=flux_ilias_api /flux-ilias-api /code/flux-ilias-api
RUN change-namespace /code/flux-ilias-api FluxIliasApi FluxIliasRestApi\\Libs\\FluxIliasApi

COPY --from=flux_rest_api /flux-rest-api /code/flux-rest-api
RUN change-namespace /code/flux-rest-api FluxRestApi FluxIliasRestApi\\Libs\\FluxRestApi

FROM $FLUX_PHP_BACKPORT_IMAGE AS build

COPY --from=build_namespaces /code/flux-autoload-api /flux-ilias-rest-api/libs/flux-autoload-api
COPY --from=build_namespaces /code/flux-ilias-api /flux-ilias-rest-api/libs/flux-ilias-api
COPY --from=build_namespaces /code/flux-rest-api /flux-ilias-rest-api/libs/flux-rest-api
COPY . /flux-ilias-rest-api

RUN php-backport /flux-ilias-rest-api

FROM scratch

LABEL org.opencontainers.image.source="https://github.com/flux-caps/flux-ilias-rest-api"
LABEL maintainer="fluxlabs <support@fluxlabs.ch> (https://fluxlabs.ch)"
LABEL flux-docker-registry-rest-api-build-path="/flux-ilias-rest-api"

COPY --from=build /flux-ilias-rest-api /flux-ilias-rest-api

ARG COMMIT_SHA
LABEL org.opencontainers.image.revision="$COMMIT_SHA"
