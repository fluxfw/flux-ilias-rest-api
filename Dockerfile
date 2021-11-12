ARG REST_API_IMAGE
FROM $REST_API_IMAGE AS rest_api

FROM alpine:latest AS build

COPY --from=rest_api /FluxRestApi /FluxIliasRestApi/libs/FluxRestApi
COPY . /FluxIliasRestApi

FROM scratch

LABEL org.opencontainers.image.source="https://github.com/fluxapps/FluxIliasRestApi"
LABEL maintainer="fluxlabs <support@fluxlabs.ch> (https://fluxlabs.ch)"

COPY --from=build /FluxIliasRestApi /FluxIliasRestApi
