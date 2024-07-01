<?php

$pdo = new PDO('mysql:host=localhost;dbname=connexion', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            session_start();
        require_once("/html.php");
            if(isset($_POST["email"])){
                $valide= !empty($_POST["email"]) &&
                         !empty($_POST["password"]);
                if(!$valide){
                    echo "<p style='color:red'>Tous les champs sont obligatoire!</p>";
                }else{
                    $sql = "select email, password from login where identifiant='".$_POST['email']."'";
                    $stmt = $pdo->query($sql, PDO::FETCH_ASSOC);
                    $stmt->execute();

                    $result= $stmt->fetch();
                    $goodPassword= password_verify($_POST['password'], $result["password"]);

                    if($_POST['password'] === $result["password"]){
                        $_SESSION["User"]= $result;
                        header('Location: https://github.com/');
                    }else{
                        echo "<p style='color:red'>Identifiants incorrect !</p>";
                    }
                }
            }else if(isset($_SESSION["User"])){
                header('Location: C:\Users\Utilisateur\Desktop\github\Matalsi_DEVOPS\acceuil.html');
            }
    ?>
