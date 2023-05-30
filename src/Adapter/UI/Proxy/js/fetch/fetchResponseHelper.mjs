import {UserError} from "./UserError.mjs";

export async function fetchResponseHelper(res) {
    if (res.status === 401 || res.status === 403) {
        throw new UserError(await res.text());
    }

    if (!res.ok) {
        throw new Error(`Fetch ${res.url} failed with status ${res.status}`);
    }

    return res;
}
