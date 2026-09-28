<?php
    $servername = "localhost";
    $username = "uday";
    $password = "Root@1234";
    $dbname = "FACEBOOK";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>