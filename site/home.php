<!DOCTYPE html>
<html>
<head>
	<title>File Management - Home</title>
</head>
<body>
<?php
	session_start();
	if (! isset($_SESSION['user'])) {
		header('Location: login.php');
		exit();
	}
	$user = $_SESSION['user'];
	if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {
   		echo '<span class="error">'.$_SESSION['error'].'</span>';
   		unset($_SESSION['error']);
	}
	if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                echo '<span class="success">'.$_SESSION['success'].'</span>';
                unset($_SESSION['success']);
        }

?>
	<form action="logout.php" method="POST">
		<p>
			<input type="submit" value="Logout"/>
		</p>
	</form>
	<ul>	
<?php
	//path to directory to scan
	$directory = "../../FileManagement/users/$user/";
	
	//get all image files with a .jpg extension.
	$files = glob($directory . "*");
	
	
	
	//print each file name
	foreach($files as $file)
	{
		$filename = str_replace($directory, "", $file);
?>
		<li>
			<div class="file">
				<div class="title">
					<div class="link">
	                    

						<form action="view.php" method="POST">
							<input type="hidden" value="<?php echo $filename; ?>" name="link"/>
							<input type="submit" value="<?php echo $filename; ?>"/>
						</form>
					</div>
					<div class="download">
						<form action="download.php" method="POST">
                                                        <input type="hidden" value="<?php echo $filename; ?>" name="link"/>
                                                        <input type="submit" value="Download"/>
                                                 </form>

					</div>
					<div class="delete">
						<form action="remove.php" method="POST">
							<input type="hidden" value="<?php echo $filename; ?>" name="link"/>
  							<input type="submit" value="Delete"/>
	         				 </form>
					</div>
				</div>
			</div>
		</li>
<?php
	}
?>
	</ul>
	<form action="upload.php" method="post" enctype="multipart/form-data">
		<p>
			<label for="file">Filename:</label>
			<input type="file" name="file" id="file" />
		</p>
		<p><input type="submit" name="submit" value="Submit" /></p>
	</form>

</body>
</html>

