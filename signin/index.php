<?php
define("IS_SIGNIN", TRUE);
include("../assets/php/header.php");
$_SESSION["lang"] = ($_SESSION["lang"])?$_SESSION["lang"]:"fr";
$lang = $_SESSION["lang"];
$traduction = traduction();
if(is_connected()) {
    header("Location: /");
}
if(isset($_GET["logout"])) {
    $_SESSION["user"] = [];
}
?>

<!-- Si déjà connecté redrige vers l'accueil -->
<div class='wrap-center'>
<?php 
if (isset($_GET["register"])) {
?>
<form id="form-register" method="POST" action="/signin/form_signin.php?register=1" class="form form-connect">
    <div class="title">
        <h1><?php echo $traduction[$lang]["signin"]["inscrire"]; ?></h1>
    </div>
    <div class='wrap-form'>
        <div class='label-form'>
            <label for="email"><?php echo $traduction[$lang]["signin"]["mail"]; ?></label>
            <input id="email" type="text" name='email'>
        </div>
        <div class='label-form'>
            <label for="pseudo"><?php echo $traduction[$lang]["signin"]["name"]; ?></label>
            <input id="pseudo" type="text" name='pseudo'>
        </div>
        <div class='label-form'>
            <label for="mdp"><?php echo $traduction[$lang]["signin"]["mdp"]; ?></label>
            <input id="mdp" type="password" name='mdp'>
        </div>
        <div class='label-form'>
            <label for="c_mdp"><?php echo $traduction[$lang]["signin"]["c_mdp"]; ?></label>
            <input id="c_mdp" type="password" name='c_mdp'>
        </div>
        <a class="login" href="/signin"><?php echo $traduction[$lang]["signin"]["membre"]; ?><span class="signin"><?php echo $traduction[$lang]["signin"]["connect"]; ?></span> </a>
        <button class="btn"><?php echo $traduction[$lang]["signin"]["inscrire"]; ?></button>
    </div>
    <div id="errors"></div>
</form>
<?php } else {?>
    <form id="form-connect" method="POST" action="/signin/form_signin.php" class="form form-connect">
        <div class="title">
            <h1><?php echo $traduction[$lang]["signin"]["titre"]; ?></h1>
        </div>
        <div class='wrap-form'>
            <div class='label-form'>
                <label for="pseudo"><?php echo $traduction[$lang]["signin"]["name"]; ?></label>
                <input id="pseudo" type="text" name='pseudo' value='<?php if($_GET["pseudo"]) {echo $_GET["pseudo"];}?>' >
            </div>
            <div class='label-form'>
                <label for="mdp"><?php echo $traduction[$lang]["signin"]["mdp"]; ?></label>
                <input id="mdp" type="password" name='mdp'>
            </div>
            <a class="signin" href="/signin?register"><?php echo $traduction[$lang]["signin"]["inscrire"]; ?></a>
            <button class="btn"><?php echo $traduction[$lang]["signin"]["connect"]; ?></button>
        </div>
        <?php  if(isset($_GET["pseudo"])) { ?>
        <div class='msg-success'>
        <?php echo $traduction[$lang]["signin"]["success"]; ?>
        </div>
        <?php  }?>
        
        <div id="errors"></div>
    </form>
<?php }?>
</div>
<?php 
include("../assets/php/footer.php");
?>