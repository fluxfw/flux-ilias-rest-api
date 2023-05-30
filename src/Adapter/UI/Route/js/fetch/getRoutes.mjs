import { fetchResponseHelper } from "./fetchResponseHelper.mjs";

export async function getRoutes() {
    return (await fetchResponseHelper(await fetch(`${import.meta.url.substring(0, import.meta.url.lastIndexOf("/"))}/../../..`, {
        headers: {
            Accept: "application/json"
        }
    }))).json();
}
