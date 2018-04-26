<?php
if (isset($_GET['download'])) {
	clearstatcache();

	$filename = './public/uploads/user_' . $_GET['user_id'] . '/' . $_GET['filename'];
	$data = file_get_contents($filename);

	$fsize = filesize($filename);
	$path_parts = pathinfo($filename);
	$ext = $path_parts['extension'];
	$file_name  = $path_parts['basename'];

	if ($ext == 'txt') {
		$ctype = 'plain/text';
	}
	else {
		$ctype = 'application/pdf';
	}

	header("Pragma: public");
	header("Expires: -1");
	header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");


	header("Content-Disposition: attachment; filename=\"$file_name\"");
	header("Content-type: " . $ctype);
	header('Content-Length: ' . $fsize);

	echo $data;
	exit;
}
?>