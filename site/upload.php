<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_SESSION['user'])) {
			$username = $_SESSION['user'];
			$file = $_FILES["file"];
			$filename = $file["name"];
			$basename = basename($filename);
			if ($file["size"] < 500000 && preg_match('/^[\w_\.\-]+$/', $basename)) {
				$link = "../../FileManagement/users/$username/$filename";			
				if (!file_exists($link)) {
					move_uploaded_file($file["tmp_name"], $link);
					$_SESSION['success'] = "File uploaded successfully";
					header('Location: home.php');
					exit();
				}
			}
		}
	}
	$_SESSION['error'] = "Cannot upload file";
	header('Location: login.php');
	exit();
	
?>

