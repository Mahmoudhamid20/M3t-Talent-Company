<?php 
session_start();
$msgs = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!$user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS)) {
        $msgs[] = "Invalid username or no username given";
    }

    if (!$pass = filter_input(INPUT_POST, "pass")) {
        $msgs[] = "Invalid password";
    }

    if (count($msgs) == 0) {
        require_once("dbconnect.php");
        
        if ($db_handler) {
            try {
                $stmt = $db_handler->prepare("SELECT * 
                                            FROM `users` 
                                            WHERE `username` = :user");
                $stmt->bindParam(":user", $user, PDO::PARAM_STR); 
                $stmt->execute();
                
                $results = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($results && password_verify($pass, $results["hashedpass"])) {
                    $_SESSION["user"] = $results["username"]; // Set the "user" key in the session
                    $_SESSION["results"] = $results;
                    header("location: profile.php");
                    exit();
                } else {
                    $msgs[] = "Failed to log in";
                }
            } catch (Exception $ex) {
                $msgs[] = "Error: " . $ex->getMessage();
            }
        }
    }
}

if (count($msgs) > 0) {
    foreach ($msgs as $msg) {
        echo $msg;
    }
}
?>
