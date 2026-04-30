<?php
require_once "connexion.php";

// Exemple d’utilisation : récupérer toutes les filières
$stmt = $pdo->query("SELECT * FROM filieres");
$filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
require_once "connexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $id_filiere = $_POST['id_filiere'];

    $stmt = $pdo->prepare("INSERT INTO etudiants (nom, prenom, id_filiere) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $prenom, $id_filiere]);

    echo "Étudiant ajouté avec succès ! <a href='index.php'>Retour</a>";
}
?>
