<?php
header("Content-Type: application/json", true);

if (isset($_POST['action'])) {
  request($_POST['action']);
}

function request($numero) {
  try {
    $servername = 'localhost';
    $dbname = 'armorikes';
    $username = 'armorikes';
    $password = ''; //TODO : fill in with the right password 
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // prepare sql query
    $stmt = $conn->prepare("UPDATE commands
                            SET completed = 1
                            WHERE Numero = :Numero");
    $stmt->bindParam(':Numero', $numero);
    
    $stmt->execute();
  }
  catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  $conn = null;
  echo "done";
  exit;
}?>
