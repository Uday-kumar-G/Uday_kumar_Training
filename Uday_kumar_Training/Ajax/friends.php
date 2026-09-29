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
		<!--  for making database conection  -->
		<?php
		// database connection
			require_once "database.php";
			if (!isset($_GET["id"])) {
				die("User ID not provided");
			}
			$id = $_GET["id"];
			$sqlUser = "SELECT 
							NAME 
						FROM 
							USER
						WHERE 
							USER_ID = ?";
			$dbStatements = $conn->prepare($sqlUser);
			$dbStatements->bind_param("i", $id);
			$dbStatements->execute();
			$user = $dbStatements->get_result()->fetch_assoc();
			echo "<h1 class='my-title'>Friends of <a href='profile.php?id=$id'>" . $user["NAME"] . "</a></h1>";
			echo "<h3 id='home-link'><a href='home.php?id=1'>HOME</a></h3>";
			$sql = "SELECT 
						U.USER_ID, U.NAME
					FROM 
						FRIEND F
					LEFT OUTER JOIN USER U ON F.FRIEND_ID = U.USER_ID
					WHERE 
						F.USER_ID = ?";
			$dbStatements = $conn->prepare($sql);
			$dbStatements->bind_param("i", $id);
			$dbStatements->execute();
			$myFrnds = $dbStatements->get_result();
			while ($frnds = $myFrnds->fetch_assoc()) {
				echo '<a class="my-friend" id="friend-link" href="friends_wall.php?id='
					. $frnds["USER_ID"]
					. '">'
					. $frnds["NAME"]
					. '</a><br>';
			}
		?>
		<?php
			if($myFrnds->num_rows>0){
				while( $frnds = $myFrnds->fetch_assoc()){
					echo '<a href="profile.php?id=' . $frnds["USER_ID"] . '">'
					. $frnds["NAME"] .
					'</a><br>';
				}
			}
		?>
	</div>	
</body>
</html>





