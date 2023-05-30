<?php
session_start();
include "../../outils/biblio.php";
$con = connexion();
?>
<?php
// Vérifier si l'identifiant de la voiture est passé en paramètre dans l'URL
if (isset($_GET['id_voiture'])) {
    $id_voiture = $_GET['id_voiture'];

    // Récupérer les informations actuelles de la voiture à partir de la base de données
    $sql_select_voiture = "SELECT * FROM voiture WHERE id_voiture = '$id_voiture'";
    $result_select_voiture = mysqli_query($con, $sql_select_voiture);
    $voiture = mysqli_fetch_assoc($result_select_voiture);

    // Vérifier si la voiture existe
    if (!$voiture) {
        // Afficher un message d'erreur si la voiture n'existe pas
        echo "<script>alert('La voiture sélectionnée n'existe pas.'); window.location.href = '../recherche.php';</script>";
        exit();
    }

    // Traiter le formulaire de modification
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les nouvelles valeurs du formulaire
        $nouvelle_immatriculation = $_POST["immatriculation"];
        $nouveau_compteur = $_POST["compteur"];

        // Mettre à jour les informations de la voiture dans la base de données
        $sql_update_voiture = "UPDATE voiture SET immatriculation = '$nouvelle_immatriculation', compteur = '$nouveau_compteur' WHERE id_voiture = '$id_voiture'";
        $result_update_voiture = mysqli_query($con, $sql_update_voiture);

        // Afficher un message de succès
        echo "<script>alert('Les informations de la voiture ont été modifiées avec succès.'); window.location.href = '../recherche.php';</script>";
        exit();
    }
}
?>

<!-- HTML du formulaire de modification -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../Resources/Style/style_LRCM.css">
    <title>Modifier une voiture</title>
    <!-- Inclure les styles CSS nécessaires -->
    
</head>
<body>
    <h2>Modifier une voiture</h2>
    <form method="POST" action="../controlers/modifier_vehicule.php?id_voiture=<?php echo $id_voiture; ?>">
        <!-- Afficher les informations actuelles de la voiture dans les champs du formulaire -->
        <label for="immatriculation">Immatriculation :</label>
        <input type="varchar" name="immatriculation" value="<?php echo $voiture['immatriculation']; ?>" required><br>

        <label for="compteur">Compteur - Km :</label>
        <input type="int" name="compteur" value="<?php echo $voiture['compteur']; ?>"><br><br>

        <!-- Bouton Modifier -->
        <button type="submit" class="edit-button">Valider</button>
        <a href="../recherche.php" class="cancel-button">Annuler</a>
    </form>
</body>
</html>
