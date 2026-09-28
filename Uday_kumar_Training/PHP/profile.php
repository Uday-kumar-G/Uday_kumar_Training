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
	<!-- To Establishing the database connection and checking here-->
	<?php
    // database connection
        require_once "database.php";
		if (!isset($_GET["id"])){
			die("User ID not specified.");
		}
		$id = $_GET["id"];
		$sql = "SELECT 
                    USER_ID, NAME, EMAIL, ADDRESS, PHONE
				FROM 
                    USER
				WHERE 
                    USER_ID = ?";
		$statement = $conn->prepare($sql);
		$statement->bind_param("i",$id);
		$statement->execute();
		$profileResult = $statement->get_result();
		$user = $profileResult->fetch_assoc();
		if(!$user){
			die("User not found.");
		}
	?>
	<!-- for desplaying the profile person details -->
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
		$currentUserId = 1;
		if ($id == $currentUserId) {
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

	<!-- table to display the post details -->
	<table class="my-post-table">
		<tr>
			<th>Date</th>
			<th>Post</th>
		</tr>
		<?php
			$sqlPost=" SELECT 
                            POST,POSTING_DATE 
						FROM 
                            WALL 
						WHERE 
                            USER_ID=? 
						ORDER BY 
                            POSTING_DATE DESC";
			$postStatement = $conn->prepare($sqlPost);
			$postStatement->bind_param("i",$id);
			$postStatement->execute();
			$postResult = $postStatement->get_result();
			while($post=$postResult->fetch_assoc()){
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





