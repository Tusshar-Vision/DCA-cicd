async function getData(url) {
    const response = await fetch(url);
    const data = await response.json();
    return data;
}

async function saveData(url, data) {
    try {
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        });
        const result = await response.json();
        return result;
    } catch (error) {
        console.error("Error:", error);
    }
}
