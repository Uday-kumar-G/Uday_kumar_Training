$(document).ready(function () {
	// Store the main content elements
	var allContent = $(
		".first-left, .second-left, .right-post, .your_posts"
	);
	// Initially hide Friends and Photos
	$("#friendz, #photoz, #aboutz").hide();
	// ALL TAB
	$("#all-tab").off("click");
	$("#all-tab").on("click", function () {
		allContent.show();
		$("#friendz, #photoz, #aboutz").hide();
	});
	// FRIENDS TAB
	$("#friends-tab").off("click");
	$("#friends-tab").on("click", function () {
		allContent.hide();
		$("#aboutz").hide()
		$("#photoz").hide();
		$(".posts_div").hide();
		$("#friendz").show();
	});
	// ABOUT TAB
	$("#about-tab").off("click");
	$("#about-tab").on("click",function (){
		allContent.hide();
		$("#friendz").hide();
		$("#photoz").hide();
		$(".posts_div").hide();
		$("#aboutz").show();
	})
});