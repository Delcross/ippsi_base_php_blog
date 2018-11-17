<?php
	include('./function.php');
    include('./header.php');
?>

<form action=".php" method="post">
		<label>Title : </label>
		<input type="text" name="title" placeholder="Title of article" maxlength="255" minlength="1" required>
		<br>
		<label>Content : </label>
		<input type="text" name="content" placeholder="Content of the article" minlength="1" required>
		<br>
		<input type="file" name="fileToUpload" id="fileToUpload">
		<br>
		<input type="submit" value="Validation">
</form>