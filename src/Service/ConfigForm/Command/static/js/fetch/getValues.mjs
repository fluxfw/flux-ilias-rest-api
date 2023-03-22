import { fetchResponseHelper } from "../../../../flux-ilias-rest-web-proxy/static/js/fetch/fetchResponseHelper.mjs";

export async function getValues() {
    return (await fetchResponseHelper(await fetch(`${import.meta.url.substring(0, import.meta.url.lastIndexOf("/"))}/../../../get-values`, {
        headers: {
            Accept: "application/json"
        }
    }))).json();
}
