<?php
include "../admin/session.php";
include "../assets/db/dbcon.php";
if(!loggedin()){
	header("Location:../admin/login.php");
}
else if($_SESSION['username']=="busi.com")
{
      header("Location:../superuser/");
}
if(isset($_POST['sub'])){
  $tarrif=$_POST['result'];
  $user=$_SESSION['username'];
  $pdo=dbcon::connect();  
  $sql="UPDATE kk_hotels SET tarrif='$tarrif' WHERE username='$user'";
  $pdo->query($sql);
header("Location:../static/tarrif.php");

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
	<script src="../assets/js/jquery.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<style>
	input[type='file']{
		visibility: hidden;
	}
	body{

	background-image: url('bg.jpg');
}
 .ml li a{
  font: 15px arial;
  border-radius:0px;
  }
	</style>
</head>
<body>
 <?php
  $pdo=dbcon::connect();
  $user=$_SESSION['username'];
  ?>



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
                  <li ><a href="index.php"><span class ="glyphicon glyphicon-home"></span> Home</a></li>
                  
                  <li class="active"><a href="tarrif.php"><span class ="glyphicon glyphicon-usd"></span> Tarrif</a></li>
                  <li><a href="location.php"><span class ="glyphicon glyphicon-map-marker"></span> Location</a></li>
                  <li><a href="contactus.php"><span class ="glyphicon glyphicon-phone"></span> Contact us</a></li> 
               </ul>
               <ul class="nav navbar-nav navbar-right">
                  <li><a href="../admin/logout.php" class="btn " style="margin-bottom:2px;background:#496CAD;border-radius:15px;"><span class ="glyphicon glyphicon-user"></span> Sign Out</a></li>
     
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
  $pdo=dbcon::connect();
  $user=$_SESSION['username'];
  $sql="SELECT * FROM kk_hotels WHERE username='$user'";
  $row=$pdo->query($sql);
  $tarrif="";
  foreach ($row as $i) {
    $tarrif= $i['tarrif'];

  }
  if($tarrif=="")
  {
  echo '<div class="in-box" >
			<div class="in" style="margin:20px;">
				ROWS:<input type="text" id="rows" class="form-control" style="border-radius:15px">
			</div>
			<div class="in" style="margin:20px;">
				COLUMNS:<input type="text" id="cols"class="form-control" style="border-radius:15px">
			</div>
			<br/><br/>
			<div class="in">
				<button class="btn btn-primary"  id="gen" onclick="gen()" style="margin-bottom:2px;background:#2E446C;border-radius:10px;">Generate</button>
			</div>
			<div class="in">
				<button class="btn btn-primary" name="save" onclick="cpy()" style="margin-bottom:2px;background:#2E446C;border-radius:10px;">Finalise</button>
			</div>
			<div class="in">
		<form action="tarrif.php" method="post">
		<input type="hidden" name= "result" id="cpy"class="form-control">
	<input type="submit" class="btn btn-primary" name="sub" value ="save page" data-toggle="tooltip" data-placement="bottom" title="Please make sure that you have finalized the changes"  style="margin-bottom:2px;background:#2E446C;border-radius:10px;">
		</form>
</div>

</div>
		<br><br>
		<div id="str"></div>
</div>';
  }
  else{
        echo '<div class="in-box" >
			<div class="in" style="margin:20px;">
				ROWS:<input type="text" id="rows" class="form-control" style="border-radius:15px">
			</div>
			<div class="in" style="margin:20px;">
				COLUMNS:<input type="text" id="cols"class="form-control" style="border-radius:15px">
			</div>
			<br></br>
			<div class="in" >
				<button class="btn btn-primary"  id="gen" onclick="gen()" style="margin-bottom:2px;background:#2E446C;border-radius:10px;">Generate</button>
			</div>
			<div class="in">
				<button class="btn btn-primary" name="save" onclick="cpy()"  style="margin-bottom:2px;background:#2E446C;border-radius:10px;">Finalise</button>
			</div>
			<div class="in">
		<form action="tarrif.php" method="post">
		<input type="hidden" name= "result" id="cpy"class="form-control">
	<input type="submit" class="btn btn-primary" name="sub"  data-toggle="tooltip" data-placement="bottom" title="Please make sure that you have finalized the changes" value="save page" style="margin-bottom:2px;background:#2E446C;border-radius:10px;">
		</form>
</div>

</div>
		<br><br>
		<div id="str">'.$tarrif.'</div>
</div>';
  }

?>

</center>
		<script>
		function gen(){
		var rows=document.getElementById('rows').value;
		var cols=document.getElementById('cols').value;
		var string="<table class='table table-responsive table-bordered'   id='tab'>";
		var i;

			string+="<tr class='active'>";
			for(var j=0;j<cols;j++){
				string+="<th contenteditable='true'>Demo</th>";
			}
			string+="</tr>";
		for(i=0;i<rows;i++){
			string+="<tr>";
			for(var j=0;j<cols;j++){
				string+="<td contenteditable='true'>Demo</td>";
			}
			string+="</tr>";
		}
		string+="</table>";

		document.getElementById('str').innerHTML=string;
		
	}
	function cpy(){
		var tab=document.getElementById('str').innerHTML;
		document.getElementById('cpy').value=tab;
		
	}
		</script>
		
</body>
</html>