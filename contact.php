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
    
    <title>Formulaire de contact</title>
</head>
<header>
<?php
include 'header.php'
?>
</header>
<body>
    <form name="formulaire" method="post" action="recup_formulaire.php">
        <fieldset>
            <legend class="text-align-center">Formulaire de contact</legend>
            <div class="container shadow-lg p-3 mb-5 bg-body rounded">
                <div class="form-group">
                    <label name="email" for="exampleInputEmail1" class="form-label mt-4">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrer votre email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" name="nom" class="form-label mt-4">Nom</label>
                    <input type="text" name="nom" class="form-control" placeholder="Entrer votre nom">
                </div>
                <div class="form-group">
                    <label for="exampleTextarea" name="message" class="form-label mt-4">Message</label>
                    <textarea name="message"class="form-control" id="exampleTextarea" rows="3"></textarea>
                </div><br/>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
    <form>
</body>
<footer>
<?php
include 'footer.php'
?>
</footer>
</html>