<?php
require_once "connexion.php";

// Exemple d’utilisation : récupérer toutes les filières
$stmt = $pdo->query("SELECT * FROM filieres");
$filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
require_once "connexion.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Requête préparée pour sécuriser la suppression
    $stmt = $pdo->prepare("DELETE FROM etudiants WHERE id_etudiant = :id");
    $stmt->execute([':id' => $id]);

    // Redirection vers la page principale
    header("Location: index.php?deleted=1");
    exit();
} else {
    echo "❌ Erreur : aucun étudiant sélectionné.";
}
?>
