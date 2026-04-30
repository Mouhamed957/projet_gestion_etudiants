<?php
require_once "connexion.php";

// Récupérer les filières pour le formulaire
$stmtFiliere = $pdo->query("SELECT * FROM filieres");
$filieres = $stmtFiliere->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les étudiants avec leur filière (jointure)
$stmtEtudiants = $pdo->query("
    SELECT e.id_etudiant, e.nom, e.prenom, f.nom_filiere
    FROM etudiants e
    INNER JOIN filieres f ON e.id_filiere = f.id_filiere
");
$etudiants = $stmtEtudiants->fetchAll(PDO::FETCH_ASSOC);
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

    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <p style="color: red; font-weight: bold; text-align:center;">
            Étudiant supprimé avec succès.
        </p>
    <?php endif; ?>

    <h2>Liste des étudiants</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Filière</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $etudiant): ?>
                <tr>
                    <td><?= htmlspecialchars($etudiant['nom']); ?></td>
                    <td><?= htmlspecialchars($etudiant['prenom']); ?></td>
                    <td><?= htmlspecialchars($etudiant['nom_filiere']); ?></td>
                    <td>
                        <a href="update.php?id=<?= $etudiant['id_etudiant']; ?>">Modifier</a> |
                        <a href="delete.php?id=<?= $etudiant['id_etudiant']; ?>" onclick="return confirm('Supprimer cet étudiant ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="assets/js/script.js"></script>
</body>
</html>
