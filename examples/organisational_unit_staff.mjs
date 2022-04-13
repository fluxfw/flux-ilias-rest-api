const organisational_unit_position = await (await fetch("/flux-ilias-rest-api/organisational-unit-position/by-core-identifier/employee")).json();

await (await fetch(`/flux-ilias-rest-api/organisational-unit-staff?organisational_unit_id=${organisational_unit.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/organisational-unit-staff?user_id=${user.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/organisational-unit-staff?position_id=${organisational_unit_position.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/organisational-unit/by-id/${organisational_unit.id}/add-staff/by-id/${user.id}/${organisational_unit_position.id}`, {
    method: "POST"
})).json();

await (await fetch(`/flux-ilias-rest-api/organisational-unit/by-id/${organisational_unit.id}/remove-staff/by-id/${user.id}/${organisational_unit_position.id}`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "DELETE"
    }
})).json();
