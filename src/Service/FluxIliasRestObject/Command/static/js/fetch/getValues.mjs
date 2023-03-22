import { fetchResponseHelper } from "../../../../flux-ilias-rest-web-proxy/static/js/fetch/fetchResponseHelper.mjs";

export async function getValues(ref_id) {
    return (await fetchResponseHelper(await fetch(`${import.meta.url.substring(0, import.meta.url.lastIndexOf("/"))}/../../../${ref_id}/get-values`, {
        headers: {
            Accept: "application/json"
        }
    }))).json();
}
