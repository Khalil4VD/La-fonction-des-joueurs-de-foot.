<!DOCTYPE html>
<html class="fondgen">

<head>
   <link rel="stylesheet" href="/Khalil/Styles/acceuil.css" type="text/css" media="screen" />
   <title>Article</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
      $(document).ready(function() {
         $('#formajoutpan').submit(function(event) {
            var quantite = parseInt($('#quantité').val());

            if (quantite <= 0) {
               alert("Veuillez entrer une quantité valide (supérieure à zéro).");
               event.preventDefault();
            } else {
               var stockDisponible = <?php echo $articles['quantités']; ?>;
               if (quantite > stockDisponible) {
                  alert("La quantité demandée dépasse le stock disponible.");
                  event.preventDefault();
               }
            }
         });
      });
   </script>
</head>

<body id="contenu">

   <?php
   function getBD()
   {
      $bdd = new PDO('mysql:host=localhost;dbname=Articles;charset=utf8', 'root', 'root');
      return $bdd;
   }


   $bdd = getBD();
   $id_art = $_GET["Id_art"];
   $rep = $bdd->query("SELECT * FROM articles WHERE Id_art = $id_art");
   if ($articles = $rep->fetch(PDO::FETCH_ASSOC)) {
      echo "<h1>" . $articles['Nom'] . "</h1>";
      echo '<img src="' . $articles['Image'] . '" alt= "Photo" height="200">';
      echo "<p class='p2'> Produit restants : " . $articles['quantités'] . "</p>";
      echo "<p class='p2'> Prix : " . $articles['prix'] . " euros </p>";
      echo "<p class='p2'> Description du maillot : </p>";
      echo "<ul class='listeDes'>";
      echo "<li>" . $articles['description'] . "</li>";
      echo "<li> Etat : neuf </li>";
      echo "<li> Retour : disponible sous 30 jours.</li>";
      echo "<li> Taille disponible : 12 ans, S , M , L , XL, XXL. </li>";
      echo "</ul>";
   } else {
      header("Location: /Khalil/index.php");
      exit;
   }

   session_start();

   //echo "Votre panier :<br>";
   //print_r($_SESSION['panier']);

   if (isset($_SESSION['Clients'])) {
      // Vérifier si la quantité en stock est supérieure à 0
      if ($articles['quantités'] > 0) {
          $article_id = $articles['Id_art'];
  
          echo "<p class='p2'>Sélectionner le nombre d'article(s) que vous souhaitez</p>";
  
          echo "<form id='formajoutpan' action='/Khalil/ajouter.php' method='post'>";
          echo "<input type='hidden' name='article_id' value='" . $article_id . "'>";
          echo "<label for='quantité'>Nombre d'exemplaires :</label>";
          echo "<input type='number' name='quantité' id='quantité' min='1' max='" . $articles['quantités'] . "' value='1' required>";
          echo "<input type='submit' value='Ajoutez à votre panier'>";
          echo "</form>";
      } else {
          echo "<p class='p3'>Cet article est actuellement épuisé.</p>";
      }
  } else {
      echo '<p class="p3">Veuillez vous connecter pour ajouter cet article à votre panier.</p>';
  }
  

   /*if (isset($_SESSION['Clients'])) {

      $article_id = $articles['Id_art'];
      //var_dump($article_id);

      echo "<p class = 'p2'> Séléctionner le nombre d'article(s) que vous souhaitez </p>";

      echo "<form id='formajoutpan' action='/Khalil/ajouter.php' method='post'>";
      echo "<input type='hidden' name='article_id' value='" . $article_id . "'>";
      echo "<label for='quantité'>Nombre d'exemplaires : </label>";
      echo "<input type='number' name='quantité' id='quantité' min='1' max ='". $articles['quantités'] ."' value='1' required>";
      echo "<input type='submit' value='Ajoutez à votre panier'>";
      echo "</form>";
   } else {
      echo '<p class="p3">Veuillez vous connecter pour ajouter cet article à votre panier.</p>';
   }*/


   echo "<p class = 'p2'> Bientôt les options de floquages seront disponibles. Merci de votre visite. A bientôt. </p>";

   $rep->closeCursor();



   ?>

   <footer>
      <a href='/Khalil/index.php'>Page d'acceuil</a>
   </footer>
</body>

</html>