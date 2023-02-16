<!-- php -S localhost:8000 -->
<?php 
include("./assets/php/header.php");
$pdo = new PDO('sqlite:./database.db');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$lang = $_SESSION["lang"];
$traduction = traduction();
?>
<?php $receipt = $pdo->query('SELECT * FROM receipts WHERE is_public=1 AND lang = "fr" ORDER BY id DESC LIMIT 1')->fetch(); ?> 
<h1><?php echo $traduction[$lang]["accueil"]["titre"]; ?></h1>

<div class="wrapper">
    <h2><?php echo $traduction[$lang]["accueil"]["titre2"]; ?> </h2>
    <div class="list">
    <div class='item'>
        <div class="txt">
            <h2><?php echo $receipt["titre"]; ?></h2>
            <p><?php echo $receipt["resume"]; ?></p>
        </div>
        <div class="actions">
            <a class="btn info" href="/receipts/?id=<?php echo $receipt["id"]; ?>"><?php echo $traduction[$lang]["accueil"]["info"]; ?></a>
        </div>
    </div>
    </div>
    <div class="btns">
        <a href="/receipts/" class="btn info"><?php echo $traduction[$lang]["accueil"]["info_all"]; ?></a>
    </div>
</div>

<?php 
include("./assets/php/footer.php");
?>