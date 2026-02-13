import axios from "axios";

document.addEventListener("click", function (e) {
    // LIKE
    if (e.target.closest(".like-btn")) {
        e.preventDefault();

        let btn = e.target.closest(".like-btn");
        let url = btn.dataset.url;
        let count = btn.querySelector(".like-count");

        axios.post(url).then((res) => {
            count.textContent = res.data.likes_count;
            btn.classList.toggle("liked", res.data.liked);
        });
    }

    // ADD FRIEND
    if (e.target.closest(".add-friend-btn")) {
        e.preventDefault();

        let btn = e.target.closest(".add-friend-btn");
        let box = btn.closest(".friend-action");
        let url = btn.dataset.url;

        axios.post(url).then(() => {
            box.innerHTML = `
                <span class="text-gray-500 font-semibold">
                    Pending
                </span>
            `;
        });
    }

    // ACCEPT FRIEND
    if (e.target.closest(".accept-friend-btn")) {
        e.preventDefault();

        let btn = e.target.closest(".accept-friend-btn");
        let box = btn.closest(".friend-action");
        let url = btn.dataset.url;

        axios.post(url).then(() => {
            box.innerHTML = `
                <span class="text-green-500 font-semibold">
                    Friend
                </span>
            `;
        });
    }

    // REJECT FRIEND
    if (e.target.closest(".reject-friend-btn")) {
        e.preventDefault();

        let btn = e.target.closest(".reject-friend-btn");
        let box = btn.closest(".friend-action");
        let url = btn.dataset.url;

        axios.post(url).then(() => {
            box.innerHTML = `
                <span class="text-red-500 font-semibold">
                    Rejected
                </span>
            `;
        });
    }
});

document.addEventListener("submit", function (e) {
    if (!e.target.classList.contains("comment-form")) return;

    e.preventDefault();

    const form = e.target;
    const url = form.dataset.url;
    const formData = new FormData(form);
    const commentsList = form
        .closest("[data-post-id]")
        .querySelector(".comment-list");

    fetch(url, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": formData.get("_token"),
            Accept: "application/json",
        },
        body: formData,
    })
        .then((res) => res.json())
        .then((data) => {
            const commentHtml = `
            <p>
                <a href="${data.user.profile_url}">
                    <strong>${data.user.name}:</strong>
                </a>
                ${data.content}
            </p>
        `;

            commentsList.insertAdjacentHTML("beforeend", commentHtml);
            form.reset();
        })
        .catch((err) => {
            console.error(err);
            alert("Failed to add comment");
        });
});
