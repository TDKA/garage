
<?php

$garage_id = null;
$name = null;
$price = null;

if(!empty($_POST['garageId']) && ctype_digit($_POST['garageId']) ){
    $garage_id = $_POST['garageId'];
}

if(!empty($_POST['name']) && !empty($_POST['price']) ){
    $name = htmlspecialchars($_POST['name']);
    $price = htmlspecialchars($_POST['price']);
}

if( !$garage_id || !$name || !$price ){
    die("incorrectly completed form");
}


$pdo = new PDO('mysql:host=localhost:3304;dbname=garage','garage' ,'garage', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  ,
    PDO::ATTR_DEFAULT_FETCH_MODE  =>    PDO::FETCH_ASSOC          
  ]);


  $reqGarageExist = $pdo->prepare("SELECT * FROM garages WHERE id =:garage_id");

  $reqGarageExist->execute(['garage_id' => $garage_id]);

  $garage = $reqGarageExist->fetch();

  if(!$garage){

    die("This garage do not exist!");
  }

  $reqAddAnnonce = $pdo->prepare("INSERT INTO annonces (name, price, garage_id) 
                                        VALUES (:name, :price, :garage_id)");

  $reqAddAnnonce->execute([
                            'name' => $name,
                            'price' => $price,
                            'garage_id' => $garage_id

                        ]);


header("Location: garage.php?id=$garage_id");



/// 1. Watch POST

// 2. Check the three data transmitted by POST

///3.  make a request to verify  if the garage exist

//4. if the garage is non-existent => die();

//NEXT ->

//5. INSERT new annonce (requestSQL)

//6. Redirection to the garage page




