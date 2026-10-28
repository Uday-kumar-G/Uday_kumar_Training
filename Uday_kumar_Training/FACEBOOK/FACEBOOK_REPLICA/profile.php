<?php
	session_start();
	require_once "database.php";

	if (!isset($_SESSION["id"])) {
		header("Location: login.php");
		exit;
	}

	// ID of the person who is logged in
	$loggedInId = (int) $_SESSION["id"];

	// ID of the profile being viewed
	$profileId = isset($_GET["id"])
		? filter_var($_GET["id"], FILTER_VALIDATE_INT)
		: $loggedInId;

	if ($profileId === false || $profileId === null || $profileId < 1) {
		$profileId = $loggedInId;
	}

	// Get logged-in user's details
	$sql = "SELECT NAME, PROFILE_PICTURE
			FROM `USER`
			WHERE USER_ID = ?";

	$statement = $conn->prepare($sql);
	$statement->bind_param("i", $loggedInId);
	$statement->execute();

	$loggedInUser = $statement->get_result()->fetch_assoc();
	$statement->close();

	if (!$loggedInUser) {
		exit("Logged-in user not found.");
	}

	$loggedInName = $loggedInUser["NAME"];
	$loggedInPicture = $loggedInUser["PROFILE_PICTURE"] ?? "";


	// Get the owner of the profile being viewed
	$sql = "SELECT 
				*
			FROM 
				`USER`
			WHERE 
				USER_ID = ?";

	$statement = $conn->prepare($sql);
	$statement->bind_param("i", $profileId);
	$statement->execute();

	$wallOwner = $statement->get_result()->fetch_assoc();
	$statement->close();

	if (!$wallOwner) {
		http_response_code(404);
		exit("Profile not found.");
	}

	$profileName = $wallOwner["NAME"];
	$profilePicture = $wallOwner["PROFILE_PICTURE"] ?? "";
// Handle creating a post
if (
	$_SERVER["REQUEST_METHOD"] === "POST" &&
	isset($_POST["create_post"])
) {
	$postText = trim($_POST["post"] ?? "");

	if ($postText === "") {
		http_response_code(422);
		header("Content-Type: application/json");
		echo json_encode([
			"success" => false,
			"message" => "Please enter some text."
		]);
		exit;
	}

	$sql = "INSERT INTO WALL
				(USER_ID, WALL_OWNER_ID, POST, POSTING_DATE)
			VALUES (?, ?, ?, NOW())";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("iis", $loggedInId, $profileId, $postText);

	if (!$stmt->execute()) {
		$stmt->close();
		http_response_code(500);
		header("Content-Type: application/json");
		echo json_encode([
			"success" => false,
			"message" => "Failed to save the post."
		]);
		exit;
	}

	$stmt->close();

	if (
		isset($_SERVER["HTTP_X_REQUESTED_WITH"]) &&
		strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) === "xmlhttprequest"
	) {
		header("Content-Type: application/json");
		echo json_encode([
			"success" => true,
			"message" => "Post published successfully."
		]);
		exit;
	}

	header("Location: profile.php?id=" . $profileId);
	exit;
}


	// Fetch posts displayed on the profile being viewed
	$sql = "SELECT
				W.USER_ID AS AUTHOR_ID,
				W.WALL_OWNER_ID,
				W.POST,
				W.POSTING_DATE,
				A.NAME AS AUTHOR_NAME,
				O.NAME AS OWNER_NAME
			FROM
				WALL W
			LEFT OUTER JOIN
				`USER` A
			ON
				A.USER_ID = W.USER_ID
			LEFT OUTER JOIN
				`USER` O
			ON
				O.USER_ID = W.WALL_OWNER_ID
			WHERE
				W.WALL_OWNER_ID = ?
			ORDER BY
				W.POSTING_DATE DESC";

	$statement = $conn->prepare($sql);
	$statement->bind_param("i", $profileId);
	$statement->execute();

	$postsResult = $statement->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="/CSS/home_page.css">
	<link rel="stylesheet" href="/CSS/profile.css">
	<link rel="stylesheet" href="/CSS/wall.css">
	<link rel="stylesheet" href="/CSS/my_posts.css">
	<link rel="stylesheet" href="/CSS/navbar.css">
	<title>Document</title>
</head>
<body>
	<?php
	require_once "navbar.php"
	?>
	<div id="full_page">
		<div id="center_content">
			<div id="cover_photo">
				<div class="cover-image">
					<img src="/images/default_cover.jpg" alt="cover_page loading..">
				</div>
			</div>
			<div id="full_detaile">
				<div id="detaile_at_center">
					<div class="profile_img" id="pro-img">
						<img id="account_image" src="../images/<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile picture" >
					</div>
					<div class="primary-detail">
						<div id="profile_top">
							<div id="top_left">
								<div id="person_name">
									<span>
										<?php echo htmlspecialchars($profileName); ?>
									</span>
								</div>
								<div id="person_followers">
									<span id="followers">
										121M followers
									</span>
								</div>
								
							</div>
							<div id="top_right">
								<div id="side-buttons">
									<div id="follow_btn">
										<span id="follow_btn_content" >
											<div class="follow-image">
												<img draggable="false" height="16" width="16" class="xz74otr x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 xaj1gnb" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yk/r/nSurzCxCD4K.webp">
											</div>
											<span id="follow_txt">
												Follow
											</span>
										</span>
									</div>
									<div id="search_btn">
										<div id="search_icon">
											<img draggable="false" height="16" width="16" class="xz74otr x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 xep6ejk" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yT/r/fPC9TAN2ujg.webp">
										</div>
										<span>
											Search
										</span>
									</div>
									<div id="down_arrow">
										<svg viewBox="0 0 16 16" width="16" height="16" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--primary-icon);"><path d="M6.94 10.354a1.5 1.5 0 0 0 2.12 0l2.647-2.647a1 1 0 0 0-1.414-1.414L8 8.586 5.707 6.293a1 1 0 0 0-1.414 1.414l2.646 2.647z"></path></svg>
									</div>
								</div>
							</div>
						</div>
						<div id="profle-low">
							<span class="tag-line">
								Bringing the world closer together.
							</span>
							<span class="make-horizontal">
								<span>
									<img height="12" width="12" class="xz74otr x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 xep6ejk" alt="" aria-hidden="true" referrerpolicy="origin-when-cross-origin" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M7.43 3h9.14c1.355 0 2.471 0 3.355.119.928.124 1.747.396 2.403 1.053.657.656.928 1.475 1.053 2.403.12.884.119 2 .119 3.354v4.141c0 1.355 0 2.471-.119 3.355-.125.928-.396 1.747-1.053 2.403-.656.657-1.475.928-2.403 1.053-.884.12-2 .119-3.354.119H7.429c-1.354 0-2.47 0-3.354-.119-.928-.125-1.747-.396-2.403-1.053-.657-.656-.929-1.475-1.053-2.403-.12-.884-.119-2-.119-3.354V9.929c0-1.354 0-2.47.119-3.354.124-.928.396-1.747 1.053-2.403.656-.657 1.475-.928 2.403-1.053.884-.12 2-.119 3.354-.119ZM21.4 6.841c-.096-.706-.263-1.033-.486-1.255-.222-.223-.55-.39-1.255-.485-.584-.079-1.324-.096-2.328-.1L19.731 8h1.751a11.546 11.546 0 0 0-.082-1.16ZM12.08 5l2.4 3h2.689l-2.4-3h-2.688Z'/%3E %3C/svg%3E">
									<span class="profle-low-txt">
										Public figure 
									</span>
								</span>
								<span>
									<img height="12" width="12" class="xz74otr x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 xep6ejk" alt="" aria-hidden="true" referrerpolicy="origin-when-cross-origin" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M12 .5a9 9 0 0 0-9 9c0 2.64 1.351 5.422 2.859 7.736 1.529 2.347 3.325 4.37 4.418 5.522a2.365 2.365 0 0 0 3.446 0c1.093-1.152 2.89-3.175 4.418-5.522C19.65 14.922 21 12.14 21 9.5a9 9 0 0 0-9-9Zm0 4.999a4 4 0 1 1 0 8 4 4 0 0 1 0-8Z'/%3E %3C/svg%3E">
									<span class="profle-low-txt">
										Palo Alto, CA
									</span>
								</span>
								<span>   
									<img height="12" width="12" class="xz74otr x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 xep6ejk" alt="" aria-hidden="true" referrerpolicy="origin-when-cross-origin" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M7 .5a1 1 0 0 0-1 1V4a2 2 0 0 0-2 2v1h-.5A2.5 2.5 0 0 0 1 9.5v11A2.5 2.5 0 0 0 3.5 23h17a2.5 2.5 0 0 0 2.5-2.5V6.015a2.5 2.5 0 0 0-1.572-2.32l-7-2.8A2.5 2.5 0 0 0 11 3.214V7h-1V6a2 2 0 0 0-2-2V1.5a1 1 0 0 0-1-1ZM3.5 9h2.55c-.033.162-.05.329-.05.5V21H3.5a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5Zm10.186-6.249 7 2.8a.5.5 0 0 1 .314.464V20.5a.5.5 0 0 1-.5.5H18V9.5A2.5 2.5 0 0 0 15.5 7H13V3.215a.5.5 0 0 1 .686-.464ZM10 12a1 1 0 0 1 1-1h2a1 1 0 1 1 0 2h-2a1 1 0 0 1-1-1Zm0 3.5a1 1 0 0 1 1-1h2a1 1 0 1 1 0 2h-2a1 1 0 0 1-1-1Z'/%3E %3C/svg%3E">
									<span class="profle-low-txt">
										Meta
									</span>
								</span>
								<span>
									<img height="12" width="12" class="xz74otr x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 xep6ejk" alt="" aria-hidden="true" referrerpolicy="origin-when-cross-origin" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M13.387 2.223a2.5 2.5 0 0 0-2.774 0L.945 8.668a1 1 0 0 0 0 1.664l9.668 6.445.015.01.54.36a1.5 1.5 0 0 0 1.664 0l.546-.364.009-.006 8.113-5.409V14a1 1 0 1 0 2 0V9.5a.995.995 0 0 0-.456-.84l-9.657-6.437Z'/%3E %3Cpath d='M4 16.833v-2.662l6.336 4.224a3 3 0 0 0 3.328 0L20 14.171v2.662a1 1 0 0 1-.445.832l-6.168 4.112a2.5 2.5 0 0 1-2.774 0l-6.168-4.112A1 1 0 0 1 4 16.833Z'/%3E %3C/svg%3E">
									<span class="profle-low-txt">
										Harvard University 
									</span>
								</span>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- <hr id="hr-line"> -->
			<div id="profile_nav">
				<!-- Profile Navigation -->
				<div id="profile_nav_inner">
					<div id="profile_nav_tab">
						<ul class="nav nav-pills" id="profile-tabs" role="tablist">

							<li class="nav-item_profile" role="presentation">
								<button class="nav-link active"
									id="all-tab"
									data-bs-toggle="pill"
									data-bs-target="#all"
									type="button" role="tab">
									All
								</button>
							</li>
							<!-- <a href="about.php"> -->
							<li class="nav-item_profile" role="presentation">
								<button class="nav-link"
									id="about-tab"
									data-bs-toggle="pill"
									data-bs-target="#about"
									type="button" role="tab">
									About
								</button>
							</li>
							<!-- </a> -->

							<li class="nav-item_profile" role="presentation">
								<button class="nav-link"
									id="reels-tab"
									data-bs-toggle="pill"
									data-bs-target="#reels"
									type="button" role="tab">
									Reels
								</button>
							</li>

							<li class="nav-item_profile" role="presentation">
								<button class="nav-link"
									id="photos-tab"
									data-bs-toggle="pill"
									data-bs-target="#photos"
									type="button" role="tab">
									Photos
								</button>
							</li>

							<li class="nav-item_profile" role="presentation">
								<button class="nav-link"
									id="friends-tab"
									data-bs-toggle="pill"
									data-bs-target="#friends"
									type="button" role="tab">
									Friends
								</button>
							</li>

							<li class="nav-item_profile dropdown">
								<button class="nav-link dropdown-toggle"
									data-bs-toggle="dropdown"
									type="button">
									More
								</button>

								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="#">Videos</a></li>
									<li><a class="dropdown-item" href="#">Check-ins</a></li>
									<li><a class="dropdown-item" href="#">Sports</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div id="three_dots">
						<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--primary-icon);"><circle cx="12" cy="12" r="2.5"></circle><circle cx="19.5" cy="12" r="2.5"></circle><circle cx="4.5" cy="12" r="2.5"></circle></svg>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="below_body">
		<div class="profile_page_all_content">
			<div id="aboutz">
				<?php require_once "about.php" ?>
			</div>
			<div id="friendz">
				<?php require_once "facebook_friends.php" ?>
			</div>
			<div id="photoz">
				<?php require_once "all_photos.php" ?>
			</div>
		</div>
		<div id="profile_page_content" class="profile_page_all_content">
			<div id="left_side">
				<div class="first-left">
					<?php require_once "personal_details.php" ?>
				</div>
				<div class="second-left">
					<?php require_once "photos.php" ?>
				</div>  
				<div id="privacy_policy">
					<?php require "footer.php"?>
				</div>       
			</div>
			<div id="right_side">
				<div class="right">
					<div class="right-post">
						<?php require_once "test_post.php" ?>  
					</div>
					<div class="posts_div">
						<span>
							Posts
						</span>
						
						<div id="posts_div_filter">
							<div>
								<svg viewBox="0 0 16 16" width="16" height="16" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--primary-icon);"><path d="M2.614 5.75H1.75a.75.75 0 0 1 0-1.5h.864a2.501 2.501 0 1 1 0 1.5zM11 8.5c1.12 0 2.067.736 2.386 1.75h.864a.75.75 0 0 1 0 1.5h-.864A2.501 2.501 0 1 1 11 8.5zM7.5 11a.75.75 0 0 0-.75-.75h-5a.75.75 0 0 0 0 1.5h5A.75.75 0 0 0 7.5 11zm1.75-6.75a.75.75 0 0 0 0 1.5h5a.75.75 0 0 0 0-1.5h-5z"></path></svg>
							</div>
							<span class="filter_title">
								Filters
							</span>
						</div>
					</div>
					<div class="your_posts" id="all_posts">
						<?php require_once "my_posts.php" ?>  
					</div>       
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="/JS/profile.js"></script>
	<script src="/JS/home_page.js"></script>
</body>
</html>
