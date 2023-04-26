const constants = await (await fetch("/flux-ilias-rest-api/constants")).json();

await (await fetch("/flux-ilias-rest-api/groups")).json();

const time = Date.now();
const group = await (await fetch(`/flux-ilias-rest-api/group/create/to-ref-id/${constants.root_object_ref_id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        title: `Group ${time}`
    })
})).json();

await (await fetch(`/flux-ilias-rest-api/group/by-id/${group.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/group/by-id/${group.id}/update`, {
    method: "PATCH",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        description: "Some description of the group"
    })
})).json();
