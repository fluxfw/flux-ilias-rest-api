import {replaceWithNoneElement} from "./replaceWithNoneElement.mjs";

export function initContentTypeList(content_type_template_el, content_types, content_types_el) {
    if (content_types.length === 0) {
        replaceWithNoneElement(content_types_el);
        return;
    }

    for (const content_type of content_types) {
        const content_type_el = content_type_template_el.content.firstElementChild.cloneNode(true);
        content_type_el.querySelector("[data-content-type]").innerText = content_type.content_type;
        content_type_el.querySelector("[data-type]").innerText = content_type.type;
        content_type_el.querySelector("[data-description]").innerText = content_type.description;
        content_types_el.appendChild(content_type_el);
    }
}
