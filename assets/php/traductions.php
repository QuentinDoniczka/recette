<?php 

function traduction() {
    $traduction = [];
    $traduction["fr"] = [];
    $traduction["en"] = [];
    // -------------------- Traduction Français
    $traduction["fr"]["accueil"] = [];
    $traduction["fr"]["accueil"]["titre"] = "Bienvenue sur \"My App\"";
    $traduction["fr"]["accueil"]["titre2"] = "Voir la dernière recette :";
    $traduction["fr"]["accueil"]["info"] = "Voir la recette";
    $traduction["fr"]["accueil"]["info_all"] = "Voir toutes les recettes";

    $traduction["fr"]["lang"] = [];
    $traduction["fr"]["lang"]["change_fr"] = "Traduire le site en français";
    $traduction["fr"]["lang"]["change_en"] = "Traduire le site en anglais";

    $traduction["fr"]["gestion"] = [];
    $traduction["fr"]["gestion"]["btn_edit"] = "Editer";
    $traduction["fr"]["gestion"]["btn_delete"] = "Supprimer";

    $traduction["fr"]["recette"] = [];
    $traduction["fr"]["recette"]["titre_privee"] = "Page de recette (privée)";
    $traduction["fr"]["recette"]["titre_public"] = "Page de recette (public)";
    $traduction["fr"]["recette"]["creation"] = "Création";
    $traduction["fr"]["recette"]["modif"] = "Modification";
    $traduction["fr"]["recette"]["recette"] = "recette";
    $traduction["fr"]["recette"]["titre"] = "Titre de la recette";
    $traduction["fr"]["recette"]["temps"] = "Temps de préparation (min)";
    $traduction["fr"]["recette"]["description"] = "Courte description";
    $traduction["fr"]["recette"]["ingredient"] = "Ingrédients";
    $traduction["fr"]["recette"]["t_ingredient"] = "Ecrire votre ingrédient ...";
    $traduction["fr"]["recette"]["q_ingredient"] = "Quantité";
    $traduction["fr"]["recette"]["u_ingredient"] = "Unité";
    $traduction["fr"]["recette"]["n_ingredient"] = "Nom ingrédient";
    $traduction["fr"]["recette"]["add"] = "Ajouter";
    $traduction["fr"]["recette"]["etape"] = "Etapes";
    $traduction["fr"]["recette"]["e_etape"] = "Ecrire votre étape ...";
    $traduction["fr"]["recette"]["save"] = "Enregistrer";
    $traduction["fr"]["recette"]["cancel"] = "Annuler";
    $traduction["fr"]["recette"]["r_liste"] = "Retour à la liste";
    $traduction["fr"]["recette"]["indispo"] = "Recette indisponible";
    $traduction["fr"]["recette"]["time"] = "Temps de préparations :";
    $traduction["fr"]["recette"]["n_recette"] = "Nouvelle recette";
    $traduction["fr"]["recette"]["propose"] =  "Proposer ma recette";
    $traduction["fr"]["recette"]["voir"] = "Voir la recette";
    $traduction["fr"]["recette"]["edit"] = "Editer";
    $traduction["fr"]["recette"]["sup"] = "Supprimer";
    $traduction["fr"]["recette"]["none"] = "Il n'y a pas de recettes à afficher.";

    //Form signin
    $traduction["fr"]["signin"] = [];
    $traduction["fr"]["signin"]["titre"] = "Connexion";
    $traduction["fr"]["signin"]["mail"] = "Email";
    $traduction["fr"]["signin"]["name"] = "Pseudo";
    $traduction["fr"]["signin"]["mdp"] = "Mot de passe";
    $traduction["fr"]["signin"]["c_mdp"] = "Confirmation de mot de passe";
    $traduction["fr"]["signin"]["connect"] = "Se connecter";
    $traduction["fr"]["signin"]["inscrire"] = "S'inscrire";
    $traduction["fr"]["signin"]["membre"] = "Déjà membre ?";
    $traduction["fr"]["signin"]["success"] = "Inscription réussie, veuillez vous connecter.";
   
    //Header
    $traduction["fr"]["header"]["home"] = "Accueil";
    $traduction["fr"]["header"]["profil"] = "Profil";
    $traduction["fr"]["header"]["recette"] = "Recettes";
    $traduction["fr"]["header"]["m_recette"] = "Mes recettes";
    $traduction["fr"]["header"]["course"] = "Liste de courses";
    $traduction["fr"]["header"]["utilisateur"] = "Gestion des utilisateurs";
    $traduction["fr"]["header"]["deco"] = "Me deconnecter";

    //Erreurs
    $traduction["fr"]["error_signin"]["pseudo"] = "Ce pseudo est déjà pris";
    $traduction["fr"]["error_signin"]["mdp"] = "Mots de passes differents";
    $traduction["fr"]["error_signin"]["email"] = "Email invalide";
    $traduction["fr"]["error_signin"]["user_ok"] = "Utilisateur bien enregistré.";
    $traduction["fr"]["error_signin"]["fields"] = "Les champs ne sont pas bien remplis.";
    $traduction["fr"]["error_signin"]["connect_ok"] = "Connexion réussie.";
    $traduction["fr"]["error_signin"]["id"] = "Les identifiants sont incorrects.";

    //Erreurs rôles
    $traduction["fr"]["msg_role"]["droit"] = "Vous ne pouvez pas modifier les rôles.";
    $traduction["fr"]["msg_role"]["self"] = "Vous ne pouvez pas modifier votre propre rôle.";
    $traduction["fr"]["msg_role"]["update"] = "Rôle mis à jour.";
    $traduction["fr"]["msg_role"]["error"] = "Une erreur est survenu, veuillez réessayer plus tard.";

    $traduction["fr"]["recette"]["my_fav"] = "Mes favoris";
    $traduction["fr"]["recette"]["fav"] = "Favori";
    $traduction["fr"]["recette"]["moderation"] = "Modération des recettes";
    $traduction["fr"]["recette"]["add_course"] = "Ajouter à ma liste de course";

    //Liste de course 
    $traduction["fr"]["liste"]["titre"] = "Ma liste de courses";
    $traduction["fr"]["liste"]["nombre"] = "Nombre de recettes choisies :";
    $traduction["fr"]["liste"]["creat"] = "Générer ma liste";
    $traduction["fr"]["liste"]["vide"] = "Liste de course vide";

    //Management
    $traduction["fr"]["manage"]["titre"] = "Gestion des utilisateurs";
    $traduction["fr"]["manage"]["membre"] = "Membre";

    // -------------------- Traduction Anglais
    $traduction["en"]["accueil"] = [];
    $traduction["en"]["accueil"]["titre"] = "Welcome to \"My App\"";
    $traduction["en"]["accueil"]["titre2"] = "See the last receipt :";
    $traduction["en"]["accueil"]["info"] = "See receipt";
    $traduction["en"]["accueil"]["info_all"] = "See every receipts";

    $traduction["en"]["lang"] = [];
    $traduction["en"]["lang"]["change_fr"] = "Traduire le site en français";
    $traduction["en"]["lang"]["change_en"] = "Traduire le site en anglais";

    $traduction["en"]["gestion"] = [];
    $traduction["en"]["gestion"]["btn_edit"] = "Editer";
    $traduction["en"]["gestion"]["btn_delete"] = "Supprimer";

    //Form signin
    $traduction["en"]["signin"] = [];
    $traduction["en"]["signin"]["titre"] = "Connection";
    $traduction["en"]["signin"]["mail"] = "Email";
    $traduction["en"]["signin"]["name"] = "Pseudo";
    $traduction["en"]["signin"]["mdp"] = "Password";
    $traduction["en"]["signin"]["c_mdp"] = "Confirm password";
    $traduction["en"]["signin"]["connect"] = "Log in";
    $traduction["en"]["signin"]["inscrire"] = "Register";
    $traduction["en"]["signin"]["membre"] = "Already member ?";
    $traduction["en"]["signin"]["success"] = "Register done, please login.";
    $traduction["en"]["signin"]["success"] = "Register done, please login.";

    //Header
    $traduction["en"]["header"]["home"] = "Homepage";
    $traduction["en"]["header"]["profil"] = "Profil";
    $traduction["en"]["header"]["recette"] = "Receipt";
    $traduction["en"]["header"]["m_recette"] = "My Receipt";
    $traduction["en"]["header"]["course"] = "Shopping list";
    $traduction["en"]["header"]["utilisateur"] = "User management";
    $traduction["en"]["header"]["deco"] = "Logout";

    //Erreurs
    $traduction["en"]["error_signin"]["pseudo"] = "This pseudo is already taken";
    $traduction["en"]["error_signin"]["mdp"] = "password is not matching";
    $traduction["en"]["error_signin"]["email"] = "Email invalid";
    $traduction["en"]["error_signin"]["user_ok"] = "User well saved";
    $traduction["en"]["error_signin"]["fields"] = "The fields are not filled in correctly.";
    $traduction["en"]["error_signin"]["connect_ok"] = "Successful connection.";
    $traduction["en"]["error_signin"]["id"] = "Identifiers are incorrect.";

    //Erreurs rôles
    $traduction["en"]["msg_role"]["droit"] = "You cannot change roles.";
    $traduction["en"]["msg_role"]["self"] = "You cannot change your won role.";
    $traduction["en"]["msg_role"]["update"] = "Updated role";
    $traduction["en"]["msg_role"]["error"] = "An error has occurred, please try again later.";
    
    //Recette 
    $traduction["en"]["recette"] = [];
    $traduction["en"]["recette"]["titre_privee"] = "Receipts page (private)";
    $traduction["en"]["recette"]["titre_public"] = "Receipts page (public)";
    $traduction["en"]["recette"]["creation"] = "Creation";
    $traduction["en"]["recette"]["modif"] = "Edit";
    $traduction["en"]["recette"]["recette"] = "receipt";
    $traduction["en"]["recette"]["titre"] = "Receipts title";
    $traduction["en"]["recette"]["temps"] = "Preparation time (mins)";
    $traduction["en"]["recette"]["description"] = "Short Description";
    $traduction["en"]["recette"]["ingredient"] = "Ingredients";
    $traduction["en"]["recette"]["t_ingredient"] = "Write your ingredient...";
    $traduction["en"]["recette"]["q_ingredient"] = "Quantity";
    $traduction["en"]["recette"]["u_ingredient"] = "Unit";
    $traduction["en"]["recette"]["n_ingredient"] = "Ingredient name";
    $traduction["en"]["recette"]["add"] = "Add";
    $traduction["en"]["recette"]["etape"] = "Steps";
    $traduction["en"]["recette"]["e_etape"] = "Write your step...";
    $traduction["en"]["recette"]["save"] = "Save";
    $traduction["en"]["recette"]["cancel"] = "Cancel";
    $traduction["en"]["recette"]["r_liste"] = "Back to list";
    $traduction["en"]["recette"]["indispo"] = "Recipe unavailable";
    $traduction["en"]["recette"]["time"] = "Preparation time:";
    $traduction["en"]["recette"]["n_recette"] = "New recipe";
    $traduction["en"]["recette"]["propose"] =  "Submit my recipe";
    $traduction["en"]["recette"]["voir"] = "See the recipe";
    $traduction["en"]["recette"]["edit"] = "Edit";
    $traduction["en"]["recette"]["sup"] = "Delete";
    $traduction["en"]["recette"]["none"] = "There are no recipes to display.";

    $traduction["en"]["recette"]["my_fav"] = "My favorites";
    $traduction["en"]["recette"]["fav"] = "Favorite";
    $traduction["en"]["recette"]["moderation"] = "Management receipt public";
    $traduction["en"]["recette"]["add_course"] = "Add to my wishlist";

    $traduction["en"]["liste"]["titre"] = "My shopping list";
    $traduction["en"]["liste"]["nombre"] = "Number of recipes chosen :";
    $traduction["en"]["liste"]["creat"] = "Generate my list";
    $traduction["en"]["liste"]["vide"] = "Shopping list is empty";
    
    //Management
    $traduction["en"]["manage"]["titre"] = "User management";
    $traduction["en"]["manage"]["membre"] = "Member";

    return $traduction;
}

if($_GET && $_GET["lang"]) {
    session_start();
    $langues = ["fr", "en"];
    $_SESSION["lang"] = (in_array($_GET["lang"], $langues))?$_GET["lang"]:"fr";
}