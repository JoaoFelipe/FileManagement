<!DOCTYPE html>
<html>
<head>
	<title>File Management - Login</title>
</head>
<body>
<?php
	$usersfile = "../../FileManagement/users.txt";
	session_start();
	if (isset($_SESSION['user'])) {
		header('Location: home.php');
		exit();
	}
	if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {
   		echo '<span class="error">'.$_SESSION['error'].'</span>';
   		unset($_SESSION['error']);
	}
	if (isset($_POST['username'])) {
		$login = $_POST["username"];		
		if ($login == "") {
			echo '<span class="error">Empty username</span>';
		} else {
			$found = false;
			$fh = fopen($usersfile, 'r');
			while(! feof($fh)) {
				$line = str_replace("\n", "", fgets($fh));
				if ($login == $line) {
					$found = true;
				} 
  			}
			fclose($fh);
			if (isset($_REQUEST['login'])) {
				if (!$found) {
					echo '<span class="error">Username not found</span>';
				} else {
					$_SESSION['user'] = $login;
					header('Location: home.php');
					exit();
				}
			} else {
				if ($found) {
                                        echo '<span class="error">Username already in use</span>';
                                } else {
					$fh = fopen($usersfile, "a+");
					$size = filesize($usersfile);
					fread($fh, $size);
					fwrite($fh, "\n".$login);
					fclose($fh);
					mkdir("users/$login", 0777);
                                        $_SESSION['user'] = $login;
                                        header('Location: home.php');
                                        exit();
                                }

			}
		}
	} 
?>
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
		<p>
			<label for="username">Username:</label>
			<input type="text" name="username" id="username"/>
		</p>
		<p>
			<input type="submit" name="login" value="Login"/>
			<input type="submit" name="signup" value="Sign up"/>
		</p>
	</form>

</body>
</html>

