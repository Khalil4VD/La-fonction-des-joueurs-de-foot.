<script>
    const appearance = {
        theme: 'night',
        variables: {
            fontFamily: 'Sohne, system-ui, sans-serif',
            fontWeightNormal: '500',
            borderRadius: '8px',
            colorBackground: '#0A2540',
            colorPrimary: '#EFC078',
            accessibleColorOnColorPrimary: '#1A1B25',
            colorText: 'white',
            colorTextSecondary: 'white',
            colorTextPlaceholder: '#727F96',
            tabIconColor: 'white',
            logoColor: 'dark'
        },
        rules: {
            '.Input, .Block': {
                backgroundColor: 'transparent',
                border: '1.5px solid var(--colorPrimary)'
            }
        }
    };

    const elements = stripe.elements({
        clientSecret,
        appearance
    });
</script>




<?php

session_start();
require_once('vendor/autoload.php');
require_once('stripe.php');

function getBD()
{
    $bdd = new PDO('mysql:host=localhost;dbname=Articles;charset=utf8', 'root', 'root');
    return $bdd;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['csrf_token'], $_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        if (isset($_POST['prix'])) {
            $prix_final = $_POST['prix'];

            if (isset($_SESSION['Clients'])) {

                $bdd = getBD();

                $panier = isset($_SESSION['panier']) ? $_SESSION['panier'] : array();
                $client = $_SESSION['Clients'];

                if (!empty($panier)) {
                    $Panier = [];

                    foreach ($panier as $article) {
                        $id_art = $article['article_id'];
                        $quantite = $article['quantité'];

                        $requetes = "SELECT Nom, prix, ID_STRIPE FROM articles WHERE Id_art = :Id_art";
                        $stmt = $bdd->prepare($requetes);
                        $stmt->bindParam(':Id_art', $id_art, PDO::PARAM_INT);
                        $stmt->execute();
                        $ligne = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($ligne) {
                            $id_stripe = $ligne['ID_STRIPE'];

                            $Panier[] = [
                                'price' => $id_stripe,
                                'quantity' => $quantite,
                            ];
                        }
                    }

                    $checkout_session = $stripe->checkout->sessions->create([
                        'customer' => $_SESSION['Clients']['ID_STRIPE'],
                        'success_url' => 'http://localhost:8888/Khalil/acheter.php',
                        'cancel_url' => 'http://localhost:8888/Khalil/index.php',
                        'mode' => 'payment',
                        'automatic_tax' => ['enabled' => false],
                        'line_items' => $Panier,
                    ]);

                    $clientSecret = $checkout_session->client_secret;

                    header('Location: ' . $checkout_session->url);
                    exit;
                }
            }
        }
    } else {
        die("requetes CSRF invalide");
    }
}
