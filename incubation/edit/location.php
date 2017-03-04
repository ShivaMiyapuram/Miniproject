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
if(isset($_POST['sub'])){
  $user=$_SESSION['username']; 
  $location=$_POST['location'];
  $pdo=dbcon::connect();
  $sql="UPDATE kk_hotels SET location='$location' WHERE username='$user'";
  $pdo->query($sql);

header("Location:../static/location.php");
}
if(isset($_POST['submit'])){
  $aboutus=$_POST['details'];
  $user=$_SESSION['username'];
  $pdo=dbcon::connect();  
  $sql="UPDATE kk_hotels SET aboutus='$aboutus' WHERE username='$user'";
  $pdo->query($sql);
header("Location:../static/location.php");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/theme.css">
  <link rel="stylesheet" href="../assets/css/owl.carousel.css">
  <link rel="stylesheet" href="../assets/css/owl.theme.css">
  <script src="../assets/js/jquery.js"></script>
  <script src="../assets/js/owl.carousel.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  	<style>
	input[type='file']{
		visibility: hidden;
	}
	body{

	background-image: url('bg.png');
}

  .ml li a{
  font: 15px arial;
  border-radius:0px;
  }
    .save{
  border:0px;
  outline:0px;
  padding:2px 10px;
  background:#2E446C;
  border-radius:8px;
  color:white;
  }
   .save:hover{
  background:#496CAD;
 color:white;
  }
  .details{
  font-size:16px;
    line-height: 1.8;
	color:#384858;
  }
	</style>
	 <?php
  $pdo=dbcon::connect();
  $user=$_SESSION['username'];
  
  ?>
  </head>
  <body>
  <form action="location.php" method="post">
        <nav class="navbar navbar-default" role="navigation" style="background:#2E446C;border:0px;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <div class="navbar-brand logo">
               		<?php 
                  echo '<img src="../hotels/'.$user.'/images/0.jpg" alt="" class="img0">';
               ?>
               </div>
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
               <span >Menu</span>
               </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
               <ul class="nav navbar-nav ml">
                  <li ><a href="index.php" ><span class ="glyphicon glyphicon-home"></span> Home</a></li>
                  
                  <li><a href="tarrif.php"><span class ="glyphicon glyphicon-usd"></span> Tarrif</a></li>
                  <li class="active"><a href="location.php"><span class ="glyphicon glyphicon-map-marker"></span> Location</a></li>
                  <li><a href="contactus.php"><span class ="glyphicon glyphicon-phone"></span> Contact us</a></li>
                  
               </ul>

               <ul class="nav navbar-nav navbar-right">
                  <li><a href="../admin/logout.php"  style="margin-bottom:2px;background:#496CAD;border-radius:15px;"><span class ="glyphicon glyphicon-user"></span> Sign Out</a></li>
     
               </ul>
            </div>
            <!-- /.navbar-collapse -->
         </nav>
		 




 

<html>
<body>

<div class="container">


  URL: <input type="text" id="location" width="50%">
<input type="button"  value="Embed" onclick="shwmap()" id="sub1">
<input type="submit" name="sub"  value="save" onclick="shwmap()" id="sub1"><br/>
<input type="hidden" name="location" id="cpy"><br/>

<div  id="locmap"></div>

</div>
</form>
<div class="col-md-1"></div>
<div class="col-md-4"><br>
 <form action="location.php" method="post" enctype="multipart/form-data">
  <?php
  $pdo=dbcon::connect();
  $user=$_SESSION['username'];
  $sql="SELECT * FROM kk_hotels WHERE username='$user'";
  $row=$pdo->query($sql);
  $aboutus="";
  foreach ($row as $i) {
    $aboutus= $i['aboutus'];

  }
  if($aboutus=="")
  {
  echo '<textarea  class="details" name="details" id="" rows="10" >
  This is an editable block where you can place the details of your Location!!!!
  
  Place:
  Area:
  Plot No:
  District:
  State:
  Pincode:
       </textarea>';
  }
  else{
      echo '<textarea  class="details" name="details" id="" rows="10" >
          '.$aboutus.'
       </textarea>';
  }

?>
	<div class="center-block" style="text-align:center">
		
		<input type="submit" name="submit" value="Save"  class="btn btn-sky my-btn save">

	</div>
  </form>
</div>
<div class="col-md-4">
<h4> step 1:go to google maps;</h4>
<h4>step 2:search the location to embed;</h4>
<h4>step 3:click the settings symbol present at the bottm right corner;</h4>
<h4> step 4:select 'share or embed map';</h4>
<h4>step 5:click the 'Embed map'  copy the given link and paste in the text area provided;</h4>
 </div>


  <script>
 
  function shwmap()
  {
  var loc=document.getElementById("location").value;
  var loc=document.getElementById("cpy").value=loc;
  document.getElementById('locmap').innerHTML=loc;
  }
  </script>
</body>
</html>
