const time = Date.now();

await (await fetch(`?/changes&from=${(time - (60 * 60 * 24 * 1000)) / 1000}&to=${time / 1000}`)).json();
