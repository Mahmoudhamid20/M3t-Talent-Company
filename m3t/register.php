<?php
$msgs = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!$user = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
        $msgs[] = "Invalid username or no username given";
    }

    if (!$pass = filter_input(INPUT_POST, "password")) {
        $msgs[] = "No password given";
    }

    if (count($msgs) == 0) {
        require_once("dbconnect.php"); // Make sure this file exists and contains your database connection logic

        if ($db_handler) {
            try {
                $stmt = $db_handler->prepare("INSERT INTO `users`(`id`, `username`, `hashedpass`) 
                                VALUES(NULL ,:user, :pass)"
                );
                $stmt->bindParam(":user", $user, PDO::PARAM_STR);
                $password = password_hash($pass, PASSWORD_BCRYPT);
                $stmt->bindParam(":pass", $password, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msgs[] = "Error: " . $ex->getMessage(); // Display error message
            }
        }
        if ($stmt && $stmt->rowCount() == 1) {
            $msgs[] = "Registration successful";
        } else {
            $msgs[] = "Registration failed. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login please</title>
</head>

<body>
    <h1>Register</h1>
    <?php
    if (count($msgs) > 0) {
        foreach ($msgs as $msg) {
            echo "<p>" . $msg . "</p>";
        }
    }
    ?>
    <form action="" method="post">
        <table>
            <tr>
                <td>
                    Username:
                </td>
                <td>
                    <input type="text" name="username" />
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="password" />
                </td>
            </tr>
        </table>
        <div></div>
        <input type="submit" name="submit">
    </form>
    <a href="login.php">Go back to login page</a>
</body>

</html>
