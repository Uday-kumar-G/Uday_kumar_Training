<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Friends page</title>
	<link rel="stylesheet" href="friends.css">
</head>
<body>
<div class="content">
	<?php
		$servername = "localhost";
		$username = "uday";
		$password = "Root@1234";
		$dbname = "FACEBOOK";
		// Connect to MySQL
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		if (!isset($_GET["id"])) {
			die("User ID not provided");
		}
		$id = $_GET["id"];
		$sql_user = "SELECT NAME FROM USER
					WHERE USER_ID = ?";
		$stmt = $conn->prepare($sql_user);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$user = $stmt->get_result()->fetch_assoc();
		echo "<h1 class='my-title'>Friends of <a href='profile.php?id=$id'>" . $user["NAME"] . "</a></h1>";
		echo "<h3 id='home-link'><a href='home.php?id=1'>HOME</a></h3>";
		$sql = "SELECT U.USER_ID, U.NAME
				FROM FRIEND F
				JOIN USER U
				ON F.FRIEND_ID = U.USER_ID
				WHERE F.USER_ID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$my_frnds = $stmt->get_result();
		while ($frnds = $my_frnds->fetch_assoc()) {
			echo '<a class="my-friend" id="friend-link" href="profile.php?id='
				. $frnds["USER_ID"]
				. '">'
				. $frnds["NAME"]
				. '</a><br>';
		}

	?>
	<?php
		if($my_frnds->num_rows>0){
			while( $frnds = $my_frnds->fetch_assoc()){
				echo '<a href="profile.php?id=' . $frnds["USER_ID"] . '">'
					. $frnds["NAME"] .'</a><br>';
			}
		}
	?>
</div>   
</body>
</html>





