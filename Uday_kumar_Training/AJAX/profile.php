<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profile page</title>
	<link rel="stylesheet" href="profile.css">
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
		if (!isset($_GET["id"])){
			die("User ID not specified.");
		}
		$id = $_GET["id"];
		$sql = "SELECT USER_ID, NAME, EMAIL, ADDRESS, PHONE
				FROM USER
				WHERE USER_ID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$profile_result = $stmt->get_result();
		$user = $profile_result->fetch_assoc();
		if(!$user){
			die("User not found.");
		}
	?>
	<h1 class="my-title">Wlecome to  <a href="profile.php?id=<?php echo $id; ?>"><?php echo $user["NAME"]; ?></a>'s profile</h1>
	<div class="my-address">
		<p>Email:  <?php echo $user["EMAIL"];?></p>
		<p>Address:  <?php echo $user["ADDRESS"];?></p>
		<p>Phone:  <?php echo $user["PHONE"];?></p>
	</div>
	<button class="my-friends">
		<a href="friends.php?id=<?php echo $id; ?>">FRIENDS</a>
	</button><br>
	<?php
		$current_user_id = 1;
		if ($id == $current_user_id) {
			echo '<button class="my-update">
			<a href="update.php?id=1">
				Update
			</a>
			</button>';
		}
	?>
	<button class="my-home">
		<a href="home.php?id=1">HOME</a>
	</button>
	<h3 class="my-post-title">Post's</h3>
	<table class="my-post-table">
		<tr>
			<th>Date</th>
			<th>Post</th>
		</tr>
		<?php
			$sql_post="SELECT POST,POSTING_DATE FROM WALL WHERE USER_ID=? ORDER BY POSTING_DATE DESC";
			$post_stmt = $conn->prepare($sql_post);
			$post_stmt->bind_param("i",$id);
			$post_stmt->execute();
		$post_result = $post_stmt->get_result();
		while($post=$post_result->fetch_assoc()){
			$d=date("y.m.d",strtotime($post["POSTING_DATE"]));
			echo "<tr>";
			echo "<td>" .$d. "</td>";
			echo "<td>" . $post["POST"] . "</td>";
			echo "</tr>";
		}

			$conn->close();
		?>
	</table>
</div>
</body>
</html>





