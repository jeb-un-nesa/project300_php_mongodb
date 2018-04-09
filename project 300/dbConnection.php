<?php


try{
   require 'vendor/autoload.php';
 $connection = (new MongoDB\Client("mongodb://127.0.0.1:27017"));

 $db= $connection->sachetan;
  /* $arr =  ["firstname"=>"Liton","lastname"=>"Islam","email"=>"saiful.sust.cse@gmail.com","password"=>"password","cpassword"=>"cpassword"];
 	$collection =$db->selectCollection("user");
     $collection->insertOne($arr);*/
 }catch(Exception $ex)
 {
 	echo $ex->getMessage();
 }
  
?>