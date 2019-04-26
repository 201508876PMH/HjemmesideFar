<?php 
if(isset($_POST['submit'])){

 // Count total files
	$countfiles = count($_FILES['file']['name']);

 // Looping all files
	for($i=0;$i<$countfiles;$i++){
		$filename = $_FILES['file']['name'][$i];

		$target_dir = "uploads/";
		$error = 0;
		$target_file = $target_dir . basename($_FILES["file"]["name"][$i]);
		$uploadOk = 1;

		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

		$check = getimagesize($_FILES["file"]["tmp_name"][$i]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$error = 1;
			$uploadOk = 0;
		}
		
// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$error = 2;
			$uploadOk = 0;
		}
// Check file size
		if ($_FILES["file"]["size"][$i] > 20000000) {
			echo "Sorry, your file is too large.";
			$error = 3;
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif") {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$error = 4;
			$uploadOk = 0;
		}
// if everything is ok, try to upload file
		if($error == 0) {
		  	// Upload file
			move_uploaded_file($_FILES['file']['tmp_name'][$i],'uploads/'.$filename);
		}
	}
}
$errorCode = $error == 0 ? "?err=$error" : "";
header("Location: index.php?err=" . $error);
?>