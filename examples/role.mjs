const object = await (await fetch("?/role/global-object")).json();

await (await fetch("?/roles")).json();

const time = Date.now();
const role = await (await fetch(`?/role/create/to-ref-id/${object.ref_id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        title: `Role ${time}`
    })
})).json();

await (await fetch(`?/role/by-id/${role.id}`)).json();

await (await fetch(`?/role/by-id/${role.id}/update`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        description: "Some description of the role"
    })
})).json();
