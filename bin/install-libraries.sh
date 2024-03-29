#!/usr/bin/env sh

set -e

bin="`dirname "$0"`"
root="$bin/.."
libs="$root/.."

checkAlreadyInstalled() {
    if [ `ls "$libs" | wc -l` != "1" ]; then
        echo "Already installed" >&2
        exit 1
    fi
}

installComposerLibrary() {
    (mkdir -p "$libs/$1" && cd "$libs/$1" && composer require "$2" --ignore-platform-reqs)
}

installLibrary() {
    (mkdir -p "$libs/$1" && cd "$libs/$1" && wget -O - "$2" | tar -xz --strip-components=1)
}

checkAlreadyInstalled

installLibrary flux-authentication-frontend https://github.com/fluxfw/flux-authentication-frontend/archive/refs/tags/v2023-07-27-1.tar.gz

installLibrary flux-http-api https://github.com/fluxfw/flux-http-api/archive/refs/tags/v2023-06-19-1.tar.gz

installLibrary flux-legacy-enum https://github.com/fluxfw/flux-legacy-enum/archive/refs/tags/v2023-02-09-1.tar.gz

installLibrary flux-loading-spinner https://github.com/fluxfw/flux-loading-spinner/archive/refs/tags/v2023-07-27-1.tar.gz

installLibrary flux-php-backport https://github.com/fluxfw/flux-php-backport/archive/refs/tags/v2023-02-09-1.tar.gz

installLibrary flux-style-sheet-manager https://github.com/fluxfw/flux-style-sheet-manager/archive/refs/tags/v2023-07-27-1.tar.gz

installComposerLibrary polyfill-php80 symfony/polyfill-php80:v1.27.0

installComposerLibrary polyfill-php81 symfony/polyfill-php81:v1.27.0

installComposerLibrary polyfill-php82 symfony/polyfill-php82:v1.27.0
