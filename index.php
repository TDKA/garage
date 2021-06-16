<?php 

echo "coucou";

// $host = "localhost:3304";
// $usernameDB = "garage";
// $passwordDB = "garage";
// $nameDB = "garage";

$pdo = new PDO('mysql:host=localhost:3304; dbname=garage', 'garage', 'garage', [
   
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);


    $result = $pdo -> query('SELECT * FROM garages');

    $garages = $result -> fetchAll();
    $titlePage = "Garages";

    // foreach($garages as $garage) {
        
    //     var_dump($garage);
    //     echo "<br>";
    // }
    

    //BUFFER
    ob_start();

     require_once "templates/garages/garages.html.php";

    $contentOfThePage = ob_get_clean();

    require_once "templates/layout.html.php";



?>





