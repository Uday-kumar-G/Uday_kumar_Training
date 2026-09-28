<?php

session_start();
require_once "database.php";
if (!isset($_GET["id"])) {
    die("User ID not provided");
}

$id = (int) $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $post = trim($_POST["post"]);

    if ($post != "") {

        $sql = "INSERT INTO WALL
                	(USER_ID, POSTING_DATE, POST)
                VALUES 
					(?, NOW(), ?)";

        $statement = $conn->prepare($sql);

        $statement->bind_param("is", $id, $post);

        if ($statement->execute()) {

            $_SESSION["message"] = "Post created successfully";

            header("Location: home.php?id=" . $id);
            exit();
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home page</title>
	<link rel="stylesheet" href="home.css">
</head>
<body>
	<div class="full-body">
		
		<div class="nav">
			<?php
				// database connection
				require_once "database.php";
				if (!isset($_GET["id"])) {
					die("User ID not provided, so plz rpovide user id in url like this \"home.php?id=1\" for 1st user");
				}
				// from url fetching the id value and converting it into the int

				$id = (int) $_GET["id"];
				// SQL query's to fetch all details
				$sql = "SELECT 
							* 
						FROM 
							USER";
				$sql1 = "SELECT 
							* 
						FROM 
							FRIEND"; 
				$sql2="SELECT 
							* 
						FROM 
							WALL 
						order by 
							POSTING_DATE desc";
				
				$result = $conn->query($sql);
				$result_FRND_ = $conn->query($sql1);
				// for fetching the post details
				$myPost = "SELECT 
								*
							FROM 
								WALL
							WHERE 
								USER_ID = ?
							ORDER BY 
								POSTING_DATE DESC";

				$postStatement = $conn->prepare($myPost);
				$postStatement->bind_param("i", $id);
				$postStatement->execute();
				$sqlPost = $postStatement->get_result();
			?>
			<?php

				require_once "database.php";
				$userSql = "SELECT 
								USER_ID, NAME, EMAIL, ADDRESS, PHONE
							FROM 
								USER
							WHERE 
								USER_ID = ?";
				$userStatement = $conn->prepare($userSql);
				$userStatement->bind_param("i", $id);
				$userStatement->execute();
				$userResult = $userStatement->get_result();
				$user = $userResult->fetch_assoc();
				echo '<h1 class="my-title">WELCOME  <a href="profile.php?id=' . $user["USER_ID"] . '">' . $user["NAME"] . '</a></h1>';
			?>
		</div>
		<div class="body-content">
			<div class="left">
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
							. '"><br>'
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
			<div class="right">
				<!-- //FOR THE CREATE POST -->
				<h2 id="create-post" class="form-title">Create Post</h2>
					<form method="POST" >
						<textarea type="text-area" id="post" class="form-input" name="post" placeholder="Write your content to post here..." required></textarea>
						<br>
						<button id="save" class="form-button" type="submit">
							Post
						</button>
						<p id="message" class="form-message"></p>
					</form>
					<?php
						if (isset($_SESSION["message"])) {
							echo "<p id='post-message'>"
								. $_SESSION["message"] .
								"</p>";
							unset($_SESSION["message"]);
						}
					?>
					<script>
						setTimeout(function () {

							let message = document.getElementById("post-message");

							if (message) {
								message.style.display = "none";
							}

						}, 2000);
					</script>
					
					<h3 id="post-title">Post's</h3>
					<table class="post-table" id="my-table">
						<tr>
							<th>Date</th>
							<th>Post</th>
						</tr>
						<?php
							require_once "database.php";
							if($sqlPost->num_rows>0)
							{
								while($post=$sqlPost->fetch_assoc()){
									$d=date("d.m.Y",strtotime($post["POSTING_DATE"]));
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
			</div>
		</div>
	</div>
</body>
</html>	