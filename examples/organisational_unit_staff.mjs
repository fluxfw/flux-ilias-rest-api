const position = await (await fetch("?/organisational-unit-position/by-core-identifier/employee")).json();

await (await fetch(`?/organisational-unit-staff&organisational_unit_id=${organisational_unit.id}`)).json();

await (await fetch(`?/organisational-unit/by-id/${organisational_unit.id}/add-staff/by-id/${user.id}/${position.id}`, {
    method: "POST"
})).json();

await (await fetch(`?/organisational-unit/by-id/${organisational_unit.id}/remove-staff/by-id/${user.id}/${position.id}`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "DELETE"
    }
})).json();
