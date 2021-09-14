await (await fetch("?/users")).json();

const time = Date.now();
const user = await (await fetch("?/user/create", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        "email": `user_${time}@${location.host}`,
        "first_name": `User ${time}`,
        "last_name": `User ${time}`,
        "login": `user_${time}`,
        "password": time
    })
})).json();

await (await fetch(`?/user/by-id/${user.id}`)).json();

await (await fetch(`?/user/by-id/${user.id}/update`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        "first_name": "User",
        "last_name": time,
        "gender": "male"
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
            console.log(await (await fetch(`?/user/by-id/${user.id}/update/avatar`, {
                method: "POST",
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

await (await fetch(`?/user/by-id/${user.id}/update/avatar`, {
    method: "POST",
    body: new FormData()
})).json();

await (await fetch(`?/user/by-id/${user.id}/delete`, {
    method: "POST",
    headers: {
        "X-Http-Method-Override": "DELETE"
    }
})).json();
