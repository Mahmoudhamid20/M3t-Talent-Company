<?php 
session_start(); 
$msgs=[]; 
if (!isset($_SESSION["results"])) {
    $msgs[] = "You need to be logged in to see this page"; 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <?php 
    if(count($msgs) > 0){
        foreach ($msgs as $msg) {
            echo $msg;
        }
        exit;
    }else{
        echo "Hello {$_SESSION['user']}";
    }

    ?>
    
</body>
</html>