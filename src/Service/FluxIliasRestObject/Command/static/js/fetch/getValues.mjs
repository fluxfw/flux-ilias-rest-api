import {fetchResponseHelper} from "../../../../flux-ilias-rest-web-proxy/static/js/fetch/fetchResponseHelper.mjs";

const __dirname = import.meta.url.substring(0, import.meta.url.lastIndexOf("/"));

export async function getValues(ref_id) {
    return (await fetchResponseHelper(await fetch(`${__dirname}/../../../${ref_id}/get-values`, {
        headers: {
            Accept: "application/json"
        }
    }))).json();
}
