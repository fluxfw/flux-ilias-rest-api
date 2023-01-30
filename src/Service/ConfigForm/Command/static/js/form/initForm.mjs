import {initEntriesForm} from "../../../../../flux-ilias-rest-web-proxy/static/js/form/entries/initEntriesForm.mjs";
import {initScheduleForm} from "./schedule/initScheduleForm.mjs";

export function initForm(form_template_el, action, values) {
    const form_el = form_template_el.content.firstElementChild.cloneNode(true);

    const entries_template_el = form_el.querySelector("[data-entries-template]");
    entries_template_el.remove();

    const schedule_template_el = form_el.querySelector("[data-schedule-template]");
    schedule_template_el.remove();

    form_el.elements.enable_log_changes.checked = values.enable_log_changes;
    form_el.elements.enable_purge_changes.checked = values.enable_purge_changes;
    form_el.elements.enable_rest_api.checked = values.enable_rest_api;
    form_el.elements.enable_transfer_changes.checked = values.enable_transfer_changes;
    form_el.elements.flux_ilias_rest_object_default_icon_url.value = values.flux_ilias_rest_object_default_icon_url;
    form_el.elements.flux_ilias_rest_object_multiple_type_title.value = values.flux_ilias_rest_object_multiple_type_title;
    form_el.elements.flux_ilias_rest_object_type_title.value = values.flux_ilias_rest_object_type_title;
    form_el.elements.keep_changes_inside_days.valueAsNumber = values.keep_changes_inside_days;
    form_el.elements.transfer_changes_post_url.value = values.transfer_changes_post_url;
    form_el.elements.web_proxy_iframe_height_offset.valueAsNumber = values.web_proxy_iframe_height_offset;

    form_el.elements.enable_transfer_changes.addEventListener("input", changedEnableTransferChanges);
    changedEnableTransferChanges();

    initEntriesForm("api_proxy_map", entries_template_el, ["target_key", "url"], values, form_el);
    initEntriesForm("web_proxy_map", entries_template_el, ["iframe_url", "menu_icon_url", "menu_item", "menu_title", "page_title", "rewrite_url", "short_title", "target_key", "view_title", "visible_public_menu_item"], values, form_el, (entry_el) => {
        const menu_icon_url_el = entry_el.querySelector("[data-entry-menu_icon_url]");
        const menu_item_el = entry_el.querySelector("[data-entry-menu_item]");
        const menu_title_el = entry_el.querySelector("[data-entry-menu_title]");
        const visible_public_menu_item_el = entry_el.querySelector("[data-entry-visible_public_menu_item]");
        const visible_public_menu_item_info_el = entry_el.querySelector("[data-entry-visible-public-menu-item-info]");

        menu_item_el.addEventListener("input", changedMenuItem);
        changedMenuItem();

        visible_public_menu_item_el.addEventListener("input", changedVisiblePublicMenuItem);
        changedVisiblePublicMenuItem();

        function changedMenuItem() {
            const old_disabled = menu_title_el.disabled;

            menu_title_el.disabled = menu_icon_url_el.disabled = visible_public_menu_item_el.disabled = !menu_item_el.checked;

            if (old_disabled !== menu_title_el.disabled) {
                menu_title_el.value = menu_icon_url_el.value = "";
                visible_public_menu_item_el.checked = false;
            }

            changedVisiblePublicMenuItem();
        }

        function changedVisiblePublicMenuItem() {
            visible_public_menu_item_info_el.innerText = menu_item_el.checked && !visible_public_menu_item_el.checked ? "Note: Your iframe url is still accessible for public nevertheless you disabled it" : "";
        }
    });

    initEntriesForm("flux_ilias_rest_object_api_proxy_maps", entries_template_el, ["key", "url"], values, form_el);
    initEntriesForm("flux_ilias_rest_object_web_proxy_maps", entries_template_el, ["icon_url", "iframe_url", "key", "page_title", "pass_ref_id", "rewrite_url", "short_title", "view_title"], values, form_el);

    initScheduleForm("purge_changes_schedule", schedule_template_el, values, form_el);
    initScheduleForm("transfer_changes_schedule", schedule_template_el, values, form_el);

    const web_proxy_iframe_height_el = form_el.querySelector("[data-entry-web-proxy-iframe-height]");
    form_el.elements.web_proxy_iframe_height_offset.addEventListener("input", changedWebProxyIframeHeightOffset);
    changedWebProxyIframeHeightOffset();

    form_el.querySelector("[data-store]").addEventListener("click", action);

    return form_el;

    function changedEnableTransferChanges() {
        form_el.elements.transfer_changes_post_url.required = form_el.elements.enable_transfer_changes.checked;
    }

    function changedWebProxyIframeHeightOffset() {
        web_proxy_iframe_height_el.innerText = `calc(100vh - ${form_el.elements.web_proxy_iframe_height_offset.valueAsNumber}px)`;
    }
}
