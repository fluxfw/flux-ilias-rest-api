const constants = await (await fetch("/flux-ilias-rest-api/constants")).json();

await (await fetch("/flux-ilias-rest-api/objects")).json();

await (await fetch("/flux-ilias-rest-api/objects?types=category")).json();

const time = Date.now();
const object = await (await fetch(`/flux-ilias-rest-api/object/create/category/to-ref-id/${constants.root_object_ref_id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        title: `Object ${time}`
    })
})).json();

await (await fetch(`/flux-ilias-rest-api/object/by-id/${object.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/object/children/by-ref-id/${constants.root_object_ref_id}`)).json();

await (await fetch(`/flux-ilias-rest-api/object/path/by-ref-id/${object.ref_id}`)).json();

await (await fetch(`/flux-ilias-rest-api/object/by-id/${object.id}/update`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        description: "Some description of the category"
    })
})).json();

const cloned_object = await (await fetch(`/flux-ilias-rest-api/object/by-id/${object.id}/clone/to-ref-id/${constants.root_object_ref_id}`, {
    method: "POST"
})).json();

const moved_object = await (await fetch(`/flux-ilias-rest-api/object/by-id/${cloned_object.id}/move/to-id/${object.id}`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "PUT"
    }
})).json();

const linked_object = await (await fetch(`/flux-ilias-rest-api/object/by-id/${cloned_object.id}/link/to-ref-id/${constants.root_object_ref_id}`, {
    method: "POST"
})).json();

await (await fetch(`/flux-ilias-rest-api/object/by-id/${object.id}/delete`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "DELETE"
    }
})).json();
