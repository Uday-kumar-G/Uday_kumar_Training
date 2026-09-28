<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update Profile</title>
	<link rel="stylesheet" href="update.css">
</head>
<body>

	
	<br><br>
	<?php
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
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
		if (!isset($_GET["id"])){
			die("User ID not specified.");
		}
		$id = $_GET["id"];
		$sql = "SELECT NAME, EMAIL, ADDRESS, PHONE
		FROM USER
		WHERE USER_ID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();
	?>
	<button class="my-home">
		<a href="home.php?id=<?php echo $id; ?>">HOME</a>
	</button>
	<br>
	<h3 class="my-form-title">Update your profile</h3>
	<br>
	<form class="update-form" action="update.php?id=<?php echo $id; ?>" method="post">
		name:- <input type="text" name="name" id="" required value="<?php echo $user["NAME"]; ?>"><br><br>
		email:- <input type="email" name="email" id="" required value="<?php echo $user["EMAIL"]; ?>"><br><br>
		password:- <input type="password" name="password" id="password" required >
		<button type="button" onclick="togglePassword()">
			Show / Hide
		</button>
		<br><br>
		address:- <input type="text" name="address" id="" required value="<?php echo $user["ADDRESS"]; ?>"><br><br>
		phone:- <input type="text" name="phone" id="" required value="<?php echo $user["PHONE"]; ?>"><br><br>
		<button type="submit">Update</button><br><br>
	</form>
	<?php
	

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$name = $_POST["name"];
			$email = $_POST["email"];
			$n_password = $_POST["password"];
			$address = $_POST["address"];
			$phone = $_POST["phone"];
			$sql = "UPDATE USER
					SET NAME=?,
					EMAIL=?,
					PASSWORD=?,
					ADDRESS=?,
					PHONE=?
				WHERE USER_ID=?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("sssssi", $name, $email, $n_password, $address, $phone, $id);
			if ($stmt->execute()) {
				if ($stmt->affected_rows > 0) {
					echo "PROFILE UPDATED successfully";
				} 
				else {
					echo "No changes made or user not found";
				}
			} else {
				echo "Error: " . $stmt->error;
			}
		}    
	?>
	<br>
	<br>
	<a id="back-to-profile" href="profile.php?id=1">
	Back to Profile
	</a>
<script>
function togglePassword() {

	let password = document.getElementById("password");

	if (password.type === "password") {
		password.type = "text";
	} else {
		password.type = "password";
	}
}
</script>
</body>
</html>
