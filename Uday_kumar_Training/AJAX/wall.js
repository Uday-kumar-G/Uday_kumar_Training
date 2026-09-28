$("#save").click(function () {
	let post = $("#post").val();
	//FIRST CHECKING HERE WHETHER THE POST IS EMPTY OR NOT.
	if (post.length!=0 && post.trim()!="") {

		$.ajax({
			url: "add_post.php",
			type: "POST",
			data: {
				post: post
			},
			success: function(response) {
					alert("post added successfully");
					$("#message").html(response);
					$("#post").val("");
				
			},
			error: function() {
				$("#message").html("Something went wrong");
			}
		});
	}
	else{
		alert("please write a content to post");
	}
});
