<!DOCTYPE html>
<html>
<head>
	<title>Home page</title>
	<link rel="stylesheet" href="home.css">
</head>
<body>
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
			die("User ID not provided, so plz rpovide user id in url like this \"home.php?id=1\" for 1st user");
		}
		$id = (int) $_GET["id"];

		// SQL query
		$sql = "SELECT * FROM USER";
		$sql1 = "SELECT * FROM FRIEND"; 
		$sql2="SELECT * FROM WALL order by POSTING_DATE desc";		
		$result = $conn->query($sql);
				// $result1 = $conn->query($sql);
		$result_FRND_ = $conn->query($sql1);        
		$my_post = "SELECT *
		FROM WALL
		WHERE USER_ID = ?
		ORDER BY POSTING_DATE DESC";
		$post_stmt = $conn->prepare($my_post);
		$post_stmt->bind_param("i", $id);
		$post_stmt->execute();

		$sql_post = $post_stmt->get_result();
	?>
	<?php
		$user_sql = "SELECT USER_ID, NAME, EMAIL, ADDRESS, PHONE
		FROM USER
		WHERE USER_ID = ?";
		$user_stmt = $conn->prepare($user_sql);
		$user_stmt->bind_param("i", $id);
		$user_stmt->execute();
		$user_result = $user_stmt->get_result();
		$user = $user_result->fetch_assoc();
		echo '<h1 class="my-title">WELCOME  <a href="profile.php?id=' . $user["USER_ID"] . '">' . $user["NAME"] . '</a></h1>';
	?>

	<!-- //FOR THE CREATE POST FORM -->
	<h2 id="create-post" class="form-title">Create Post</h2>
	<form method="POST" >
		<textarea type="text-area" id="post" class="form-input" name="post" placeholder="Write your content to post here..." required></textarea>
		<br>
		<button id="save" class="form-button" type="submit">
		    Post
		</button>
		<p id="message" class="form-message"></p>
	</form>
	
	<h3 id="post-title">Post's</h3>
	<table class="post-table" id="my-table">
		<tr>
			<th>Date</th>
			<th>Post</th>
		</tr>
	<?php
		if($sql_post->num_rows>0)
		{
			while($post=$sql_post->fetch_assoc()){
				$d=date("y.m.d",strtotime($post["POSTING_DATE"]));
				echo "<tr>";
				echo "<td>" .$d. "</td>";
				echo "<td>" . $post["POST"] . "</td>";
				echo "</tr>";
			}
		} 
		else {
			echo "<tr><td colspan='3'>No users post found</td></tr>";
		}
		$conn->close();
	?>
</table>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.14.2/jquery-ui.js"></script>
<script src="wall.js"></script>
	</body>
</html>


        