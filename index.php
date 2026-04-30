<?php
require_once "connexion.php";

// Récupération des filières
$stmt = $pdo->query("SELECT * FROM filieres");
$filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout étudiant</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Ajouter un étudiant</h2>
        <form action="traitement.php" method="POST">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>

            <label for="filiere">Filière :</label>
            <select name="id_filiere" id="filiere" required>
                <option value="">-- Sélectionner une filière --</option>
                <?php foreach ($filieres as $filiere): ?>
                    <option value="<?= $filiere['id_filiere']; ?>">
                        <?= htmlspecialchars($filiere['nom_filiere']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>
</html>
