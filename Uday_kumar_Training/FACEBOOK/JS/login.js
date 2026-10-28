$(document).ready(function () {
	$("#log_button").off("click");
	$("#log_button").on("click", function () {
		$("#login_form")[0].requestSubmit();
});
	$("#login_password").off("click");
	$("#login_password").on('input', function() {
		if ($(this).val().length > 0) {
			if ($("#eye").attr("src") === "") {
				var inp = $("#login_password");
				if (inp[0].type === "password") {
					$("#eye")[0].src = "/images/eye/eye-password-see-view-svgrepo-com.svg"
				} else {
					$("#eye")[0].src = "/images/eye/eye-password-show-svgrepo-com.svg"
				}
				$("#eye").attr({
					"height": 24,
					"width": 24
				}).show();
			}
		} 
		else {
			$("#eye").attr("src", "");
			$("#eye").hide();
		}
	});
	$("#eye-icon").off("click");
	$("#eye-icon").on("click",function(){
		var inp = $("#login_password");
		if (inp[0].type === "password"){
			inp[0].type="text";
			$("#eye")[0].src = "/images/eye/eye-password-show-svgrepo-com.svg";
		}
		else{
			inp[0].type="password";
			$("#eye")[0].src = "/images/eye/eye-password-see-view-svgrepo-com.svg"
		}
	})
	
	$("#name_error, #password_error").each(function () {
	if ($(this).text().trim() === "") {
		$(this).hide();
	}
	$("#login_form").off("click");
	$("#login_form").on("submit", function (event) {

	var email = $("#login_name").val().trim();
	var password = $("#login_password").val();

	// Check email first
	if (email === "") {
		event.preventDefault();

		$(".name_input").addClass("error-container");
		$(".password_input").removeClass("error-container");

		$("#name_error")
			.text("The email address or mobile number you entered isn't connected to an account.")
			.show().css({
				"transform": "translateX(12px)"
			});

		$("#password_error").hide();
		return;
	}
	// Check password second
	if (password === "") {
		event.preventDefault();

		$(".name_input").removeClass("error-container");
		$(".password_input").addClass("error-container");
		$("#name_error").hide();
		$("#password_error")
			.text("The password you've entered is incorrect.")
			.show();
		return;
	}
	// Both fields filled: PHP checks the database
});
})});
// Reset errors only on a fresh GET page load
if (performance.getEntriesByType("navigation")[0]?.type !== "reload") {
	// No change needed here
}