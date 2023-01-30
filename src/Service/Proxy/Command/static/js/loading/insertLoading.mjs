export function insertLoading(parent_el) {
    const loading_el = document.createElement("div");
    loading_el.classList.add("loading");
    parent_el.appendChild(loading_el);
    return loading_el;
}
