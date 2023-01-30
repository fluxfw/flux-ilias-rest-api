export function initForm(form_template_el, action, values) {
    const form_el = form_template_el.content.firstElementChild.cloneNode(true);

    form_el.elements.description.value = values.description;
    form_el.elements.title.value = values.title;

    for (const key of values.api_proxy_map_key.values) {
        const option_el = document.createElement("option");
        option_el.value = key;
        option_el.text = key;
        form_el.elements.api_proxy_map_key.options.add(option_el);
    }
    form_el.elements.api_proxy_map_key.value = values.api_proxy_map_key.value;

    for (const key of values.web_proxy_map_key.values) {
        const option_el = document.createElement("option");
        option_el.value = key;
        option_el.text = key;
        form_el.elements.web_proxy_map_key.options.add(option_el);
    }
    form_el.elements.web_proxy_map_key.value = values.web_proxy_map_key.value;

    form_el.querySelector("[data-store]").addEventListener("click", action);

    return form_el;
}
