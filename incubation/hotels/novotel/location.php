

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Location</title>
  <link rel="stylesheet" href="../../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/theme.css">
  <link rel="stylesheet" href="../../assets/css/owl.carousel.css">
  <link rel="stylesheet" href="../../assets/css/owl.theme.css">
  <script src="../../assets/js/jquery.js"></script>
  <script src="../../assets/js/owl.carousel.min.js"></script>
  <script src="../../assets/js/bootstrap.min.js"></script>
    <style>
  input[type="file"]{
    visibility: hidden;
  }
  body{

  background-image: url("bg.png");
}

  .ml li a{
  font: 14px arial;
  border-radius:0px;
  }
    .save{
  border:0px;
  outline:0px;
  padding:10px 30px;
  background:#4b9cd3;
  border-radius:0px;
  color:white;
  }
   .save:hover{
  background:#2bbcf3;
 color:white;
  }
  .details{
  font-size:16px;
    line-height: 1.8;
  color:#384858;
  }
  </style>
  

  
  </head>
  <body>
    <?php
  include "../../assets/db/dbcon.php";
  $pdo=dbcon::connect();
  $sql="SELECT * FROM kk_hotels WHERE username='novotel'";
  $row=$pdo->query($sql);
  foreach ($row as $i) {
  $location=$i["location"];
  }

?>
          <nav class="navbar navbar-default" role="navigation" style="background:#0aa3d3;border:0px;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <div class="navbar-brand logo">
                   <?php 
               if (!file_exists("./images/0.jpg")) 
               {
                  echo '<img src="" alt="" class="img0">';
               }
               else
               {
                  echo '<img src="./images/0.jpg" alt="" class="img0">';
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
                  <li ><a href="index.php" >Home</a></li>
                  <li><a href="aboutus.php">About Us</a></li>
                  <li><a href="tarrif.php">Tarrif</a></li>
                  <li class="active"><a href="location.php">Location</a></li>
                  <li><a href="contactus.php">Contact us</a></li>
                  
               </ul>

            </div>
            <!-- /.navbar-collapse -->
         </nav>
     




 

<html>
<body>

<div class="container">


<div  id="locmap">
<?php
echo $location;
?>
</div>

</div>
  

</body>
</html>


