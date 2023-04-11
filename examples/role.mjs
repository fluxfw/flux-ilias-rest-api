const constants = await (await fetch("/flux-ilias-rest-api/constants")).json();

await (await fetch("/flux-ilias-rest-api/roles")).json();

const time = Date.now();
const role = await (await fetch(`/flux-ilias-rest-api/role/create/to-ref-id/${constants.roles_object_ref_id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        title: `Role ${time}`
    })
})).json();

await (await fetch(`/flux-ilias-rest-api/role/by-id/${role.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/role/by-id/${role.id}/update`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        description: "Some description of the role"
    })
})).json();
