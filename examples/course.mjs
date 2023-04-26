const constants = await (await fetch("/flux-ilias-rest-api/constants")).json();

await (await fetch("/flux-ilias-rest-api/courses")).json();

const time = Date.now();
const course = await (await fetch(`/flux-ilias-rest-api/course/create/to-ref-id/${constants.root_object_ref_id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        period_end: new Date("2021-05-31").getTime() / 1000,
        period_start: new Date("2021-05-01").getTime() / 1000,
        title: `Course ${time}`
    })
})).json();

await (await fetch(`/flux-ilias-rest-api/course/by-id/${course.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/course/by-id/${course.id}/update`, {
    method: "PATCH",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        description: "Some description of the course",
        online: true
    })
})).json();
