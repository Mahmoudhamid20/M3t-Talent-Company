<?php
$target_dir = "uploads/";
$uploadOk = 1;

if(isset($_POST["submit"])) {
    $uniqid = uniqid();
    $baseName = basename($_FILES["fileToUpload"]["name"]);

    echo "Target Dir: $target_dir<br>";
    echo "Uniqid: $uniqid<br>";
    echo "Base Name: $baseName<br>";

    $target_file = $target_dir . $uniqid . "_" . $baseName;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (500KB limit)
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = array("jpg", "jpeg", "png", "gif");
    if(!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Attempt to upload file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($target_file)). " has been uploaded.";
            // You can perform additional actions here if the upload was successful
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
