$(document).ready(function () {
	let items = $(".left_nav_scroll > .left_navbars");
	let expanded = false;
	// Initially show only first 11 items
	items.slice(11).hide();
	$("#toggleSidebar").on("click", function () {
		expanded = !expanded;
		if (expanded) {
			items.slice(8).show();
			$("#toggleText").text("See less");
			$("#toggleIcon").html('<svg viewBox="0 0 20 20" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--primary-icon);"><path d="M8.586 7.5a2 2 0 0 1 2.828 0l2.543 2.543a1 1 0 0 1-1.414 1.414L10 8.914l-2.543 2.543a1 1 0 1 1-1.414-1.414L8.586 7.5z"></path></svg>');
		} 
		else {
			items.slice(8).hide();
			$("#toggleText").text("See more");
			$("#toggleIcon").html('<svg viewBox="0 0 20 20" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--primary-icon);"><path d="M8.586 12.5a2 2 0 0 0 2.828 0l2.543-2.543a1 1 0 0 0-1.414-1.414L10 11.086 7.457 8.543a1 1 0 0 0-1.414 1.414L8.586 12.5z"></path></svg>');
		}
	});
	// profile card
	$("#profile_card").hide();
	let is_clicked=false
	$("#account_image").on("click", function(){
		is_clicked=!is_clicked;
		if(is_clicked){
			$("#profile_card").show();
		}
		else{
				$("#profile_card").hide();
		}
	});
	// for backgorund img for the my account story
	$("#my-story").css({
		"background-image": "url('../images/<?php echo $profil; ?>')"
	});
	
		$.ajax({
		url: "fetch_posts.php",
		type: "GET",
		dataType: "json",

		success: function (posts) {

			$("#all_posts").empty();

			if (posts.length === 0) {
				$("#all_posts").text("No posts available");
				return;
			}
			posts.forEach(function (post) {
				let card = $("<div>", {
					class: "post center-elements"
				});
				let top = $("<div>", {
					class: "post_top_bar"
				});
				let profile = $("<img>", {
					class: "post_profile_image",
					src: "../images/" + post.PROFILE_PICTURE,
					alt: "Profile"
				});
				let details = $("<div>", {
					class: "posted_person_name"
				});
				details.append(
					$("<strong>").text(post.NAME),
					$("<p>").text(post.POSTING_DATE)
				);
				top.append(profile, details);
				let message = $("<div>", {
					class: "post_msg"
				}).text(post.POST);
				let bottom = $("<div>", {
					class: "post_bottom"
				});
				bottom.append(
					$("<button>", {
						class: "like-btn",
						text: "👍 Like"
					}),
					$("<button>", {
						text: "💬 Comment"
					}),
					$("<button>", {
						text: "↗ Share"
					})
				);
				card.append(top, message, bottom);
				$("#all_posts").append(card);
			});
		},
		error: function (xhr) {
			console.log(xhr.responseText);
			$("#all_posts").text("Unable to load posts");
		}
	});
});