<?php 
include("../assets/php/header.php");
?>

<h1>Profil de JohnDoe67</h1>

<div class="wrapper">
    <form method="POST" action="?" class="form form-connect">
        <div class="title">
            <h1>Mise à jour</h1>
        </div>
        <div class='wrap-form'>
            <div class='label-form'>
                <label for="mdp">Ancien mot de passe</label>
                <input id="mdp" type="password" name='mdp'>
            </div>
            <div class='label-form'>
                <label for="mdp">Nouveau mot de passe</label>
                <input id="mdp" type="password" name='mdp'>
            </div>
            <div class='label-form'>
                <label for="mdp">Confirmer mot de passe</label>
                <input id="mdp" type="password" name='mdp'>
            </div>
            <button class="btn">Modifier</button>
        </div>
    </form>
    
    <div class="btns profil-logout">
        <a href="/signin?logout" class="btn cancel">Se déconnecter</a>
    </div>

</div>


<?php 
include("../assets/php/footer.php");
?>