<?php
require_once "config/db.php";

// Exemple d’utilisation : récupérer toutes les filières
$stmt = $pdo->query("SELECT * FROM filieres");
$filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
