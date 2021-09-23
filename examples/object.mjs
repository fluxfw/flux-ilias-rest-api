const root = await (await fetch("?/object/root")).json();

await (await fetch("?/objects/category")).json();

const time = Date.now();
const object = await (await fetch(`?/object/create/category/to-ref-id/${root.ref_id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        title: `Object ${time}`
    })
})).json();

await (await fetch(`?/object/by-id/${object.id}`)).json();

await (await fetch(`?/object/children/by-ref-id/${root.ref_id}`)).json();

await (await fetch(`?/object/by-id/${object.id}/update`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        description: "Some description of the category"
    })
})).json();

const cloned_object = await (await fetch(`?/object/by-id/${object.id}/clone/to-ref-id/${root.ref_id}`, {
    method: "POST"
})).json();

const moved_object = await (await fetch(`?/object/by-id/${cloned_object.id}/move/to-id/${object.id}`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "PUT"
    }
})).json();

await (await fetch(`?/object/by-id/${object.id}/delete`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "DELETE"
    }
})).json();
