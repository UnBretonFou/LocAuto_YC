<?php
    session_start();
    include "../outils/biblio.php";
    $con = connexion(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Facturation</title>
    <link rel="stylesheet" type="text/css" href="../src/Resources/Style/style_location.css">
</head>
<body>
    <header>
        <!-- Bouton accueil -->
        <a href="index.php">Accueil</a>
        <!-- En-tête de la page -->
        <form method="POST" action="../src/controlers/ajouter_location.php">
            <h2>Ajouter une location</h2>
            <label for="voiture">Modèle: </label>
            <select name="voiture" required>
                <?php
                    // Récupère tous les modèles de voiture de la base de données.
                    $sql = "SELECT v.id_voiture, v.immatriculation, m.id_modele, m.libelle
                            FROM voiture v
                            INNER JOIN modele m ON v.id_modele = m.id_modele";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row["id_voiture"] . "'>" . $row["immatriculation"] . " // " . $row["libelle"] . "</option>";
                    }
                ?>
            </select><br>
            <label for="client">Nom du client : </label> 
                <select name="client" requiered>
                <?php
                    //On récupère tous les noms des clients de la base de données
                    $sql = "SELECT id_client, nom 
                            FROM client";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row["id_client"] . "'>" . $row["nom"] . "</option>";
                    }
                ?>
            </select>
            </label><br>
            <label for="compteur_debut">Compteur début : </label>
            <input type="text" name="compteur_debut" required><br>
            <label for="compteur_fin">Compteur fin : </label>
            <input type="text" name="compteur_fin" required><br>
            <label for="date_debut">Date début : </label>
            <input type="date" name="date_debut" pattern="\d{4}/\d{2}/\d{2}" required><br>
            <label for="date_fin">Date fin : </label>
            <input type="date" name="date_fin" pattern="\d{4}/\d{2}/\d{2}" required><br>

            <label for="choix_option">Choix option :</label><br>
                <select name="choix_option[]" multiple required>
                    <option value="1">Assurance complémentaire</option>
                    <option value="2">Nettoyage</option>
                    <option value="3">Complément carburant</option>
                    <option value="4">Retour autre ville</option>
                    <option value="5">Rabais dimanche</option>
                    <option value="6">Tout propre</option>
                </select><br><br>
            <!-- Bouton Ajouter -->
            <input type="submit" value="Ajouter">
        </form>
    </header>

    <main>
    <h1>Location</h1>
        <?php
                //requête sql ci-dessous
                $sql = "SELECT location.id_location, client.nom AS nom_locataire, modele.libelle AS modele_voiture, location.date_debut, location.date_fin, location.compteur_debut, location.compteur_fin,
                (SELECT GROUP_CONCAT(option.libelle SEPARATOR ', ') FROM choix_option INNER JOIN option ON choix_option.id_option = option.id_option WHERE choix_option.id_location = location.id_location) AS options
                FROM location
                INNER JOIN client ON location.id_client = client.id_client
                INNER JOIN modele ON location.id_voiture = modele.id_modele";
                $requete = mysqli_query($con, $sql);

                echo "<div class='table-container'><table style='border-collapse: collapse;'>";
                echo "<tr>
                        <th>Numéro location</th>
                        <th>Nom locataire</th>
                        <th>Modèle voiture</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Compteur début</th>
                        <th>Compteur fin</th>
                        <th>Options</th>
                        <th>Actions</th>
                      </tr>";

                $compteur = 0;

                while ($resultat = mysqli_fetch_array($requete)) {
                    $compteur++;
                    $classe = ($compteur % 2 == 0) ? "even" : "odd";
                    
                    echo "<tr class='" . $classe . "'>
                        <td>" . $resultat["id_location"] . "</td>
                        <td>" . $resultat["nom_locataire"] . "</td>
                        <td>" . $resultat["modele_voiture"] . "</td>
                        <td>" . $resultat["date_debut"] . "</td>
                        <td>" . $resultat["date_fin"] . "</td>
                        <td>" . $resultat["compteur_debut"] . "</td>
                        <td>" . $resultat["compteur_fin"] . "</td>
                        <td>" . $resultat["options"] . "</td>
                        <td><a href=../src/controlers/supprimer_location.php?supprimer_location=" . $resultat["id_location"] . "'>Supprimer</a></td>
                    </tr>";
                }

                echo "</table></div>";
            ?>

    </main>

    <footer>
        <!-- Pied de page -->
    </footer>
</body>
</html>
