await (await fetch(`/flux-ilias-rest-api/user-roles?user_id=${user.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/user-roles?role_id=${role.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/user/by-id/${user.id}/add-role/by-id/${role.id}`, {
    method: "POST"
})).json();

await (await fetch(`/flux-ilias-rest-api/user/by-id/${user.id}/remove-role/by-id/${role.id}`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "DELETE"
    }
})).json();
