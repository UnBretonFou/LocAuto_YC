<?php
session_start();
include "../../outils/biblio.php";
$con = connexion();
?>

<?php
// On récupère ici les données du formulaire
$id_marque = $_POST["id_marque"];
$id_modele = $_POST["id_modele"];
$immatriculation = $_POST["immatriculation"];
$compteur = $_POST["compteur"];

// Requête SQL pour insérer dans la table "voiture"
$sql_voiture = "INSERT INTO voiture (immatriculation, compteur, id_modele) VALUES ('$immatriculation', '$compteur', '$id_modele')";
$result_voiture = mysqli_query($con, $sql_voiture);

if ($result_voiture) {
    // Récupère l'id de la dernière insertion dans la table "voiture"
    $id_voiture = mysqli_insert_id($con);

    // Requête SQL pour insérer dans la table "marque"
    $sql_marque = "INSERT INTO marque (id_marque) VALUES ('$id_marque')";
    $result_marque = mysqli_query($con, $sql_marque);

    // Requête SQL pour insérer dans la table "modele"
    $sql_modele = "INSERT INTO modele (id_modele) VALUES ('$id_modele')";
    $result_modele = mysqli_query($con, $sql_modele);

    // Requête SQL pour mettre à jour la voiture avec l'id du modèle
    $sql_update_voiture = "UPDATE voiture SET id_modele = '$id_modele' WHERE id_voiture = '$id_voiture'";
    $result_update_voiture = mysqli_query($con, $sql_update_voiture);

    // Afficher un message de succès
    echo "<script>alert('Le véhicule a été ajouté avec succès.'); window.location.href = '../recherche.php';</script>";
    exit();
} else {
    // Afficher un message d'erreur
    echo "<script>alert('Une erreur s\'est produite lors de l\'ajout du véhicule.'); window.location.href = '../recherche.php';</script>";
}
?>
