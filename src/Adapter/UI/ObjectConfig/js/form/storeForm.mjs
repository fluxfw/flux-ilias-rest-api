import { FluxLoadingSpinnerElement } from "../../../../flux-ilias-rest-web-proxy/ui/Libs/flux-loading-spinner/src/FluxLoadingSpinnerElement.mjs";
import { insertError } from "../../../../../flux-ilias-rest-web-proxy/ui/js/loading/insertError.mjs";
import { storeValues } from "../fetch/storeValues.mjs";

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

    const flux_loading_spinner_element = await FluxLoadingSpinnerElement.new();
    form_el.append(flux_loading_spinner_element);

    try {
        await storeValues(ref_id, values);
    } catch (err) {
        insertError(err, "Form could not be stored", form_el);
        return;
    } finally {
        flux_loading_spinner_element.remove();
    }

    for (const input_el of form_el.elements) {
        input_el.disabled = false;
    }
}
