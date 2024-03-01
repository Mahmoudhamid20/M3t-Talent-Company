
<!DOCTYPE html>
<html>
<body>
<?php 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errorOccured = false;
    $targetDir = 'uploads2/';
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);

    $fileExtension = pathinfo($_FILES["fileToUpload"]["full_path"])["extension"];
    if (file_exists($targetFile)) {
      $errorOccured = true;
      echo "</br>file already exists";
    }
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      $errorOccured = true;
      echo "</br>file is too big";
    }

    if (
      $fileExtension != "jpg" &&
      $fileExtension != "jpeg" &&
      $fileExtension != "png" &&
      $fileExtension != "gif"
    ) {
      $errorOccured = true;
      echo "</br>file extension is not supported";
      echo '</br> Your file extension is ' + $fileExtension;
    }

    if ($errorOccured) {
      echo "</br>Sorry, your file was not uplaoded";
    } else {

      try {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile);
        echo "</br>file was uploaded";
      } catch (Exception $e) {
        echo "</br>Error";
        echo $e->getMessage();
      }
    }
  }
?>

<form action="" method="post" enctype="multipart/form-data">

</form>
<form action="fileUpload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
  <a href="getFiles.php">Look at the uploaded files</a>
</form>

</body>
</html>
