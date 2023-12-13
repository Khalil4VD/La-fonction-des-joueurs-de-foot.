<!DOCTYPE html>
<html class="fondgen">

<head>
    <link rel="stylesheet" href="/Khalil/Styles/acceuil.css" type="text/css" media="screen" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>
    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    function getBD()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Articles;charset=utf8', 'root', 'root');
        return $bdd;
    }

    function commander($Id_art, $idclient, $quantite)
    {
        $bdd = getBD();
        $sql = "INSERT INTO Commandes (Id_art, id_client, quantite) 
            VALUES (:Id_art, :id_client, :quantite)";
        $requete = $bdd->prepare($sql);
        $requete->bindParam(':Id_art', $Id_art, PDO::PARAM_STR);
        $requete->bindParam(':id_client', $idclient, PDO::PARAM_STR);
        $requete->bindParam(':quantite', $quantite, PDO::PARAM_STR);

        return $requete->execute();
    }

    function retirer($Id_art, $quantite)
    {
        $bdd = getBD();
        $sqlidart = "SELECT quantités FROM articles WHERE Id_art = :Id_art";
        $requeteSelect = $bdd->prepare($sqlidart);
        $requeteSelect->bindParam(':Id_art', $Id_art, PDO::PARAM_STR);
        $requeteSelect->execute();
        $row = $requeteSelect->fetch();

        if ($row) {
            $quantites_en_stock = $row['quantités'];
            if ($quantites_en_stock >= $quantite) {
                $nouvelle_quantite = $quantites_en_stock - $quantite;
                $sqlUpdate = "UPDATE Articles SET quantités = :nouvelle_quantite WHERE Id_art = :Id_art";
                $requeteUpdate = $bdd->prepare($sqlUpdate);
                $requeteUpdate->bindParam(':Id_art', $Id_art, PDO::PARAM_STR);
                $requeteUpdate->bindParam(':nouvelle_quantite', $nouvelle_quantite, PDO::PARAM_INT);
                $requeteUpdate->execute();
            }
        }
    }

    if (isset($_SESSION['panier']) && isset($_SESSION['Clients'])) {
        $paniers = $_SESSION['panier'];
        $client = $_SESSION['Clients'];
        $clientid = $client['id_client'];

        foreach ($paniers as $article) {
            $quantite_demandee = $article['quantité'];
            $artid = $article['article_id'];
            $commandereu = commander($artid, $clientid, $quantite_demandee);
        }

        if ($commandereu) {
            echo '<p class="p3">Toutes les commandes ont été enregistrées avec succès.</p>';
            $Stockajour = retirer($artid, $quantite_demandee);
            unset($_SESSION['panier']);
        } else {
            echo '<p class="p3">votre commande présente une erreur .</p>';
        }
    }

    echo "</br><a href='/Khalil/index.php'>Retour à l'acceuil</a>";
    /*var_dump($commandereu);
    var_dump($quantite_demandee);
    var_dump($artid);
    var_dump($clientid);
    echo "e";*/

    ?>
</body>

</html>