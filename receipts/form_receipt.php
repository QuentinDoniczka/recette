<?php

try {
    $pdo = new PDO('sqlite:../database.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function is_admin(){
        session_start();
        if($_SESSION["user"] && $_SESSION["user"]["role"] == "admin" ) {
            return true;
        }
        return false;
    }
    function is_owner($id) {
        session_start();
        if($_SESSION["user"]["id"] == $id ) {
            return true;
        }
        return false;
    }

    $is_public = (isset($_POST["is_public"]) && is_admin())?$_POST["is_public"]:0;
    $id = htmlspecialchars($_POST["id"]);
    // Formatage données 
    $titre = htmlspecialchars(trim($_POST["titre"]));
    $temps = htmlspecialchars($_POST["temps"]);
    $resume = htmlspecialchars(trim($_POST["resume"]));
    $ingredients = $_POST["ingredients"];
    $description = htmlspecialchars(trim($_POST["description"]));
    
    $errors = [];
    if(empty($titre)) {
        $errors[] = "Vous devez remplir le champ titre";
    }
    if(empty($description)) {
        $errors[] = "Vous devez remplir le champ description";
    }
    if(!empty($temps) && !intval($temps)) {
        $errors[] = "Vous devez entrer un nombre pour le temps de préparation";
    }
    if(!empty($errors)) {
        echo json_encode(["status"=>0, "msg"=>implode(', ',$errors)]);
    } else {
        $ingredients = [];
        $ingredient = "";
        if(!empty($_POST["ingredients"])) {
            foreach($_POST["ingredients"] as $ingredient) {
                list($name, $qte, $unit) = explode(':', $ingredient);
                $ingredients[] = ["quantity"=>htmlspecialchars($qte), "unit"=>htmlspecialchars($unit), "name"=>htmlspecialchars($name)];
            }
            $ingredient = json_encode($ingredients);
        }
        if($id == 0) { //Cas Création 
            session_start();
            $statement = $pdo->prepare('INSERT INTO receipts (titre, id_owner, is_public, temps, resume, ingredients, description) 
            VALUES (:titre, :id_owner, :is_public, :temps, :resume, :ingredients, :description)');
            $statement->bindValue('titre', $titre);
            $statement->bindValue('id_owner', $_SESSION["user"]["id"]);
            $statement->bindValue('is_public', $is_public);
            $statement->bindValue('temps', $temps);
            $statement->bindValue('resume', $resume);
            $statement->bindValue('ingredients', $ingredient);
            $statement->bindValue('description', $description);
            $statement->execute();
            echo json_encode(["status"=>1, "msg"=>"Recette enregistrée."]);
        } else { //Cas Modification
            // --- Vérification existence recette et propriétaire
            $req = $pdo->prepare('SELECT * FROM receipts WHERE id=:id');
            $req->bindValue('id', intval($_POST["id"]));
            $req->execute();
            $receipt = $req->fetch();
            // ---
            if(empty($receipt) || (!empty($receipt) && !is_owner($receipt["id_owner"])) ) {
                echo json_encode(["status"=>0, "msg"=>"Vous ne pouvez pas modifier cette recette."]);
            } else {
                $statement = $pdo->prepare('UPDATE receipts SET titre = :titre, temps = :temps, resume = :resume, ingredients = :ingredients, description = :description WHERE id = :id');
                $statement->bindValue('id', $id);
                $statement->bindValue('titre', $titre);
                $statement->bindValue('temps', $temps);
                $statement->bindValue('resume', $resume);
                $statement->bindValue('ingredients', $ingredient);
                $statement->bindValue('description', $description);
                $statement->execute();
                echo json_encode(["status"=>1, "msg"=>"Recette mise à jour."]);
            }
        }
    }
   

} catch (Exception $exception) {
    var_dump($exception->getMessage());
}
