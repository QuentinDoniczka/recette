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
    $id_delete = intval($_GET["delete"]);
    if(!empty($id_delete)) {
        $req = $pdo->prepare('SELECT * FROM receipts WHERE id=:id');
        $req->bindValue('id', $id_delete);
        $req->execute();
        $receipt = $req->fetch();
        if(!$receipt) {
            echo json_encode(["status"=>0, "msg"=>"Recette introuvable."]);
        } else {
            if(is_owner($receipt["id_owner"])) {
                $statement = $pdo->prepare('DELETE FROM receipts WHERE id = :id');
                $statement->bindValue('id', $id_delete);
                $statement->execute();
                echo json_encode(["status"=>1, "msg"=>"Recette bien supprimée."]);
            } else {
                echo json_encode(["status"=>0, "msg"=>"Vous n'avez pas les droits."]);
            }
        }
    } else {
        echo json_encode(["status"=>0, "msg"=>"Une erreur s'est produite."]);
    }

} catch (Exception $exception) {
    var_dump($exception->getMessage());
}
