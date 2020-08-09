<?php
$title = "Upload new image";

$content = '<form action="" method="post" enctype="multipart/form-data">
                <label fro="file">Filename: </label>
                <input type="file" name="file" id="file"><br/>
                <input type="submit" name="submit" value="Submit">
            </form>';

if(isset($_POST["submit"])) {
    //Check file format
    $fileType = $_FILES["file"]["type"];

    if (($fileType == "image/gif") ||
        ($fileType == "image/jpeg") ||
        ($fileType == "image/jpg") ||
        ($fileType == "image/png")) {
            
            //Check if file exists
            if (file_exists("Image/Coffee/" . $_FILES["file"]["name"])) {
                echo "File already exists";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], "Images/Coffee/" . $_FILES["file"]["name"]);
                echo "Upload in " . "Images/Coffee/" . $_FILES["file"]["name"];
            }
    }
}

include './template.php';
?>
