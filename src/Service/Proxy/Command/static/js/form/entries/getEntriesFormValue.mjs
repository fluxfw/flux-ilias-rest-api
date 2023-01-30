export function getEntriesFormValue(name, keys, form_el) {
    const entries = [];

    for (const input_el_ of form_el.querySelectorAll(`input[name=${name}_${keys[0]}]`)) {
        const entries_el = input_el_.closest(".form_field").parentElement;

        const entry = {};

        for (const key of keys) {
            const input_el = entries_el.querySelector(`input[name=${name}_${key}]`);

            let value;
            switch (input_el.type) {
                case "checkbox":
                    value = input_el.checked;
                    break;

                case "number":
                    value = input_el.valueAsNumber;
                    break;

                default:
                    value = input_el.value;
                    break;
            }
            entry[key] = value;
        }

        entries.push(entry);
    }

    return entries;
}
