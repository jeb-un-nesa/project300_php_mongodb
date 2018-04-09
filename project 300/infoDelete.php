<?php
include('dbConnection.php');
include('inverseMap.php');
global $collection;
$collection =$GLOBALS['db']->selectCollection("user");
global $collectionReport;
$collectionReport=$GLOBALS['db']->selectCollection("report");
global $collectionIncidentType;
$collectionIncidentType=$GLOBALS['db']->selectCollection("incidentType");
if(isset($_GET['source'])){
$id1=$_GET['source'];
try{
#$need=array("_id"=> new MongoId($userid));
$data=$GLOBALS['collection']->findOne(["_id" => new MongoDB\BSON\ObjectID($id1)]);
//print_r($data);
//echo $data['firstName'];
}catch(Exception $ex){
echo $ex->getMessage();
}
}
?>
<!doctype html>
<html lang="en-US">
  <head>
    <!-- meta -->

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Custom Drop-Down List Styling with CSS3" />
    <meta name="author" content="Codrops" />
    <!-- <link rel="stylesheet" type="text/css" href="../CSS/Sheader.css"> -->
    <script type="text/javascript" src="js/modernizr.custom.79639.js"></script>
    <!-- js -->
    <meta charset="utf-8">
    <!-- <meta http-equiv="Content-Type" content="text/html"> -->
    <title>User Profile</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <meta name="author" content="Jake Rocheleau">
    <link rel="shortcut icon" href="image/favicon.ico">
    <link rel="icon" href="image/favicon.ico">
    <link rel="stylesheet" type="text/css" media="all" href="CSS/UserProfile.css">
    <script type="text/javascript" src="JS/jquery-1.10.2.min.js"></script>
  </head>
  <body>
    <header>
      <div >
        <nav class="navHeader">
          <a class="logo" href="#"><img src="image/logo.png" width=45px height=40px  /></a>
          <ul>
            <li> <a  href=<?php echo "Sheader.php?source=".$id1; ?> >Home</a>
          </li>
          <li>
            <a href=<?php echo "details.php?source=".$id1; ?>>About</a>
          </li>
          <li>
            <a class="selected" href=<?php echo "UserProfile.php?source=".$id1; ?>>
              
              <?php
              
              echo $data['firstName'];
              ?>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <div id="w">
    <div id="content" class="clearfix">
      <div id="userphoto"><img src="image/avatar.png" alt="default avatar"></div>
      <h1> <?php echo $data['firstName'];?></h1>
      
      <nav id="profiletabs">
        <ul class="clearfix">
          
          <li><a href="#activity" class="sel">Activity</a></li>
          <li><a href="#settings">About</a></li>
        </ul>
      </nav>
      
      
      <section id="activity">
        <p>Most recent actions:</p>
        
        <p class="activity">
          <br> <?php
          try{
          #echo $data['_id'];
          $result = $GLOBALS['collection']->findOne(['_id'=>$data['_id']]);
        
          $res=$result['reports'];
         
          #echo $result['reports']['_id'];
          $n=1;
          foreach ($res as $doc) {
          
          
          ?> <p class="activity"> <strong style="font-size: 18px"> Report <?php echo $n++."<br>"; ?> </strong> <?php
            
            $reportData=$collectionReport->findOne(['_id'=> $doc['$id']]);
            ?>  <strong style="font-size: 14px">Created At :</strong><?php echo $date= $reportData['createdAt']->toDateTime()->format('Y-m-d H:i:s'); echo "<br>" ?> 

            <strong style="font-size: 14px">Incident Date :</strong> <?php echo $date= $reportData['incidentDate']->toDateTime()->format('Y-m-d H:i:s'); echo "<br>"  ?> 
          <?php 
            $incident = $GLOBALS['collectionReport']->findOne(['_id'=>$reportData['_id']]);
            $inci=$incident['incidentType'];
      
          $incii=$collectionIncidentType->findOne(['_id'=> $inci['$id']]);

           ?>
         <strong style="font-size: 14px">Area Name : </strong>
           <?php
             $lat=$reportData['location'][1];
             $lng=$reportData['location'][0];
             //var_dump($loc);
  // $lat= $loc[0]; //latitude
  // $lng= $loc[1]; //longitude
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
  }
?>
          <strong style="font-size: 14px">Incident Type :</strong> <?php echo $incii['name'].'<br>' ?>
           <strong style="font-size: 14px">Description : </strong> <?php echo $reportData['description'].'<br>' ;
            $descript = $reportData['description']; ?>
           <strong style="font-size: 14px"> Severity : </strong> <?php echo $reportData['severity'].'<br>' ;
              $severt = $reportData['severity']; ?>
              
            <?php  $reportEdit=$reportData['_id'];
                ?>
 <a href="#" class="btn btn-lg btn-danger buttonSignOut" data-toggle="modal" data-target="#smallModal">Delete</a>
<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">confirmation msg :</h3>
      </div>
      <div class="modal-body">
        <h3>Are you sure to delete your info?</h3>
      </div>
      <div class="modal-footer">
          
        <button type="button" class="btn btn-default" data-dismiss="modal">no</button>
        <button type="button" class="btn btn-success" data-dismiss="modal">confirm</button>

      </div>
    </div>
  </div>
</div>

          </p> 

           <?php
          }}catch(Exception $ex){
          echo $ex->getMessage();
          }
          
          ?>
          
        </section>
        
        
        <section id="settings" class="hidden">
          <p>Your Info:</p>
          <p class="setting"><span>Name<img src="image/edit.png" alt="*Edit*"></span>
          <?php echo $data['firstName']." ".$data['lastName']; ?>
        </p>
        <p class="setting"><span>E-mail Address <img src="image/edit.png" alt="*Edit*"></span> <?php echo $data['email']; ?> </p>
        
        <!-- <button class="buttonSignOut"><a href="reg.html"></a> sign out</button> -->
        <form action="">
          <input type="button" class ="buttonSignOut" value="Sign Out" onclick="window.location.href='Welcome.php';"/>
        </form>
        
      </section>
      </div><!-- @end #content -->
      </div><!-- @end #w -->
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
      <script type="text/javascript">
      $(function(){
      $('#profiletabs ul li a').on('click', function(e){
      e.preventDefault();
      var newcontent = $(this).attr('href');
      
      $('#profiletabs ul li a').removeClass('sel');
      $(this).addClass('sel');
      
      $('#content section').each(function(){
      if(!$(this).hasClass('hidden')) { $(this).addClass('hidden'); }
      });
      
      $(newcontent).removeClass('hidden');
      });
      });
      </script>
      <!-- <footer >
        copyright
      </footer> -->
    </body>
  </html>