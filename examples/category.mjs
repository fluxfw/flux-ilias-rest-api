await (await fetch("?/categories")).json();

const time = Date.now();
const category = await (await fetch("?/category/create/to-ref-id/1", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        title: `Category ${time}`
    })
})).json();

await (await fetch(`?/category/by-id/${category.id}`)).json();

await (await fetch(`?/category/by-id/${category.id}/update`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        description: "Some description of the category"
    })
})).json();
