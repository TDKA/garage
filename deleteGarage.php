<?php

if(isset($_GET['id'])) {

    if(!empty($_GET['id']) && ctype_digit($_GET['id']) ) {

        $garage_id = $_GET['id'];

        $pdo = new PDO('mysql:host=localhost:3304; dbname=garage', 'garage', 'garage', [
    
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,

        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC

        ]);

        if($garage_id) {
           
            $requete = $pdo->prepare("SELECT * FROM garages WHERE id = :garage_id");

            $requete->execute(['garage_id' => $garage_id]);
        
            $garage = $requete->fetch();

            if($requete) {

                   $delete = $pdo->prepare("DELETE FROM garages WHERE id = :garage_id");

                    $delete->execute(['garage_id' => $garage_id]);

                   header("Location: index.php");
            }

        }else {
            die("Désolé mais ce garage n'existe pas");
        }

    }
}
?>