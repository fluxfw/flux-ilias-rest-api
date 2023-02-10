#!/usr/bin/env sh

set -e

bin="`dirname "$0"`"
root="$bin/.."
build="$root/build"

name="`basename "$(realpath "$root")"`"
user="${FLUX_PUBLISH_DOCKER_USER:=fluxfw}"
image="$user/$name"
tag="`get-release-tag "$root"`"
build_name="$name-$tag-build.tar.gz"

mkdir -p "$build"

if [ -f "$build/$build_name" ]; then
    unlink "$build/$build_name"
fi

docker build "$root" --pull -t "$image:$tag"

copy-from-docker-image "$image:$tag" /build.tar.gz "$build/$build_name"
