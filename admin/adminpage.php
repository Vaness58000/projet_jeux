<?php
session_start();
                                    //protège page admin
if(!empty($_SESSION['login'])) {
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="fonts/font.css">
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
<?php
    require_once("connexion_admin.php");

        try{
            $dbco = new PDO("mysql:host=$servername;dbname=jeux", $username, $password);
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                /*Sélectionne les valeurs dans les colonnes nom, descriptif et images de la table
                 *users pour chaque entrée de la table*/
                $sth = $dbco->prepare("SELECT * FROM produits");
                $sth->execute();
                
                /*Retourne un tableau associatif pour chaque entrée de notre table
                 *avec le nom des colonnes sélectionnées en clefs*/
                $jeux = $sth->fetchAll(PDO::FETCH_ASSOC);
            }  
            catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }
    ?>
 <section>
    <div class="container d-flex flex-row flex-wrap justify-content-evenly">
  <?php
  
  foreach ($jeux as $jeu){ ?>
        <div class="card shadow-lg p-3 mb-5 bg-body rounded" style="width: 18rem; margin-top: 25px; margin-bottom: 25px;">
          <img src="../img/<?php echo utf8_encode($jeu["image"]) ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?php echo utf8_encode($jeu["nom"]) ?></h5>
            <p class="card-text"><?php echo utf8_encode($jeu["description"]) ?></p>
          </div>
        
          <div class="d-flex justify-content-center">
            <a href="#" class="btn btn-secondary">Gérer</a>
          </div>
        </div>
<?php
}?>
      </div>
</body>
</html>
<?php
}
else{
    echo "interdit"; //protège la page
}
?>