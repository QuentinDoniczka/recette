<?php 
include("./assets/php/header.php");
$lang = $_SESSION["lang"];
$traduction = traduction();
?>

<?php
if(!is_admin()) { 
    header("Location: /");
}
$pdo = new PDO('sqlite:./database.db');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$users = $pdo->query('SELECT * FROM users')->fetchAll();
?> 

<form method="POST" action="?" class="form form-users">
    <div class="title">
        <h1> <?php echo $traduction[$lang]["manage"]["titre"] ; ?></h1>
    </div>
    <div class='wrap-form'>
        <?php foreach($users as $user) {
        $me = ($user["id"] == $_SESSION["user"]["id"]);?>
        <div class='user'>
           <div class="name"><?php echo $user["email"]." - ".$user["pseudo"] ?></div>
           <div class="rights <?php if($me) {echo 'its_me ';}?>">
             <span> <?php echo $traduction[$lang]["manage"]["membre"] ; ?></span>
            <label class="switch">
                <input data-id="<?php echo $user["id"];?>" class="js-role-admin" type="checkbox" <?php if($me) {echo 'disabled ';} if($user["role"] == "admin") {echo ' checked';} ?>>
                <span class="slider round"></span>
            </label>
            <span>Admin</span>
           </div>
        </div>
        <?php } ?>
    </div>
</form>
<div id="msg"></div>

<?php
include("./assets/php/footer.php");
?>
