<!--
!DOCTYPE html>
<html id="acceuil">
   <head>
   <title>BD</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
</html>
-->


<?php
    function getBD(){
        $bdd = new PDO('mysql:host=localhost;dbname=Articles;charset=utf8', 'root', 'root');
        return $bdd;
    }
?>