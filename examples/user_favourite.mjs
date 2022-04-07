await (await fetch(`/flux-ilias-rest-api/user-favourites?user_id=${user.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/user-favourites?object_id=${object.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/user/by-id/${user.id}/add-favourite/by-id/${object.id}`, {
    method: "POST"
})).json();

await (await fetch(`/flux-ilias-rest-api/user/by-id/${user.id}/remove-favourite/by-id/${object.id}`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "DELETE"
    }
})).json();
