document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("table-search");

    if (!input) return;

    let timeout;

    input.addEventListener("input", function () {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            const url = new URL(window.location.href);

            url.searchParams.set("search", this.value);

            fetch(url, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
            })
                .then((res) => res.text())
                .then((html) => {
                    document.getElementById("table-container").innerHTML = html;
                });
        }, 300);
    });
});
