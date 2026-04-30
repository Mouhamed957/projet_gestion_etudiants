<script src="assets/js/script.js"></script>
<?php
require_once "connexion.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Récupérer les infos de l’étudiant
    $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id_etudiant = :id");
    $stmt->execute([':id' => $id]);
    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer toutes les filières
    $stmtFiliere = $pdo->query("SELECT * FROM filieres");
    $filieres = $stmtFiliere->fetchAll(PDO::FETCH_ASSOC);
} else {
    die("❌ Aucun étudiant sélectionné.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier étudiant</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Modifier un étudiant</h2>
        <form action="update.php?id=<?= $etudiant['id_etudiant']; ?>" method="POST">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($etudiant['nom']); ?>" required>

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($etudiant['prenom']); ?>" required>

            <label for="filiere">Filière :</label>
            <select name="id_filiere" id="filiere" required>
                <?php foreach ($filieres as $filiere): ?>
                    <option value="<?= $filiere['id_filiere']; ?>"
                        <?= ($etudiant['id_filiere'] == $filiere['id_filiere']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($filiere['nom_filiere']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $id_filiere = $_POST['id_filiere'];

    if (!empty($nom) && !empty($prenom) && !empty($id_filiere)) {
        $stmt = $pdo->prepare("UPDATE etudiants 
                               SET nom = :nom, prenom = :prenom, id_filiere = :id_filiere 
                               WHERE id_etudiant = :id");
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':id_filiere' => $id_filiere,
            ':id' => $id
        ]);

        header("Location: index.php?updated=1");
        exit();
    } else {
        echo "❌ Erreur : tous les champs doivent être remplis.";
    }
}
?>
