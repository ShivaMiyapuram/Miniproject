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
$page='
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
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

  background-image: url(\'bg.png\');
}
.owl-carousel .item{
  height: 300px;
  width:96%;
  }
  textarea{
  width:100%;   
  height:400px;
  }
  .ml li a{
  font: 15px arial;
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
                  <li><a href="tarrif.php"><span class ="glyphicon glyphicon-usd"></span> Tarrif</a></li>
                  <li><a href="location.php"><span class ="glyphicon glyphicon-map-marker"></span> Location</a></li>
                  <li class="active"><a href="contactus.php"><span class ="glyphicon glyphicon-phone"></span> Contact us</a></li>
                  
               </ul>

            
            </div>
            <!-- /.navbar-collapse -->
         </nav>
      </div>
   </div>
</div>
</nav>
<form role="form" method="post" action="contactus.php">
<div class="col-md-1"></div>
<div class="col-md-4"><br>
 <?php
  include "../../assets/db/dbcon.php";
  $pdo=dbcon::connect();
  $sql="SELECT * FROM kk_hotels WHERE username=\''.$user.'\'";
  $row=$pdo->query($sql);
  $contactus="";
  foreach ($row as $i) {
    $contactus= $i["contactus"];

  }
  if($contactus=="")
  {
    echo \'<pre  >
This is an editable paragraph.
</pre>\';
  }
  else{
echo \'<pre  >
\'.$contactus.\'
</pre>\';
  }
    ?>
</div>
</form>
<div class="col-md-2"></div>
<div class="col-md-4">
             <br><div class="panel panel-primary">
                     <div class="panel-heading">
                       <h3 class="panel-title"><span class ="glyphicon glyphicon-phone"></span> Contact us</h3>
                    </div>
                          <div class="panel-body"> 
                             
                                  <div class="form-group:focus">
                                      <label for="exampleInputName">Full Name</label>
                                      <input type="text" class="form-control" name="exampleInputName" placeholder="Enter Full Name">
                                  </div><br>
                  <div class="form-group:focus">
                                      <label for="exampleInputEmail1">Email address</label>
                                      <input type="email" class="form-control" name="exampleInputEmail1" placeholder="Enter email">
                                  </div><br>
                  <div class="form-group:focus">
                                      <label for="exampleInputSubject">Subject</label>
                                      <input type="text" class="form-control" name="exampleInputSubject" placeholder="Enter Subject">
                                  </div><br>
                  <div class="form-group:focus">
                       <label for="exampleInputSubject">Message</label>
                         
                                          <textarea class="form-control" rows="3" name="Message"></textarea>

                                   </div> 
                        <input type="submit" class="btn btn-sky submit" style="" name="submit" value="submit">                                  
                                                     
                   

                       </div>
             </form>
</div>
</body>
</html>

';
$fname="../hotels/".$url."/contactus.php";
$fp=fopen($fname,'w');
fwrite($fp,$page);
fclose($fp);
header("Location:../edit/contactus.php")

?>