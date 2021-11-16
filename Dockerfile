ARG REST_API_IMAGE
FROM $REST_API_IMAGE AS rest_api

FROM alpine:latest AS build

COPY --from=rest_api /flux-rest-api /flux-ilias-rest-api/libs/flux-rest-api
COPY . /flux-ilias-rest-api

FROM scratch

LABEL org.opencontainers.image.source="https://github.com/fluxapps/flux-ilias-rest-api"
LABEL maintainer="fluxlabs <support@fluxlabs.ch> (https://fluxlabs.ch)"

COPY --from=build /flux-ilias-rest-api /flux-ilias-rest-api
