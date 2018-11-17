<?php
    include('./function.php');
    include('./header.php');
?>

<!DOCTYPE html>
<html>
    <body>
        <form action="Connection.php" method="post">
            Pseudo: <input type="text" name="pseudo" value="" />
     
            Mot de passe: <input type="password" name="mdp" value="" />
     
            <input type="submit" name="connexion" value="Connexion" />
        </form>
    </body>
</html>

<?php 
    //  Récupération de l'utilisateur et de son pass hashé
    $bdd=connection();
    $req = $bdd->prepare('SELECT * FROM user WHERE username = :username');
    $req->bindValue(':username',$user, PDO::PARAM_STR);
    $req->execute();
    $data=$req->fetch();
    echo $data['password'];
    if (password_verify($password, $data['password'])) // Acces OK !
    {
        $_SESSION['id_user']=$data['id'];
        $_SESSION['user'] = $data['username'];
        header("Location: admin.php");
    
    }
    else // Acces pas OK !
    {  
        $message = '<center><br /><br /><br /><p>Une erreur s\'est produite 
            pendant votre identification.<br /> The password or the entered 
            identifier is not correct. Please retry your identifiers</p><p> 
                <a class="red" href="./Index.php">Click here to return to the home page</a> 
            </p></center>';
        echo $message;
    }
    $req->CloseCursor();
?>