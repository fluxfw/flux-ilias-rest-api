await (await fetch(`/flux-ilias-rest-api/group/by-id/${group.id}/add-member/by-id/${user.id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        member_role: true
    })
})).json();

await (await fetch(`/flux-ilias-rest-api/group-members?group_id=${group.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/group-members?user_id=${user.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/group/by-id/${group.id}/update-member/by-id/${user.id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        administrator_role: true,
        member_role: false
    })
})).json();

await (await fetch(`/flux-ilias-rest-api/group/by-id/${group.id}/update-member/by-id/${user.id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        learning_progress: "completed"
    })
})).json();

await (await fetch(`/flux-ilias-rest-api/group/by-id/${group.id}/remove-member/by-id/${user.id}`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "DELETE"
    }
})).json();
