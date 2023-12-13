<?php
session_start();

$scoreMapContents = file_get_contents('ScoreMap.json');
$scoreMap = json_decode($scoreMapContents, true);

if (isset($_POST['message'])) {
    $message = $_POST['message'];

    $mots = array_unique(preg_split('/\s+/', strtolower($message)));
    $offensive = false;

    foreach ($mots as $mot) {
        if (isset($scoreMap[$mot]) && $scoreMap[$mot] > 1.5) {
            $offensive = true;
            break;
        }
    }

    if ($offensive) {
        echo "offensive";
    } else {
        echo "valid";
    }
}
?>
