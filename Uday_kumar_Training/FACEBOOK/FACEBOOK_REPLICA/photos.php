<?php

session_start();

require_once "database.php";

if (!isset($_SESSION["id"])) {
	header("Location: login.php");
	exit();
}

$id = $_SESSION["id"];

$sql = "SELECT 
			* 
		FROM USER 
		WHERE USER_ID = ?";
$post_sql="SELECT
            W.*
        FROM
            `USER` U
        LEFT OUTER JOIN
            FRIEND F
        ON
            U.USER_ID = F.USER_ID
        LEFT OUTER JOIN
            WALL W
        ON
            F.FRIEND_ID = W.USER_ID
        WHERE
            U.USER_ID = ?";
$statement = $conn->prepare($sql);

$statement->bind_param("i", $id);

$statement->execute();

$result = $statement->get_result();

$user = $result->fetch_assoc();

$name = $user["NAME"];
$profil=$user["PROFILE_PICTURE"];

// FOR POST DISPLAYING
$post_statement = $conn->prepare($post_sql);

$post_statement->bind_param("i", $id);

$post_statement->execute();

$post_result = $post_statement->get_result();

$posts = $post_result->fetch_assoc();


$post_by = $user["NAME"];
$post_profil=$user["PROFILE_PICTURE"];

?>

<head>
	<link rel="stylesheet" href="/CSS/photos.css">
</head>
<div id="Photos_card">
	<div id="Photos_title-head">
		<span id="Photos_title">
			Photos
		</span>
		<!-- <a href="all_photos.php" > -->
		<span id="see_photos">
			See All Photos
		</span>
	<!-- </a> -->
	</div>
	<div id="all_photos_pro">
		<div class="grid-photo">
			<img src="/images/pro-4.png" alt="" class="my-photo">
			<img src="/images/pro-4.png" alt="" class="my-photo">
			<img src="/images/pro-4.png" alt="" class="my-photo">
			<img src="/images/pro-4.png" alt="" class="my-photo">
			<img src="/images/pro-4.png" alt="" class="my-photo">
			<img src="/images/pro-4.png" alt="" class="my-photo">
			<img src="/images/pro-4.png" alt="" class="my-photo">
			<img src="/images/pro-4.png" alt="" class="my-photo">
			<img src="/images/pro-4.png" alt="" class="my-photo">
	
		</div>
	</div>
</div>