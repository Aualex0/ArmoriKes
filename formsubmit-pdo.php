<?php
try {
    if (isset($_POST['surname']) 
            && !empty($_POST['surname']) 
            && isset($_POST['room']) 
            && !empty($_POST['room'])
            && isset($_POST['distinct']) 
            && !empty($_POST['distinct'])
            && isset($_POST['id_hotline']) 
            && ($_POST['id_hotline']==1 || $_POST['id_hotline']==2 || $_POST['id_hotline']==3 || $_POST['id_hotline']==4 || $_POST['id_hotline']==5)) {
        //filtrer les valeurs à l'entrée

        if (!empty($_POST['token']) && hash_equals($_SESSION['token'], $_POST['token'])) {
            $servername = 'localhost';
            $dbname = 'armorikes';
            $username = 'armorikes';
            $password = 'p5nUL7EfXcxJO1sm';
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO commands (Heure, id_hotline, Nom, Signe_distinctif, Lieu, completed)
            VALUES (:Heure, :id_hotline, :Nom, :Signe_distinctif, :Lieu, :completed)");
            $stmt->bindParam(':Heure', $Heure);
            $stmt->bindParam(':id_hotline', $id_hotline);
            $stmt->bindParam(':Nom', $Nom);
            $stmt->bindParam(':Signe_distinctif', $Signe_distinctif);
            $stmt->bindParam(':Lieu', $Lieu);
            $stmt->bindParam(':completed', $completed);

            // insert a row
            $Heure = date('Y-m-d H:i:s');
            $id_hotline = $_POST['id_hotline'];
            $Nom = htmlspecialchars($_POST['surname'], ENT_QUOTES, 'UTF-8');
            $Signe_distinctif = htmlspecialchars($_POST['distinct']);
            $Lieu = htmlspecialchars($_POST['room'], ENT_QUOTES, 'UTF-8');
            $completed = 0;
            $stmt->execute();

            //reset $_POST
            $url = $_SERVER['REQUEST_URI'];
            $url = strtok($url, '?');
            echo("<script>history.replaceState({},'','$url');</script>");

            //show validation
            echo '<script type="text/JavaScript"> 
                 document.getElementById("validater").style.display = "flex";
                 </script>';
        } 
        else {
            echo '<script type="text/JavaScript"> 
                 document.getElementById("problem").style.display = "flex";
                 </script>';
        }
    }
   
}
catch(PDOException $e) {
    echo "Error: " . $e->GetMessage();
}

$conn = null;?>