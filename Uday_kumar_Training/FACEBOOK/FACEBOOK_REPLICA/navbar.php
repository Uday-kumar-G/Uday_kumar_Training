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
			WHERE USER_ID = ?";
			
	$statement = $conn->prepare($sql);
	$statement->bind_param("i", $id);
	$statement->execute();
	$result = $statement->get_result();
	$user = $result->fetch_assoc();

	// name and profile variables
	$name = $user["NAME"];
	$profil=$user["PROFILE_PICTURE"];
	$isHomePage = basename($_SERVER['PHP_SELF']) === 'home_page.php';
?>
<head>
	<link rel="stylesheet" href="/CSS/navbar.css">
</head>
<div class="nav-bar">
	<div id="left_nav">
		<div class="logo">
			<svg viewBox="0 0 24 24">
				<path d="M22 12.037C22 6.494 17.523 2 12 2S2 6.494 2 12.037c0 4.707 3.229 8.656 7.584 9.741v-6.674H7.522v-3.067h2.062v-1.322c0-3.416 1.54-5 4.882-5 .634 0 1.727.125 2.174.25v2.78a12.807 12.807 0 0 0-1.155-.037c-1.64 0-2.273.623-2.273 2.244v1.085h3.266l-.56 3.067h-2.706V22C18.164 21.4 22 17.168 22 12.037z" />
			</svg>
		</div>
		<div class="search">
			<div id="search-person">
				<label class="x1a2a7pz x1qjc9v5 xal68kn x51dqfy x1w4cqa3 x1byqp33 x9f619 x78zum5 x1fns5xo x1n2onr6 xh8yej3 x1ba4aug xwoeoq">
					<span class="xhb22t3 xb5gni xcj1dhv x6s0dn4 x78zum5 xuxw1ft x47corl x1g0dm76">
						<svg viewBox="0 0 16 16" width="16" height="16" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color:var(--secondary-icon)">
							<g fill-rule="evenodd" transform="translate(-448 -544)">
								<g fill-rule="nonzero">
									<path d="M10.743 2.257a6 6 0 1 1-8.485 8.486 6 6 0 0 1 8.485-8.486zm-1.06 1.06a4.5 4.5 0 1 0-6.365 6.364 4.5 4.5 0 0 0 6.364-6.363z" transform="translate(448 544)">

									</path>
									<path d="M10.39 8.75a2.94 2.94 0 0 0-.199.432c-.155.417-.23.849-.172 1.284.055.415.232.794.54 1.103a.75.75 0 0 0 1.112-1.004l-.051-.057a.39.39 0 0 1-.114-.24c-.021-.155.014-.356.09-.563.031-.081.06-.145.08-.182l.012-.022a.75.75 0 1 0-1.299-.752z" transform="translate(448 544)">

									</path>
									<path d="M9.557 11.659c.038-.018.09-.04.15-.064.207-.077.408-.112.562-.092.08.01.143.034.198.077l.041.036a.75.75 0 0 0 1.06-1.06 1.881 1.881 0 0 0-1.103-.54c-.435-.058-.867.018-1.284.175-.189.07-.336.143-.433.2a.75.75 0 0 0 .624 1.356l.066-.027.12-.061z" transform="translate(448 544)">

									</path>
									<path d="m13.463 15.142-.04-.044-3.574-4.192c-.599-.703.355-1.656 1.058-1.057l4.191 3.574.044.04c.058.059.122.137.182.24.249.425.249.96-.154 1.41l-.057.057c-.45.403-.986.403-1.411.154a1.182 1.182 0 0 1-.24-.182zm.617-.616.444-.444a.31.31 0 0 0-.063-.052c-.093-.055-.263-.055-.35.024l.208.232.207-.206.006.007-.22.257-.026-.024.033-.034.025.027-.257.22-.007-.007zm-.027-.415c-.078.088-.078.257-.023.35a.31.31 0 0 0 .051.063l.205-.204-.233-.209z" transform="translate(448 544)">

									</path>
								</g>
							</g>
						</svg>
					</span>
					<input placeholder="Search Facebook" spellcheck="false" aria-invalid="false" aria-label="Search Facebook" type="search" value="" id="search_facebook">
				</label>
			</div>
		</div>
	</div>
	<div id="midle_nav_elements">
		<ul class="nav nav-pills" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="pills-home-tab" data-bs-toggle="tab" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Home">
					<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--secondary-icon);"><path d="M8.99 23H7.93c-1.354 0-2.471 0-3.355-.119-.928-.125-1.747-.396-2.403-1.053-.656-.656-.928-1.475-1.053-2.403C1 18.541 1 17.425 1 16.07v-4.3c0-1.738-.002-2.947.528-4.006.53-1.06 1.497-1.784 2.888-2.826L6.65 3.263c1.114-.835 2.02-1.515 2.815-1.977C10.294.803 11.092.5 12 .5c.908 0 1.707.303 2.537.786.795.462 1.7 1.142 2.815 1.977l2.232 1.675c1.391 1.042 2.359 1.766 2.888 2.826.53 1.059.53 2.268.528 4.006v4.3c0 1.355 0 2.471-.119 3.355-.124.928-.396 1.747-1.052 2.403-.657.657-1.476.928-2.404 1.053-.884.119-2 .119-3.354.119H8.99zM7.8 4.9l-2 1.5C4.15 7.638 3.61 8.074 3.317 8.658 3.025 9.242 3 9.937 3 12v4c0 1.442.002 2.424.101 3.159.095.706.262 1.033.485 1.255.223.223.55.39 1.256.485.734.099 1.716.1 3.158.1V14.5a2.5 2.5 0 0 1 2.5-2.5h3a2.5 2.5 0 0 1 2.5 2.5V21c1.443 0 2.424-.002 3.159-.101.706-.095 1.033-.262 1.255-.485.223-.222.39-.55.485-1.256.099-.734.101-1.716.101-3.158v-4c0-2.063-.025-2.758-.317-3.342-.291-.584-.832-1.02-2.483-2.258l-2-1.5c-1.174-.881-1.987-1.489-2.67-1.886C12.87 2.63 12.425 2.5 12 2.5c-.425 0-.87.13-1.53.514-.682.397-1.495 1.005-2.67 1.886zM14 21v-6.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5V21h4z"></path></svg>
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-reels-tab" data-bs-toggle="tab" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reels">
					<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--secondary-icon);"><path d="M10.996 12.132A1 1 0 0 0 9.5 13v4a1 1 0 0 0 1.496.868l3.5-2a1 1 0 0 0 0-1.736l-3.5-2z"></path><path d="M12.075 1h-.15C9.632 1 7.81 1 6.38 1.192c-1.472.198-2.674.616-3.623 1.565-.949.95-1.367 2.15-1.565 3.623C1 7.81 1 9.632 1 11.925v.15c0 2.293 0 4.116.192 5.545.198 1.472.616 2.674 1.565 3.623.95.949 2.15 1.367 3.623 1.565C7.81 23 9.632 23 11.925 23h.15c2.293 0 4.116 0 5.545-.192 1.472-.198 2.674-.616 3.623-1.565.949-.95 1.367-2.15 1.565-3.623.192-1.43.192-3.252.192-5.545v-.15c0-2.293 0-4.116-.192-5.545-.198-1.472-.616-2.674-1.565-3.623-.95-.949-2.15-1.367-3.623-1.565C16.19 1 14.368 1 12.075 1zM4.172 4.172c.515-.516 1.224-.83 2.475-.998l.183-.023L8.113 7H3.132c.013-.121.027-.239.042-.353.168-1.25.482-1.96.998-2.475zM10.22 7 8.895 3.023C9.778 3 10.801 3 12 3c.642 0 1.234 0 1.78.004L15.114 7H10.22zm6.253 2h4.507c.02.86.02 1.848.02 3 0 2.385-.002 4.074-.174 5.353-.168 1.25-.482 1.96-.998 2.475-.515.516-1.224.83-2.475.998-1.28.172-2.968.174-5.353.174s-4.074-.002-5.353-.174c-1.25-.168-1.96-.482-2.475-.998-.516-.515-.83-1.224-.998-2.475C3.002 16.073 3 14.385 3 12c0-1.152 0-2.14.02-3h13.454zm.747-2-1.316-3.949c.537.026 1.016.065 1.448.123 1.25.168 1.96.482 2.475.998.516.515.83 1.224.998 2.475.015.114.03.232.042.353H17.22z"></path></svg>
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-friends-tab" data-bs-toggle="tab" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Friends">
					<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--secondary-icon);"><path d="M12.496 5a4 4 0 1 1 8 0 4 4 0 0 1-8 0zm4-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-9 2.5a4 4 0 1 0 0 8 4 4 0 0 0 0-8zm-2 4a2 2 0 1 1 4 0 2 2 0 0 1-4 0zM5.5 15a5 5 0 0 0-5 5 3 3 0 0 0 3 3h8.006a3 3 0 0 0 3-3 5 5 0 0 0-5-5H5.5zm-3 5a3 3 0 0 1 3-3h4.006a3 3 0 0 1 3 3 1 1 0 0 1-1 1H3.5a1 1 0 0 1-1-1zm12-9.5a5.04 5.04 0 0 0-.37.014 1 1 0 0 0 .146 1.994c.074-.005.149-.008.224-.008h4.006a3 3 0 0 1 3 3 1 1 0 0 1-1 1h-3.398a1 1 0 1 0 0 2h3.398a3 3 0 0 0 3-3 5 5 0 0 0-5-5H14.5z"></path></svg>
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-group-tab" data-bs-toggle="tab" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Groups">
					<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color:var(--secondary-icon)"><path d="M.5 12c0 6.351 5.149 11.5 11.5 11.5S23.5 18.351 23.5 12 18.351.5 12 .5.5 5.649.5 12zm2 0c0-.682.072-1.348.209-1.99a2 2 0 0 1 0 3.98A9.539 9.539 0 0 1 2.5 12zm.84-3.912A9.502 9.502 0 0 1 12 2.5a9.502 9.502 0 0 1 8.66 5.588 4.001 4.001 0 0 0 0 7.824 9.514 9.514 0 0 1-1.755 2.613A5.002 5.002 0 0 0 14 14.5h-4a5.002 5.002 0 0 0-4.905 4.025 9.515 9.515 0 0 1-1.755-2.613 4.001 4.001 0 0 0 0-7.824zM12 5a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm-2 4a2 2 0 1 0 4 0 2 2 0 0 0-4 0zm11.291 1.01a9.538 9.538 0 0 1 0 3.98 2 2 0 0 1 0-3.98zM16.99 20.087A9.455 9.455 0 0 1 12 21.5c-1.83 0-3.54-.517-4.99-1.414a1.004 1.004 0 0 1-.01-.148V19.5a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v.438a1 1 0 0 1-.01.148z"></path></svg>
				</button>
			</li>
		</ul>
	</div>
	<div id="right_nav">
		<div id="find_friends">
			<button id="find_friend">
				Find friends
			</button>
		</div>
		<div id="facebook_menu" class="navbar-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Groups">
			<svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color:var(--primary-icon)"><path d="M18.5 1A1.5 1.5 0 0 0 17 2.5v3A1.5 1.5 0 0 0 18.5 7h3A1.5 1.5 0 0 0 23 5.5v-3A1.5 1.5 0 0 0 21.5 1h-3zm0 8a1.5 1.5 0 0 0-1.5 1.5v3a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5v-3A1.5 1.5 0 0 0 21.5 9h-3zm-16 8A1.5 1.5 0 0 0 1 18.5v3A1.5 1.5 0 0 0 2.5 23h3A1.5 1.5 0 0 0 7 21.5v-3A1.5 1.5 0 0 0 5.5 17h-3zm8 0A1.5 1.5 0 0 0 9 18.5v3a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5v-3a1.5 1.5 0 0 0-1.5-1.5h-3zm8 0a1.5 1.5 0 0 0-1.5 1.5v3a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5v-3a1.5 1.5 0 0 0-1.5-1.5h-3zm-16-8A1.5 1.5 0 0 0 1 10.5v3A1.5 1.5 0 0 0 2.5 15h3A1.5 1.5 0 0 0 7 13.5v-3A1.5 1.5 0 0 0 5.5 9h-3zm0-8A1.5 1.5 0 0 0 1 2.5v3A1.5 1.5 0 0 0 2.5 7h3A1.5 1.5 0 0 0 7 5.5v-3A1.5 1.5 0 0 0 5.5 1h-3zm8 0A1.5 1.5 0 0 0 9 2.5v3A1.5 1.5 0 0 0 10.5 7h3A1.5 1.5 0 0 0 15 5.5v-3A1.5 1.5 0 0 0 13.5 1h-3zm0 8A1.5 1.5 0 0 0 9 10.5v3a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5v-3A1.5 1.5 0 0 0 13.5 9h-3z"></path></svg>
		</div>
		<div id="messanger" class="navbar-icon">
			<svg viewBox="0 0 16 16" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color:var(--primary-icon)"><path fill-rule="evenodd" d="M.5 8a7.5 7.5 0 1 1 4.006 6.638.341.341 0 0 0-.236-.041l-2.193.534A1 1 0 0 1 .87 13.923l.534-2.193a.341.341 0 0 0-.04-.236A7.47 7.47 0 0 1 .5 8zm11.389-.907a.56.56 0 0 0-.79-.78L9.25 7.75 7.294 6.327a1 1 0 0 0-1.386.205L4.111 8.906a.56.56 0 0 0 .791.781L6.75 8.25l1.957 1.423a1 1 0 0 0 1.385-.205l1.797-2.375z" clip-rule="evenodd"></path></svg>
		</div>
		<div id="notifications" class="navbar-icon">
			<span class="html-span xdj266r x14z9mp xat24cr x1lziwak xexx8yu xyri2b x18d9i69 x1c1uobl x1hl2dhg x16tdsg8 x1vvkbs x4k7w5x x1h91t0o x1h9r5lt x1jfb8zj xv2umb2 x1beo9mf xaigb6o x12ejxvf x3igimt xarpa2k xedcshv x1lytzrv x1t2pt76 x7ja8zs x1qrby5j">
				<span>
					<div>
						<div aria-expanded="false" aria-haspopup="dialog" aria-label="Notifications, 2 unread" class="x1i10hfl xjqpnuy xc5r6h4 xqeqjp1 x1phubyo x13fuv20 x18b5jzi x1q0q8m5 x1t7ytsu x1ypdohk xdl72j9 x2lah0s x3ct3a4 xdj266r x14z9mp xat24cr x1lziwak x2lwn1j xeuugli x16tdsg8 x1hl2dhg xggy1nq x1ja2u2z x1t137rt x1q0g3np x87ps6o x1lku1pv x1a2a7pz x6s0dn4 x1iwo8zk x1033uif x179ill4 x1b60jn0 x972fbf x10w94by x1qhh985 x14e42zd x9f619 x78zum5 xl56j7k xexx8yu xyri2b x18d9i69 x1c1uobl x1n2onr6 x1vqgdyp x100vrsf x1qhmfi1" role="button" tabindex="0">
							<svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color:var(--primary-icon)">
								<path d="M3 9.5a9 9 0 1 1 18 0v2.927c0 1.69.475 3.345 1.37 4.778a1.5 1.5 0 0 1-1.272 2.295h-4.625a4.5 4.5 0 0 1-8.946 0H2.902a1.5 1.5 0 0 1-1.272-2.295A9.01 9.01 0 0 0 3 12.43V9.5zm6.55 10a2.5 2.5 0 0 0 4.9 0h-4.9z">

								</path>
							</svg>
							<div class="x1ey2m1c xtijo5x x1o0tod xg01cxk x47corl x10l6tqk x13vifvy x1ebt8du x19991ni x1dhq9h x1iwo8zk x1033uif x179ill4 x1b60jn0" role="none" data-visualcompletion="ignore" style="inset: 0px;">

							</div>
						</div>
						<!--$-->
						<div aria-expanded="false" aria-haspopup="dialog" aria-hidden="true" aria-label="Notifications, 2 unread" class="x1i10hfl x1qjc9v5 xjbqb8w xjqpnuy xc5r6h4 xqeqjp1 x1phubyo x13fuv20 x18b5jzi x1q0q8m5 x1t7ytsu x972fbf x10w94by x1qhh985 x14e42zd x9f619 x1ypdohk xdl72j9 x2lah0s x3ct3a4 xdj266r x14z9mp xat24cr x1lziwak x2lwn1j xeuugli xexx8yu xyri2b x18d9i69 x1c1uobl x16tdsg8 x1hl2dhg xggy1nq x1t137rt x1fmog5m xu25z0z x140muxe xo1y3bh x3nfvp2 x1q0g3np x87ps6o x1lku1pv x1a2a7pz x10l6tqk x1vjfegm x1pe450p xtu2xtp" role="button" tabindex="-1">
							<!--$-->
							<span class="html-span xdj266r x14z9mp xat24cr x1lziwak xexx8yu xyri2b x18d9i69 x1c1uobl x1hl2dhg x16tdsg8 x1vvkbs x1iwo8zk x1033uif x179ill4 x1b60jn0 x3nfvp2 x1nxh6w3 xk50ysn xhvdbge xo5v014 xnyloks xdi0jry">
							</span>
							<!--/$-->
							<div class="x1ey2m1c xtijo5x x1o0tod xg01cxk x47corl x10l6tqk x13vifvy x1ebt8du x19991ni x1dhq9h x1iwo8zk x1033uif x179ill4 x1b60jn0" role="none" data-visualcompletion="ignore">
							</div>
						</div>
						<!--/$-->
					</div>
				</span>
			</span>
		</div>
		<div id="my-profile">
			<?php echo "<img id='account_image' src='../images/".$profil."'alt='img loading..' > "?>
		</div>
		<div id="profile_card">
			<div>
				<div class="upper">
					<a href="profile.php?id=<?php echo (int)$id; ?>">
						<div id="profile_card_profile">
							<div>
								<?php echo "<img id='account_image' src='../images/".$profil."'alt='img loading..' > "?>
							</div>
							<div>
								<?php echo htmlspecialchars($name); ?>
							</div>
						</div>
					</a>
					<hr>
					<div id="see_more_profile">
						<div>
							<svg viewBox="0 0 16 16" width="16" height="16" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--primary-icon);"><path d="M8 .5a7.498 7.498 0 0 0-6.575 3.888.75.75 0 1 0 1.315.724A6.003 6.003 0 0 1 13.812 6.5h-.562a.75.75 0 0 0-.53 1.28l1.5 1.5a.75.75 0 0 0 1.28-.53V8A7.501 7.501 0 0 0 8 .5zM1.78 6.72a.75.75 0 0 0-1.28.53V8a7.501 7.501 0 0 0 14.075 3.612.75.75 0 0 0-1.314-.724c-.232.42-.511.81-.832 1.16A3.52 3.52 0 0 0 9.23 10H6.769a3.52 3.52 0 0 0-3.198 2.048A5.986 5.986 0 0 1 2.19 9.5h.561a.75.75 0 0 0 .53-1.28l-1.5-1.5z"></path><path d="M5.5 6.5a2.5 2.5 0 1 1 5 0 2.5 2.5 0 0 1-5 0z"></path></svg>
						</div>
						<span>
							See all profiles
						</span>
					</div>
				</div>
			</div>
			<div>
				<div class="lower">
					<div class="l_tab">
						<div><div class="html-div xdj266r x14z9mp xat24cr x1lziwak xexx8yu xyri2b x18d9i69 x1c1uobl x1c9tyrk xeusxvb x1pahc9y x1ertn4p x6s0dn4 x972fbf x10w94by x1qhh985 x14e42zd x9f619 x3nfvp2 xl56j7k x1n2onr6 x1qhmfi1 xc9qbxq x14qfxbe"><svg viewBox="0 0 20 20" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--primary-icon);"><path d="M7.5 10a2.5 2.5 0 1 1 5 0 2.5 2.5 0 0 1-5 0z"></path><path d="M17.773 8.983a1.748 1.748 0 0 0 0 2.034v-.001l.949 1.328c.302.423.31.988.023 1.42l-1.387 2.081a1.25 1.25 0 0 1-1.195.547l-1.235-.154a1.75 1.75 0 0 0-1.856 1.122l-.498 1.328a1.25 1.25 0 0 1-1.17.811H8.597a1.25 1.25 0 0 1-1.17-.811l-.476-1.269a1.75 1.75 0 0 0-1.91-1.115l-1.165.182a1.248 1.248 0 0 1-1.246-.561L1.238 13.75a1.25 1.25 0 0 1 .036-1.4l.934-1.307a1.75 1.75 0 0 0-.018-2.059l-.904-1.22a1.249 1.249 0 0 1-.06-1.399l1.398-2.272a1.25 1.25 0 0 1 1.258-.58l1.16.181A1.75 1.75 0 0 0 6.95 2.579l.476-1.269a1.25 1.25 0 0 1 1.17-.811h2.807c.52 0 .987.323 1.17.811l.498 1.328a1.752 1.752 0 0 0 1.856 1.122l1.235-.154a1.25 1.25 0 0 1 1.195.547l1.387 2.081a1.25 1.25 0 0 1-.023 1.42l-.95 1.329zM10 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"></path></svg></div></div>
						<span>
							Settings & privacy
						</span>
						<div class="moree x9f619 x1n2onr6 x1ja2u2z xdt5ytf x2lah0s x193iq5w xeuugli x78zum5 x1yrsyyn x1icxu4v x10b6aqq x25sj25"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--secondary-icon);"><path d="M8.116 3.116a1.25 1.25 0 0 1 1.768 0c.887.887 1.777 1.774 2.668 2.662 1.429 1.425 2.86 2.852 4.283 4.282a2.747 2.747 0 0 1-.005 3.88 8169.154 8169.154 0 0 1-6.946 6.944 1.25 1.25 0 0 1-1.768-1.768l2.683-2.681 4.263-4.263a.247.247 0 0 0 0-.349c-1.42-1.427-2.844-2.847-4.27-4.268a2473.35 2473.35 0 0 1-2.676-2.671 1.25 1.25 0 0 1 0-1.768z"></path></svg></div>
					</div>
					<div class="l_tab">
						<div><div class="html-div xdj266r x14z9mp xat24cr x1lziwak xexx8yu xyri2b x18d9i69 x1c1uobl x1c9tyrk xeusxvb x1pahc9y x1ertn4p x6s0dn4 x972fbf x10w94by x1qhh985 x14e42zd x9f619 x3nfvp2 xl56j7k x1n2onr6 x1qhmfi1 xc9qbxq x14qfxbe"><svg viewBox="0 0 20 20" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--primary-icon);"><path d="M10 .5a9.5 9.5 0 1 0 0 19 9.5 9.5 0 0 0 0-19zm0 4.996a2 2 0 0 0-2 2 .75.75 0 1 1-1.5 0 3.5 3.5 0 1 1 5.179 3.072c-.282.154-.53.34-.7.538-.166.194-.229.364-.229.515v.625a.75.75 0 0 1-1.5 0v-.625c0-.608.264-1.111.59-1.492a4.02 4.02 0 0 1 1.119-.877A2 2 0 0 0 10 5.496zm.001 10.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path></svg></div></div>
						<span>
							Help & support
						</span>
						<div class="moree x9f619 x1n2onr6 x1ja2u2z xdt5ytf x2lah0s x193iq5w xeuugli x78zum5 x1yrsyyn x1icxu4v x10b6aqq x25sj25"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--secondary-icon);"><path d="M8.116 3.116a1.25 1.25 0 0 1 1.768 0c.887.887 1.777 1.774 2.668 2.662 1.429 1.425 2.86 2.852 4.283 4.282a2.747 2.747 0 0 1-.005 3.88 8169.154 8169.154 0 0 1-6.946 6.944 1.25 1.25 0 0 1-1.768-1.768l2.683-2.681 4.263-4.263a.247.247 0 0 0 0-.349c-1.42-1.427-2.844-2.847-4.27-4.268a2473.35 2473.35 0 0 1-2.676-2.671 1.25 1.25 0 0 1 0-1.768z"></path></svg></div>
					</div>
					<div class="l_tab">
						<div><div class="html-div xdj266r x14z9mp xat24cr x1lziwak xexx8yu xyri2b x18d9i69 x1c1uobl x1c9tyrk xeusxvb x1pahc9y x1ertn4p x6s0dn4 x972fbf x10w94by x1qhh985 x14e42zd x9f619 x3nfvp2 xl56j7k x1n2onr6 x1qhmfi1 xc9qbxq x14qfxbe"><svg viewBox="0 0 20 20" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--primary-icon);"><path d="M.544 18.788c.044.302.169.795.673 1.033.503.238.964.02 1.225-.137.26-.158.561-.406.881-.67l2.1-1.729c.144-.119.225-.185.289-.23a.601.601 0 0 1 .061-.04h.003s.003-.002.008-.002a.61.61 0 0 1 .064-.007C5.926 17 6.03 17 6.218 17h6.587c1.367 0 2.47 0 3.337-.116.9-.122 1.658-.38 2.26-.982.602-.602.86-1.36.982-2.26.116-.867.116-1.97.116-3.337V8.696c0-1.367 0-2.47-.116-3.337-.122-.9-.38-1.658-.982-2.26-.602-.601-1.36-.86-2.26-.981C15.275 2 14.172 2 12.805 2h-5.61c-1.367 0-2.47 0-3.336.116-.9.12-1.659.38-2.26.982-.603.601-.861 1.36-.982 2.26C.5 6.226.5 7.328.5 8.696v8.986c0 .415 0 .805.044 1.106zM10 5.001a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5a.75.75 0 0 1 .75-.75zM10 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path></svg></div></div>
						<div id="ctrl">
							<span>
								Report a problem
							</span>
							<span>
								CTRL B
							</span>
						</div> 
					</div>
					<div class="l_tab">
						<div><div class="html-div xdj266r x14z9mp xat24cr x1lziwak xexx8yu xyri2b x18d9i69 x1c1uobl x1c9tyrk xeusxvb x1pahc9y x1ertn4p x6s0dn4 x972fbf x10w94by x1qhh985 x14e42zd x9f619 x3nfvp2 xl56j7k x1n2onr6 x1qhmfi1 xc9qbxq x14qfxbe"><svg viewBox="0 0 20 20" width="20" height="20" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--primary-icon);"><path d="M10.293 1.691A.75.75 0 0 0 9.66.501a9.503 9.503 0 0 0 .343 19c4.594-.001 8.426-3.26 9.31-7.593a.75.75 0 0 0-1.07-.822 6.336 6.336 0 0 1-7.95-9.395z"></path></svg></div></div>
						<span>
							Display & accessibility
						</span>
						<div class="moree x9f619 x1n2onr6 x1ja2u2z xdt5ytf x2lah0s x193iq5w xeuugli x78zum5 x1yrsyyn x1icxu4v x10b6aqq x25sj25"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" aria-hidden="true" class="x14rh7hd x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="--x-color: var(--secondary-icon);"><path d="M8.116 3.116a1.25 1.25 0 0 1 1.768 0c.887.887 1.777 1.774 2.668 2.662 1.429 1.425 2.86 2.852 4.283 4.282a2.747 2.747 0 0 1-.005 3.88 8169.154 8169.154 0 0 1-6.946 6.944 1.25 1.25 0 0 1-1.768-1.768l2.683-2.681 4.263-4.263a.247.247 0 0 0 0-.349c-1.42-1.427-2.844-2.847-4.27-4.268a2473.35 2473.35 0 0 1-2.676-2.671 1.25 1.25 0 0 1 0-1.768z"></path></svg></div>
					</div>
					<a href="logout.php" id="logout" class="logout-link">
						<div class="l_tab" >
							<div><div class="html-div xdj266r x14z9mp xat24cr x1lziwak xexx8yu xyri2b x18d9i69 x1c1uobl x1c9tyrk xeusxvb x1pahc9y x1ertn4p x6s0dn4 x972fbf x10w94by x1qhh985 x14e42zd x9f619 x3nfvp2 xl56j7k x1n2onr6 x1qhmfi1 xc9qbxq x14qfxbe"><i data-visualcompletion="css-img" class="x15mokao x1ga7v0g x16uus16 xbiv7yw x1b0d499 xep6ejk" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/yj/r/x2uoYM0kyMM.webp&quot;); background-position: 0px -130px; background-size: auto; width: 20px; height: 20px; background-repeat: no-repeat; display: inline-block;"></i></div></div>
						<span>
							Log out
						</span>
					</div></a>
					<div id="policy">
						<?php require_once "footer.php" ?>
					</div>
				</div>
			</div>
		</div>
	</div> 
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</div>

