<?php

require('func.php');

if(isset($_GET['vid'])){
	$link = $_GET['link'];
	$list_anime = list_anime_py($link);
	echo json_encode($list_anime);
}

function list_anime_py($url){
	$a = @file_get_contents("https://jstreamsapi.herokuapp.com/get_video/$url");
	$error = '';
	$b = "<video controls class=\"idframe\" src=\"$a\"></video>";
	
	if($a === FALSE){
		$a="";
		$b="";
		$error = error_get_last();
		$error['penyakit'] = d_url($url);
	}

	return array(
					"video" => $b,
					"error" => $error
					);
}
?>


