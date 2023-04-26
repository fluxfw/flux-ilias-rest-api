const constants = await (await fetch("/flux-ilias-rest-api/constants")).json();

await (await fetch("/flux-ilias-rest-api/organisational-units")).json();

const time = Date.now();
const organisational_unit = await (await fetch(`/flux-ilias-rest-api/organisational-unit/create/to-ref-id/${constants.organisational_unit_root_object_ref_id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        title: `Organisational unit ${time}`
    })
})).json();

await (await fetch(`/flux-ilias-rest-api/organisational-unit/by-id/${organisational_unit.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/organisational-unit/by-id/${organisational_unit.id}/update`, {
    method: "PATCH",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        description: "Some description of the organisational unit"
    })
})).json();
