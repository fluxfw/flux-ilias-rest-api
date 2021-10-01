await (await fetch("?/organisational-unit-positions")).json();

const time = Date.now();
const organisational_unit_position = await (await fetch("?/organisational-unit-position/create", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        authorities: [
            {
                over_position_id: (await (await fetch("?/organisational-unit-position/by-core-identifier/employee")).json()).id,
                scope_in: "same_and_subsequent"
            }
        ],
        title: `Organisational unit position ${time}`
    })
})).json();

await (await fetch(`?/organisational-unit-position/by-id/${organisational_unit_position.id}`)).json();

await (await fetch(`?/organisational-unit-position/by-id/${organisational_unit_position.id}/update`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        description: "Some description of the organisational unit position"
    })
})).json();

await (await fetch(`?/organisational-unit-position/by-id/${organisational_unit_position.id}/delete`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "DELETE"
    }
})).json();
