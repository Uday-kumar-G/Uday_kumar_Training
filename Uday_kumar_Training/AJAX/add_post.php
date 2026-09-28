<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add post</title>
</head>
<body>
	<?php
		$conn = new mysqli(
		"localhost",
		"uday",
		"Root@1234",
		"FACEBOOK");
		$post = $_POST["post"];
		$sql = "INSERT INTO WALL
				(USER_ID, POSTING_DATE, POST)
				VALUES (1, NOW(), ?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $post);
		if ($stmt->execute() and strlen($post) > 0) {
			echo "Post created successfully";
			// set_time_limit(10000);
		}
		else {
			echo "Failed to create post";
		}
		$conn->close();
	?>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.14.2/jquery-ui.js"></script>
	<script src="wall.js"></script>
</body>
</html>