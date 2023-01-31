#!/usr/bin/env sh

set -e

root="`dirname "$0"`/.."
libs="$root/.."

"$libs/flux-php-backport/bin/php-backport.php" "$libs"
