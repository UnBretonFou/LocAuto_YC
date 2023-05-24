<?php
session_start();
include "../../outils/biblio.php";
$con = connexion();

// Vérifier si l'ID de la location à supprimer est spécifié
if (isset($_GET['supprimer_location'])) {
    $id_location = $_GET['supprimer_location'] ?? null;

    // Supprimer les enregistrements de la table choix_option liés à la location
    $sql_supprimer_choix_option = "DELETE FROM choix_option WHERE id_location = ?";
    $stmt_supprimer_choix_option = mysqli_prepare($con, $sql_supprimer_choix_option);
    
    if ($stmt_supprimer_choix_option) {
        mysqli_stmt_bind_param($stmt_supprimer_choix_option, "i", $id_location);
        mysqli_stmt_execute($stmt_supprimer_choix_option);
        mysqli_stmt_close($stmt_supprimer_choix_option);
        
        // Supprimer la location de la table location
        $sql_supprimer_location = "DELETE FROM location WHERE id_location = ?";
        $stmt_supprimer_location = mysqli_prepare($con, $sql_supprimer_location);
        
        if ($stmt_supprimer_location) {
            mysqli_stmt_bind_param($stmt_supprimer_location, "i", $id_location);
            mysqli_stmt_execute($stmt_supprimer_location);
            mysqli_stmt_close($stmt_supprimer_location);
            
            // Afficher un message de succès
            echo "<script>alert('La location a été supprimée avec succès.'); window.location.href = '../location.php';</script>";
            exit();
        } else {
            // Afficher un message d'erreur
            echo "<script>alert('Une erreur s'est produite lors de la suppression de la location.'); window.location.href = '../location.php';</script>";
        }
    } else {
        // Afficher un message d'erreur
        echo "<script>alert('Une erreur s'est produite lors de la suppression des choix d'options.'); window.location.href = '../location.php';</script>";
    }
}
?>