#!/usr/bin/env sh

set -e

bin="`dirname "$0"`"
root="$bin/.."
libs="$root/.."

"$libs/flux-php-backport/bin/php-backport.php" "$libs"
