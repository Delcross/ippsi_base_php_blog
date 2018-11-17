<?php
    declare(strict_types=1);


    function connection()
    {
        $Server = (String) "db";
        $DataBase = (String) "blog";
        $SQLUser = (String) "user";
        $SQLPassword = (String) "password123";

        $bdd = new PDO('mysql:host='.$Server.';dbname='.$DataBase.';charset=utf8', "$SQLUser", "$SQLPassword");

        return $bdd;
    }

    function add_user ()
    {
        $bdd = connection();
        $AddData = $bdd->prepare("INSERT INTO user (id,username,password) VALUE (NULL,:username, :password)");

        return $AddData;
    }

    function check_username ()
    {
        $bdd = connection();
        $CheckUser = $bdd->prepare("SELECT COUNT(*) FROM user WHERE username = (:username)");

        return $CheckUser;
    }

    function check_password ()
    {

    }

    function remove_article ()
    {
        $data_base=connection();
        try {
            $req = $data_base->prepare('SELECT * FROM article WHERE id = :id');
            $req->bindValue(':id',$id_article);
            $req->execute();
            $data=$req->fetchAll();
            if(unlink($data[0]['image'])){
                echo "fichier supprimer";
            }
            $delete=$data_base->prepare('DELETE FROM article WHERE id = :id_article');
            $delete->bindParam(':id_article',$id_article);
            $delete->execute();
            header("Location: admin.php");
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function save_article ()
    {
        $data_base=connection();
        $name = "../image/".$file["name"];
        $result = move_uploaded_file($file['tmp_name'],$name);
        if ($result) echo "Transfert réussi";
        try {
            $insert=$data_base->prepare('INSERT INTO article (title,content,image,author) VALUE (:title,:content,:image,:author)');
                $insert->bindParam(':title',$title);
                $insert->bindParam(':content',$description);
                $insert->bindParam(':image',$name);
                $insert->bindParam(':author',$_SESSION['id_user']);
                $insert->execute();
                header("Location: admin.php");
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function update_article ()
    {
        $data_base=connection();
        $name = "../image/".$file["name"];
        $result = move_uploaded_file($file['tmp_name'],$name);
        if ($result) echo "Transfert réussi";
        try {
            $req = $data_base->prepare('SELECT * FROM article WHERE id = :id');
            $req->bindValue(':id',$id_article);
            $req->execute();
            $data=$req->fetchAll();
            if(unlink($data[0]['image'])){
                echo "fichier supprimer";
            }
            $update=$data_base->prepare('UPDATE article SET title=:title,content=:content,image=:image,author=:author WHERE id = :id');
                $update->bindParam(':title',$title);
                $update->bindParam(':content',$description);
                $update->bindParam(':image',$name);
                $update->bindParam(':author',$_SESSION['id_user']);
                $update->bindParam(':id',$id_article);
                $update->execute();
                header("Location: admin.php");
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function comment ()
    {

    }

    function connection_user($user,$password)
    {
        $data_base=connection();
        $req = $data_base->prepare('SELECT * FROM user WHERE username = :username');
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
                pendant votre identification.<br /> Le mot de passe ou l\'identifiant
                    entré, n\'est pas correct.</p><p> 
                    <a class="red" href="connection.php">Cliquez ici pour revenir à la page précédente</a>
                    <br /><br />
                    <a class="red" href="../index.php">Cliquez ici pour revenir à la page d\'accueil</a> 
                </p></center>';
            echo $message;
        }
        $req->CloseCursor();
    }

?>