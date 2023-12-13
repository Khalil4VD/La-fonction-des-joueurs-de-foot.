<!DOCTYPE html>
<html class="mesfon">

<head>
    <title>Messagerie</title>
    <link rel="stylesheet" href="/Khalil/Styles/acceuil.css" type="text/css" media="screen" />
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <?php
    session_start();

    function getBD()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Articles;charset=utf8', 'root', 'root');
        return $bdd;
    }

    $bdd = getBD();

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
    <h2>Messagerie</h2>
    <p class="mess1">Vous voici sur la messagerie de FRS.</p>
    <a href="/Khalil/index.php" id="lienretmess">Page d'acceuil</a>
    <p class="mess2"> Nous vous prions de discuter sans utiliser des mots, phrases, expressions 'offensive'.
        <br>Les messages avec du contenu inapropriés n'aurons pas la capacité de s'envoyer.
    </p>

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
                                    url: 'messagerie.php',
                                    data: {
                                        message: message
                                    },
                                    success: function() {
                                        $('#messages').load('messagerie.php #messages');
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
        });
    </script>
</body>

</html>