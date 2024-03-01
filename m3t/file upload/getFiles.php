
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1 class="title"><a href="fileUpload.php">Go to the file upload</a></h1>
</body>
</html>

<?php
    $files = scandir("./uploads2");

    foreach ($files as $file) {
        $fileExtension = pathinfo($file)["extension"];
        if (
            $fileExtension != "jpg" &&
            $fileExtension != "jpeg" &&
            $fileExtension != "png" &&
            $fileExtension != "gif"
        ){
            echo $fileExtension;
        } else {
            echo "<img src='./uploads2/".$file."' alt='".$file."' class='image'>";
        }
    }
?>