<?php
include "../admin/session.php";
include "../assets/db/dbcon.php";
if(!loggedin()){
  header("Location:../admin/login.php");
}
if(isset($_POST['sub'])){

  $username=$_POST['usr'];
  $password=$_POST['pwd'];
  $url=$_POST['url'];
  $pdo=dbcon::connect();
  if($url=="")
  {
  echo "<script type='text/javascript'>alert('please enter valid url');</script>";
  }
  if($username=="")
  {
  echo "<script type='text/javascript'>alert('please enter valid USERNAME');</script>";
  }
  if($password=="")
  {
  echo "<script type='text/javascript'>alert('please enter valid PASSWORD');</script>";
  }
  if(!file_exists("../hotels/".$url) && !($password=="") && !($username=="") && !($url==""))
  {
    mkdir("../hotels/".$url);
  }
  else if(file_exists("../hotels/".$url) && !($password=="") && !($username=="") && !($url=="")){
    echo "<script type='text/javascript'>alert('URL already exists please enter another URL');</script>";
  }

  if(file_exists("../hotels/".$url) && !($username=="") && !($password=="") && !($url==""))
  {
  $sql="INSERT INTO kk_users(username,password,url) VALUES('$username','$password','$url')";
  $pdo->query($sql);
    $sql="INSERT INTO kk_hotels(username) VALUES('$username')";
  $pdo->query($sql);
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
  input[type='file']{
    visibility: hidden;
  }
  body{

  background-image: url('bg.png');
}

  </style>
</head>
<body>
<nav class="navbar navbar-default" role="navigation" style="background:#2E446C;border:0px;">
  <div class="container-fluid" >
    <div class="navbar-header">
        <img src="../Capture.png"/>
      
    </div>
	<p class="navbar-text navbar-right">Signed in as superuser</p>
  </div>
</nav>
<form action="index.php" method="post">



         <div class="container">
  <form action="index.php" method="post">
  <div class="in-box" >
      <div class="in" style="margin:20px;">
        USERNAME:<input type="text" id="username" name="usr" class="form-control">
      </div>
      <div class="in" style="margin:20px;">
        PASSWORD:<input type="password" id="password" name="pwd" class="form-control">
      </div>
      <div class="in" style="margin:20px;">
        URL:/<input type="text" id="password" name="url" class="form-control">
      </div>
      </br>
  <input type="submit" class="btn btn-primary" value="store" name="sub" data-toggle="tooltip" data-placement="bottom" title="Save the USER Account" style="margin-top:40px; margin-bottom:40px; margin-right:20px; margin-left:75px;background:#2E446C;border-radius:10px;border-color:#2E446C">  
     <a href="../admin/logout.php">Sign Out</a>
</div>
</form>
</body>
</html>