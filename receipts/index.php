<?php 
include("../assets/php/header.php");
$pdo = new PDO('sqlite:../database.db');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$lang = $_SESSION["lang"];
$traduction = traduction();
?>

<?php if(isset($_GET["id"]) && isset($_GET["edit"])) { ?>
<!-- Cas 1 : Edition -->
<?php 
    $req = $pdo->prepare('SELECT * FROM receipts WHERE id=:id AND lang = "fr" ');
    $req->bindValue('id', intval($_GET["id"]));
    $req->execute();
    $receipt = $req->fetch();
?> 
<?php if( (!empty($_GET["id"]) && $receipt && is_owner($receipt["id_owner"])) || ($_GET["id"] == 0 && is_admin())) { ?>

<h1 class="title-page" > <?php if($_GET["id"] == 0) {echo $traduction[$lang]["recette"]["creation"];} else {echo $traduction[$lang]["recette"]["modif"];} ?> <?php echo $traduction[$lang]["recette"]["recette"] ; ?></h1>
<form id="form_receipt" method="POST" action="/receipts/form_receipt.php" class="form form-recette">
    <input name="id" type="hidden" value="<?php echo $_GET["id"];?>">
    <input type="hidden" value="1" name="is_public">
    <div class="label-form">
    <label for=""> <?php echo $traduction[$lang]["recette"]["titre"]; ?></label>
        <input type="text" name="titre" value="<?php if($receipt){echo $receipt["titre"];} ?>">
    </div>
    <div class="label-form">
    <label for=""><?php echo $traduction[$lang]["recette"]["temps"]; ?></label>
        <input type="text" name="temps" value="<?php if($receipt){echo $receipt["temps"];} ?>">
    </div>
    <div class="label-form">
        <label for=""><?php echo $traduction[$lang]["recette"]["description"]; ?></label>
        <textarea rows="3" name="resume" type="text" ><?php if($receipt){echo $receipt["resume"];} ?></textarea>
    </div>
    <div class="label-form">
        <label for=""><?php echo $traduction[$lang]["recette"]["ingredient"]; ?></label>
        <div id="list-ingredients">
            <?php if($receipt["ingredients"]) {
                $ingredients = json_decode($receipt["ingredients"]);
                foreach($ingredients as $ingredient) { ?>
                    <label><input checked='checked' type='checkbox' name='ingredients[]' value='<?php echo $ingredient->name.':'.$ingredient->quantity.":".$ingredient->unit; ?>'/>
                            <span><?php echo $ingredient->quantity." ".$ingredient->unit.' : '.$ingredient->name; ?></span>
                            <span class="delete_ingredient" title="Delete">X</span>
                    </label>
                <?php }
            } ?>
        </div>
        <div class="autocomplete">
            <div class="ingredients-inputs">
                <input type="number" id="qte_ingred" placeholder="Quantité" >
                <select name="" id="unit_ingred">
                    <option value="" disabled><?php echo $traduction[$lang]["recette"]["u_ingredient"]; ?></option>
                    <option value="kilogrammes">kg</option>
                    <option value="litres">litres</option>
                    <option value="grammes">grammes</option>
                </select>
                <input type="text" id="name_ingred" placeholder="Nom ingrédient" >
            </div>
            <button id="add_ingredient" class="btn"><?php echo $traduction[$lang]["recette"]["add"]; ?></button>
        </div>
    </div>
    <div class="label-form">
        <label for=""><?php echo $traduction[$lang]["recette"]["etape"]; ?></label>
        <textarea rows="20" name="description" placeholder="Ecrire votre étape ..." ><?php if($receipt){echo $receipt["description"];} ?></textarea>
    </div>
    <div class="btns">
        <button class="btn valid"><?php echo $traduction[$lang]["recette"]["save"]; ?></button>
        <button type="reset" class="btn cancel"><?php echo $traduction[$lang]["recette"]["cancel"]; ?></button>
        <a class="btn retour-list" href="?"><?php echo $traduction[$lang]["recette"]["r_liste"]; ?></a>
    </div>
</form>
<div id="errors"></div>
<?php } else { ?>
<div class="no-result">
    <?php echo $traduction[$lang]["recette"]["indispo"]; ?>
</div>

<?php }
} elseif( isset($_GET["id"]) ) { ?>
<!-- Cas 2 : Affichage -->
<?php 
    $req = $pdo->prepare('SELECT * FROM receipts WHERE id=:id AND lang = "fr" ');
    $req->bindValue('id', intval($_GET["id"]));
    $req->execute();
    $receipt = $req->fetch();
?> 

<div class="wrapper">
    <h1 class="title-page" > <?php echo $receipt["titre"]; ?> </h1>
    <div><?php echo $traduction[$lang]["recette"]["time"]; ?><?php echo $receipt["temps"]; ?>min</div>
    <?php if($receipt["ingredients"]) {
        $ingredients = json_decode($receipt["ingredients"]);
        echo ' <ul> ';
        foreach($ingredients as $ingredient) { ?>
            <li>
                <?php echo $ingredient->quantity." ".$ingredient->unit.' : '.$ingredient->name; ?>
            </li>
        <?php }
        echo ' </ul> ';
     } ?>

    <div>
        <?php echo nl2br($receipt["description"]); ?>
    </div>

    <a class="btn retour-list" href="?"><?php echo $traduction[$lang]["recette"]["r_liste"]; ?></a>

</div>
<?php  } else { ?> 
<!-- Cas 3 : Liste -->
<?php $receipts = $pdo->query('SELECT * FROM receipts WHERE is_public=1 AND lang = "fr"')->fetchAll(); ?>
<h1 class="title-page"><?php echo $traduction[$lang]["recette"]["titre_public"]; ?></h1>

<div class="list">
    <div class='btns'>
        <?php if(is_admin()) { ?>
        <a href="?id=0&edit=1" class="btn"><?php echo $traduction[$lang]["recette"]["n_recette"]; ?></a>
        <?php } ?>
    </div>
    <div id="msg"></div>
    <?php 
    if ($receipts) {
    foreach($receipts as $receipt) { ?>
   <div class='item item-<?php echo $receipt["id"]; ?>'>
        <div class="txt">
            <h2><?php echo $receipt["titre"]; ?></h2>
            <p><?php echo $receipt["resume"]; ?></p>
            
            <div class="fav_receipt">
                <button class="btn js-wishlist" data-id="<?php echo $receipt["id"]; ?>" title="Envoyer à ma liste de course" ><?php echo $traduction[$lang]["recette"]["add_course"]; ?></button>
            </div>
        </div>
        <div class="actions">
            <a class="btn info" href="?id=<?php echo $receipt["id"]; ?>"> <?php echo $traduction[$lang]["recette"]["voir"]; ?> </a>
            <?php if(is_admin()) { ?>
            <a href="?" class="btn delete js-delete-receipt" data-id="<?php echo $receipt["id"]; ?>"> <?php echo $traduction[$lang]["recette"]["sup"]; ?> </a>
            <a class="btn edit" href="?id=<?php echo $receipt["id"]; ?>&edit=1" > <?php echo $traduction[$lang]["recette"]["edit"]; ?> </a>
            <?php } ?>
        </div>
   </div>
   <?php } 
   } else { ?>
         <p class="no-result">
             <?php echo $receipt["id"]; ?>"> <?php echo $traduction[$lang]["recette"]["none"]; ?> 
        </p>
    <?php }
    }?>
</div>

<?php 
include("../assets/php/footer.php");
?>