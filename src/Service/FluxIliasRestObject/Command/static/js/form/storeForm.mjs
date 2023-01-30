import {insertError} from "../../../../../flux-ilias-rest-web-proxy/static/js/loading/insertError.mjs";
import {insertLoading} from "./../../../../flux-ilias-rest-web-proxy/static/js/loading/insertLoading.mjs";
import {storeValues} from "../fetch/storeValues.mjs";

export async function storeForm(ref_id, form_el) {
    if (!form_el.checkValidity()) {
        form_el.reportValidity();
        return;
    }

    for (const input_el of form_el.elements) {
        input_el.disabled = true;
    }

    const values = {
        api_proxy_map_key: form_el.elements.api_proxy_map_key.value,
        description: form_el.elements.description.value,
        title: form_el.elements.title.value,
        web_proxy_map_key: form_el.elements.web_proxy_map_key.value
    };

    const loading_el = insertLoading(form_el);
    try {
        await storeValues(ref_id, values);
    } catch (err) {
        insertError(err, "Form could not be stored", form_el);
        return;
    } finally {
        loading_el.remove();
    }

    for (const input_el of form_el.elements) {
        input_el.disabled = false;
    }
}
