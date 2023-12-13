<?php
session_start();

function verifierUtilisateur($email, $motdepasse)
{
    $bdd = new PDO('mysql:host=localhost;dbname=Articles;charset=utf8', 'root', 'root');

    $query = "SELECT * FROM `Clients` WHERE `mail`=:mail";
    $requete = $bdd->prepare($query);
    $requete->bindParam(':mail', $email, PDO::PARAM_STR);
    $requete->execute();

    $resultat = $requete->fetch(PDO::FETCH_ASSOC);

    if ($resultat && password_verify($motdepasse, $resultat['mdp'])) {
        $_SESSION['Clients'] = array(
            'id_client' => $resultat['id_client'],
            'nom' => $resultat['nom'],
            'prenom' => $resultat['prenom'],
            'adresse' => $resultat['adresse'],
            'numero' => $resultat['numero'],
            'mail' => $resultat['mail'],
            'ID_STRIPE' => $resultat['ID_STRIPE'],
        );
        return true;
    } else {
        return false;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        echo json_encode(array('valide' => false));
        exit;
    }

    if (isset($_POST['adrmail']) && isset($_POST['mdpcon'])) {
        $emailAVerifier = $_POST['adrmail'];
        $motdepasseAVerifier = $_POST['mdpcon'];

        $utilisateurValide = verifierUtilisateur($emailAVerifier, $motdepasseAVerifier);

        header('Content-Type: application/json');
        echo json_encode(array('valide' => $utilisateurValide));
        exit;
    }
}

echo json_encode(array('valide' => false));
?>

