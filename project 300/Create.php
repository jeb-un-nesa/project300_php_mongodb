<?php
include('dbConnection.php');
include('inverseMap.php');
ob_start();


if(isset($_GET['source'])){
  $id1=$_GET['source'];
try{
	global $collection;
  $collection =$GLOBALS['db']->selectCollection("user");
	global $collectionReport;
$collectionReport=$GLOBALS['db']->selectCollection("report");
global $collectionIncidentType;
$collectionIncidentType=$GLOBALS['db']->selectCollection("incidentType");
  #$need=array("_id"=> new MongoId($userid));
   $data=$GLOBALS['collection']->findOne(["_id" => new MongoDB\BSON\ObjectID($id1)]);
   //print_r($data);
     //echo $data['firstName'];

}catch(Exception $ex){
  echo $ex->getMessage();

}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sachetan Create Report</title>
	<!-- Meta tags -->
	<!-- <meta charset="UTF-8" /> -->
       <!--  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1" /> -->
	<!-- 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="" /> -->
	<!-- 	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script> -->
	<!-- Meta tags -->
<!-- font-awesome icons -->
   <link rel="stylesheet" href="css/font-awesome.min.css" />
<!-- //font-awesome icons -->
<!--stylesheets-->
  <!-- <link rel="stylesheet" type="text/css" href="../CSS/Sheader.css"> -->
<link href="css/style.css" rel='stylesheet' type='text/css' media="all">
<!--//style sheet end here-->
<link href="css/wickedpicker.css" rel="stylesheet" type='text/css' media="all" /><!--time-->
<link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Muli:300,400,600,600i,700" rel="stylesheet">


</head>
<body>
	<header>
			<div >
				<nav class="navHeader">
					<a class="logo" href="#"><img src="image/logo.png" width=45px height=40px  /></a>
					<ul>
						<li> <a href='<?php echo "Sheader.php?source=".$id1; ?>'>Home</a>
					</li>
					<li>
           <a href=<?php echo "details.php?source=".$id1; ?>>About</a>
          </li>
					<li>
						<a href='<?php echo "UserProfile.php?source=".$id1; ?>'><?php echo $data['firstName'];?></a>
					</li>
				</ul>
			</nav>
		</div>
	</header>
     <h1 class="header-w3ls">
Create Report</h1>
 <div class="appointment-w3">
 	<!--<input type="hidden" name="maps_latitude" id="maps_latitude" value="">
<input type="hidden" name="maps_longitude" id="maps_longitude" value="">
    <form action="" method="post">-->

         

          <div class="form-control-w3l">
               <input type="hidden" name="lat" value="<?php echo $_POST['lat'] ?>" id="name">
          </div>

          <div class="form-control-w3l">
               <input type="hidden" name="lang" value="<?php echo $_POST['lng'] ?>" id="name">
          </div>

        <div class="form-control-w3l">
        	<strong style="font-size: 20px ; margin-left: 20%; color: #fff;margin-bottom: 20px;" > Area Name : </strong>
        	<strong style="font-size: 20px ; color: #fff;margin-bottom: 20px; padding-left: 10px;"> 
<?php
        	global  $lat;
        	 	global $lng;

        	 try{

        	 	
        	 	
        	 if(isset($_POST['lat'])& isset($_POST['lng'] )){
             
             $lat=$_POST['lat'];
             $lng=$_POST['lng'] ;
             

  $address= getaddress($lat,$lng);
  if($address)
  {
    
    echo $address;
    echo "<br>";
  }
  else
  {
    echo "Not found";
    echo  "<br>";
  } } } catch(Exception $ex){
  	echo $ex->getMessage();
  }
?> 
</strong>

          </div>
		  

		  <!--- -->



		          <form method="post" >  



<div class="form-control">
               <input type="hidden" name="latitute" value="<?php echo $_POST['lat'] ?>" />
          </div>

          <div class="form-control">
               <input type="hidden" name="longitute" value="<?php echo $_POST['lng'] ?>" />
          </div>
     <div id="ddlViewBy" style="color:#fff;" >

      <?php 
            $dataincident=$collectionIncidentType->find();
           
      ?>


     	<select name="crime" style="color:#fff;height: 30px ; width:537px ; background-color:rgba(249, 249, 249, 0.31); margin-bottom: 10px; padding-left:10px; ">
           <option style="color:#fff;" value="" disabled selected>Report Type</option>
<?php foreach ($dataincident as $dataincii) {
 ?>   <option style="color:#000;" value=" <?php echo  $dataincii['_id'] ?> "> <?php echo $dataincii['name'] ?> </option>  
<?php
    }
?>
   
    
 </select>

</div>
				<div class="form-control-w3l">
					
						<input  id="datepicker1" name="date1" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" placeholder="mm/dd/yyyy" required="">
				</div>
				 <div class="form-control-w3l">
				 
					<input type="text" id="timepicker" name="time" class="timepicker form-control-w3l" placeholder="Time" value="">	
				</div>
<div class="form-control-w3l">
 <textarea id="message" name="textd" placeholder="Description of incident..."></textarea>
 </div>
 <!-- <div class="form-control-w3l">	
			
				<input type="text" id="orgn" name="phone number" placeholder="Phone Number" title="Please enter your Phone Number" required=""> -->


					<!-- ================ -->
 <div id="ddlViewBy" style="color: #fff" >
     	<select name="severity" style=" color:#fff; height: 30px ; width:537px ; background-color:rgba(249, 249, 249, 0.31); margin-bottom: 10px; padding-left:10px;">
           <option style="color:#fff;" value="" disabled selected>Severity</option>
    <option style="color: #000"  value="1">1</option>
    <option style="color: #000"  value="2">2</option>
    <option style="color: #000" value="3">3</option>
    <option style="color: #000" value="4">4</option>
    <option style="color: #000" value="5">5</option>
 </select>

</div>
					<!-- ================= -->
		  <!--  </div> -->
 <input  type="submit" value="Submit" name="submit">
</form>
<?php
try{
   	if(isset($_POST['submit'])){
   		 $datecreated = new MongoDB\BSON\UTCDateTime();
        $report1=$_POST['crime'];
     $date=$_POST['date1'];
     $time1=$_POST['time'];
     $time2=str_replace(' ','',$time1);
     $time3=date('h:i A',strtotime($time2));
     $describe = $_POST['textd'];
     $sever=(int)$_POST['severity'];

     $date = new DateTime($date);
$time4 = new DateTime($time3);

// Solution 1, merge objects to new object:
$merge = new DateTime($date->format('Y-m-d') .' ' .$time4->format('H:i:s'));
$merge= $merge->format('Y-m-d H:i:s');
 // Outputs '2017-03-14 13:37:42'
$datetime = new DateTime($merge);

$datetime=new MongoDB\BSON\UTCDateTime($datetime);
$report1=str_replace(' ','',$report1);
  $report = new MongoDB\BSON\ObjectID($report1);
 
// $lat1=floattostr($lat);
//              $lng1=floattostr($lng);
//              var_dump($lat1);

//  header_remove($this) ;
   
   	$lat1=(double)$_POST['latitute'];
   	$lng1=(double)$_POST['longitute'];

    //$lng1=(double)$GLOBALS['lng'];
    //echo $lat1;
            
     $array= ["severity"=>$sever,"incidentDate"=>$datetime,"createdAt"=>$datecreated,"description"=>$describe,"location"=>array($lng1,$lat1),"incidentType"=>array( '$ref'=>"incidentType", '$id'=>$report)];
 //  var_dump($array);
           $array2=  $collectionReport->insertOne($array);
            
            $reportId= (string)$array2->getInsertedId();
            $updateArray=$collection->findOne(["_id" => new MongoDB\BSON\ObjectID($id1)]);
           
            $up= $updateArray['_id'];
            $up=new MongoDB\BSON\ObjectID($up);
            $reportId=new MongoDB\BSON\ObjectID($reportId);
     
 			$collection->updateOne(["_id" => $up],['$push'=>["reports"=>array('$ref'=>"report",'$id'=>$reportId)]]);
 			$passId=$GLOBALS['id1'];
 			$str='Location:Sheader.php?source='.$passId;
 			header($str);

          } }catch(Exception $ex)
           {
           	echo $ex->getMessage();
           }


   	

?>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
            <script type="text/javascript" src="JS/Sheader.js"></script>
   </div>
   
    
 
		<!-- js -->
		<script type="text/javascript" src="js/Sheader.js"></script>
  <script type='text/javascript' src='js/jquery-2.2.3.min.js'></script>
<!-- //js -->
<!-- Calendar -->
				<link rel="stylesheet" href="css/jquery-ui.css" />
				<script src="js/jquery-ui.js"></script>
				  <script>
						  $(function() {
							$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
						  });
				  </script>
				  <script>var e = document.getElementById("ddlViewBy");
var strUser = e.options[e.selectedIndex].value;</script>
			<!-- //Calendar -->
			<!-- Time -->
			<script type="text/javascript" src="js/wickedpicker.js"></script>
			<script type="text/javascript">
				$('.timepicker').wickedpicker({twentyFour: false});
			</script>
		<!-- // Time -->

</body>
</html>