<?php
session_start();
                                    //protège page admin
if(!empty($_SESSION['login'])) {
?>
<?php
            $servname = "localhost"; $dbname = "jeux"; $user = "root"; $pass = "root";
            
            try{
                $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                /*Sélectionne les valeurs dans les colonnes nom, descriptif et images de la table
                 *users pour chaque entrée de la table*/
                $sth = $dbco->prepare("SELECT * FROM produits ORDER BY id DESC");
                $sth->execute();
                
                /*Retourne un tableau associatif pour chaque entrée de notre table
                 *avec le nom des colonnes sélectionnées en clefs*/
                $jeux = $sth->fetchAll(PDO::FETCH_ASSOC);
                
            }  
            catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }?>

            <?php
require_once("connexion_admin.php");

if (isset($_POST)){ //si quelqu'un à appuyer sur le bouton enregistrer on verifie
    if(isset($_POST["nom"]) && !empty($_POST["nom"])    
        && isset($_POST["description"]) && !empty($_POST["description"])
        && isset($_POST["console"]) && !empty($_POST["console"])
        && isset($_POST["age"]) && !empty($_POST["age"])
        && isset($_POST["image"]) && !empty($_POST["image"])
         //si les champs sont remplis isset = si ça existe  //&& !empty = si les champs ne sont pas vides
     ) {
        $nom=strip_tags($_POST["nom"]); //strip_tags=pour securisé et que la personne qui enregistre dans le formulaire ne puisse pas mettre de balise php ou html
        $description=strip_tags($_POST["description"]);
        $console=strip_tags($_POST["console"]);
        $age=strip_tags($_POST["age"]);
        $image=strip_tags($_POST["image"]);
     

        $sth="INSERT INTO produits (nom, description, console, age, image) VALUES (:nom, :description, :console, :age, :image)"; // Pour insèrer des données dans une table 
        $sth=$dbco->prepare($sth);
        $sth->bindValue(":nom",$nom);   //pour sécurisé formulaire
        $sth->bindValue(":description",$description); 
        $sth->bindValue(":console",$console); 
        $sth->bindValue(":age",$age);
        $sth->bindValue(":image",$image);


        $sth->execute();
        //mettre header tout de suite après execute 
        header("Location:adminpage.php"); //sinon renvoi page d'ajout
    }
    if (!$sth){ //si aucun resultat 

        echo"Erreur"; //renvoi à l'index
    }
        
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
    <link href="https://bootswatch.com/5/morph/bootstrap.min.css" rel="stylesheet">

    <title>Catalogue de jeux vidéos</title>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">GAMING</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="adminpage.php">Accueil
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="liste_produits.php">Gestion des jeux</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Messagerie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../index.php">Retour au site</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="deconnexion.php">Déconnexion</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-sm-2" type="text" placeholder="Entrez votre recherche">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Rechercher</button>
      </form>
    </div>
  </div>
</nav>
<body>
    <form id="ajout" method="POST" style="margin-top: 50px;">

     
            <label class="text-dark" for="nom">Nom</label>
            <input class="bg-light border-bottom rounded-pill" type="text" name="nom" id="nom" required size=50> </br></br>      <!-- required= indique qu'il faut renseigner obligatoirement les champs -->
       
            <label class="text-dark" for="description">Description</label>
            <input class="bg-light border-bottom rounded-pill" type="text" name="description" id="temps" required size=50> </br></br>      <!-- required= indique qu'il faut renseigner obligatoirement les champs -->

  
            <label class="text-dark" for="console">Console</label>
            <input class="bg-light border-bottom rounded-pill"type="text" name="console" id="temps" required size=50> </br></br>      <!-- required= indique qu'il faut renseigner obligatoirement les champs -->
 
            <label class="text-dark" for="age">Age</label>
            <input class="bg-light border-bottom rounded-pill"type="text" name="age" id="temps" required size=50> </br></br>      <!-- required= indique qu'il faut renseigner obligatoirement les champs -->
   
       
            <label class="form-label text-dark" for="image">Image</label>
            <input class="bg-light border-bottom" type="file" class="form-control" id="image" name="image" />  </br></br></br>

          
                <button type="submit" class="p-3 mb-2 bg-dark text-white w-25 bg-info mt-2 p-2 rounded-pill"><i class="fa fa-paper-plane" aria-hidden="true"></i> Enregistrer</button>
    </br>
    </br>
      
    </form>

    <section style="margin-top: 50px;">
    <form>
    <table class="table table-striped table-dark">
        <thead>
            <th>Nom</th>
            <th>Description</th>
            <th>console</th>
            <th>age</th>
            <th>image</th>
            <th></th>
            <th></th>
            
        </thead>
        <tbody>
        
            <?php //Pour afficher les infos de la base de données 
            foreach($jeux as $jeu){    // foreach=boucle - pour afficher les données de la base de données dans un tableau/ as $= Pour afficher chaque resultat (les entrées de la base de données)
            ?>

                <tr>
                    <td scope="row"><?= utf8_encode($jeu["nom"]) //<?= veut dire php echo mais on pourrait l'écrire aussi <?php echo 
                    ?>      
                    </td> 
                    <td scope="row"><?= utf8_encode($jeu["description"]) ?></td>  
                    <td scope="row"><?= utf8_encode($jeu["console"]) ?></td>
                    <td scope="row"><?= utf8_encode($jeu["age"]) ?></td>
                    <td scope="row"><img src="../img/<?= utf8_encode($jeu["image"]) ?>" style="width:60%; height: auto;"></td> 
                    <td scope="row"><button><a href="modification_jeus.php?id=<?= $jeu["id"]?>" style="color:black;"><img src="../img/crayon.svg" width="45px;" alt="modifier"></a></button></td>
                    <td scope="row"><button><a href="suppression_jeu.php?id=<?= $jeu["id"]?>" style="color:black;"><img src="../img/poubelle.svg" width="45px;" alt="supprimer"></a></button></td>
                    <!--sert à pouvoir supprimer une entrée grâce à l'id-->
                </tr>
                
            <?php
            }    
            ?>
        </tbody>
    </table>
    </form>
    </section>


      
</body>
</html>
<?php
}
else{
    echo"interdit"; //protge la page
}
?>