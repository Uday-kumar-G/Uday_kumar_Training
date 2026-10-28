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

	$sql = "SELECT 
				U.*
			FROM 
				FRIEND F
			LEFT OUTER JOIN USER U ON F.FRIEND_ID = U.USER_ID
			WHERE 
				F.USER_ID = ?";
	$dbStatements = $conn->prepare($sql);
	$dbStatements->bind_param("i", $id);
	$dbStatements->execute();
	$myFrnds = $dbStatements->get_result();
	
?>
<head>
	<link rel="stylesheet" href="/CSS/facebook_friends.css">
</head>
<div id="friends-page">
	<div id="top-title">
		<div class="top-left-title" >
			<span>
				Friends
			</span>
		</div>
		<div class="top-right-search">
			<div class="search-icon">
				<svg viewBox="0 0 16 16" width="16" height="16" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--placeholder-icon);"><path d="M7.5 1a6.5 6.5 0 1 0 3.835 11.749l1.958 1.958a1 1 0 0 0 1.414-1.414l-1.958-1.958A6.5 6.5 0 0 0 7.5 1zM3 7.5a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0z"></path></svg>
			</div>
			<input type="text" name="" id="serach-inp" placeholder="Search">
		</div>
	</div>
	<div id="followers_tab">
		Followers
	</div>
	<div class="friends_list">
		<?php
			while ($frnds = $myFrnds->fetch_assoc()) {

				$friendId = (int) $frnds["USER_ID"];
				$friendName = htmlspecialchars($frnds["NAME"], ENT_QUOTES, "UTF-8");
				$friendAddress = htmlspecialchars($frnds["ADDRESS"] ?? "", ENT_QUOTES, "UTF-8");
				$profile = htmlspecialchars($frnds["PROFILE_PICTURE"] ?: "profile.png", ENT_QUOTES, "UTF-8");

				echo '
				<div class="friend_card">
					<div class="friend_img">
						<a class="my-friend"
							href="profile.php?id=' . $friendId . '">
							<img src="../images/' . $profile . '" alt="Profile picture">
						</a>
					</div>
					<div class="friend-detail">
						<div class="f_name">
							<a class="my-friend"
							href="profile.php?id=' . $friendId . '">
								' . $friendName . '
							</a>
						</div>
						<div class="friend_address">
							' . $friendAddress . '
						</div>
					</div>
				</div>';
			}
		?>
	</div>
</div>