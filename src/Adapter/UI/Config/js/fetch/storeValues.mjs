import { fetchResponseHelper } from "../../../../flux-ilias-rest-web-proxy/ui/js/fetch/fetchResponseHelper.mjs";

export async function storeValues(values) {
    return (await fetchResponseHelper(await fetch(`${import.meta.url.substring(0, import.meta.url.lastIndexOf("/"))}/../../../store-values`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json"
        },
        body: JSON.stringify(values)
    }))).json();
}
