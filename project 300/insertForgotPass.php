<?php 
include('dbConnection.php');
global  $collection;
  $collection =$GLOBALS['db']->selectCollection("user");
global  $collectionRecovery;
  $collectionRecovery =$GLOBALS['db']->selectCollection("recoveryKeys");
?>

<?php 
if(isset($_POST['submit']))
 
{
   

$uemail = $_POST['uemail'];
 
if(checkUser($uemail) == "true")
 
{
	
 
$userID = UserID($uemail);
 
$token = generateRandomString();

 $query=$GLOBALS['collectionRecovery']->insertOne(["userId"=>$userID,"token"=>$token,"valid"=>1 ]);
if(!empty($query))
 
{
 
$send_mail = send_mail($uemail, $token);
 
 
if($send_mail === 'success')
 
{
  header("Location:msg.php");

 
// $msg = 'A mail with recovery instruction has sent to your email.';
 
// $msgclass = 'bg-success';
 
}else{
  echo '<script type="text/javascript">alert("There is something wrong.");
     </script>';
// $msg = 'There is something wrong.';
 
// $msgclass = 'bg-danger';
 
}
 
}else
 
{
   echo '<script type="text/javascript">alert("There is something wrong.");
     </script>';
 
// $msg = 'There is something wrong.';
 
// $msgclass = 'bg-danger';
 
}
 
 
 
}else
 
{
   // echo '<script type="text/javascript">alert("this email does not exist in our database.");
   //   </script>';
 
// $msg = "This email doesn't exist in our database.";
 
// $msgclass = 'bg-danger';
 
}
 
}



function checkUser($email)
 
{
           $needemail=array("email"=> $email);
           $dataemail=$GLOBALS['collection']->findOne($needemail);
          if(empty($dataemail)){
          	return 'false';
          	
          }
          else{
          	return 'true';

          }
}

function UserID($email)
 
{
 
           $needemail=array("email"=> $email);
           $dataemail=$GLOBALS['collection']->findOne($needemail);
          if(empty($dataemail)){
          	return 'false';
          }
          else{
          	
          	return $dataemail['_id'];
          }
 
}

function generateRandomString($length = 20) {
 
                // This function has taken from stackoverflow.com
 
 
 
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
                 $charactersLength = strlen($characters);
 
                $randomString = '';
 
                for ($i = 0; $i < $length; $i++)
 
{
 
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
 
                }
 
    return md5($randomString);
 
}

function send_mail($to, $token)
{
	require 'PHPMailer/PHPMailerAutoload.php';
	require './vendor/autoload.php';
	$mail = new PHPMailer;
	
	$mail->isSMTP();
  // $mail->Mailer = "smtp"; 

	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
  $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
	$mail->Username = 'jebunnesajemi@gmail.com';
	$mail->Password = '348589703219';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
	$mail->From = 'jebunnesajemi@gmail.com';
	$mail->FromName = 'Sachetan';
	$mail->addAddress($to);
	$mail->addReplyTo('jebunnesajemi@gmail.com', 'Reply');
	
	$mail->isHTML(true);
	// $mail->SMTPDebug = 3;
	$mail->Subject = 'Demo: Password Recovery Instruction';
	$link = 'http://localhost/Shacheton/recovery.php?email='.$to.'&token='.$token;
	$mail->Body    = "<b>Hello</b><br><br>You have requested for your password recovery. <a href='$link' target='_blank'>Click here</a> to reset your password. If you are unable to click the link then copy the below link and paste in your browser to reset your password.<br><i>". $link."</i>";
	
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
		return 'fail';
	} else {
		return 'success';
	}
}
function verifytoken($userID, $token)
 
{             
 
        $query = $GLOBALS['collectionRecovery']->findOne(array("userId"=>$userID),array("token"=>$token));   
         
        if(!empty($query))
        {
 
            if($query['valid'] == 1)
            {
              return 1;
            }else
            {
              return 0;
            }
        }else
        {

             return 0;
        }
}
?>