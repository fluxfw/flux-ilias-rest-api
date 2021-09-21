await (await fetch(`?/course/by-id/${course.id}/members`)).json();

await (await fetch(`?/course/by-id/${course.id}/member/add/by-id/${user.id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        member_role: true
    })
})).json();

await (await fetch(`?/course/by-id/${course.id}/member/by-id/${user.id}`)).json();

await (await fetch(`?/course/by-id/${course.id}/member/by-id/${user.id}/update`, {
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
await (await fetch(`?/course/by-id/${course.id}/member/by-id/${user.id}/update`, {
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

await (await fetch(`?/course/by-id/${course.id}/member/by-id/${user.id}/remove`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "DELETE"
    }
})).json();
