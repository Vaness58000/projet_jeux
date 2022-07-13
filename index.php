<?php
            $servname = "localhost"; $dbname = "jeux"; $user = "root"; $pass = "root";
            
            try{
                $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
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
            }?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_header_footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="fonts/font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
    
    <title>Catalogue de jeux vidéos</title>
</head>
<header>
<?php
include 'header.php'
?>
</header>
<body>
  <section>
    <div class="container d-flex flex-row flex-wrap justify-content-evenly">

<?php
  foreach ($jeux as $jeu){ ?>
        <div class="card shadow-lg p-3 mb-5 bg-body rounded" style="width: 18rem; margin-top: 25px; margin-bottom: 25px;">
          <img src="img/<?php echo utf8_encode($jeu["image"]) ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?php echo utf8_encode($jeu["nom"]) ?></h5>
            <p class="card-text"><?php echo utf8_encode($jeu["description"]) ?></p>
          </div>
        
          <div class="d-flex justify-content-center">
            <a href="#" class="btn btn-secondary">Voir plus</a>
          </div>
        </div>
<?php
}?>
    </div>
</body>
</section>
<footer>
<?php
include 'footer.php'
?>
</footer>
</html>