ARG ALPINE_IMAGE=alpine:latest
ARG FLUX_REST_API_IMAGE=docker-registry.fluxpublisher.ch/flux-rest/api:latest

FROM $FLUX_REST_API_IMAGE AS flux_rest_api

FROM $ALPINE_IMAGE AS build

COPY --from=flux_rest_api /flux-rest-api /flux-ilias-rest-api/libs/flux-rest-api
COPY . /flux-ilias-rest-api

FROM scratch

LABEL org.opencontainers.image.source="https://github.com/fluxapps/flux-ilias-rest-api"
LABEL maintainer="fluxlabs <support@fluxlabs.ch> (https://fluxlabs.ch)"

COPY --from=build /flux-ilias-rest-api /flux-ilias-rest-api
