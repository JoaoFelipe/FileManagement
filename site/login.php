<?php
        $title = "Login";
        $redirect = "home.php";
	$user_logged = false; 
        $elements_by_page = 20;
        include "header.php";
?>
<?php
	include "functions.php";
	$usersfile = "../../FileManagement/users.txt";
	if (isset($_POST['username'])) {
		$login = $_POST["username"];		
		if ($login == "") {
			echo '<div class="error" id="Login">Empty username</div>';
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
					echo '<div class="error" id="Login">Username not found</div>';
				} else {
					$_SESSION['user'] = $login;
					$_SESSION['token'] = random_token();
					header('Location: home.php');
					exit();
				}
			} else {
				if ($found) {
                                        echo '<div class="error" id="Login">Username already in use</div>';
                                } else if (!preg_match('/^[\w_\-]+$/', $login)) {
					echo '<div class="error" id="Login">Invalid username</div>';

				} else {
					$fh = fopen($usersfile, "a+");
					$size = filesize($usersfile);
					fread($fh, $size);
					fwrite($fh, "\n".$login);
					fclose($fh);
					mkdir("../../FileManagement/users/$login", 0777);
                                        $_SESSION['user'] = $login;
					$_SESSION['token'] = random_token();
                                        header('Location: home.php');
                                        exit();
                                }

			}
		}
	} 
?>
	<div class="login-box">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
			<p class="username">
				<label for="username">Username:</label>
				<input type="text" name="username" id="username"/>
			</p>
			<p class="buttons">
				<input type="submit" name="login" value="Login"/>
				<input type="submit" name="signup" value="Sign up"/>
			</p>
		</form>
	</div>
</div>
</body>
</html>

