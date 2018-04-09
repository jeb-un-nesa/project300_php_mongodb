<?php
session_start();
global $collection;
  $collection =$GLOBALS['db']->selectCollection("user");
  global $collectionReport;
  $collectionReport=$GLOBALS['db']->selectCollection("report");


 $user_ok = false;
 $log_id = "";
 $log_username = "";
 $log_password = "";

function insert()
{


	if(isset($_POST['submit']))
	{

     $firstName=$_POST['firstName'];
     $lastName=$_POST['lastName'];
     $email = $_POST['email'];
     $password=$_POST['password'];
      // $password=md5($password);
     // $cpassword=$_POST['cpassword'];
     // $flag=0;
     // for($i=0;$i<strlen($password) && $i<strlen($cpassword) ;$i++)
     // {
     // 	if($password[$i]!=$cpassword[$i])
     // 	{
     // 		$flag=1;
     // 		break;

     // 	}
     // }

     // if(strlen($password) != strlen($cpassword)){ echo"not match";
     //        }

               $arr =  ["email"=>$email,"firstName"=>$firstName,"lastName"=>$lastName,"password"=>$password,"reports"=>array()];

      try{


      
             $GLOBALS['collection']->insertOne($arr);
             header("Refresh:register.php");

           }catch(Exception $ex)
           {
           	echo $ex->getMessage();
           }




	
}

}

 
function logData(){
if(isset($_POST['log'])){
   $email = $_POST['lemail'];
     $password=$_POST['lpassword'];
    
 
  try{
    $need=array("email"=> $email,"password" =>$password);

 $data=$GLOBALS['collection']->findOne($need);
 if(empty($data)){
      unset($_POST);
     echo '<script type="text/javascript">alert("invalid email and password");
     </script>';
     
    header("Refresh:register.php");

        }
 else{


$id1=$data['_id'];
$str='Location: Sheader.php?source='.$id1;
 header($str);
 }


  }catch(Exception $ex)
  {
    echo $ex->getMessage();
  }

}
}
?>