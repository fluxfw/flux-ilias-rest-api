import {getValues} from "./fetch/getValues.mjs";
import {initForm} from "./form/initForm.mjs";
import {insertError} from "../../../../flux-ilias-rest-web-proxy/static/js/loading/insertError.mjs";
import {insertLoading} from "./../../../flux-ilias-rest-web-proxy/static/js/loading/insertLoading.mjs";
import {storeForm} from "./form/storeForm.mjs";

async function flilre_config() {
    const el = document.getElementById("flilre_config");

    const loading_el = insertLoading(el);
    let values;
    try {
        values = await getValues();
    } catch (err) {
        insertError(err, "Form could not be loaded", el);
        return;
    } finally {
        loading_el.remove();
    }

    const form_template_el = el.querySelector("[data-form-template]");
    const form_el = initForm(form_template_el, async () => {
        await storeForm(form_el);
    }, values);
    form_template_el.replaceWith(form_el);
}

await flilre_config();
