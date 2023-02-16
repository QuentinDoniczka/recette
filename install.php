<?php
try {
    $pdo = new PDO('sqlite:./database.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // --------------- USERS
    $pdo->query('CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email VARCHAR(255) NOT NULL,
        pseudo VARCHAR(255) NOT NULL,
        mdp VARCHAR(255) NOT NULL,
        wishlist TEXT,
        role VARCHAR(16) DEFAULT "membre"
    )');
    // Insérer administrateur par défaut
    $mdp = password_hash("admin", PASSWORD_ARGON2I);
    $req = $pdo->prepare('INSERT OR IGNORE INTO users (id, email, pseudo, mdp, role) VALUES ("1", "admin@admin.fr", "admin", :mdp, "admin")');
    $req->bindValue('mdp', $mdp);
    $req->execute();
    // --------------- RECETTES
    $pdo->query('CREATE TABLE IF NOT EXISTS receipts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        titre VARCHAR(255) NOT NULL,
        temps INT,
        ingredients TEXT,
        lang VARCHAR(3) DEFAULT "fr",
        id_owner INT,
        is_public INT DEFAULT 0,
        resume TEXT,
        description TEXT NOT NULL
    )');
    $json = file_get_contents("./receipts.json");
    $receipts = json_decode($json, true)["receipts"];
    foreach($receipts as $receipt) {
        $req2 = $pdo->prepare('INSERT OR IGNORE INTO receipts (id, titre, description, temps, ingredients, resume, is_public, id_owner) VALUES (:id, :titre, :description, :temps, :ingredients, :resume, :is_public, :id_owner)');
        $req2->bindValue('id', $receipt["id"]);
        $req2->bindValue('titre', $receipt["titre"]);
        $req2->bindValue('description', $receipt["description"]);
        $req2->bindValue('temps', $receipt["temps"]);
        $req2->bindValue('ingredients', '[{"quantity":"30","unit":"grammes","name":"oeufs"},{"quantity":"5","unit":"grammes","name":"sel"}]');
        $req2->bindValue('resume', $receipt["resume"]);
        $req2->bindValue('is_public', $receipt["is_public"]);
        $req2->bindValue('id_owner', $receipt["id_owner"]);
        $req2->execute();
    }
    // --------------- 

    echo("La base de données a bien été crée");

} catch (Exception $exception) {
    var_dump($exception->getMessage());
}