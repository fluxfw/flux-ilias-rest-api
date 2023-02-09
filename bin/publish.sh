#!/usr/bin/env sh

set -e

bin="`dirname "$0"`"
root="$bin/.."
build="$root/build"

name="`basename "$(realpath "$root")"`"
tag="`get-release-tag "$root"`"
build_name="$name-$tag-build.tar.gz"

"$bin/build.sh"

tag-release "$root"
create-github-release "$root"

upload-asset-to-github-release "$root" "build/$build_name" "$build_name"

update-github-metadata "$root"
