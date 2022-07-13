<?php
 session_start(); 
  require("connexion_admin.php");
 
  $dbco = new PDO(
      "mysql:host=$servername; dbname=jeux",
      $username, $password
  );
    
 $dbco->setAttribute(PDO::ATTR_ERRMODE,
                  PDO::ERRMODE_EXCEPTION);
   
function test_input($data) {
      
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
  
if ($_SERVER["REQUEST_METHOD"]== "POST") {
      
    $adminname = test_input($_POST["adminname"]);
    $password = $_POST["password"];//echo password_hash("mdp", PASSWORD_ARGON2I); POUR CRYPTER MOT DE PASSE a mettre sur page de connexion pour recevoir  un code crypter+inserer dans bdd
    
    $stmt = $dbco->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($users as $user) {
       
        if(($user['adminname'] == $adminname) && password_verify($password,$user['password'] )
    ) {
                $_SESSION["login"] = $user['adminname'];
                header("Location: adminpage.php");
        }
        else {
        
            echo "<script language='javascript'>";
            echo "alert('Mot de passe incorrect')";
            echo "</script>";
            die();
        }
    }
}
  
?>