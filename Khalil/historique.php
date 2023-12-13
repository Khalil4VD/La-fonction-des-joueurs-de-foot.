<!DOCTYPE html>
<html class="fondgen">

<head>
    <link rel="stylesheet" href="/Khalil/Styles/acceuil.css" type="text/css" media="screen" />
    <title>Historique</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>
    <p class="p3">Historique de vos commandes</p>
    <?php

    function getBD()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Articles;charset=utf8', 'root', 'root');
        return $bdd;
    }

    session_start();

    $idClient = $_SESSION['Clients']["id_client"];
    //var_dump($idClient);
    $bdd = getBD();

    $sql = "SELECT Commandes.id_commande, Commandes.Id_art, articles.nom, 
    articles.prix, Commandes.quantite, Commandes.envoi
    FROM Commandes 
    INNER JOIN articles ON Commandes.Id_art = articles.Id_art
    WHERE Commandes.id_client = :id_client";

    $requete = $bdd->prepare($sql);

    $requete->bindValue(':id_client', $idClient, PDO::PARAM_INT); 



    $requete->execute();
    //var_dump($requete->execute());


    echo '<table id="histo">
            <tr>
                <th>Id_Commande</th>
                <th>Id_Article</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité demandée</th>
                <th>Commande traite?</th>
            </tr>';



    while ($ligne = $requete->fetch()) {
        echo '<tr>
                <td>' . $ligne['id_commande'] . '</td>
                <td>' . $ligne['Id_art'] . '</td>
                <td>' . $ligne['nom'] . '</td>
                <td>' . $ligne['prix'] . '</td>
                <td>' . $ligne['quantite'] . '</td>
                <td>' . $ligne['envoi'] . '</td>
            </tr>';
    }

    echo '</table></br>';

    ?>

<a href='/Khalil/index.php'>Page d'acceuil</a>
</body>

</html>