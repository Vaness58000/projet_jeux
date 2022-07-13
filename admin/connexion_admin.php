<?php
  
$dbco = "";
   
try {
    $servername = "localhost:3306";
    $dbname = "jeux";
    $username = "root";
    $password = "root";
   
    $dbco = new PDO(
        "mysql:host=$servername; dbname=jeux;charset=utf8",
        $username, $password
    );
      
   $dbco->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
  
?>