<?php

$db = mysqli_connect("localhost", "root", "", "crud_oop");

if (isset($_POST['upload'])) {
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "uploads/" . $filename; 

    
    $sql = "INSERT INTO files (filename) VALUES ('$filename')";
    mysqli_query($db, $sql);

    
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>File uploaded successfully!</h3>";
    } else {
        echo "<h3>Failed to upload file!</h3>";
    }
}
?>


