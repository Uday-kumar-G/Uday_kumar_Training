$(document).ready(function () {
	var items = $(".left_nav_scroll > .left_navbars");
	var expanded = false;
	// Initially show only first 11 items
	items.slice(11).hide();
	$("#toggleSidebar").off("click");
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
	// Profile card toggle
	$(document).ready(function () {
		var $profileCard = $("#profile_card");

		$profileCard.hide();

		$("#account_image").on("click", function (event) {
			event.stopPropagation();
			$profileCard.toggle();
		});

		$profileCard.on("click", function (event) {
			event.stopPropagation();
		});

		$(document).on("click", function () {
			$profileCard.hide();
		});
	});
	// for backgorund img for the my account story
	$("#my-story").css({
		"background-image": "url('../images/<?php echo $profil; ?>')"
	});
	
	
});