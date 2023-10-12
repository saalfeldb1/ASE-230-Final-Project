<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["image"])) {
        $uploadsDirectory = "uploads/"; // Destination directory
        $tempFile = $_FILES["image"]["tmp_name"]; // Temporary file location
        $targetFile = $uploadsDirectory . basename($_FILES["image"]["name"]); // Target location

        if (move_uploaded_file($tempFile, $targetFile)) {
            // File uploaded successfully
            echo "Image uploaded and copied to $uploadsDirectory.";
        } else {
            // Error handling for failed upload
            echo "Error uploading the image.";
        }
    }
}
?>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" required>
    <input type="submit" value="Upload Image">
</form>
