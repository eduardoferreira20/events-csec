<?php

if(isset($_FILES['upload']['name']))
{

	$file = $_FILES['upload']['tmp_name'];
	$file_name = $FILES['upload']['name'];
	$file-name_array = explode(".",$files_name);
	$extension = end($file_name_array);
	$new_image_name = rand().'.'.$extension;
	chmod('resources/views/', 0777);
	$allowed_extension = array("jpg","gif","png","pdf","jpeg");

	if(in_array($extension,$allowed_extension)){

		move_uploaded_file($file,'resources/views/'.$new_image_name);
		$function_number = $_GET['CKEditorFuncNum'];
		$url = 'upload/'.$new_image_name;
	}
}



?>