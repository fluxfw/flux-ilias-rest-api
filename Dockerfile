ARG ALPINE_IMAGE=alpine:latest
ARG FLUX_AUTOLOAD_API_IMAGE=docker-registry.fluxpublisher.ch/flux-autoload/api:latest
ARG FLUX_ILIAS_API_IMAGE=docker-registry.fluxpublisher.ch/flux-ilias-api/api:latest
ARG FLUX_NAMESPACE_CHANGER_IMAGE=docker-registry.fluxpublisher.ch/flux-namespace-changer:latest
ARG FLUX_REST_API_IMAGE=docker-registry.fluxpublisher.ch/flux-rest/api:latest

FROM $FLUX_AUTOLOAD_API_IMAGE AS flux_autoload_api
FROM $FLUX_NAMESPACE_CHANGER_IMAGE AS flux_autoload_api_build
ENV FLUX_NAMESPACE_CHANGER_FROM_NAMESPACE FluxAutoloadApi
ENV FLUX_NAMESPACE_CHANGER_TO_NAMESPACE FluxIliasRestApi\\Libs\\FluxAutoloadApi
COPY --from=flux_autoload_api /flux-autoload-api /code
RUN $FLUX_NAMESPACE_CHANGER_BIN

FROM $FLUX_ILIAS_API_IMAGE AS flux_ilias_api
FROM $FLUX_NAMESPACE_CHANGER_IMAGE AS flux_ilias_api_build
ENV FLUX_NAMESPACE_CHANGER_FROM_NAMESPACE FluxIliasApi
ENV FLUX_NAMESPACE_CHANGER_TO_NAMESPACE FluxIliasRestApi\\Libs\\FluxIliasApi
COPY --from=flux_ilias_api /flux-ilias-api /code
RUN $FLUX_NAMESPACE_CHANGER_BIN

FROM $FLUX_REST_API_IMAGE AS flux_rest_api
FROM $FLUX_NAMESPACE_CHANGER_IMAGE AS flux_rest_api_build
ENV FLUX_NAMESPACE_CHANGER_FROM_NAMESPACE FluxRestApi
ENV FLUX_NAMESPACE_CHANGER_TO_NAMESPACE FluxIliasRestApi\\Libs\\FluxRestApi
COPY --from=flux_rest_api /flux-rest-api /code
RUN $FLUX_NAMESPACE_CHANGER_BIN

FROM $ALPINE_IMAGE AS build

COPY --from=flux_autoload_api_build /code /flux-ilias-rest-api/libs/flux-autoload-api
COPY --from=flux_ilias_api_build /code /flux-ilias-rest-api/libs/flux-ilias-api
COPY --from=flux_rest_api_build /code /flux-ilias-rest-api/libs/flux-rest-api
COPY . /flux-ilias-rest-api

FROM scratch

LABEL org.opencontainers.image.source="https://github.com/flux-caps/flux-ilias-rest-api"
LABEL maintainer="fluxlabs <support@fluxlabs.ch> (https://fluxlabs.ch)"

COPY --from=build /flux-ilias-rest-api /flux-ilias-rest-api
