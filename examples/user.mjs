await (await fetch("/flux-ilias-rest-api/users")).json();

await (await fetch("/flux-ilias-rest-api/user/current/api")).json();

await (await fetch("/flux-ilias-rest-api/user/current/web")).json();

const time = Date.now();
const user = await (await fetch("/flux-ilias-rest-api/user/create", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        email: `user_${time}@${location.host}`,
        first_name: `User ${time}`,
        last_name: `User ${time}`,
        login: `user_${time}`,
        password: time
    })
})).json();

await (await fetch(`/flux-ilias-rest-api/user/by-id/${user.id}`)).json();

await (await fetch(`/flux-ilias-rest-api/user/by-id/${user.id}/update`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-Http-Method-Override": "PATCH"
    },
    body: JSON.stringify({
        first_name: "User",
        last_name: time,
        gender: "male"
    })
})).json();

{
    const button = document.createElement("button");
    button.type = "button";
    button.innerText = "Update avatar";
    button.addEventListener("click", () => {
        const selector = document.createElement("input");
        selector.type = "file";
        selector.addEventListener("change", async () => {
            const data = new FormData();
            data.set("file", selector.files[0]);
            console.log(await (await fetch(`/flux-ilias-rest-api/user/by-id/${user.id}/update/avatar`, {
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

{
    const image = document.createElement("img");
    image.src = `?/user/by-id/${user.id}/avatar`;
    document.body.appendChild(image);
}

await (await fetch(`/flux-ilias-rest-api/user/by-id/${user.id}/update/avatar`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "PUT"
    },
    body: new FormData()
})).json();
