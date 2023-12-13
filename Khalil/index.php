<!DOCTYPE html>
<html class="fondgen">

<head>
    <link rel="stylesheet" href="/Khalil/Styles/acceuil.css" type="text/css" media="screen" />
    <title>Foot Retro</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <p class='p2'>Football Rétro Store FRS</p>

    <?php
    session_start();

    if (isset($_SESSION['Clients'])) :
        $prenom = $_SESSION['Clients']["prenom"];
        $nom = $_SESSION['Clients']["nom"];
    ?>
        <h2>Bonjour <?= $prenom . " " . $nom ?></h2>
        <ul class="menu">
            <li><a href="/Khalil/panier.php">Consulter le panier</a></li>
            <li><a href="/Khalil/historique.php">Historique des commandes</a></li>
            <li><a href="/Khalil/deconnexion.php">Se déconnecter</a></li>
            <li><a href="/Khalil/Contacts/Contact.html">Contacts</a></li>
        </ul>
    <?php else : ?>
        <ul class="menu">
            <li><a href="/Khalil/new.php">Nouveau client?</a></li>
            <li><a href="/Khalil/connexion.php">Se connecter</a></li>
        </ul>
    <?php endif; ?>

    <?php
    include("bd.php");

    $bdd = getBD();

    echo '<br>';
    echo "<table id='tableau'>";
    echo '<tr>
        <th>Nom</th>
        <th>Stock</th>
        <th>Prix</th>
        <th>Photo</th>
        <th>Description</th>
        </tr>';

    $rep = $bdd->prepare("SELECT * from articles");
    $rep->execute();

    while ($ligne = $rep->fetch()) {
        echo "<tr>";
        echo '<td><a href="/Khalil/Articles/article2.php?Id_art=' . $ligne['Id_art'] . ' ">' . $ligne['Nom'] . '</a></td>';
        echo "<td>" . $ligne['quantités'] . "</td>";
        echo "<td>" . $ligne['prix'] . "</td>";
        echo '<td><img src="' . $ligne['Image'] . '" alt="' . $ligne['Nom'] . '" height = "100"></td>';
        echo "<td>" . $ligne['description'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    $rep->closeCursor();

    if (isset($_SESSION['Clients'])) {
        $deleteQuery = $bdd->prepare("DELETE FROM message WHERE TIMESTAMPDIFF(SECOND, timestamp, NOW()) > 600"); // 600 secondes équivalent à 10 minutes
        $deleteQuery->execute();


        if (isset($_POST['message'])) {
            if (!empty($_POST['message'])) {
                $message = nl2br(htmlspecialchars($_POST['message']));

                if (strlen($message) <= 256) {
                    $id_client = $_SESSION['Clients']['id_client'];

                    $inserer = $bdd->prepare('INSERT INTO message(Id_client, mess, timestamp) VALUES(?, ?, CURRENT_TIMESTAMP)');
                    $inserer->execute(array($id_client, $message));
                } else {
                    echo "Le message ne doit pas dépasser 256 caractères.";
                }
            } else {
                echo "Veuillez saisir un message";
            }
            exit;
        }
        $messagesQuery = $bdd->query("SELECT * FROM message WHERE TIMESTAMPDIFF(MINUTE, timestamp, NOW()) <= 10 ORDER BY timestamp DESC");


    ?>
        <div class="sidebar">
            <h2>Messagerie</h2>

            <form id="messageForm">
                <textarea name="message"></textarea>
                <br>
                <input type="submit" value="Envoyer">
            </form>

            <section id="messages">
                <?php
                $query = $bdd->prepare("
        SELECT m.mess, m.timestamp, c.nom, c.prenom
        FROM message m
        JOIN Clients c ON m.Id_client = c.id_client
        WHERE TIMESTAMPDIFF(MINUTE, m.timestamp, NOW()) <= 10
        ORDER BY m.timestamp DESC
    ");
                $query->execute();

                while ($message = $query->fetch()) {
                    echo '<p>' . $message['nom'] . ' ' . $message['prenom'] . ' dit : - ' . $message['mess'] . '</p>';
                }
                ?>
            </section>
        </div>
    <?php
    } else {
    ?>
        <div class="sidebar">
            <p>Pour utiliser notre messagerie, veuillez vous connecter ou créer un compte.<br>L'équipe FRS.</p>
        </div>
    <?php
    }
    ?>


    <script>
        $(document).ready(function() {
            $('#messageForm').submit(function(e) {
                e.preventDefault();
                var message = $('textarea[name=message]').val();
                if (message.length <= 256) {
                    $.ajax({
                        type: 'POST',
                        url: 'checkmess.php',
                        data: {
                            message: message
                        },
                        success: function(response) {
                            console.log(response);
                            if (response === "valid") {
                                $.ajax({
                                    type: 'POST',
                                    url: 'index.php',
                                    data: {
                                        message: message
                                    },
                                    success: function() {
                                        $('#messages').load('index.php #messages');
                                        $('textarea[name=message]').val('');
                                    }
                                });
                            } else {
                                alert("Le message est jugé offensant et ne peut pas être envoyé.");
                            }
                        }
                    });
                } else {
                    alert("Le message ne doit pas dépasser 256 caractères.");
                }
            });
            setInterval(function() {
            $('#messages').load('index.php #messages');
            }, 2000);
        });
    </script>

</body>

</html>