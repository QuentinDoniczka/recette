<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet recette</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
<?php
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
    function is_owner($id) {
        if($_SESSION["user"]["id"] == $id ) {
            return true;
        }
        return false;
    }
    function is_connected(){
        if($_SESSION["user"]) {
            return true;
        }
        return false;
    }
    define("IS_SIGNIN", FALSE);
    if(!(IS_SIGNIN) && !is_connected()){
        header("Location: /signin");
    }
?>
<header>
    <div class="elemt-left">
        <?php if(is_connected()) { ?>
        <img id="js-open-menu" src="/assets/img/menu.png" alt="">
        <nav id="menu">
            <div class="close-menu">
                <img id="js-close-menu" src="/assets/img/close.png" alt="">
            </div>
            <ul>
                <li><a href="/"><?php echo $traduction[$lang]["header"]["home"];?></a> </li>
                <li>
                    <a href="/profil"><?php echo $traduction[$lang]["header"]["profil"];?></a>
                </li>
                <li>
                    <a href="/receipts"><?php echo $traduction[$lang]["header"]["recette"];?></a>
                </li>
                <li>
                    <a href="/my-receipts"><?php echo $traduction[$lang]["header"]["m_recette"];?></a>
                </li>
                <li><a href="/shopping-list.php"><?php echo $traduction[$lang]["header"]["course"];?></a> </li>
                <?php if(is_admin()) { ?>
                    <li><a href="/users-management.php"><?php echo $traduction[$lang]["header"]["utilisateur"];?></a> </li>
                <?php } ?>
            </ul>
        </nav>
        <?php } ?>
    </div>
    <div class='title-project'> <a href="/">My App</a> </div>
    <div class="elemt-right">
        <?php if(is_connected()){?>
        <a class="btn btn-logout" href="/signin?logout"> <img src="/assets/img/logout.png" alt=""> <span><?php echo $traduction[$lang]["header"]["deco"];?></span> </a>
        <?php } ?>
    </div>
</header>

<main>
