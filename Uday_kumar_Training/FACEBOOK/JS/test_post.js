// const postText = document.getElementById("post_text");
// const postButton = document.getElementById("post_button");

// function checkPostText() {
// 	if (postText.value.trim().length < 1) {
// 		postButton.disabled = true;
// 	} else {
// 		postButton.disabled = false;
// 	}
// }

// // Check immediately when the page loads
// checkPostText();

// // Check whenever the user types or deletes text
// postText.addEventListener("input", checkPostText);


// $(document).ready(function () {
// 	$("#post_button").on("click", function(){
		
// 	})

// })

document.addEventListener("DOMContentLoaded", function () {
	const form = document.getElementById("createPostForm");
	const postText = document.getElementById("post_text");
	const postButton = document.getElementById("post_button");

	if (!form || !postText || !postButton) return;

	let message = document.getElementById("post-message");

	if (!message) {
		message = document.createElement("p");
		message.id = "post-message";
		message.setAttribute("role", "status");
		form.prepend(message);
	}

	function checkPostText() {
		postButton.disabled = postText.value.trim() === "";
	}

	checkPostText();
	postText.addEventListener("input", checkPostText);

	form.addEventListener("submit", async function (event) {
		event.preventDefault();

		if (postText.value.trim() === "") {
			message.textContent = "Please enter some text.";
			return;
		}

		postButton.disabled = true;
		message.textContent = "Publishing...";

		try {
			const formData = new FormData(form);

			// Ensure PHP receives the create_post field.
			formData.set("create_post", "1");

			const response = await fetch(form.action, {
				method: "POST",
				body: formData,
				headers: {
					"X-Requested-With": "XMLHttpRequest",
					"Accept": "application/json"
				}
			});

			const data = await response.json();

			if (!response.ok || !data.success) {
				throw new Error(data.message || "Could not publish the post.");
			}

			postText.value = "";
			message.textContent = data.message;

			const modalElement = document.getElementById("centerModal");
			if (modalElement && window.bootstrap) {
				const modal = bootstrap.Modal.getInstance(modalElement);
				if (modal) {
					modal.hide();
				}
				// Clean up any leftover modal backdrop.
				setTimeout(function () {
					document.querySelectorAll(".modal-backdrop").forEach(function (backdrop) {
						backdrop.remove();
					});

					document.body.classList.remove("modal-open");
					document.body.style.removeProperty("overflow");
					document.body.style.removeProperty("padding-right");
				}, 100);

			}

			// Update only the posts area, without refreshing the whole page.
			const postsSection = document.querySelector(".your_posts");

			if (postsSection) {
				const pageResponse = await fetch(window.location.href);

				if (pageResponse.ok) {
					const html = await pageResponse.text();
					const doc = new DOMParser().parseFromString(html, "text/html");
					const updatedSection = doc.querySelector(".your_posts");

					if (updatedSection) {
						postsSection.replaceWith(updatedSection);
					}
				}
			}
		} catch (error) {
			message.textContent = error.message || "Something went wrong.";
		} finally {
			checkPostText();
		}
	});
});
