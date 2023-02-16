<?php 
if(empty($_GET["id_receipt"])) {
include("./assets/php/header.php");
$lang = $_SESSION["lang"];
$traduction = traduction();

$pdo = new PDO('sqlite:./database.db');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$req = $pdo->prepare('SELECT wishlist FROM users WHERE id = (:id)');
$req->bindValue('id', $_SESSION["user"]["id"]);
$req->execute();
$user = $req->fetch();
$nb = ($user["wishlist"])?count( explode(',', $user["wishlist"]) ):0;

if($nb > 0) {
    $cond = "";
    $i = 0;
    foreach(explode(',', $user["wishlist"]) as $id) {
        if($i) {
            $cond .= " OR ";
        }
        $cond .= " id = ".$id;
        $i++;
    }
    $req2 = $pdo->query('SELECT titre, id, ingredients FROM receipts WHERE '.$cond);
    $receipts = $req2->fetchAll();
}
?>


<div class="wrapper">
    <h1> <?php echo $traduction[$lang]["liste"]["titre"]; ?> </h1>
    <?php if($nb > 0) { ?>
        <div class="">
        <div>
            <div><?php echo $traduction[$lang]["liste"]["nombre"].' '.$nb ?></div>
            <ul>
                <?php 
                $ingredients = [];
                foreach($receipts as $receipt) { ?>
                    <li> <?php echo $receipt["titre"] ; ?></li>
                    <?php $ingredients = array_merge($ingredients, json_decode($receipt['ingredients'])) ; ?>
                <?php } ?>
            </ul>
        </div>
        <div>
            <h2>Ma liste de course :</h2>
            <ul>
            <?php 
            if($ingredients) {
            foreach($ingredients as $item) {?>
                <li> <?php echo $item->quantity." ".$item->unit." ".$item->name ?>
                 </li>
            <?php }
            } else { ?>
                <li class="no-result">Aucun ingrédients</li>
            <?php } ?>
            </ul>
        </div>
    </div>
    <?php } else { ?>
        <div class="no-result">
            <?php echo $traduction[$lang]["liste"]["vide"]; ?>
        </div>
    <?php } ?>
    
        
    
</div>



<?php 
include("./assets/php/footer.php");
} else {
    session_start();
    include(dirname(__FILE__)."/assets/php/traductions.php");
    $lang = $_SESSION["lang"];
    $traduction = traduction();

    $id_receipt = intval($_GET["id_receipt"]);
    $id_user = $_SESSION["user"]["id"];
    $pdo = new PDO('sqlite:./database.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $req = $pdo->prepare('SELECT * FROM users WHERE id = (:id)');
    $req->bindValue('id', $id_user);
    $req->execute();

    if($result = $req->fetch()) {

        $wishlist = $result["wishlist"];
        if($wishlist) {
            $wishlist = explode(',', $wishlist);
            if(!in_array($id_receipt, $wishlist)) {
                $wishlist[] = $id_receipt;
            }
        } else {
            $wishlist = [$id_receipt];
        }
        $wishlist = implode(',', $wishlist);

        $statement = $pdo->prepare('UPDATE users SET wishlist = :wishlist WHERE id = :id');
        $statement->bindValue('wishlist', $wishlist);
        $statement->bindValue('id', $id_user);
        $result = $statement->execute();

        if($result) {
            echo json_encode(["status"=>1, "msg"=>"Ajouté !"]);
        } else {
            echo json_encode(["status"=>0, "msg"=>"Une erreur est survenue."]);
        }
    } else {
        echo json_encode(["status"=>0, "msg"=>"Une erreur est survenue."]);
    }
}
?>