<?php

//The name of the folder.

//Get a list of all of the file names in the folder.
$file = $_GET['file'];

if(is_file($file)){
        //Use the unlink function to delete the file.
	unlink($file);

}else{
	echo "file doiesnt exuitst";
	echo $file;
}
header("Location: index.php");