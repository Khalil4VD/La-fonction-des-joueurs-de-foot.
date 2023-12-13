<!DOCTYPE html>
<html class="fondgen">

<head>
  <title>Connexion</title>
  <link rel="stylesheet" href="/Khalil/Styles/acceuil.css" type="text/css" media="screen" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

  <p class='p2'> Si jamais vous n'avez pas de compte, vous pouvez en créer un. </p>
  <a href='/Khalil/new.php'>Créer un compte</a></br>
  <p class='p2'> Vous avez déjà un compte ? Connectez-vous. </p></br>

  <?php
  session_start();

  function generateCSRFToken()
  {
    $token = bin2hex(random_bytes(64));
    $_SESSION['csrf_token'] = $token;
    return $token;
  }
  ?>

  <form id="loginForm" action="connecter.php" method="post" autocomplete="off">
    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
    <p> Identifiant (mail): <input type="text" name="adrmail" value=""><br></p>
    <p> Mot de passe : <input type="password" name="mdpcon" value=""><br></p>
    <p><input type="submit" id="seconn" value="Se connecter"></p>
  </form>

  <script>
    $(document).ready(function() {
      $('#loginForm').submit(function(event) {
        event.preventDefault();

        var emailInput = $('input[name="adrmail"]');
        var passwordInput = $('input[name="mdpcon"]');
        var emailValue = emailInput.val().trim();
        var passwordValue = passwordInput.val().trim();
        var emailFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        $('.error-message').remove();
        emailInput.css('border', '1px solid #ccc');
        passwordInput.css('border', '1px solid #ccc');
        $('#form-error').remove();

        if (emailValue !== '' && passwordValue !== '') {
          if (emailFormat.test(emailValue)) {
            var formData = $(this).serialize();
            console.log(formData);

            $.ajax({
              url: 'connecter.php',
              type: 'POST',
              data: formData,
              dataType: 'json',
              success: function(response) {
                console.log(response);
                if (response.valide === true) {
                  $('body').prepend('<p id="success-message" style="color: white; background: green; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); width: 200px; text-align: center;">Connexion en cours. Vous allez être redirigé.</p>');
                  setTimeout(function() {
                    window.location.href = 'index.php';
                  }, 3000);
                } else {
                  $('body').prepend('<p id="success-message" style="color: white; background: red; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); width: 200px; text-align: center;">Mot de passe incorrect ou email introuvable</p>');
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX Error:", textStatus, errorThrown);
              }
            });
          } else {
            emailInput.after('<p class="error-message" style="color: red;">Adresse e-mail incorrecte</p>');
            emailInput.css('border', '1px solid red');
          }
        } else {
          $('body').prepend('<p id="success-message" style="color: white; background: red; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); width: 200px; text-align: center;">Veuillez remplir les champs vides</p>');
          if (emailValue === '') {
            emailInput.css('border', '1px solid red');
          }
          if (passwordValue === '') {
            passwordInput.css('border', '1px solid red');
          }
        }
      });

      $('input[name="adrmail"], input[name="mdpcon"]').on('input', function() {
        $('#success-message').remove(); 
      });

      $('input[name="adrmail"], input[name="mdpcon"]').on('input', function() {
        $('.error-message').remove();
        $(this).css('border', '1px solid #ccc');
        $('#form-error').remove();
        $('p:contains("Mot de passe incorrect ou email introuvable")').remove();
      });

    });
  </script>








  </br>
  <a href='/Khalil/index.php'>Page d'accueil</a>

</body>

</html>