<?php
session_start();
include "../../outils/biblio.php";
$con = connexion();

// Vérifier si l'ID du véhicule à supprimer est spécifié
if (isset($_GET['supprimer_vehicule'])) {
    $id_voiture = $_GET['supprimer_vehicule'] ?? null;

    $sql_supprimer_vehicule = "DELETE FROM voiture WHERE id_voiture = ?";
    $stmt_supprimer_vehicule = mysqli_prepare($con, $sql_supprimer_vehicule);
    
    if ($stmt_supprimer_vehicule) {
        mysqli_stmt_bind_param($stmt_supprimer_vehicule, "i", $id_voiture);
        mysqli_stmt_execute($stmt_supprimer_vehicule);
        mysqli_stmt_close($stmt_supprimer_vehicule);

        echo "<script>alert('Le véhicule a été supprimé avec succès.'); window.location.href = '../recherche.php';</script>";
        exit();
    } else {

        echo "<script>alert('Une erreur s\'est produite lors de la suppression du véhicule.'); window.location.href = '../recherche.php';</script>";
    }
}
?>
