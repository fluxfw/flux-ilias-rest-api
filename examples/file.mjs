await (await fetch("?/files")).json();

const time = Date.now();
const file = await (await fetch(`?/file/create/to-ref-id/${root.ref_id}`, {
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
    document.body.appendChild(title);
    const checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.title = "Replace";
    document.body.appendChild(checkbox);
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
            console.log(await (await fetch(`?/file/by-id/${file.id}/upload`, {
                method: "POST",
                headers: {
                    "X-Http-Method-Override": "PUT"
                },
                body: data
            })).json());
        });
        selector.click();
    });
    document.body.appendChild(button);
}

await (await fetch(`?/file/by-id/${file.id}`)).json();

await (await fetch(`?/file/by-id/${file.id}/update`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        description: "Some description of the file"
    })
})).json();
