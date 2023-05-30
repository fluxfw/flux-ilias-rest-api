import {replaceWithNoneElement} from "./replaceWithNoneElement.mjs";

export function initResponseList(response_template_el, responses, responses_el) {
    if (responses.length === 0) {
        replaceWithNoneElement(responses_el);
        return;
    }

    for (const response of responses) {
        const response_el = response_template_el.content.firstElementChild.cloneNode(true);
        response_el.querySelector("[data-status]").innerText = response.status;
        response_el.querySelector("[data-content-type]").innerText = response.content_type;
        response_el.querySelector("[data-type]").innerText = response.type;
        response_el.querySelector("[data-description]").innerText = response.description;
        responses_el.appendChild(response_el);
    }
}
