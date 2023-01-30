import {getEntriesFormValue} from "../../../../../flux-ilias-rest-web-proxy/static/js/form/entries/getEntriesFormValue.mjs";
import {getScheduleFormValue} from "./schedule/getScheduleFormValue.mjs";
import {insertError} from "../../../../../flux-ilias-rest-web-proxy/static/js/loading/insertError.mjs";
import {insertLoading} from "./../../../../flux-ilias-rest-web-proxy/static/js/loading/insertLoading.mjs";
import {storeValues} from "../fetch/storeValues.mjs";

export async function storeForm(form_el) {
    if (!form_el.checkValidity()) {
        form_el.reportValidity();
        return;
    }

    const restore_disabled = [];
    for (const input_el of form_el.elements) {
        if (input_el.disabled) {
            restore_disabled.push(input_el);
        }
        input_el.disabled = true;
    }

    const values = {
        api_proxy_map: getEntriesFormValue("api_proxy_map", ["target_key", "url"], form_el),
        enable_log_changes: form_el.elements.enable_log_changes.checked,
        enable_purge_changes: form_el.elements.enable_purge_changes.checked,
        enable_rest_api: form_el.elements.enable_rest_api.checked,
        enable_transfer_changes: form_el.elements.enable_transfer_changes.checked,
        flux_ilias_rest_object_api_proxy_maps: getEntriesFormValue("flux_ilias_rest_object_api_proxy_maps", ["key", "url"], form_el),
        flux_ilias_rest_object_default_icon_url: form_el.elements.flux_ilias_rest_object_default_icon_url.value,
        flux_ilias_rest_object_multiple_type_title: form_el.elements.flux_ilias_rest_object_multiple_type_title.value,
        flux_ilias_rest_object_type_title: form_el.elements.flux_ilias_rest_object_type_title.value,
        flux_ilias_rest_object_web_proxy_maps: getEntriesFormValue("flux_ilias_rest_object_web_proxy_maps", ["icon_url", "iframe_url", "key", "page_title", "pass_ref_id", "rewrite_url", "short_title", "view_title"], form_el),
        keep_changes_inside_days: form_el.elements.keep_changes_inside_days.valueAsNumber,
        purge_changes_schedule: getScheduleFormValue("purge_changes_schedule", form_el),
        transfer_changes_post_url: form_el.elements.transfer_changes_post_url.value,
        transfer_changes_schedule: getScheduleFormValue("transfer_changes_schedule", form_el),
        web_proxy_iframe_height_offset: form_el.elements.web_proxy_iframe_height_offset.valueAsNumber,
        web_proxy_map: getEntriesFormValue("web_proxy_map", ["iframe_url", "menu_icon_url", "menu_item", "menu_title", "page_title", "rewrite_url", "short_title", "target_key", "view_title", "visible_public_menu_item"], form_el)
    };

    const loading_el = insertLoading(form_el);
    try {
        await storeValues(values);
    } catch (err) {
        insertError(err, "Form could not be stored", form_el);
        return;
    } finally {
        loading_el.remove();
    }

    for (const input_el of form_el.elements) {
        input_el.disabled = restore_disabled.includes(input_el);
    }
}
