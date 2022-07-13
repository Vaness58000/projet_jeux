<?php
            $servername = 'localhost';
            $username = 'root';
            $password = 'root';
            //On essaie de se connecter
            try{
                $dbco = new PDO("mysql:host=$servername;dbname=jeux", $username, $password);
                //On définit le mode d'erreur de PDO sur Exception
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo 'Connexion réussie';
            }
            /*On capture les exceptions si une exception est lancée et on affiche
             *les informations relatives à celle-ci*/
            catch(PDOException $e){
              echo "Erreur : " . $e->getMessage();
            }
?>