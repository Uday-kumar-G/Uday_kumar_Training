<?php

session_start();

require_once "database.php";

if (!isset($_SESSION["id"])) {
	header("Location: login.php");
	exit();
}

$id = $_SESSION["id"];

$sql = "SELECT * FROM USER WHERE USER_ID = ?";
$post_sql="SELECT * FROM WALL WHERE USER_ID in (SELECT F.FRIEND_ID FROM USER U LEFT JOIN FRIEND F ON U.USER_ID=F.USER_ID WHERE F.USER_ID=?)";

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
	<link rel="stylesheet" href="all_photos.css">
</head>
<div id="all_photos_card">
	<div id="all_photos_title-head">
		<span id="Photos_title">
			Photos
		</span>
		
	</div>
	<div>
		<div id="photo_name_tab">
			<span>
				<?php echo htmlspecialchars($name); ?>
			</span>
			<span class="change-tab-name">'s Photos</span> 
		</div>
	</div>
	<div id="all_photos">
		<img src="/images/pro-5.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
		<img src="/images/pro-4.png" alt="" class="my-all-photos" width="185.98">
	</div>
</div>