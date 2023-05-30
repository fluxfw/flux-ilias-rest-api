export function getScheduleFormValue(name, form_el) {
    return {
        type: form_el.elements[`${name}_type`].value,
        interval: form_el.elements[`${name}_interval`].valueAsNumber
    };
}
