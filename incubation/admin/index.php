<?php
include "../assets/db/dbcon.php";
include "session.php";
if(loggedin()){
	header("Location:../edit/index.php");
}
else if(loggedin() && $_SESSION['username']=="busi.com")
{
      header("Location:../superuser/");
}

$pdo=dbcon::connect();

if(isset($_POST['submit']))
{
	$usr=$_POST['usr'];
	$pwd=$_POST['pwd'];

	if($usr&& $pwd){
		$sql="SELECT * FROM kk_users WHERE username='$usr'";
		foreach ($pdo->query($sql) as $row) {
			if($row['username']==$usr && $row['password'])
			{
				$login="TRUE";
				$_SESSION['username']=$usr;
			}
			else{
				$login="FALSE";
			}
		}
	}
	
	if($login=="TRUE" && $_SESSION['username']!="busi.com"){
		header("Location:../edit/index.php");
	 }
	else if($login=="TRUE" && $_SESSION['username']=="busi.com"){
		header("Location:../superuser");
	 }
	else{
      echo "<script type='text/javascript'>alert('username or password entered is incorrect');</script>";
  }
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
		body{background:url('bg.png');}
		.login{
			width:35%;
			height:50%;
			margin-top:10%;
		margin-right: auto;
		margin-left: auto;
		text-align: center;
		}
		
		.submit{
			border:0px;
			outline:0px;
			padding:10px 30px;
			background:#2E446C;
			border-radius:10px;
			color:white;
		}
   .submit:hover{
			background:#496CAD;
			color:white;
		}
		.box{
			height:320px;
		}
		.panel-heading{
			height:15%;
			font-size: 30px;
		}
	</style>
</head>
<body>
		<div class="container">
			<div class="login">
				<div class="panel panel-primary box">
					<div class="panel-heading">
						SIGN IN
					</div>
					<div class="panel-body">
						<form role="form" action="index.php" method="post" style="margin-top:8%;">
							<div class="input-group">
								<input type="text" name="usr" class="form-control" placeholder="Username">
								<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
							</div>
							<br/><br/>
							<div class="input-group">
								<input type="password" name="pwd" class="form-control" placeholder="Password">
								<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
							</div>
								<input type="submit" name="submit" value="submit" class="btn btn-sky submit" style="border-radius:10px;margin-top:8%;font-style:bold;">
           
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
</body>
</html>
