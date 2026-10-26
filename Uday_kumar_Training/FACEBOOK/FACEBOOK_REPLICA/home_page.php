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
			FROM 
				USER 
			WHERE 
				USER_ID = ?";
	$post_sql="SELECT 
				W.*
			FROM 
				USER U
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

	// name and profile picture variables
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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="/CSS/home_page.css">
	<title>Document</title>
</head>
<body>
	<div id="full_body">
		<?php require_once "navbar.php" ?>
		<br>
		<div id="my_page_body"> 
			<div id="left_part">
				<div class="left_nav_scroll">	
					<div class="left_navbars">
						<div class="icon">
							<a href="profile.php?id=<?php echo (int)$id; ?>">
								<div id="account">
									<img id="account_image" src="../images/<?php echo htmlspecialchars($profil); ?>" alt="Profile picture">
								</div>
							</a>
						</div>
						<div class="icon-disc">
							<span>
								<?php echo htmlspecialchars($name); ?>
							</span>
						</div>
					</div>
					<div class="left_navbars">
						<div class="icon">
							<i data-visualcompletion="css-img" class="" style="background-image:url('https://static.xx.fbcdn.net/rsrc.php/yt/r/FubCAjH3_RH.webp');background-position:0 0;background-size:auto;width:36px;height:36px;background-repeat:no-repeat;display:inline-block"></i>
						</div>
						<div class="icon-disc">
							<span>
								Meta AI
							</span>
						</div>
					</div> 
					<div class="left_navbars">
						<div class="icon">
							<i data-visualcompletion="css-img" class="" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yA/r/BY-cnZEKEQQ.webp&quot;); background-position: 0px -814px; background-size: auto; width: 36px; height: 36px; background-repeat: no-repeat; display: inline-block;"></i>
						</div> 
						<div class="icon-disc">
							<span>
								Friends

							</span>
						</div>
					</div> 
					<div class="left_navbars">
						<div class="icon">
							<i data-visualcompletion="css-img" class="" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yA/r/BY-cnZEKEQQ.webp&quot;); background-position: 0px -1184px; background-size: auto; width: 36px; height: 36px; background-repeat: no-repeat; display: inline-block;"></i>
						</div>
						<div class="icon-disc">
							<span>
								Memories
							</span>
						</div>
					</div> 
					<div class="left_navbars">
					<div class="icon">
							<i data-visualcompletion="css-img" class="" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yA/r/BY-cnZEKEQQ.webp&quot;); background-position: 0px -518px; background-size: auto; width: 36px; height: 36px; background-repeat: no-repeat; display: inline-block;"></i>
						</div>
						<div class="icon-disc">
							<span>
								Saved
							</span>
						</div>
					</div>
					<div class="left_navbars">
					<div class="icon">
							<i data-visualcompletion="css-img" class="" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yA/r/BY-cnZEKEQQ.webp&quot;); background-position: 0px -185px; background-size: auto; width: 36px; height: 36px; background-repeat: no-repeat; display: inline-block;"></i>
						</div>
						<div class="icon-disc">
							<span>
								Groups
							</span>
						</div>
					</div>
					<div class="left_navbars">
						<div class="icon">
							<i data-visualcompletion="css-img" class="" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yA/r/BY-cnZEKEQQ.webp&quot;); background-position: 0px -111px; background-size: auto; width: 36px; height: 36px; background-repeat: no-repeat; display: inline-block;"></i>
						</div>
						<div class="icon-disc">
							<span>
								Reels
							</span>
						</div>
					</div> 
					<div class="left_navbars">
					<div class="icon">
							<i data-visualcompletion="css-img" class="" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yA/r/BY-cnZEKEQQ.webp&quot;); background-position: 0px -962px; background-size: auto; width: 36px; height: 36px; background-repeat: no-repeat; display: inline-block;"></i>
						</div>
						<div class="icon-disc">
							<span>
								Marketplace
							</span>
						</div>
					</div> 
					<div class="left_navbars">
						<div class="icon">
							<img draggable="false" height="36" width="36" class="xz74otr" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yd/r/6H6EFrx5Jjl.webp">
						</div>
						<div class="icon-disc">
							<span>
								Feeds
							</span>
						</div>
					</div> 
					<div class="left_navbars">
						<div class="icon">
							<i data-visualcompletion="css-img" class="" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yA/r/BY-cnZEKEQQ.webp&quot;); background-position: 0px -666px; background-size: auto; width: 36px; height: 36px; background-repeat: no-repeat; display: inline-block;"></i>
						</div>
						<div class="icon-disc">
							<span>
								Events
							</span>
						</div>
					</div>
					<div class="left_navbars">
						<div class="icon">
							<i data-visualcompletion="css-img" class="" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yA/r/BY-cnZEKEQQ.webp&quot;); background-position: 0px -407px; background-size: auto; width: 36px; height: 36px; background-repeat: no-repeat; display: inline-block;"></i>
						</div>
						<div class="icon-disc">
							<span>
								Ads Manager
							</span>
						</div>
					</div>
					<div class="left_navbars">
						<div class="icon">
							<i data-visualcompletion="css-img" class="" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yC/r/FTKb61IRG16.webp&quot;); background-position: 0px 0px; background-size: auto; width: 36px; height: 36px; background-repeat: no-repeat; display: inline-block;"></i>
						</div>
						<div class="icon-disc">
							<span>
								Birthdays
							</span>
						</div>
					</div> 
					<div class="left_navbars">
						<div class="icon">
							<img draggable="false" height="36" width="36" class="xz74otr" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yT/r/JYr05Vf7xjV.webp">
						</div>
						<div class="icon-disc">
							<span>
								Gaming video
							</span>
						</div>
					</div> 
					<div class="left_navbars">
						<div class="icon">
							<i data-visualcompletion="css-img" class="" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yF/r/yUAAurE0b1h.webp&quot;); background-position: 0px 0px; background-size: auto; width: 36px; height: 36px; background-repeat: no-repeat; display: inline-block;"></i>
						</div>
						<div class="icon-disc">
							<span>
								Messenger
							</span>
						</div>
					</div> 
					<div class="left_navbars">
						<div class="icon">
							<img draggable="false" height="36" width="36" class="xz74otr" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/ys/r/p20rsJMTZBx.webp">
						</div>
						<div class="icon-disc">
							<span>
								Messenger Kids  
							</span>
						</div>
					</div> 
					<div class="left_navbars">
						<div class="icon">
							<img draggable="false" height="36" width="36" class="xz74otr" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/y_/r/R4eauTzM8dl.webp">
						</div>

						<div class="icon-disc">
							<span>
								Orders and payments
							</span>
						</div>
					</div>
					<div class="left_navbars">
						<div class="icon">
							<i data-visualcompletion="css-img" class="" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yA/r/BY-cnZEKEQQ.webp&quot;); background-position: 0px -333px; background-size: auto; width: 36px; height: 36px; background-repeat: no-repeat; display: inline-block;"></i>	
						</div>
						<div class="icon-disc">

							<span>
								Pages
							</span>
						</div>
					</div>
					<div class="left_navbars">
						<div class="icon">
							<i data-visualcompletion="css-img" class="" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yA/r/BY-cnZEKEQQ.webp&quot;); background-position: 0px -259px; background-size: auto; width: 36px; height: 36px; background-repeat: no-repeat; display: inline-block;"></i>
						</div>
						<div class="icon-disc">
							<span>
								Play games
							</span>
						</div>
					</div> 
					<div class="left_navbars">
						<div class="icon">
							<img draggable="false" height="36" width="36" class="xz74otr" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yT/r/kI6LBklVbSW.webp">
						</div>
						<div class="icon-disc">
							<span>
								Ray-Ban Meta
							</span>
						</div>
					</div> 
					<div class="left_navbars">
						<div class="icon">
							<img draggable="false" height="36" width="36" class="xz74otr" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/y-/r/ITvoZIONvPL.webp">
						</div>
						<div class="icon-disc">
							<span>
								Yourad activity
							</span>
						</div>
					</div> 
					<div class="see_more" type="button" id="toggleSidebar">
						<span id="toggleIcon">
							<svg viewBox="0 0 20 20" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--primary-icon);"><path d="M8.586 12.5a2 2 0 0 0 2.828 0l2.543-2.543a1 1 0 0 0-1.414-1.414L10 11.086 7.457 8.543a1 1 0 0 0-1.414 1.414L8.586 12.5z"></path></svg>
						</span>
						<span id="toggleText" class="see_more_disc">
							See more
						</span>
					</div>
					<div id="privacy_policy">
						<?php require "footer.php"?>
					</div>
				</div>
			</div>
			<div id="content">
				<div class="middle-content">
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
							<div id="wall" class="center-elements">
								<div class="porfile" >
									<a href="profile.php?id=<?php echo (int)$id; ?>">
										<div id="account" class="pointer">
											<!-- <img src="/home/uday-kumar/Documents/repo/Uday_kumar_Training/FACEBOOK/images/mark_profile.jpg" alt=""> -->
											<?php echo "<img id='account_image' src='../images/".$profil."'alt='img loading..' > "?>
										</div>
									</a>
								</div>
								<!-- <a href="test_post.php"> -->
								<div id="post-input">
									<div>
										<div>
											<span style="-webkit-box-orient:vertical;-webkit-line-clamp:2;display:-webkit-box">What's on your mind, <?php echo htmlspecialchars($name); ?>?</span>
										</div>
										<div>

										</div>
									</div>
								</div>
								<!-- </a> -->
								<div id="live_video" class="pointer top-icon">
									<img height="24" width="24" class="xz74otr x15mokao x1ga7v0g x16uus16 xbiv7yw" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yE/r/f0XMdTi7eQy.webp">
								</div>
								<div id="photos" class="pointer top-icon">
									<img height="24" width="24" class="xz74otr x15mokao x1ga7v0g x16uus16 xbiv7yw" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yX/r/8_VnccIZfRa.webp">
								</div>
								<div id="activity" class="pointer top-icon">
									<img height="24" width="24" class="xz74otr x15mokao x1ga7v0g x16uus16 xbiv7yw" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/ya/r/XlpCJi9w2HF.webp">
								</div>
							</div>
							<div id="all-story" class="center-elements">
								<div id="my_story" class="story">
									<div id="account">
										<!-- <img src="/home/uday-kumar/Documents/repo/Uday_kumar_Training/FACEBOOK/images/mark_profile.jpg" alt=""> -->
										<!-- <img id="account_image" src="../images/mark_profile.jpg" alt="img loading.." >  -->
										
									</div>
									<div class="x6s0dn4 x1jx94hy xvs2etk xg3wpu6 x1jwbhkm xgg4q86 x78zum5 x1vqgdyp xl56j7k x10l6tqk xcrr8yc x100vrsf" id="add_story">
										<div class="x6s0dn4 xwnonoy xvs2etk xg3wpu6 x1jwbhkm xgg4q86 x78zum5 x10w6t97 xl56j7k x1td3qas" id="add_story_icon">
											<svg viewBox="0 0 20 20" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color:var(--always-white)">
												<g fill-rule="evenodd" transform="translate(-446 -350)">
													<g fill-rule="nonzero">
														<path d="M95 201.5h13a1 1 0 1 0 0-2H95a1 1 0 1 0 0 2z" transform="translate(354.5 159.5)"></path>
														<path d="M102.5 207v-13a1 1 0 1 0-2 0v13a1 1 0 1 0 2 0z" transform="translate(354.5 159.5)"></path>
													</g>
												</g>
											</svg>
										</div>
									</div>
									<div id="create_story">
										<span class="x193iq5w xeuugli x13faqbe x1vvkbs x10flsy6 x1lliihq x1s928wv xhkezso x1gmr53x x1cpjm7i x1fgarty x1943h6x x1tu3fi x3x7a5m x1nxh6w3 x1sibtaa x1s688f xzsf02u x2b8uid" dir="auto"><span class="" style="-webkit-box-orient: vertical; -webkit-line-clamp: 3; display: -webkit-box;">Create story</span></span>
									</div>
								</div>
								<div id="friends_story_1" class="story">
									<div id="account">
										<!-- <img src="/home/uday-kumar/Documents/repo/Uday_kumar_Training/FACEBOOK/images/mark_profile.jpg" alt=""> -->
										<img id="account_image" src="../images/mark_profile.jpg" alt="img loading.." class="story-account"> 
									</div>
									<div class="story-by">
										<span>Rahul</span>
									</div>
								</div>
								<div id="friends_story_2" class="story">
									<div id="account">
										<!-- <img src="/home/uday-kumar/Documents/repo/Uday_kumar_Training/FACEBOOK/images/mark_profile.jpg" alt=""> -->
										<img id="account_image" src="../images/mark_profile.jpg" alt="img loading.." class="story-account" > 
									</div>
									<div class="story-by">
										<span>Ramu</span>
									</div>
								</div>
								<div id="friends_story_3" class="story">
									<div id="account">
										<!-- <img src="/home/uday-kumar/Documents/repo/Uday_kumar_Training/FACEBOOK/images/mark_profile.jpg" alt=""> -->
										<img id="account_image" src="../images/mark_profile.jpg" alt="img loading.." class="story-account"> 
									</div>
									<div class="story-by">
										<span>kumar</span>
									</div>
								</div>
								<div id="friends_story_4" class="story">
									<div id="account">
										<!-- <img src="/home/uday-kumar/Documents/repo/Uday_kumar_Training/FACEBOOK/images/mark_profile.jpg" alt=""> -->
										<img id="account_image" src="../images/mark_profile.jpg" alt="img loading.." class="story-account"> 
									</div>  
									<div class="story-by">
										<span>tilak</span>
									</div>
								</div>
								<!-- <div id="friends_story_5" class="story">

								</div> -->
							</div>
							<div id="post" class="center-elements">
								<div id="post_top_bar">
									<div id="post_profile" class="top">
										<div id="account">
										<!-- <img src="/home/uday-kumar/Documents/repo/Uday_kumar_Training/FACEBOOK/images/mark_profile.jpg" alt=""> -->
											<img id="account_image" src="../images/mark_profile.jpg" alt="img loading.." > 
										</div> 
									</div>
									<div id="posted_person_name" class="top">
										<span>Rahul.</span>
										<p>this is the first post in my page</p>
									</div>
									<div id="dot_nav" class="top">
										<div class="xqcrz7y x78zum5 x1qx5ct2 x1y1aw1k xf159sx xwib8y2 xmzvs34 xw4jnvo">
											<div>
												<div aria-expanded="false" aria-haspopup="menu" aria-label="Actions for this post by Dr. Vamshika Chetla" class="x1i10hfl x1qjc9v5 xjqpnuy xc5r6h4 xqeqjp1 x1phubyo x9f619 x1ypdohk xdl72j9 x2lah0s x3ct3a4 x2lwn1j xeuugli x16tdsg8 x1hl2dhg xggy1nq x1ja2u2z x1t137rt x1fmog5m xu25z0z x140muxe xo1y3bh x1q0g3np x87ps6o x1lku1pv x1a2a7pz xjyslct xjbqb8w x13fuv20 x18b5jzi x1q0q8m5 x1t7ytsu x972fbf x10w94by x1qhh985 x14e42zd x3nfvp2 xdj266r x14z9mp xat24cr x1lziwak xexx8yu xyri2b x18d9i69 x1c1uobl x1n2onr6 x3ajldb xrw4ojt xg6frx5 xw872ko xhgbb2x x1xhcax0 x1s928wv x1o8326s x56lyyc x1j6awrg x1tfg27r xitxdhh" role="button" tabindex="0"><svg viewBox="0 0 20 20" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--secondary-icon);"><g fill-rule="evenodd" transform="translate(-446 -350)"><path d="M458 360a2 2 0 1 1-4 0 2 2 0 0 1 4 0m6 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0m-12 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0"></path></g></svg>
													<div class="x1ey2m1c xtijo5x x1o0tod xg01cxk x47corl x10l6tqk x13vifvy x1ebt8du x19991ni x1dhq9h x1iwo8zk x1033uif x179ill4 x1b60jn0" role="none" data-visualcompletion="ignore" style="inset: -8px;">

													</div>
												</div>
											</div>
										</div>
									</div>
									<div id="close" class="top">
										<svg viewBox="0 0 20 20" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--secondary-icon);"><path d="M15.543 3.043a1 1 0 1 1 1.414 1.414L11.414 10l5.543 5.542a1 1 0 0 1-1.414 1.415L10 11.414l-5.543 5.543a1 1 0 0 1-1.414-1.415L8.586 10 3.043 4.457a1 1 0 1 1 1.414-1.414L10 8.586l5.543-5.543z"></path></svg> 
									</div>
								</div>
								<div id="post_msg">
									Elon Musk has raised concerns about the use of electronic voting machines (EVMs), arguing that computer-based voting systems may carry potential security risks. His com
								</div>
								<div id="post_image"  class="pointer">
									<img src="/images/Pasted image.png" alt="post loading..">
								</div>
								<div id="post_bottom">
									<div class="pointer">
										<div id="like">
											<i data-visualcompletion="css-img" class="x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 x1d69dk1" style="background-image:url('https://static.xx.fbcdn.net/rsrc.php/yH/r/1RsW4JFjPX8.webp');background-position:0 -441px;background-size:auto;width:20px;height:20px;background-repeat:no-repeat;display:inline-block"></i>
										</div>
										<div id="like_count">
											12.2k
										</div>
									</div>
									<div  class="pointer">

										<div id="comment">
											<i data-visualcompletion="css-img" class="x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 x1d69dk1" style="background-image:url('https://static.xx.fbcdn.net/rsrc.php/yH/r/1RsW4JFjPX8.webp');background-position:0 -231px;background-size:auto;width:20px;height:20px;background-repeat:no-repeat;display:inline-block"></i>
										</div>
										<div id="like_count">
											12.2k
										</div>
									</div>
									<div  class="pointer">

										<div id="share">
											<i data-visualcompletion="css-img" class="x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 x1d69dk1" style="background-image:url('https://static.xx.fbcdn.net/rsrc.php/yH/r/1RsW4JFjPX8.webp');background-position:0 -567px;background-size:auto;width:20px;height:20px;background-repeat:no-repeat;display:inline-block"></i>
										</div>
										<div id="like_count">
											12.2k
										</div>
									</div>
									<div  class="pointer">
										<div id="total_like">
											<span class="x6s0dn4 x78zum5 x135b78x" id="corner">
												<span class="x6zyg47 x1lu4ftm xpn8fn3 x114g2xr xqbdsaf xpf24wh x14a4ghu x1a4jp9x x13fuv20 x18b5jzi x1q0q8m5 x1t7ytsu xamhcws x1alpsbp xlxy82 xyumdvf xmix8c7 x165d6jo x1n2onr6 x1xp8n7a xhtitgo">
													<span class="x1fuqvrd xmvrd30 xt2fmn5 xkn4fgx x1rg5ohu xmix8c7 x1xp8n7a">
														<span class="html-span xdj266r x14z9mp xat24cr x1lziwak xexx8yu xyri2b x18d9i69 x1c1uobl x1hl2dhg x16tdsg8 x1vvkbs x4k7w5x x1h91t0o x1h9r5lt x1jfb8zj xv2umb2 x1beo9mf xaigb6o x12ejxvf x3igimt xarpa2k xedcshv x1lytzrv x1t2pt76 x7ja8zs x1qrby5j">
															<div aria-label="Like: 261 people" class="x1i10hfl x1qjc9v5 xjbqb8w xjqpnuy xc5r6h4 xqeqjp1 x1phubyo x13fuv20 x18b5jzi x1q0q8m5 x1t7ytsu x972fbf x10w94by x1qhh985 x14e42zd x9f619 x1ypdohk xdl72j9 x2lah0s x3ct3a4 xdj266r x14z9mp xat24cr x1lziwak x2lwn1j xeuugli xexx8yu xyri2b x18d9i69 x1c1uobl x1n2onr6 x16tdsg8 x1hl2dhg xggy1nq x1ja2u2z x1t137rt x1fmog5m xu25z0z x140muxe xo1y3bh x3nfvp2 x1q0g3np x87ps6o x1lku1pv x1a2a7pz" role="button" tabindex="0">
																<img class="x16dsc37" height="18" role="presentation" src="data:image/svg+xml,%3Csvg fill='none' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath d='M16.0001 7.9996c0 4.418-3.5815 7.9996-7.9995 7.9996S.001 12.4176.001 7.9996 3.5825 0 8.0006 0C12.4186 0 16 3.5815 16 7.9996Z' fill='url(%23paint0_linear_15251_63610)'/%3E%3Cpath d='M16.0001 7.9996c0 4.418-3.5815 7.9996-7.9995 7.9996S.001 12.4176.001 7.9996 3.5825 0 8.0006 0C12.4186 0 16 3.5815 16 7.9996Z' fill='url(%23paint1_radial_15251_63610)'/%3E%3Cpath d='M16.0001 7.9996c0 4.418-3.5815 7.9996-7.9995 7.9996S.001 12.4176.001 7.9996 3.5825 0 8.0006 0C12.4186 0 16 3.5815 16 7.9996Z' fill='url(%23paint2_radial_15251_63610)' fill-opacity='.5'/%3E%3Cpath d='M7.3014 3.8662a.6974.6974 0 0 1 .6974-.6977c.6742 0 1.2207.5465 1.2207 1.2206v1.7464a.101.101 0 0 0 .101.101h1.7953c.992 0 1.7232.9273 1.4917 1.892l-.4572 1.9047a2.301 2.301 0 0 1-2.2374 1.764H6.9185a.5752.5752 0 0 1-.5752-.5752V7.7384c0-.4168.097-.8278.2834-1.2005l.2856-.5712a3.6878 3.6878 0 0 0 .3893-1.6509l-.0002-.4496ZM4.367 7a.767.767 0 0 0-.7669.767v3.2598a.767.767 0 0 0 .767.767h.767a.3835.3835 0 0 0 .3835-.3835V7.3835A.3835.3835 0 0 0 5.134 7h-.767Z' fill='%23fff'/%3E%3Cdefs%3E%3CradialGradient id='paint1_radial_15251_63610' cx='0' cy='0' r='1' gradientUnits='userSpaceOnUse' gradientTransform='rotate(90 .0005 8) scale(7.99958)'%3E%3Cstop offset='.5618' stop-color='%230866FF' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%230866FF' stop-opacity='.1'/%3E%3C/radialGradient%3E%3CradialGradient id='paint2_radial_15251_63610' cx='0' cy='0' r='1' gradientUnits='userSpaceOnUse' gradientTransform='rotate(45 -4.5257 10.9237) scale(10.1818)'%3E%3Cstop offset='.3143' stop-color='%2302ADFC'/%3E%3Cstop offset='1' stop-color='%2302ADFC' stop-opacity='0'/%3E%3C/radialGradient%3E%3ClinearGradient id='paint0_linear_15251_63610' x1='2.3989' y1='2.3999' x2='13.5983' y2='13.5993' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%2302ADFC'/%3E%3Cstop offset='.5' stop-color='%230866FF'/%3E%3Cstop offset='1' stop-color='%232B7EFF'/%3E%3C/linearGradient%3E%3C/defs%3E%3C/svg%3E" width="18">
														</div>
													</span>
												</span>
											</span>
											<span class="x6zyg47 x1lu4ftm xpn8fn3 x114g2xr xqbdsaf xpf24wh x14a4ghu x1a4jp9x x13fuv20 x18b5jzi x1q0q8m5 x1t7ytsu xamhcws x1alpsbp xlxy82 xyumdvf xmix8c7 x165d6jo x1n2onr6 x1xp8n7a x1vjfegm">
												<span class="x1fuqvrd xmvrd30 xt2fmn5 xkn4fgx x1rg5ohu xmix8c7 x1xp8n7a">
													<span class="html-span xdj266r x14z9mp xat24cr x1lziwak xexx8yu xyri2b x18d9i69 x1c1uobl x1hl2dhg x16tdsg8 x1vvkbs x4k7w5x x1h91t0o x1h9r5lt x1jfb8zj xv2umb2 x1beo9mf xaigb6o x12ejxvf x3igimt xarpa2k xedcshv x1lytzrv x1t2pt76 x7ja8zs x1qrby5j">
														<div aria-label="Haha: 65 people" class="x1i10hfl x1qjc9v5 xjbqb8w xjqpnuy xc5r6h4 xqeqjp1 x1phubyo x13fuv20 x18b5jzi x1q0q8m5 x1t7ytsu x972fbf x10w94by x1qhh985 x14e42zd x9f619 x1ypdohk xdl72j9 x2lah0s x3ct3a4 xdj266r x14z9mp xat24cr x1lziwak x2lwn1j xeuugli xexx8yu xyri2b x18d9i69 x1c1uobl x1n2onr6 x16tdsg8 x1hl2dhg xggy1nq x1ja2u2z x1t137rt x1fmog5m xu25z0z x140muxe xo1y3bh x3nfvp2 x1q0g3np x87ps6o x1lku1pv x1a2a7pz" role="button" tabindex="0">
															<img class="x16dsc37" height="18" role="presentation" src="data:image/svg+xml,%3Csvg fill='none' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cg clip-path='url(%23clip0_15251_63610)'%3E%3Cpath d='M15.9953 7.9996c0 4.418-3.5816 7.9996-7.9996 7.9996S-.004 12.4176-.004 7.9996 3.5776 0 7.9957 0c4.418 0 7.9996 3.5815 7.9996 7.9996Z' fill='url(%23paint0_linear_15251_63610)'/%3E%3Cpath d='M15.9973 7.9992c0 4.4178-3.5811 7.9992-7.9987 7.9992C3.5811 15.9984 0 12.417 0 7.9992S3.5811 0 7.9986 0c4.4176 0 7.9987 3.5814 7.9987 7.9992Z' fill='url(%23paint1_radial_15251_63610)'/%3E%3Cpath d='M15.9953 7.9996c0 4.418-3.5816 7.9996-7.9996 7.9996S-.004 12.4176-.004 7.9996 3.5776 0 7.9957 0c4.418 0 7.9996 3.5815 7.9996 7.9996Z' fill='url(%23paint2_radial_15251_63610)' fill-opacity='.8'/%3E%3Cpath d='M12.5278 8.1957c.4057.1104.6772.4854.623.9024-.3379 2.6001-2.5167 4.9012-5.1542 4.9012s-4.8163-2.3011-5.1542-4.9012c-.0542-.417.2173-.792.623-.9024.8708-.237 2.5215-.596 4.5312-.596 2.0098 0 3.6605.359 4.5312.596Z' fill='%234B280E'/%3E%3Cpath d='M11.5809 12.3764c-.9328.9843-2.1948 1.6228-3.5841 1.6228-1.3892 0-2.6512-.6383-3.5839-1.6225a1.5425 1.5425 0 0 0-.016-.0174c.4475-1.0137 2.2-1.3599 3.5999-1.3599 1.4 0 3.1514.3468 3.5998 1.3599l-.0157.0171Z' fill='url(%23paint3_linear_15251_63610)'/%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M13.3049 5.8793c.1614-1.1485-.6387-2.2103-1.7872-2.3717l-.0979-.0138c-1.1484-.1614-2.2103.6388-2.3717 1.7872l-.0163.1164a.5.5 0 0 0 .9902.1392l.0163-.1164c.0846-.6016.6408-1.0207 1.2424-.9362l.0978.0138c.6016.0845 1.0207.6407.9362 1.2423l-.0164.1164a.5.5 0 0 0 .9903.1392l.0163-.1164ZM2.6902 5.8793c-.1614-1.1485.6387-2.2103 1.7872-2.3717l.0979-.0138c1.1484-.1614 2.2103.6388 2.3717 1.7872l.0164.1164a.5.5 0 1 1-.9903.1392l-.0163-.1164c-.0846-.6016-.6408-1.0207-1.2423-.9362l-.098.0138c-.6015.0845-1.0206.6407-.936 1.2423l.0163.1164a.5.5 0 0 1-.9902.1392l-.0164-.1164Z' fill='%231C1C1D'/%3E%3C/g%3E%3Cdefs%3E%3CradialGradient id='paint1_radial_15251_63610' cx='0' cy='0' r='1' gradientUnits='userSpaceOnUse' gradientTransform='matrix(0 7.9992 -7.99863 0 7.9986 7.9992)'%3E%3Cstop offset='.5637' stop-color='%23FF5758' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23FF5758' stop-opacity='.1'/%3E%3C/radialGradient%3E%3CradialGradient id='paint2_radial_15251_63610' cx='0' cy='0' r='1' gradientUnits='userSpaceOnUse' gradientTransform='rotate(45 -4.5272 10.9202) scale(10.1818)'%3E%3Cstop stop-color='%23FFF287'/%3E%3Cstop offset='1' stop-color='%23FFF287' stop-opacity='0'/%3E%3C/radialGradient%3E%3ClinearGradient id='paint0_linear_15251_63610' x1='2.396' y1='2.3999' x2='13.5954' y2='13.5993' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23FFF287'/%3E%3Cstop offset='1' stop-color='%23F68628'/%3E%3C/linearGradient%3E%3ClinearGradient id='paint3_linear_15251_63610' x1='5.1979' y1='10.7996' x2='5.245' y2='14.2452' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23FF60A4'/%3E%3Cstop offset='.2417' stop-color='%23FA2E3E'/%3E%3Cstop offset='1' stop-color='%23BC0A26'/%3E%3C/linearGradient%3E%3CclipPath id='clip0_15251_63610'%3E%3Cpath fill='%23fff' d='M-.002 0h16v15.9992h-16z'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E" width="18">
														</div>
													</span>
												</span>
											</span>
											<span class="x6zyg47 x1lu4ftm xpn8fn3 x114g2xr xqbdsaf xpf24wh x14a4ghu x1a4jp9x x13fuv20 x18b5jzi x1q0q8m5 x1t7ytsu xamhcws x1alpsbp xlxy82 xyumdvf xmix8c7 x165d6jo x1n2onr6 x1xp8n7a x1ja2u2z">
												<span class="x1fuqvrd xmvrd30 xt2fmn5 xkn4fgx x1rg5ohu xmix8c7 x1xp8n7a">
													<span class="html-span xdj266r x14z9mp xat24cr x1lziwak xexx8yu xyri2b x18d9i69 x1c1uobl x1hl2dhg x16tdsg8 x1vvkbs x4k7w5x x1h91t0o x1h9r5lt x1jfb8zj xv2umb2 x1beo9mf xaigb6o x12ejxvf x3igimt xarpa2k xedcshv x1lytzrv x1t2pt76 x7ja8zs x1qrby5j">
														<div aria-label="Love: 31 people" class="x1i10hfl x1qjc9v5 xjbqb8w xjqpnuy xc5r6h4 xqeqjp1 x1phubyo x13fuv20 x18b5jzi x1q0q8m5 x1t7ytsu x972fbf x10w94by x1qhh985 x14e42zd x9f619 x1ypdohk xdl72j9 x2lah0s x3ct3a4 xdj266r x14z9mp xat24cr x1lziwak x2lwn1j xeuugli xexx8yu xyri2b x18d9i69 x1c1uobl x1n2onr6 x16tdsg8 x1hl2dhg xggy1nq x1ja2u2z x1t137rt x1fmog5m xu25z0z x140muxe xo1y3bh x3nfvp2 x1q0g3np x87ps6o x1lku1pv x1a2a7pz" role="button" tabindex="0">
															<img class="x16dsc37" height="18" role="presentation" src="data:image/svg+xml,%3Csvg fill='none' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cg clip-path='url(%23clip0_15251_63610)'%3E%3Cpath d='M15.9963 8c0 4.4179-3.5811 7.9993-7.9986 7.9993-4.4176 0-7.9987-3.5814-7.9987-7.9992 0-4.4179 3.5811-7.9992 7.9987-7.9992 4.4175 0 7.9986 3.5813 7.9986 7.9992Z' fill='url(%23paint0_linear_15251_63610)'/%3E%3Cpath d='M15.9973 7.9992c0 4.4178-3.5811 7.9992-7.9987 7.9992C3.5811 15.9984 0 12.417 0 7.9992S3.5811 0 7.9986 0c4.4176 0 7.9987 3.5814 7.9987 7.9992Z' fill='url(%23paint1_radial_15251_63610)'/%3E%3Cpath d='M7.9996 5.9081c-.3528-.8845-1.1936-1.507-2.1748-1.507-1.4323 0-2.4254 1.328-2.4254 2.6797 0 2.2718 2.3938 4.0094 4.0816 5.1589.3168.2157.7205.2157 1.0373 0 1.6878-1.1495 4.0815-2.8871 4.0815-5.159 0-1.3517-.993-2.6796-2.4254-2.6796-.9811 0-1.822.6225-2.1748 1.507Z' fill='%23fff'/%3E%3C/g%3E%3Cdefs%3E%3CradialGradient id='paint1_radial_15251_63610' cx='0' cy='0' r='1' gradientUnits='userSpaceOnUse' gradientTransform='matrix(0 7.9992 -7.99863 0 7.9986 7.9992)'%3E%3Cstop offset='.5637' stop-color='%23E11731' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23E11731' stop-opacity='.1'/%3E%3C/radialGradient%3E%3ClinearGradient id='paint0_linear_15251_63610' x1='2.3986' y1='2.4007' x2='13.5975' y2='13.5993' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23FF74AE'/%3E%3Cstop offset='.5001' stop-color='%23FA2E3E'/%3E%3Cstop offset='1' stop-color='%23FF5758'/%3E%3C/linearGradient%3E%3CclipPath id='clip0_15251_63610'%3E%3Cpath fill='%23fff' d='M-.001.0009h15.9992v15.9984H-.001z'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E" width="18">
														</div>
													</span>
												</span>
											</span>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
						<div class="tab-pane" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
							<p>This is some placeholder content the <strong>Reels Tab</strong> associated content.</p>
						</div>
						<div class="tab-pane" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
							<div class="title">
								<span>People you may know</span>
							</div>
							<div id="find_frineds_here">
								<div class="friend">
									<div class="image">
										<img src="/images/photos_default.jpg" alt="loading">
									</div>
									<div class="name">
										<span>Dog</span>
									</div>
									<div class="followed_by">
										<span>Followed by 12k</span>
									</div>
									<div class="add_friend">
										<button>Add friend</button>
									</div>
									<div class="remove">
										<button>Remove</button>
									</div>
								</div>
								<div class="friend">
									<div class="image">

									</div>
									<div class="name">
										
									</div>
									<div class="followed_by">
										
									</div>
									<div class="add_friend">

									</div>
									<div class="remove">
										
									</div>
								</div>
								<div class="friend"></div>
								<div class="friend"></div>
								<div class="friend"></div>
								<div class="friend"></div>
								<div class="friend"></div>
								<div class="friend"></div>
							</div>
						</div>
						<div class="tab-pane" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">
							<p>This is some placeholder content the <strong>Group tab</strong> associated content.</p>
						</div>
					<!-- </div> -->
				</div>
			</div>
			<div id="right_corner">
				<svg viewBox="0 0 20 20" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--primary-icon);"><path fill-rule="evenodd" d="M17.99.93a1.75 1.75 0 0 0-2.48.005l-9.148 9.224a1.25 1.25 0 0 0-.362.88v2.21c0 .415.336.75.75.75h2.212c.33 0 .646-.13.88-.362l9.223-9.148a1.75 1.75 0 0 0 .005-2.48L17.99.93zm-1.415 1.06a.25.25 0 0 1 .355 0l1.08 1.08a.25.25 0 0 1-.001.353L16.742 4.68l-1.423-1.423 1.256-1.267z" clip-rule="evenodd"></path><path d="M11.238 1H9.694C7.856 1 6.4 1 5.26 1.153c-1.172.158-2.121.49-2.87 1.238-.748.749-1.08 1.698-1.238 2.87C1 6.401 1 7.856 1 9.694v.612c0 1.838 0 3.294.153 4.433.158 1.172.49 2.121 1.238 2.87.749.748 1.698 1.08 2.87 1.238C6.401 19 7.856 19 9.694 19h.612c1.838 0 3.294 0 4.433-.153 1.172-.158 2.121-.49 2.87-1.238.748-.749 1.08-1.698 1.238-2.87.153-1.14.153-2.595.153-4.433V8.764a.75.75 0 0 0-1.5 0v1.487c0 1.907-.002 3.261-.14 4.29-.135 1.005-.389 1.585-.812 2.008-.423.423-1.003.677-2.009.812-1.027.138-2.382.14-4.289.14h-.5c-1.907 0-3.261-.002-4.29-.14-1.005-.135-1.585-.389-2.008-.812-.423-.423-.677-1.003-.812-2.009-.138-1.027-.14-2.382-.14-4.289v-.5c0-1.907.002-3.261.14-4.29.135-1.005.389-1.585.812-2.008.423-.423 1.003-.677 2.009-.812 1.028-.138 2.382-.14 4.289-.14h1.488a.75.75 0 0 0 0-1.5z"></path></svg>
			</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="/JS/home_page.js"></script>
</body>
</html>