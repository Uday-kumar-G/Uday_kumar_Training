$(document).ready(function () {
	// Initially disable button
	$("#save").prop("disabled", true);
	// Enable / disable button while typing
	$("#post").on("input", function () {
		let post = $(this).val().trim();
		if (post === "") {
			$("#save")
				.prop("disabled", true)
				.css({
					"background-color": "gray",
					"opacity": "0.5",
					"cursor": "not-allowed"
				});
		}
		else {
			$("#save")
				.prop("disabled", false)
				.css({
					"background-color": "green",
					"opacity": "1",
					"cursor": "pointer"
				});
		}
	});
	// Post button
	$("#save").on("click", function (event) {
		event.preventDefault();
		let post = $("#post").val().trim();
		if (post === "") {
			toastr.warning(
				"Please write something before posting.",
				"Warning"
			);
			return;
		}
		$.ajax({
			url: "Add_post.php",
			type: "POST",
			data: {
				post: post
			},
			success: function (response) {
				console.log("Server response:", response);
				if (response.trim() === "1") {
					toastr.success("Post created successfully!", "Success");
					// Current date
					let today = new Date();
					let day = String(today.getDate()).padStart(2, "0");
					let month = String(today.getMonth() + 1).padStart(2, "0");
					let year = today.getFullYear();
					let formattedDate = day + "." + month + "." + year;
					// Create row
					let newRow = $("<tr>");
					newRow.append(
						$("<td>").text(formattedDate)
					);
					newRow.append(
						$("<td>").text(post)
					);
					// Remove no-post row if available
					$("#no-post-row").remove();
					// Add new post under table heading
					$("#my-table tr:first").after(newRow);
					// Clear textarea
					$("#post").val("");
					$("#post").val("");
	$("#save")
		.prop("disabled", true)
		.css({
			"background-color": "gray",
			"opacity": "0.5",
			"cursor": "not-allowed"
		});
					}
					else {
						toastr.error(
							"Server did not return success.",
							"Error"
						);
						console.log(
							"Unexpected PHP response:",
							response
						);
					}
				},
				error: function (xhr, status, error) {
					console.log("AJAX error:", error);
					toastr.error(
						"Unable to connect to the server.",
						"Error"
					);
				}
			});
		});
});