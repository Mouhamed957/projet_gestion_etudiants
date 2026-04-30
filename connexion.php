<?php
// config/db.php

$host = "localhost";
$dbname = "gestion_etudiants";
$username = "root";   // à adapter selon ton environnement
$password = "";       // idem, mettre ton mot de passe si nécessaire

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Activer les erreurs PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
