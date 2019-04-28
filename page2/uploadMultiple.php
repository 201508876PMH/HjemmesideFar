<?php
if(isset($_POST['submit'])){

	$fileTypes = ["png", "jpg", "jpeg", "pdf", "gif", "mov", "mp4"];
	$target_dir = "uploads/";
	$error = 0;

 	// Count total files
	$countfiles = count($_FILES['file']['name']);

 	// Looping all files
	for($i=0;$i<$countfiles;$i++){
		$filename = $_FILES['file']['name'][$i];

		$target_file = $target_dir . basename($_FILES["file"]["name"][$i]);
		$uploadOk = 1;

		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		// Check if file already exists
		if (file_exists($target_file)) {
			display_error("Sorry, file already exists.");
		}
		// Check file size
		if ($_FILES["file"]["size"][$i] > 20000000000) {
			display_error("Sorry, your file is too large.");
		}

		// Allow certain file formats
		if(!in_array(strtolower($imageFileType), $fileTypes)) {
			display_error("Sorry, only JPG, JPEG, PNG, PDF & GIF files are allowed.");
		}

		// if everything is ok, try to upload file
		move_uploaded_file($_FILES['file']['tmp_name'][$i], 'uploads/' . $filename);
	}
} else {

}

function display_error($message) {
	header('HTTP/1.0 500 Internal Server Error');
	die($message);
}
?>
