import {replaceWithNoneElement} from "./replaceWithNoneElement.mjs";

export function initParamList(param_template_el, params, params_el) {
    if (params.length === 0) {
        replaceWithNoneElement(params_el);
        return;
    }

    for (const param of params) {
        const param_el = param_template_el.content.firstElementChild.cloneNode(true);
        param_el.querySelector("[data-name]").innerText = param.name;
        param_el.querySelector("[data-type]").innerText = param.type;
        param_el.querySelector("[data-description]").innerText = param.description;
        params_el.appendChild(param_el);
    }
}
