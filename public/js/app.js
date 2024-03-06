async function getData(url) {
    // Construct a unique cache key based on the URL
    const cacheKey = `cache-${encodeURIComponent(url)}`;

    // Try to get cached data from localStorage
    const cachedData = localStorage.getItem(cacheKey);

    if (cachedData) {
        const { data, expiry } = JSON.parse(cachedData);

        // Check if the cached data is still valid based on an expiry time
        const now = new Date();

        if (now.getTime() < expiry) {
            // Cached data is still valid, return it instead of fetching
            return data;
        } else {
            // Cached data has expired, remove it from localStorage
            localStorage.removeItem(cacheKey);
        }
    }

    // Cached data is not available or has expired, fetch new data
    const response = await fetch(url);
    const data = await response.json();

    // Set a new expiry time for the cached data (e.g., 1 minute from now)
    const expiry = new Date().getTime() + (60 * 1000); // 1 minute in milliseconds

    // Store the fetched data in localStorage with the expiry time
    localStorage.setItem(cacheKey, JSON.stringify({ data, expiry }));

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
