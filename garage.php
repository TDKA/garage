<?php 

$garage_id= null;


// ctype_digit / empty methods
if(!empty($_GET['id']) && ctype_digit($_GET['id']) ) {

    $garage_id = $_GET['id'];
}

if(!$garage_id) {
   die("il faut ajouter un id dans l'url"); 
}

$pdo = new PDO('mysql:host=localhost:3304; dbname=garage', 'garage', 'garage', [
    
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,

    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

$requete = $pdo->prepare("SELECT * FROM garages WHERE id = :garage_id");

$requete->execute(['garage_id' => $garage_id]);

$garage = $requete->fetch() ;


//******  Annonces   *****/

// $annonces = ["annonce1", "annonce2", "annonce3"];

$requestAnnonces = $pdo->prepare("SELECT * FROM annonces WHERE garage_id = :garage_id");

$requestAnnonces->execute(['garage_id' => $garage_id]);

$annonces = $requestAnnonces->fetchAll();



$titlePage = "Garage";

                    // var_dump($garage);

     ob_start();

     require_once "templates/garages/garage.html.php";

    $contentOfThePage = ob_get_clean();

    require_once "templates/layout.html.php";

            

?>