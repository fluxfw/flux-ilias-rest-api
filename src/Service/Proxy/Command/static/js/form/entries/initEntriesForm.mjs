export function initEntriesForm(name, entries_template_el, keys, values, form_el, add_action = null) {
    const entries = values[name];

    const placeholder_el = form_el.querySelector(`[data-${name}]`);

    const entry_template_el = placeholder_el.querySelector("template");

    const div_el = entries_template_el.content.firstElementChild.cloneNode(true);

    const entries_el = div_el.querySelector("[data-entries]");

    for (const entry of entries) {
        addEntry(entry, false);
    }

    div_el.querySelector("[data-add-entry]").addEventListener("click", () => {
        addEntry();
    });

    updateButtons();

    placeholder_el.replaceWith(div_el);

    function addEntry(entry, update_buttons = true) {
        const entry_el = entry_template_el.content.firstElementChild.cloneNode(true);

        for (const key of keys) {
            const input_el = entry_el.querySelector(`[data-entry-${key}]`);

            input_el.name = `${name}_${key}`;

            const value = entry?.[key] ?? null;
            if (value !== null) {
                switch (input_el.type) {
                    case "checkbox":
                        input_el.checked = value;
                        break;

                    case "number":
                        input_el.valueAsNumber = value;
                        break;

                    default:
                        input_el.value = value;
                        break;
                }
            }
        }

        const move_entry_up_el = entry_el.querySelector("[data-move-entry-up]");
        if (move_entry_up_el !== null) {
            move_entry_up_el.addEventListener("click", () => {
                moveEntryUp(entry_el);
            });
        }

        const move_entry_down_el = entry_el.querySelector("[data-move-entry-down]");
        if (move_entry_down_el !== null) {
            move_entry_down_el.addEventListener("click", () => {
                moveEntryDown(entry_el);
            });
        }

        const remove_entry_el = entry_el.querySelector("[data-remove-entry]");
        if (remove_entry_el !== null) {
            remove_entry_el.addEventListener("click", () => {
                removeEntry(entry_el);
            });
        }

        entries_el.appendChild(entry_el);

        if (update_buttons) {
            updateButtons();
        }

        if (add_action !== null) {
            add_action(entry_el);
        }
    }

    function moveEntryUp(entry_el) {
        entry_el.previousElementSibling?.insertAdjacentElement("beforebegin", entry_el);
        updateButtons();
    }

    function moveEntryDown(entry_el) {
        entry_el.nextElementSibling?.insertAdjacentElement("afterend", entry_el);
        updateButtons();
    }

    function removeEntry(entry_el) {
        entry_el.remove();
        updateButtons();
    }

    function updateButtons() {
        for (const entry_el of entries_el.children) {
            const move_entry_up_el = entry_el.querySelector("[data-move-entry-up]");
            if (move_entry_up_el !== null) {
                move_entry_up_el.disabled = entry_el.previousElementSibling === null;
            }

            const move_entry_down_el = entry_el.querySelector("[data-move-entry-down]");
            if (move_entry_down_el !== null) {
                move_entry_down_el.disabled = entry_el.nextElementSibling === null;
            }
        }
    }
}
