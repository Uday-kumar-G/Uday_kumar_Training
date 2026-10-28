<?php
	// session_start();
	require_once "database.php"; // Adjust the path if necessary

	if (!isset($_SESSION["id"])) {
		header("Location: login.php");
		exit;
	}

	$loggedInId = (int) $_SESSION["id"];

	$profileId = isset($_GET["id"])
		? (int) $_GET["id"]
		: $loggedInId;
?>
<div id="my-wall" class="my-center-elements">
	<div class="top">
		<div class="my-porfile">
			<a href="profile.php?id=<?php echo $loggedInId; ?>">
				<div id="my-account" class="my-pointer1">
					<?php if ($loggedInPicture !== ""): ?>
						<img
							class="post-creator-image"
							src="../images/<?php echo htmlspecialchars($loggedInPicture); ?>"
							alt="Profile picture"
						>
					<?php endif; ?> 
				</div>
			</a>
		</div>
		
		<button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#centerModal">
			<div id="my-post-input">
				<div>
					<div>
						<span style="-webkit-box-orient:vertical;-webkit-line-clamp:2;display:-webkit-box">What's on your mind,
							<?php echo htmlspecialchars($loggedInName); ?>?
						</span>
					</div>
					<div>

					</div>
				</div>
			</div>
		</button>
	</div>
	<div class="bottom" id="post-bottom-elements">
	
		<div id="my-live_video" class="my-pointer top-icon">
			<img height="24" width="24" class="xz74otr x15mokao x1ga7v0g x16uus16 xbiv7yw" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yE/r/f0XMdTi7eQy.webp">
			<span>Live video</span>
		</div>
		<div id="my-photos" class="my-pointer top-icon">
			<img height="24" width="24" class="xz74otr x15mokao x1ga7v0g x16uus16 xbiv7yw" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yX/r/8_VnccIZfRa.webp">
			<span>Photo/video</span>
		</div>
		<div id="my-activity" class="my-pointer top-icon">
			<img height="24" width="24" class="xz74otr x15mokao x1ga7v0g x16uus16 xbiv7yw" alt="" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yd/r/R9lJq0bdBk6.webp">
			<span>Life update</span>
		</div>
	</div>
</div>
<!-- for creating the post it taking to the next page -->
<div class="modal fade"
	id="centerModal"
	tabindex="-1"
	aria-labelledby="centerModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<span class="modal-title" id="centerModalLabel">
					Create Post
				</span>
				<button type="button"
						class="btn-close"
						data-bs-dismiss="modal"
						aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<form action="profile.php?id=<?php echo $profileId; ?>" method="POST" id="createPostForm">
					<div id="post_container">
						<div id="posting_detail">
							<div id="account">
								<?php echo "<img id='account_image' src='../images/".$profil."'alt='img loading..' > "?>
							</div> 
							<div>
								<div id="post_type_by_name">
									<span id="person_name">
										<?php echo htmlspecialchars($loggedInName); ?>
									</span>
								</div>
								<div id="post_type">
									<div class="post-type-back">
										<img draggable="false" height="12" width="12" class="xz74otr x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 xep6ejk" alt="Public" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yY/r/w9qu7-Zte67.webp">
										<span>public</span>
										<i data-visualcompletion="css-img" class="x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 xep6ejk" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/y7/r/VFWCbL21ygI.webp&quot;); background-position: 0px -848px; background-size: auto; width: 12px; height: 12px; background-repeat: no-repeat; display: inline-block;"></i>
									</div>
									<div class="post-type-back">
										<i data-visualcompletion="css-img" class="x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 xep6ejk" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/y7/r/VFWCbL21ygI.webp&quot;); background-position: 0px -639px; background-size: auto; width: 16px; height: 16px; background-repeat: no-repeat; display: inline-block;"></i>
										<span>AI labeloff</span>
										<i data-visualcompletion="css-img" class="x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 xep6ejk" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/y7/r/VFWCbL21ygI.webp&quot;); background-position: 0px -848px; background-size: auto; width: 12px; height: 12px; background-repeat: no-repeat; display: inline-block;"></i>
									</div>
								</div>
							</div>
						</div>
						<div id="actual_post">
							<textarea
								id="post_text"
								name="post"
								placeholder="What's on your mind?"
								rows="4"></textarea>
						</div>
						<div id="ai_image">
							<div id="ai_image_left">
								<span id="ai_image_span">
									<img src="/images/ai-img.png" alt="loading..">
								</span>
							</div>
							<div id="ai_image_right">
								<span>
									<i data-visualcompletion="css-img" aria-label="Emoji" class="x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499" role="img" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yD/r/ndGOOykT4lB.webp&quot;); background-position: 0px -162px; background-size: auto; width: 24px; height: 24px; background-repeat: no-repeat; display: inline-block;"></i>
								</span>
							</div>
						</div>
						<div id="post_media">
							<div id="post_media_display">
								<div id="add_post_text">
									<span>
										Add to your post
									</span>
								</div>
								<div>
									<span class="post-icon">
										<img height="24" width="24" class="xl1xv1r x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499" alt="" aria-hidden="true" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yX/r/8_VnccIZfRa.webp">
									</span> 
								</div>
								<div>
									<span class="post-icon">
										<img height="24" width="24" class="xl1xv1r x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499" alt="" aria-hidden="true" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yO/r/UnRgJelt7Mg.webp">
									</span>
								</div>
								<div>
									<span class="post-icon">
										<img height="24" width="24" class="xl1xv1r x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499" alt="" aria-hidden="true" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/ya/r/XlpCJi9w2HF.webp">
									</span>
								</div>
								<div>
									<span class="post-icon">
										<img height="24" width="24" class="xl1xv1r x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499" alt="" aria-hidden="true" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/yC/r/glLNpLPayUm.webp"> 
									</span>
								</div>
					
								<div>
									<span class="post-icon">
										<img height="24" width="24" class="xl1xv1r x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499" alt="" aria-hidden="true" referrerpolicy="origin-when-cross-origin" src="https://static.xx.fbcdn.net/rsrc.php/y1/r/pfuEaSjPXaI.webp">
									</span>
								</div>
								<div>
									<span class="post-icon">
										<i data-visualcompletion="css-img" class="x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yU/r/w9zlAF3rnY1.webp&quot;); background-position: 0px -112px; background-size: auto; width: 24px; height: 24px; background-repeat: no-repeat; display: inline-block;">
										</i>
									</span>
								</div>
							</div>    
						</div>
						<button type="submit" id="post_button" name="create_post" value="1">
							Post    
						</button>   
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="/JS/test_post.js"></script>
