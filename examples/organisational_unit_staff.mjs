await (await fetch(`?/organisational-unit-staff&organisational_unit_id=${organisational_unit.id}`)).json();

await (await fetch(`?/organisational-unit/by-id/${organisational_unit.id}/add-staff/by-id/${user.id}/1`, {
    method: "POST"
})).json();

await (await fetch(`?/organisational-unit/by-id/${organisational_unit.id}/remove-staff/by-id/${user.id}/1`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "DELETE"
    }
})).json();
