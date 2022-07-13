<?php
    $serveur = "localhost";
    $dbname = "jeux";
    $user = "root";
    $pass = "root";
    
    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname; charset=utf8",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //On insère les données reçues
        $sth = $dbco->prepare("
            INSERT INTO messagerie(email, nom, message)
            VALUES(:nom,:email,:message)");
        
        $sth->bindParam(':email',$_POST['email']);
        $sth->bindParam(':nom',$_POST['nom']);
        $sth->bindParam(':message',$_POST['message']);
        $sth->execute();

        function valid_donnees($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            return $donnees;
        }
               
        $email = valid_donnees($_POST["email"]);
        $nom = valid_donnees($_POST["nom"]);
        $message = valid_donnees($_POST["message"]);
        include "message_email.php";
        message_email('vanessa.geoffroid@gmail.com', valid_donnees($_POST['email']), 'Envoi depuis la page index', valid_donnees($_POST['message']));
    
    ?>
    <script type="text/javascript">
    alert("Votre message à bien été envoyé");
    window.location.href="index.php";
    </script>
       
     <?php
    }
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }
?>