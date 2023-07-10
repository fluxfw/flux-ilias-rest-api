import { FluxLoadingSpinnerElement } from "../../../../flux-ilias-rest-web-proxy/ui/Libs/flux-loading-spinner/src/FluxLoadingSpinnerElement.mjs";
import { getValues } from "./fetch/getValues.mjs";
import { initForm } from "./form/initForm.mjs";
import { insertError } from "../../../../flux-ilias-rest-web-proxy/ui/js/loading/insertError.mjs";
import { storeForm } from "./form/storeForm.mjs";

async function flilre_object_config() {
    const el = document.getElementById("flilre_object_config");

    const ref_id = new URL(location).searchParams.get("ref_id");

    const flux_loading_spinner_element = FluxLoadingSpinnerElement.new();
    el.append(flux_loading_spinner_element);

    let values;
    try {
        values = await getValues(ref_id);
    } catch (err) {
        insertError(err, "Form could not be loaded", el);
        return;
    } finally {
        flux_loading_spinner_element.remove();
    }

    const form_template_el = el.querySelector("[data-form-template]");
    const form_el = initForm(form_template_el, async () => {
        await storeForm(ref_id, form_el);
    }, values);
    form_template_el.replaceWith(form_el);
}

await flilre_object_config();
