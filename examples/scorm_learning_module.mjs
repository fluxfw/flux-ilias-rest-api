await (await fetch("?/scorm-learning-modules")).json();

const time = Date.now();
const scorm_learning_module = await (await fetch("?/scorm-learning-module/create/to-ref-id/1", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        title: `Scorm learning module ${time}`,
        type: "scorm_2004"
    })
})).json();

{
    const button = document.createElement("button");
    button.type = "button";
    button.innerText = "Upload scorm learning module";
    button.addEventListener("click", () => {
        const selector = document.createElement("input");
        selector.type = "file";
        selector.addEventListener("change", async () => {
            const data = new FormData();
            data.set("file", selector.files[0]);
            console.log(await (await fetch(`?/scorm-learning-module/by-id/${scorm_learning_module.id}/upload`, {
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

await (await fetch(`?/scorm-learning-module/by-id/${scorm_learning_module.id}`)).json();

await (await fetch(`?/scorm-learning-module/by-id/${scorm_learning_module.id}/update`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        description: "Some description of the scorm learning module"
    })
})).json();
