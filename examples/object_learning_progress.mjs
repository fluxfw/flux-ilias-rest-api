await (await fetch(`/flux-ilias-rest-api/object/learning-progress?object_id=${object.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/object/learning-progress?user_id=${user.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/object/by-id/${object.id}/update-learning-progress/by-id/${user.id}/completed`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "PATCH"
    }
})).json();
