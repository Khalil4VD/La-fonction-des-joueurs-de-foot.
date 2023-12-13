<!DOCTYPE html>
<html class="fondgen">

<head>
    <title>Panier</title>
    <link rel="stylesheet" href="/Khalil/Styles/acceuil.css" type="text/css" media="screen" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

    <?php

    function getBD()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Articles;charset=utf8', 'root', 'root');
        return $bdd;
    }

    session_start();

    //var_dump($_SESSION['panier']);

    if (isset($_SESSION['panier'])) {
        $panier = $_SESSION['panier'];
        $bdd = getBD();

        echo '<h1> Votre panier :</h1></br>';

        echo '<table id="panier">';
        echo '<tr>';
        echo '<th>Id_art</th>';
        echo '<th>Nom</th>';
        echo '<th>Prix</th>';
        echo '<th>Quantité demandée</th>';
        echo '<th>Prix total</th>';
        echo '</tr>';

        $prixfinal = 0;

        foreach ($panier as $article) {
            $article_id = $article['article_id'];
            $quantite_demandee = $article['quantité'];

            $rep = $bdd->query("SELECT * FROM articles WHERE Id_art = $article_id");
            $ligne = $rep->fetch();

            if ($ligne) {
                $id_art = $ligne['Id_art'];
                $nom = $ligne['Nom'];
                $prix = $ligne['prix'];

                $prixart = $prix * $quantite_demandee;
                $prixfinal += $prixart;

                echo "<tr>";
                echo "<td>" . $id_art . "</td>";
                echo "<td>" . $nom . "</td>";
                echo "<td>" . $prix . "</td>";
                echo "<td>" . $quantite_demandee . "</td>";
                echo "<td>" . $prixart . "</td>";
                echo "</tr>";
            }
        }
        echo '<tr>';
        echo '<td colspan="4">Prix total de votre commande :</td>';
        echo '<td>' . $prixfinal . '</td>';
        echo '</tr>';
        echo "</table>";
        echo "</br>";

        echo "</br>";
        echo '<p class="p3"> Montant total à payer : ' . $prixfinal . ' euros.</p>';
    } else {
        echo '<p class="p3"> Votre panier ne contient aucun articles</p>';
    }

    if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
        $_SESSION['prixcommande'] = $prixfinal;
        
        $token = bin2hex(random_bytes(32)); // Génère un jeton aléatoire (32 bytes)
        $_SESSION['csrf_token'] = $token;
        ?>
        <form action="commande.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
            <input type="hidden" name="prix" value="<?php echo $prixfinal; ?>">
            <input id = "boutcomm" type="submit" value="Passer La Commande">
        </form>
        <?php
    }

    ?>
    </br>
    <a href='/Khalil/index.php'>Page d'acceuil</a>

</body>

</html>