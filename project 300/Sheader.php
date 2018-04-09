<?php
include('dbConnection.php');
global $collection;
$collection =$GLOBALS['db']->selectCollection("user");
global $collectionReport1;
$collectionReport1=$GLOBALS['db']->selectCollection("report");
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



<!DOCTYPE html>
<html>
<head>
  <!-- meta -->
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Custom Drop-Down List Styling with CSS3"/>
  <meta name="author" content="Codrops"/>
  <title>Sachetan</title>
  <!-- meta  -->

  <!-- csslink -->
  <link rel="stylesheet" type="text/css" href="css/Sheader.css">
  <link rel="stylesheet" type="text/css" href="css/map.css">

  <!--<link rel="stylesheet" type="text/css" href="css/map.css">-->
  <!-- csslink -->
  <!-- js -->
</head>

<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFyDeanTOzQtasHJ8q_HTodhuvWqQ8bnc&libraries=visualization">
</script>


<body>
  <header>
    <div>
      <nav class="navHeader">
        <a class="logo" href="#"><img src="image/logo.png" width=45px height=40px  /></a>
        <ul>
          <li> <a class="selected" href=<?php "Sheader.php?source=".$id1;?>>Home</a>
          </li>
          <li>
<!-- CREATE REPORT IN NAVBAR -->
          </li>
          <li>
            <a href="#">About</a>
          </li>
          <li>
           <a href=<?php echo "UserProfile.php?source=".$id1; ?>>

            <?php

            echo $data['firstName'];


            ?>

          </a>
        </li>
      </ul>
    </nav>
  </div>
</header>
<!--<div id="floating-panel">
    <button class="btn btn-primary" onclick="changeGradient()">Change gradient</button>
    <button class="btn btn-success" onclick="changeRadius()">Change radius</button
    </div> -->


    <div id="map" class="mapbar"></div>   <!-- THIS IS THE MAP -->

    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="js/map.js"></script>


    <!--eikhane checkbox er sob kaj-->

<!-- <div class="mainContainer">
</div> -->
<div class="menubar">

  <div>


    <div class="loading" id="loading">
      <img src="images/loading.gif" alt="Loading..." width="150">
      <span>Loading...</span>
    </div>


    <!--checkbox label input korsi-->

    <label class="checkboxContainer">News
      <input type="checkbox" class="cb" name="" id="news_cb">
      <span class="checkmark"></span>
    </label>
    <label class="checkboxContainer">Posts
      <input type="checkbox" class="cb" name="" id="report_cb"">
      <span class="checkmark"></span>
    </label>
    <input type="checkbox" class="cb" name="" id="all_cb" style="display: none;">
  </div>
  <!-- drop down-->
  <section class="main">
    <!--<div class="wrapper-demo">
      <div id="dd" class="wrapper-dropdown-3" tabindex="1">
        <span>Reports</span>
       <ul class="dropdown">
          <li><a href="#">All</a></li>
          <li><a href="#">Mugging</a></li>
          <li><a href="#">Road Accident</a></li>
          <li><a href="#">Robbery</a></li>
          <li><a href="#">Sexual Harassment</a></li>
          <li><a href="#">Theft</a></li>
        </ul>-->
      </div>
      ​</div>
    </section>
     <select name="category" class="dropdown wrapper-dropdown-3" id="cat">
      <option class="dropdown" value="all">All</option>
      <option class="dropdown" value="mugging">Mugging</option>
      <option class="dropdown" value="robbery">Robbery</option>
      <option class="dropdown" value="harrasment">Sexual Harrasment</option>
      <option class="dropdown" value="accident">Road Accident</option>
      <option class="dropdown" value="theft">Theft</option>
    </select> 
    <div>
    
 </select>

</div>

    <form method="POST" action="<?php echo "Create.php?source=".$id1; ?>">

      <input type="hidden" name="lat" id="latId">
      <input type="hidden" name="lng" id="langId">
      
      <input class="button" id="createButton" type="submit" value="Click to Create Report" disabled>
    </form>

    </div>
    

    <!-- drop down-->
    
    <script type="text/javascript" src="js/Sheader.js"></script>

    <script type="text/javascript">
      var mugging = [];
      var mug_id = null;
      <?php
      require 'vendor/autoload.php';

      $m = new MongoDB\Client("mongodb://localhost:27017");
       //echo "Connection to database successfully<br><br><br><br>";
      ?>

      function getReportPoints() {
        return [
        <?php
        $reportCollection = $m->selectCollection('sachetan', 'report');
        $all_report = $reportCollection->find([]);
        foreach ($all_report as $single_report) {
         echo '{ lat: ' .
         $single_report['location'][1] .
         ', lng: ' .
         $single_report['location'][0] .
         ', type: "report" },';
         //var_dump(MongoDB\BSON\toJSON(MongoDB\BSON\fromPHP(json_decode(MongoDB\BSON\toJSON(MongoDB\BSON\fromPHP($single_report['incidentType']))))));
       }
       ?>

       ];
     }

     function getNewsPoints() {
      return [
      <?php

      $newsCollection = $m->selectCollection('sachetan', 'newsActivity');
      $all_news = $newsCollection->find([]);
      foreach ($all_news as $single_news) {
                   // new google.maps.LatLng(24.918177, 91.833873),
       echo '{ lat: ' .
         $single_news['lat'] .
         ', lng: ' .
         $single_news['lon'] .
         ', type: "news" },';

     }
     ?>

     ];
   }



   function getMuggingPoints() {
        return [
        <?php
        $reportCollection = $m->selectCollection('sachetan', 'report');
        $all_report = $reportCollection->find();
        foreach ($all_report as $single_report) {
          $pq =  (json_encode((json_decode(MongoDB\BSON\toJSON(MongoDB\BSON\fromPHP($single_report['incidentType']))))));
          //echo $pq."#########";
         if( $pq == '{"$ref":"incidentType","$id":{"$oid":"58b0150e6140e23d3b5cc869"}}' ) {
          echo '{ lat: ' .
          $single_report['location'][1] .
          ', lng: ' .
          $single_report['location'][0] .
          ', type: "mugging" },';
        }
       }
       ?>
       ];
     }


     function getRobberyPoints() {
        return [
        <?php
        $reportCollection = $m->selectCollection('sachetan', 'report');
        $all_report = $reportCollection->find();
        foreach ($all_report as $single_report) {
          $pq =  (json_encode((json_decode(MongoDB\BSON\toJSON(MongoDB\BSON\fromPHP($single_report['incidentType']))))));
          //echo $pq."#########";
         if( $pq == '{"$ref":"incidentType","$id":{"$oid":"58b0150e6140e23d3b5cc86b"}}' ) {
          echo '{ lat: ' .
          $single_report['location'][1] .
          ', lng: ' .
          $single_report['location'][0] .
          ', type: "robbery" },';
        }
       }
       ?>
       ];
     }


function getSexualHarrasmentPoints() {
        return [
        <?php
        $reportCollection = $m->selectCollection('sachetan', 'report');
        $all_report = $reportCollection->find();
        foreach ($all_report as $single_report) {
          $pq =  (json_encode((json_decode(MongoDB\BSON\toJSON(MongoDB\BSON\fromPHP($single_report['incidentType']))))));
          //echo $pq."#########";
         if( $pq == '{"$ref":"incidentType","$id":{"$oid":"58b0150e6140e23d3b5cc86c"}}' ) {
          echo '{ lat: ' .
          $single_report['location'][1] .
          ', lng: ' .
          $single_report['location'][0] .
          ', type: "harrasment" },';
        }
       }
       ?>
       ];
     }



function getTheftPoints() {
        return [
        <?php
        $reportCollection = $m->selectCollection('sachetan', 'report');
        $all_report = $reportCollection->find();
        foreach ($all_report as $single_report) {
          $pq =  (json_encode((json_decode(MongoDB\BSON\toJSON(MongoDB\BSON\fromPHP($single_report['incidentType']))))));
          //echo $pq."#########";
         if( $pq == '{"$ref":"incidentType","$id":{"$oid":"58b0150e6140e23d3b5cc86d"}}' ) {
          echo '{ lat: ' .
          $single_report['location'][1] .
          ', lng: ' .
          $single_report['location'][0] .
          ', type: "theft" },';
        }
       }
       ?>
       ];
     }


function getRoadAccidentPoints() {
        return [
        <?php
        $reportCollection = $m->selectCollection('sachetan', 'report');
        $all_report = $reportCollection->find();
        foreach ($all_report as $single_report) {
          $pq =  (json_encode((json_decode(MongoDB\BSON\toJSON(MongoDB\BSON\fromPHP($single_report['incidentType']))))));
          //echo $pq."#########";
         if( $pq == '{"$ref":"incidentType","$id":{"$oid":"58b0150e6140e23d3b5cc86a"}}' ) {
          echo '{ lat: ' .
          $single_report['location'][1] .
          ', lng: ' .
          $single_report['location'][0] .
          ', type: "accident" },';
        }
       }
       ?>
       ];
     }

 



 </script>
 <script type="text/javascript" src="js/work.js"></script>



    <!--   <div class = "mainContainer">
   </div>
   <div class="menubar">
     <div>

       <label class="checkboxContainer">News
         <input type="checkbox" checked="checked">
         <span class="checkmark"></span>
       </label>
       <label class="checkboxContainer">Posts
         <input type="checkbox" checked="checked">
         <span class="checkmark"></span>
       </label>
     </div>-->
     <!-- drop down-->
    <!--    <section class="main">

</section>-->
    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/Sheader.js"></script>-->

  </div>

  <div class="footer" >
   Copyright
 </div>


</body>
</html>
