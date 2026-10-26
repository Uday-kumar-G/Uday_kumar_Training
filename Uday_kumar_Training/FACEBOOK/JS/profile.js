$(document).ready(function () {
	// Store the main content elements
	let allContent = $(
		".first-left, .second-left, .right-post, .your_posts"
	);
	// Initially hide Friends and Photos
	$("#friendz, #photoz, #aboutz").hide();
	// ALL TAB
	$("#all-tab").on("click", function () {
		allContent.show();
		$("#friendz, #photoz, #aboutz").hide();
	});
	// FRIENDS TAB
	$("#friends-tab").on("click", function () {
		allContent.hide();
		$("#aboutz").hide()
		$("#photoz").hide();
		$(".posts_div").hide();
		$("#friendz").show();
	});
	// PHOTOS TAB
	$("#photos-tab, #see_photos").on("click", function () {
		allContent.hide();
		$("#aboutz").hide()
		$("#friendz").hide();
		$(".posts_div").hide();
		$("#photoz").show();
		$("#Photos_title").text("Photos")
		$(".change-tab-name").text("'s Photos")
	});
	// REELS TAB
	$("#reels-tab").on("click", function () {
		allContent.hide();
		$("#aboutz").hide()
		$("#friendz").hide();
		$(".posts_div").hide();
		$("#photoz").show();
		$("#Photos_title").text("Reels")
		$(".change-tab-name").text("'s Reels")
	})
	// ABOUT TAB
	$("#about-tab").on("click",function (){
		allContent.hide();
		$("#friendz").hide();
		$("#photoz").hide();
		$(".posts_div").hide();
		$("#aboutz").show();
	})
});