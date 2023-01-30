import {fetchResponseHelper} from "../../../../flux-ilias-rest-web-proxy/static/js/fetch/fetchResponseHelper.mjs";

const __dirname = import.meta.url.substring(0, import.meta.url.lastIndexOf("/"));

export async function storeValues(values) {
    return (await fetchResponseHelper(await fetch(`${__dirname}/../../../store-values`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json"
        },
        body: JSON.stringify(values)
    }))).json();
}
