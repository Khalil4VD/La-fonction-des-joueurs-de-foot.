<?php
// Fonction pour établir la connexion à la base de données
function getBD(){
    $bdd = new PDO('mysql:host=localhost;dbname=Articles;charset=utf8', 'root', 'root');
    return $bdd;
}

// Vérification si l'e-mail existe déjà
function emailExists($email) {
    $db = getBD();

    $query = "SELECT COUNT(*) FROM Clients WHERE mail = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn(); // Récupère le résultat de la requête

    return $count > 0; // Vérifie si le compte est supérieur à zéro
}

header('Content-Type: application/json');

if ($_POST['mail']) {
    $email = $_POST['mail'];
    $exists = emailExists($email);
    if ($exists) {
        echo json_encode(array('exists' => true));
    } else {
        echo json_encode(array('exists' => false));
    }
} else {
    echo json_encode(array('error' => 'Invalid input'));
}
?>
