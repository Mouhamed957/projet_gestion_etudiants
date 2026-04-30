<?php
// Inclusion de la connexion PDO
require_once "connexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 1. Récupérer les données envoyées
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $id_filiere = $_POST['id_filiere'];

    // 2. Vérifier que les champs ne sont pas vides (sécurité côté serveur)
    if (!empty($nom) && !empty($prenom) && !empty($id_filiere)) {
        // 3. Utiliser une requête préparée pour insérer
        $stmt = $pdo->prepare("INSERT INTO etudiants (nom, prenom, id_filiere) VALUES (:nom, :prenom, :id_filiere)");
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':id_filiere' => $id_filiere
        ]);

        // 4. Rediriger vers la page principale après insertion
        header("Location: index.php?success=1");
        exit();
    } else {
        echo "❌ Erreur : tous les champs doivent être remplis.";
    }
}
?>
