<?php
include(dirname(__FILE__)."/../assets/php/traductions.php");
session_start();
$lang = $_SESSION["lang"];
$traduction = traduction();

try {
    
    $pdo = new PDO('sqlite:../database.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(!empty($_GET["register"])) { // Inscription
        $email = htmlspecialchars($_POST["email"]);
        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $mdp = htmlspecialchars($_POST["mdp"]);
        $c_mdp = htmlspecialchars($_POST["c_mdp"]);
        if(!empty($email) && !empty($pseudo) && !empty($mdp) && !empty($c_mdp)){
            $errors = [];
            // Test si pseudo libre 
            $req = $pdo->prepare('SELECT * FROM users WHERE pseudo = (:pseudo)');
            $req->bindValue('pseudo', $pseudo);
            $req->execute();
            $result = $req->fetchAll();
            if(!empty($result)) {
                $errors[] = $traduction[$lang]["error_signin"]["pseudo"];
            }
            if(!($mdp == $c_mdp)){
                $errors[] = $traduction[$lang]["error_signin"]["mdp"];
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = $traduction[$lang]["error_signin"]["email"];
            }
            if(!empty($errors)){
                echo json_encode(["status"=>0, "msg"=>implode(', ',$errors)]);
            }
            else{
                $statement = $pdo->prepare('INSERT INTO users (email, pseudo, mdp) 
                VALUES (:email, :pseudo, :mdp)');
                $statement->bindValue('email', $email);
                $statement->bindValue('pseudo', $pseudo);
                $statement->bindValue('mdp', password_hash($mdp, PASSWORD_ARGON2I));
                $statement->execute();
                echo json_encode(["status"=>1, "msg"=>$traduction[$lang]["error_signin"]["user_ok"]]);
            }
        } else {
            echo json_encode(["status"=>0, "msg"=>$traduction[$lang]["error_signin"]["fields"]]);
        }
   } else { // Connexion
        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $mdp = $_POST["mdp"];
        $req = $pdo->prepare('SELECT * FROM users WHERE pseudo = (:pseudo)');
        $req->bindValue('pseudo', $pseudo);
        $req->execute();
        $user = $req->fetch();
        if($user && password_verify($mdp, $user["mdp"])) {
            $_SESSION["user"] = $user;
            echo json_encode(["status"=>1, "msg"=>$traduction[$lang]["error_signin"]["connect_ok"]]);
        } else {
            echo json_encode(["status"=>0, "msg"=>$traduction[$lang]["error_signin"]["id"]]);
        }
   }

    
} catch (Exception $exception) {
    var_dump($exception->getMessage());
}
