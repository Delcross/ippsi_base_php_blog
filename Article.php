<?php
    include('./function.php');
    include('./header.php');
    $data_base=connection();
    $select = $data_base->prepare('SELECT * FROM article');
    $select->execute();
    $data=$select->fetchAll();
    $number=count($data);
    switch($_SESSION['article']){
        case '0':
            for ($i=0; $i<=4; $i++) {
                if(isset($data[$i]["title"])){
                    echo "<article>";
                    echo "<label>".$data[$i]["title"]."<label>";
                    if($i%2){
                        echo"<div class='flex'>";
                        echo "<div>";
                        echo "<img src=".$data[$i]["image"].">";
                        echo "</div>";
                        echo "<div>";
                        echo $data[$i]["content"];
                        echo "</div>";
                    }else{
                        echo"<div class='flex'>";
                        echo "<div>";
                        echo $data[$i]["content"];
                        echo "</div>";
                        echo "<div>";
                        echo "<img src=".$data[$i]["image"].">";
                        echo "</div>";
                        
                    }
                    echo "<br>";
                    echo"<form action='comment.php' method='post'>
                    <input type='hidden' name='id_article' value=".$data[$i]['id'].">
                    <input type='submit' value='voir les commentaires'>
                    </form>";
                    echo "</div>";
                } 
                echo "</article>";
            }
            $_SESSION['number']=$i;
            if($number>5){
                echo "<center>";
                echo "<div class='next-back'>" ;
                echo "<a href='next.php'>suivant</a>";
                echo "</div>";
                echo "</center>";
            }
            break;
        case 'next':
            $f=$_SESSION['number']+5;
            for ($i=$_SESSION['number']; $i<$f; $i++){
                if(isset($data[$i]["title"])){
                    echo "<article>";
                    echo "<label>".$data[$i]["title"]."<label>";
                    if($i%2){
                        echo"<div class='flex'>";
                        echo "<div>";
                        echo "<img src=".$data[$i]["image"].">";
                        echo "</div>";
                        echo "<div>";
                        echo $data[$i]["content"];
                        echo "</div>";
                    }else{
                        echo"<div class='flex'>";
                        echo "<div>";
                        echo $data[$i]["content"];
                        echo "</div>";
                        echo "<div>";
                        echo "<img src=".$data[$i]["image"].">";
                        echo "</div>";
                    }
                
                    echo"<form action='comment.php' method='post'>
                    <input type='hidden' name='id_article'  value=".$data[$i]['id'].">
                    <input type='submit' value='voir les commentaires'>
                    </form>";
                    echo "</div>";
                    echo "</article>";
                } 
                
            }
            $_SESSION['number']=$i;
            if($f>=count($data)){
                echo "<center>";
                echo "<div class='next-back'>" ;
                echo "<a href='prev.php'>précédent</a>";
                echo "</div>";
                echo "</center>";
            }else{
                echo "<center>";
                echo "<div class='next-back'>" ;
                echo "<a href='prev.php'>précédent</a>";
                echo "<a href='next.php'>suivant</a>";
                echo "</div>";
                echo "</center>";
            } 
            break;
        case 'prev':
            $number=$_SESSION['number'];
            $f=$number-10;
            if($f==0){
                for ($i=0; $i<=4; $i++) {
                    if(isset($data[$i]["title"])){
                        echo "<article>";
                        echo "<label>".$data[$i]["title"]."<label>";
                        if($i%2){
                            echo"<div class='flex'>";
                            echo "<div>";
                            echo "<img src=".$data[$i]["image"].">";
                            echo "</div>";
                            echo "<div>";
                            echo $data[$i]["content"];
                            echo "</div>";
                        }else{
                            echo"<div class='flex'>";
                            echo "<div>";
                            echo $data[$i]["content"];
                            echo "</div>";
                            echo "<div>";
                            echo "<img src=".$data[$i]["image"].">";
                            echo "</div>";
                            
                        }
                   
                        echo"<form action='comment.php' method='post'>
                        <input type='hidden' name='id_article'  value=".$data[$i]['id'].">
                        <input type='submit' value='voir les commentaires'>
                        </form>";
                        echo "</div>";
                        echo "</article>";
                    } 
                    
                } 
                $_SESSION['number']=$i;
                echo "<center>";
                echo "<div class='next-back'>" ;
                echo "<a href='next.php'>suivant</a>";
                echo "</div>";
                echo "</center>";
            }
            else{
                for ($i=$f; $i<=$f+4; $i++){
                    if(isset($data[$i]["title"])){
                        echo "<article>";
                        echo "<label>".$data[$i]["title"]."<label>";
                        if($i%2){
                            echo"<div class='flex'>";
                            echo "<div>";
                            echo "<img src=".$data[$i]["image"].">";
                            echo "</div>";
                            echo "<div>";
                            echo $data[$i]["content"];
                            echo "</div>";
                        }else{
                            echo"<div class='flex'>";
                            echo "<div>";
                            echo $data[$i]["content"];
                            echo "</div>";
                            echo "<div>";
                            echo "<img src=".$data[$i]["image"].">";
                            echo "</div>";
                            
                        }
                        echo"<form action='comment.php' method='post'>
                        <input type='hidden' name='id_article'  value=".$data[$i]['id'].">
                        <input type='submit' value='voir les commentaires'>
                        </form>";
                        echo "</div>";
                        echo "</article>"; 
                    }
                    
                }
                $_SESSION['number']=$i;
                if($f>=(count($data))){
                    echo "<center>";
                    echo "<div class='next-back'>" ;
                    echo "<a href='prev.php'>précédent</a>";
                    echo "</div>";
                    echo "</center>";
                }else{
                    echo "<center>";
                    echo "<div class='next-back'>" ;
                    echo "<a href='prev.php'>précédent</a>";
                    echo "<a href='next.php'>suivant</a>";
                    echo "</div>";
                    echo "</center>";
                } 
            }
        break;
    }
?>