<?php
require_once "connexion.php";

// Exemple d’utilisation : récupérer toutes les filières
$stmt = $pdo->query("SELECT * FROM filieres");
$filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<script src="assets/js/script.js"></script>
