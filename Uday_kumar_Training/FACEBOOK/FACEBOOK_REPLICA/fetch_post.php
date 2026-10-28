<?php
	session_start();
	require_once "database.php";
	header("Content-Type: application/json");

	if (!isset($_SESSION["id"])) {
		http_response_code(401);
		echo json_encode(["error" => "Not logged in"]);
		exit();
	}

	$id = $_SESSION["id"];

	$post_sql = "SELECT 
					W.USER_ID, W.POST, W.POSTING_DATE,
					U.NAME, U.PROFILE_PICTURE
				FROM WALL W
				LEFT OUTER JOIN USER U ON W.USER_ID = U.USER_ID
				WHERE W.USER_ID IN (
					SELECT FRIEND_ID
					FROM FRIEND
					WHERE USER_ID = ?
				)
				ORDER BY W.POSTING_DATE DESC";

	$statement = $conn->prepare($post_sql);
	$statement->bind_param("i", $id);
	$statement->execute();

	$result = $statement->get_result();

	$posts = [];

	while ($row = $result->fetch_assoc()) {
		$posts[] = $row;
	}

	echo json_encode($posts);

	$statement->close();
	$conn->close();

?>