export function replaceWithNoneElement(el) {
    const none_el = document.createElement("em");
    none_el.innerText = "None";
    el.replaceWith(none_el);
}
