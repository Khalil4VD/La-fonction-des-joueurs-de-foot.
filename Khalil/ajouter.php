<!DOCTYPE html>
<html>

<head>
    <title>Ajouter</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

    <?php
    function getBD()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Articles;charset=utf8', 'root', 'root');
        return $bdd;
    }

    $bdd = getBD();

    session_start();

    if (isset($_POST['article_id']) && isset($_POST['quantité'])) {
        $article_id = $_POST['article_id'];
        $quantité = intval($_POST['quantité']);

        if ($quantité > 0) {
            $stmt = $bdd->prepare("SELECT quantités FROM articles WHERE Id_art = $article_id");
            $stmt->bindParam(':article_id', $article_id);
            $stmt->execute();
            $row = $stmt->fetch();

            if ($row) {
                $quantité_actuelle = $row['quantités'];

                $nouvelle_quantité = $quantité_actuelle - $quantité;

                $stmt = $bdd->prepare("UPDATE articles SET quantités=:nnn WHERE Id_art=:article_id");
                $stmt->bindParam(':nnn', $nouvelle_quantité);
                $stmt->bindParam(':article_id', $article_id);
                $stmt->execute();




                if (!isset($_SESSION["panier"])) {
                    $_SESSION["panier"] = array();
                }

                $trouvé = false;

                foreach ($_SESSION['panier'] as &$article) {
                    if ($article['article_id'] == $article_id) {
                        $article['quantité'] += $quantité;
                        $trouvé = true;
                        break;
                    }
                }

                if (!$trouvé) {
                    $_SESSION['panier'][] = array('article_id' => $article_id, 'quantité' => $quantité);
                }
            }
            header('Location: index.php');
            exit();
        }
    }
    ?>



</body>

</html>