const TYPES = {
    daily: "Daily",
    every_x_minutes: "Every x minutes",
    every_x_hours: "Every x hours",
    every_x_days: "Every x days",
    monthly: "Monthly",
    quarterly: "Quarterly",
    weekly: "Weekly",
    yearly: "Yearly"
};

export function initScheduleForm(name, schedule_template_el, values, form_el) {
    const value = values[name];

    const div_el = schedule_template_el.content.firstElementChild.cloneNode(true);

    const type_el = div_el.querySelector("[data-type]");
    type_el.name = `${name}_${type_el.name}`;
    for (const type of value.types) {
        const option_el = document.createElement("option");
        option_el.value = type;
        option_el.text = TYPES[type] ?? type;
        type_el.options.add(option_el);
    }
    type_el.value = value.type;

    const interval_el = div_el.querySelector("[data-interval]");
    interval_el.name = `${name}_${interval_el.name}`;
    if (values.interval !== null) {
        interval_el.valueAsNumber = value.interval;
    }
    const interval_field_el = interval_el.closest(".form_field");

    type_el.addEventListener("input", changedType);
    changedType();

    form_el.querySelector(`[data-${name}]`).replaceWith(div_el);

    function changedType() {
        const old_display = interval_field_el.style.display;

        interval_field_el.style.display = value.interval_types.includes(type_el.value) ? "" : "none";

        interval_el.required = interval_field_el.style.display !== "none";

        if (old_display !== interval_field_el.style.display) {
            interval_el.value = "";
        }
    }
}
