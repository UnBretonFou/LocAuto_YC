<!-- Mettre le "session_start" dessous --> 
<?php
    session_start();
    include "../outils/biblio.php";
    $con = connexion(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Clients</title>
    <link rel="stylesheet" type="text/css" href="../src/Resources/Style/style_location.css">
</head>
<body>
    <header>
        <!-- Bouton accueil -->
        <a href="index.php">Accueil</a>
        <!-- En-tête de la page -->
        <form method="POST" action="../src/controlers/ajouter_client.php">
            <h2>Ajouter un client</h2>
            <label for="nom">Nom : </label>
            <input type="text" name="nom" required><br>
            <label for="prenom">Prénom : </label>
            <input type="text" name="prenom" required><br>
            <label for="adresse">Adresse : </label>
            <input type="text" name="adresse" required><br>
            <label for="type_client">Type de client : </label>
            <select name="type_client" required>
                <option value="1">Particulier</option>
                <option value="2">Entreprise</option>
                <option value="3">Administration</option>
                <option value="4">Association</option>
                <option value="5">Longue durée</option>
            </select><br>
            <!-- Bouton Ajouter -->
            <input type="submit" value="Ajouter">
        </form>
        
    
        <form method="POST" action="../src/controlers/supprimer_client.php">   
            <h2>Supprimer un client</h2>
            <label for="client_nom">Nom du client : </label>
            <select name="client_nom" requiered>
                <?php
                    //On récupère tous les noms des clients de la base de données
                    $sql = "SELECT nom FROM client";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row["nom"] . "'>" . $row["nom"] . "</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Supprimer">
        </form>

        
        <script>
            var succesMessage = "<?php echo isset($_SESSION["message"]) ? $_SESSION["message"] : ''; ?>";
            var errorMessage = "<?php echo isset($_SESSION["error"]) ? $_SESSION["error"] : ''; ?>";
            <?php unset($_SESSION["message"], $_SESSION["error"]); ?>
        </script>

    </header>

    <main>
        
        <h1>Guest History</h1>

        <?php
            //requête sql ci-dessous
            $sql = "SELECT c.id_client, c.nom, c.prenom, c.adresse, t.libelle 
                    FROM client c
                    INNER JOIN type_de_client t ON c.id_type_de_client = t.id_type_de_client";
            $requete = mysqli_query($con, $sql);

            echo "<div class='table-container'><table style='border-collapse: collapse;'>";
            echo "<tr>
                    <th>Numéro Client</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Type de client</th>
                  </tr>";

            $compteur = 0;

            while ($resultat = mysqli_fetch_array($requete)) {
                $compteur++;
            
                $classe = ($compteur % 2 == 0) ? "even" : "odd";
            
                echo "<tr class='" . $classe . "'>
                        <td>" . $resultat["id_client"] . "</td>
                        <td>" . $resultat["nom"] . "</td>
                        <td>" . $resultat["prenom"] . "</td>
                        <td>" . $resultat["adresse"] . "</td>
                        <td>" . $resultat["libelle"] . "</td>
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


<!-- TIPS - PHP  -->
<!-- 
    header('Location: http://www.google.com/'); => redirige vers une page, comme le target="_blank".



 -->
