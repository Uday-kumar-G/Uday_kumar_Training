<?php
    require_once "database.php";
    $post = $_POST["post"];
    $sql = "INSERT INTO 
                WALL (USER_ID, POSTING_DATE, POST)
            VALUES 
                (1, NOW(), ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param("s", $post);
    if ($statement->execute() and strlen($post) > 0) {
        echo 1;
    }
    else {
        echo 0;
    }
    $conn->close();
?>
