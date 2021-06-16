<?php


    if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

        $annonce_id = $_GET['id'];
  
  }
     if(!$annonce_id){

        die("Enter valid id in the url");
     }

     echo"OK";


     $pdo = new PDO('mysql:host=localhost:3304;dbname=garage','garage','garage', [

        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,
        PDO::ATTR_DEFAULT_FETCH_MODE  =>  PDO::FETCH_ASSOC      
            
        ]);

        


    $req = $pdo->prepare("SELECT * FROM annonces WHERE id =:annonce_id");

    $req->execute(['annonce_id' => $annonce_id]);

    $annonce = $req->fetch();

    //if don't exist
    if(!$annonce){
        die("this annonce dont exist");
    }

    $garage_id = $annonce['garage_id'];

    $reqDeleteArticle = $pdo->prepare("DELETE FROM annonces WHERE id =:annonce_id");

    $reqDeleteArticle->execute(['annonce_id' => $annonce_id]);

    //

    header("Location: garage.php?id=$garage_id");

?>