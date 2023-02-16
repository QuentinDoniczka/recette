<?php
$id_user = $_GET['id_user'];
$pdo = new PDO('sqlite:./../../database.db');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include(dirname(__FILE__)."/traductions.php");
session_start();
$lang = $_SESSION["lang"];
$traduction = traduction();
function is_admin(){
    if($_SESSION["user"] && $_SESSION["user"]["role"] == "admin" ) {
        return true;
    }
    return false;
}
if(!empty($id_user)) {
    if(!is_admin()) { 
        echo json_encode(["status"=>0, "msg"=>$traduction[$lang]["msg_role"]["droit"]]);
    } else if($_SESSION["user"]["id"] == $id_user ) {
        echo json_encode(["status"=>0, "msg"=>$traduction[$lang]["msg_role"]["self"]]);
    } else {
        $role = ($_GET["is_admin"] === "true") ? 'admin' : 'membre';
        $statement = $pdo->prepare('UPDATE users SET role = :role WHERE id = :id');
        $statement->bindValue('role', $role);
        $statement->bindValue('id', $id_user);
        $result = $statement->execute();
        if($result) {
            echo json_encode(["status"=>1, "msg"=>$traduction[$lang]["msg_role"]["update"]]);
        } else {
            echo json_encode(["status"=>0, "msg"=>$traduction[$lang]["msg_role"]["error"]]);
        }
    }
}
