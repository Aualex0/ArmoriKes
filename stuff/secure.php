<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Armorikès</title>
    <link rel="icon" href="media/Logo_Poitrine_Armorikès.svg" />
    <link href="css/adminview.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <?php 
      try {
        $servername = 'localhost';
        $dbname = 'armorikes';
        $username = 'armorikes';
        $password = 'p5nUL7EfXcxJO1sm'; 
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        ", $username, $password);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql query
        $stmt = $conn->prepare("SELECT Numero, Heure, Commande, Nom, Signe_distinctif, Lieu
                                FROM commands 
                                INNER JOIN hotlines ON commands.id_hotline=hotlines.id_hotline
                                WHERE commands.completed=0
                                ORDER BY commands.Numero");

        $stmt->execute();
        $commands = $stmt->fetchAll();
      }
      catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
      }

      $conn = null;?>
    

    <div id="background">
      <div id="table">
        <?php if (count($commands) > 0):?>
          <table>
            <thead>
              <tr>
                <th>
                  <?php $columns = array();
                  foreach (array_keys(current($commands)) as $key => $value) {
                    if ($key % 2 == 0) {
                      $columns[] = $value;
                    }
                  }
                  echo implode('</th><th>', $columns);
                  echo '</th><th>Fait ?';?>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($commands as $row): array_map('htmlentities', $row);?>
                <tr>
                  <td>
                    <?php $case = array();
                    $count = 0;
                    foreach ($row as $key => $value) {
                      if ($count % 2 == 0) {
                        $case[] = $value;
                      }
                      $count++;
                    }
                    echo implode('</td><td>', $case);
                    echo '</td><td><input type="checkbox" class="checkable">';?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
    </div>
    <script src="js/adminview.js"></script>
  </body>
</html>
