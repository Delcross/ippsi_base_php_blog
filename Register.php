<?php

    include('./function.php');
    include('./header.php');

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passConf'])) {
	    $username = (String) $_POST['username'];
	    $password = (String) $_POST['password'];
	    $passConf = (String) $_POST['passConf'];

	    if (strlen($username) > 0) {
		    if (strlen($password) > 0) {
			    if (strlen($passConf) > 0) {
				    if (strlen($username) < 17) {
					    if (strlen($password) < 17) {
						    if (strlen($passConf) < 17) {
							    if ($passConf === $password) {
								    try {
									    $bdd = connection();
									    if ($bdd == TRUE) {
										    $chec_user = check_username();
										    $chec_user->bindParam(':username', $username);
										    $chec_user->execute();

										    while ($Data = $chec_user->fetch()) {
											    $Number = (int) $Data["COUNT(*)"];
										    }

										    if ($Number == 0) {

											    $Hashing = (String) crypt($Password);

											    $add_data = add_user();
											    $add_data->bindParam(':username', $username);
											    $add_data->bindParam(':password', $Hashing);
											    $add_data->execute();
											    echo "your compte has create ";
											    echo "<a href='Connection.php'>Login</a>";
										    }
										    else {
											    echo "This username : ".$username." is already used";
											    echo "<a href='Register.php'>Register</a>";
										    }
									    }
								    } catch (Exception $e) {
									    echo "Error ! : ".$bdd."<br>".$e->getMessage();
									    echo "<a href='Register.php'>Register</a>";
									    die();
								    }
							    }
							    else {
								    echo "your password and password verification are not identical ";
								    echo "<a href='Register.php'>Register</a>";
							    }
						    }
						    else {
							    echo "Your password verification is not valide, enter more of 16 characters";
							    echo "<a href='Register.php'>Register</a>";
						    }
					    }
					    else {
						    echo "Your password is not valide, enter more of 16 characters";
						    echo "<a href='Register.php'>Register</a>";
					    }
				    }
				    else {
					    echo "Your username is not valide, enter more of 16 characters";
					    echo "<a href='Register.php'>Register</a>";
				    }
			    }
			    else {
				    echo "Your validation of password is not valide, enter your password validation";
				    echo "<a href='Register.php'>Register</a>";
			    }
		    }
		    else {
			    echo "Your password is not valide, enter your password";
			    echo "<a href='Register.php'>Register</a>";
		    }
	    }
	    else {
		    echo "Your username is not valide, enter your username";
		    echo "<a href='Register.php'>Register</a>";
	    }
    }
    else {
	    ?>
	    <form action="Register.php" method="post">
		    <label>Username : </label>
		    <input type="text" name="username" placeholder="Your Username" maxlength="16" minlength="1" required>
		    <br>
		    <label>Password : </label>
		    <input type="password" name="password" placeholder="Your Password" maxlength="16" minlength="1" required>
		    <br>
		    <label>Confirmation of Password : </label>
		    <input type="password" name="passConf" placeholder="Your Password" maxlength="16" minlength="1" required>
		    <br>
		    <input type="submit" value="Validation">
	    </form>
	    <?php
    }
?>