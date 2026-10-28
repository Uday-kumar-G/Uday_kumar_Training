
document.addEventListener("DOMContentLoaded", function () {
	var form = document.getElementById("createPostForm");
	var postText = document.getElementById("post_text");
	var postButton = document.getElementById("post_button");

	// Show the success message after the page reloads.
	var savedMessage = sessionStorage.getItem("postSuccessMessage");

	if (savedMessage) {
		sessionStorage.removeItem("postSuccessMessage");

		var toast = document.createElement("div");
		toast.className = "post-toast";
		toast.textContent = savedMessage;

		document.body.appendChild(toast);

		setTimeout(function () {
			toast.classList.add("hide");

			setTimeout(function () {
				toast.remove();
			}, 300);
		}, 3000);
	}
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
			var formData = new FormData(form);
			// Ensure PHP receives the create_post field.
			formData.set("create_post", "1");
			var response = await fetch(form.action, {
				method: "POST",
				body: formData,
				headers: {
					"X-Requested-With": "XMLHttpRequest",
					"Accept": "application/json"
				}
			});
			var data = await response.json();
			if (!response.ok || !data.success) {
				throw new Error(data.message || "Could not publish the post.");
			}
			// message.textContent = data.message;



			// // Step 1: Get the posts container
			// var postsContainer = document.querySelector(".your_posts");

			postText.value = "";
			message.textContent = "";

			// Step 1: Close the modal immediately after successful post creation
			var modalElement = document.getElementById("centerModal");

			if (modalElement && window.bootstrap) {
				var modal = bootstrap.Modal.getOrCreateInstance(modalElement);
				modal.hide();
			}

			// Step 2: Get the posts container
			var postsContainer = document.querySelector("#all_posts");

			if (!postsContainer) {
				console.error("Posts container not found.");
				return;
			}

			if (!postsContainer) {
				throw new Error("Posts container not found.");
			}

			// Step 2: Prepare the AJAX URL
			var postsUrl = new URL("my_posts.php", window.location.href);

			// Get the profile ID from the form action
			var profileUrl = new URL(form.action, window.location.href);

			var profileId = profileUrl.searchParams.get("id");

			if (profileId) {
				postsUrl.searchParams.set("id", profileId);
			}

			// Request only the latest post
			postsUrl.searchParams.set("latest", "1");

			// Step 3: Fetch the latest post from PHP
			var postResponse = await fetch(postsUrl, {
				method: "GET",
				headers: {
					"X-Requested-With": "XMLHttpRequest",
					"Accept": "text/html"
				}
			});

			if (!postResponse.ok) {
				throw new Error("Unable to fetch the new post.");
			}

			// Step 4: Get the HTML returned by PHP
			var postHTML = await postResponse.text();

			if (!postHTML.trim()) {
				throw new Error("New post HTML is empty.");
			}

			// Step 5: Remove the empty posts message if present
			var emptyMessage = postsContainer.querySelector("p");

			if (emptyMessage && emptyMessage.textContent.includes("You haven't posted")) {
				emptyMessage.remove();
			}

			// Step 6: Insert the new post at the top
			postsContainer.insertAdjacentHTML("afterbegin", postHTML);


			// Step 7: Close modal using the same close button
			var modalElement = document.getElementById("centerModal");

			if (modalElement) {
				var closeButton = modalElement.querySelector('[data-bs-dismiss="modal"]');

				if (closeButton) {
					closeButton.click();
				}
			}
			// Step 8: Display success toast
			var toast = document.createElement("div");

			toast.className = "post-toast";
			toast.textContent = data.message || "Post added successfully.";

			document.body.appendChild(toast);

			setTimeout(function () {
				toast.classList.add("hide");

				setTimeout(function () {
					toast.remove();
				}, 300);

			}, 3000);

		} catch (error) {
			message.textContent = error.message || "Something went wrong.";
		} finally {
			checkPostText();
		}
	});
});