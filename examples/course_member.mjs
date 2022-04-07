await (await fetch(`/flux-ilias-rest-api/course/by-id/${course.id}/add-member/by-id/${user.id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        member_role: true
    })
})).json();

await (await fetch(`/flux-ilias-rest-api/course-members?course_id=${course.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/course-members?user_id=${user.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/course/by-id/${course.id}/update-member/by-id/${user.id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        administrator_role: false,
        member_role: false,
        tutor_role: true
    })
})).json();

await (await fetch(`/flux-ilias-rest-api/course/by-id/${course.id}/update-member/by-id/${user.id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        learning_progress: "completed",
        passed: true
    })
})).json();

await (await fetch(`/flux-ilias-rest-api/course/by-id/${course.id}/remove-member/by-id/${user.id}`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "DELETE"
    }
})).json();
