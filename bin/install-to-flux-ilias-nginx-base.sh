#!/usr/bin/env sh

ln -sfT "$(realpath "`dirname "$0"`/..")/src/Adapter/Server/Config/nginx.conf" /flux-ilias-nginx-base/src/custom/flux-ilias-rest-api.conf
