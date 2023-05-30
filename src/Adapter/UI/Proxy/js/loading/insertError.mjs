import {UserError} from "../fetch/UserError.mjs";

export function insertError(err, fallback_text, parent_el) {
    console.error(err);

    const error_el = document.createElement("div");
    error_el.classList.add("error");

    if (err instanceof UserError) {
        error_el.innerText = err.message;
    } else {
        error_el.innerText = fallback_text;
    }

    parent_el.appendChild(error_el);

    return error_el;
}
