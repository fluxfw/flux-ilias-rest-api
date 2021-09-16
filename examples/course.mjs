const time = Date.now();
const course = await (await fetch("?/course/create/to-ref-id/1", {
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

await (await fetch(`?/course/by-id/${course.id}`)).json();

await (await fetch(`?/course/by-id/${course.id}/update`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        description: "Some description of the course",
        online: true
    })
})).json();
