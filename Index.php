<?php
    include('./function.php');
    include('./header.php');

    echo "<a href='Connection.php'>Login </a>";
    echo "<a href='register.php'> Sign up</a>";

    $bdd = connection();
    $req = $bdd->prepare("SELECT `title` FROM `article`");

    $x = 1;

    while ($donnees = $req->fetch()){
        $title[$x] = $donnees[`title`];
        echo $title[$x];
        $x++;  
    }
    $req->execute();

    print_r($title[$x]);

?>


