<?php
include "../admin/session.php";
include "../assets/db/dbcon.php";
if(!loggedin()){
  header("Location:../admin/");
}
else if($_SESSION['username']=="busi.com")
{
      header("Location:../superuser/");
}
$pdo=dbcon::connect();
$sql="SELECT * FROM kk_users";
foreach ($pdo->query($sql) as $row) {
  if ($row['username']==$_SESSION['username']) {
    $url=$row['url'];
    $user=$_SESSION['username'];

  }
}
$page='<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title></title>
   <link rel="stylesheet" href="../../assets/css/bootstrap.css">
   <link rel="stylesheet" href="../../assets/css/style.css">
   <link rel="stylesheet" href="../../assets/css/theme.css">
   <script src="../../assets/js/jquery.js"></script>
   <script src="../../assets/js/bootstrap.min.js"></script>
   <style>
   input[type="file"]{
      visibility: hidden;
   }
   body{

   background-image: url("bg.png");
}
 .ml li a{
  font: 15px arial;
  border-radius:0px;
  }
   </style>
</head>
<body>
           <nav class="navbar navbar-default" role="navigation" style="background:#2E446C;border:0px;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <div class="navbar-brand logo">
                      <?php 
               if (!file_exists("./images/0.jpg")) 
               {
                  echo \'<img src="" alt="" class="img0">\';
               }
               else
               {
                  echo \'<img src="./images/0.jpg" alt="" class="img0">\';
               }
              ?>
               </div>
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
               <span >Menu</span>
               </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
               <ul class="nav navbar-nav ml">
                  <li ><a href="index.php"><span class ="glyphicon glyphicon-home"></span> Home</a></li>
                  <li class="active"><a href="tarrif.php"><span class ="glyphicon glyphicon-usd"></span> Tarrif</a></li>
                  <li><a href="location.php"><span class ="glyphicon glyphicon-map-marker"></span> Location</a></li>
                  <li><a href="contactus.php"><span class ="glyphicon glyphicon-phone"></span> Contact us</a></li>
                  
               </ul>


            </div>
            <!-- /.navbar-collapse -->
         </nav>
      </div>
   </div>
</div>
</nav>
<center>
<div class="container" >
  <?php
  include "../../assets/db/dbcon.php";
  $pdo=dbcon::connect();
  $sql="SELECT * FROM kk_hotels WHERE username=\''.$user.'\'";
  $row=$pdo->query($sql);
  $tarrif="";
  foreach ($row as $i) {
    $tarrif= $i["tarrif"];

  }
  if($tarrif=="")
  {

  }
  else{
        echo \'

      <div id="str">\'.$tarrif.\'</div>
</div>\';}?>
</body>
</html>';

$fname="../hotels/".$url."/tarrif.php";
$fp=fopen($fname,'w');
fwrite($fp,$page);
fclose($fp);

header("Location:../edit/tarrif.php")




?>