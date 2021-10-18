await (await fetch("?/groups")).json();

const time = Date.now();
const group = await (await fetch(`?/group/create/to-ref-id/${root.ref_id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        title: `Group ${time}`
    })
})).json();

await (await fetch(`?/group/by-id/${group.id}`)).json();

await (await fetch(`?/group/by-id/${group.id}/update`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        description: "Some description of the group"
    })
})).json();
