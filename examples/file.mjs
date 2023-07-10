const constants = await (await fetch("/flux-ilias-rest-api/constants")).json();

await (await fetch("/flux-ilias-rest-api/files")).json();

const time = Date.now();
const file = await (await fetch(`/flux-ilias-rest-api/file/create/to-ref-id/${constants.root_object_ref_id}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        title: `File ${time}`
    })
})).json();

{
    const title = document.createElement("input");
    title.type = "text";
    title.placeholder = "Title";
    document.body.append(title);
    const checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.title = "Replace";
    document.body.append(checkbox);
    const button = document.createElement("button");
    button.type = "button";
    button.innerText = "Upload file";
    button.addEventListener("click", () => {
        const selector = document.createElement("input");
        selector.type = "file";
        selector.addEventListener("change", async () => {
            const data = new FormData();
            data.set("file", selector.files[0]);
            data.set("title", title.value);
            data.set("replace", checkbox.checked);
            console.log(await (await fetch(`/flux-ilias-rest-api/file/by-id/${file.id}/upload`, {
                method: "PUT",
                body: data
            })).json());
        });
        selector.click();
    });
    document.body.append(button);
}

await (await fetch(`/flux-ilias-rest-api/file/by-id/${file.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/file/by-id/${file.id}/update`, {
    method: "PATCH",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        description: "Some description of the file"
    })
})).json();
