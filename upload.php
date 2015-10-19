<?php
/**
 * Created by PhpStorm.
 * User: Don
 * Date: 5/20/2015
 * Time: 1:57 PM
 */

define("UPLOAD_DIR", "./uploads/");
// show upload form
//if ($_SERVER["REQUEST_METHOD"] == "GET") {
//    ?>
<!--    <em>Only GIF, JPG, and PNG files are allowed.</em>-->
<!--    <form action="upload.php" method="post" enctype="multipart/form-data">-->
<!--        <input type="file" name="myFile"/>-->
<!--        <br/>-->
<!--        <input type="submit" value="Upload"/>-->
<!--    </form>-->
<?php
//}
// process file upload
//else if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["myFile"])) {
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];      //when POST + the form input type is file, the predefined variable
                                      //$_FILES array can be used. It contains data on the uploaded file.
                                      //Filename, MIME type, size, files temporary location, and error code.
    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }
    // verify the file type
    $fileType = exif_imagetype($_FILES["myFile"]["tmp_name"]); //exif_imagetype() to examine the contents of
                                                     //the file and determine if it is indeed a GIF, JPEG
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    if (!in_array($fileType, $allowed)) {    //in_array checks if the filetype is in the allowed type array
        echo "<p>File type is not permitted.</p>";
        exit;
    }
    // ensure a safe filename, by removing any characters that can affect the destination path, such as a slash
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);    //uses regex to remove harmful characters
    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);     //pathinfo gets the dirname, basename(filename with extension),
                                  //extension (if any), and filename.
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                     //if the file name is already there, add a number to it.
    }
    //move the temporary file and rename it at the same time
    $success = move_uploaded_file($myFile["tmp_name"], UPLOAD_DIR . $name);
    //move_uploaded_file() performs additional checks to ensure the file was indeed uploaded
    //by the HTTP POST request, so always use it over copy() or move().
    if (!$success) {
        echo "<p>Unable to save file.</p>";
        exit;
    }
    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $name, 0644);    //0644 owner rw, group r, world r permissions
    echo "<p>Uploaded file saved as " . $name . ".</p>";
}