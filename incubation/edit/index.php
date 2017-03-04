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
   $pdo=dbcon::connect();
 $uploads_dir="../hotels/$user/images/";
  for($i=0;$i<10;$i++)
  { $img="img".$i;
    if($_FILES["".$img]['name']!="")
    {
     $imgbinary = fread(fopen($_FILES["".$img]['tmp_name'], "r"), filesize($_FILES["".$img]['tmp_name']));
     ${$img} = base64_encode($imgbinary);
    }
    else
    {
      ${$img}="";
    }
	  $tmp_name = $_FILES["".$img]["tmp_name"];
	  $name = $_FILES["".$img]["name"];
   	$imgage="../hotels/$user/images/$i.jpg";
  if(${$img}!=""){
   move_uploaded_file($tmp_name, "$uploads_dir/$name");
	 rename("$uploads_dir/$name","$uploads_dir/$i.jpg");
  } 
  }

  $details=$_POST['details'];
  $sql="UPDATE kk_hotels SET details='$details' WHERE username='$user'";
  $pdo->query($sql);
header("Refresh:0"); 
header("Location:../static/home.php");
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
.owl-carousel .item{
  height: 300px;
  width:96%;
  }
  
  .ml li a{
  font: 15px arial;
  border-radius:0px;
  }
  .up{
  border:2px solid #2E446C;
  border-radius:10px;
  padding:2px ;
  color:#2E446C;
  background:white;
  font-size:15px;
  }
  .up:hover{
  background:#2E446C;
  color:white;
  }
  .save{
  border:0px;
  outline:0px;
  padding:10px 30px;
  background:#2E446C;
  border-radius:10px;
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

</head>
<body>


<form action="index.php" method="post" enctype="multipart/form-data">

  <?php
  $pdo=dbcon::connect();
  $user=$_SESSION['username'];
  $sql="SELECT * FROM kk_hotels WHERE username='$user'";
  $row=$pdo->query($sql);
  ?>
         <nav class="navbar navbar-default" role="navigation" style="background:#2E446C;border:0px;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <div class="navbar-brand logo">
              <?php 
               if (!file_exists("../hotels/$user/images/0.jpg")) {
			      echo '
      <img src="" alt="" class="img0">
          <label class="logo-l">Logo<input type="file"  name="img0" id="img0" accept="image/gif, image/jpeg, image/png"/></label>
    ';
                 /* echo '<img src="" alt="" class="img0"><label id="img0" class="logo-l">Logo
                 <input type="file" class="btn btn-primary " id="img0" name="img0"/></label>';*/
               }
               else
               {
			   echo  '
	<img src="../hotels/'.$user.'/images/0.jpg" alt="" class="img0">
     
          <label class="logo-l"> Logo<input type="file"  name="img0" id="img0" accept="image/gif, image/jpeg, image/png"/></label>
    ';
              /*    echo '<div class="item ">
				  <img src="../hotels/'.$user.'/images/0.jpg" alt="" class="img0">
				 <label id="img0" class="logo-l">Logo
                 <input type="file"   id="img0" name="img0" accept="image/gif, image/jpeg, image/png"/></label>
				</div> ';*/
               }
               ?>
               </div>
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
               <span >Menu</span>
               </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
               <ul class="nav navbar-nav ml" >
                  <li class="active"><a href="index.php" ><span class ="glyphicon glyphicon-home"></span> Home</a></li>
                 
                  <li><a href="tarrif.php" ><span class ="glyphicon glyphicon-usd"></span> Tarrif</a></li>
                  <li><a href="location.php" ><span class ="glyphicon glyphicon-map-marker"></span> Location</a></li>
                  <li><a href="contactus.php"><span class ="glyphicon glyphicon-phone"></span> Contact us</a></li>
                  
               </ul>

               <ul class="nav navbar-nav navbar-right">
                  <li><a href="../admin/logout.php" style="margin-bottom:2px;background:#496CAD;border-radius:15px;"><span class ="glyphicon glyphicon-user"></span> Signout</a></li>
               </ul>
            </div>
            <!-- /.navbar-collapse -->
         </nav>
      </div>
   </div>
</div>
</nav>
<div class="wrapper">
<div class="owl-carousel  owl-theme">

<?php
$imagef="../hotels/$user/images";
if(!file_exists($imagef))
  {
    mkdir("../hotels/$user/images");
  }
  for ($i=1; $i < 10; $i++) { 
   $img="img".$i;
    $imgage="../hotels/$user/images/$i.jpg";

if (!file_exists($imgage)) {
    echo '<div class="item ">
      <img src="" alt="" class="'.$img.'">
          <label class="up"><span class ="glyphicon glyphicon-cloud-upload"></span> Upload<input type="file"  name="'.$img.'" id="'.$img.'" accept="image/gif, image/jpeg, image/png"/></label>
    </div>';
} 
  else
  {
    echo '<div class="item ">
	<img src="../hotels/'.$user.'/images/'.$i.'.jpg" alt="" class="'.$img.'">
     
          <label class="up"><span class ="glyphicon glyphicon-cloud-upload"></span> Upload<input type="file"  name="'.$img.'" id="'.$img.'" accept="image/gif, image/jpeg, image/png"/></label>
    </div>';
  }
  }

?>    

</div>
<div class="container" style="margin-top:30px;">
<?php
  $sql="SELECT * FROM kk_hotels WHERE username='$user'";
  $row=$pdo->query($sql);
  $details="";
  foreach ($row as $i) {
    $details=$i['details'];
  }
  if($details=="")
    echo '
  <textarea  class="details" name="details" id="" rows="10">
     This is the editable block.  
  </textarea>';
  else{
        echo '
  <textarea  class="details" name="details" id="" rows="10">
'.$details.'

  </textarea>';
  }
?>
  <div class="center-block" style="text-align:center">
    <input type="submit" name="sub" value="Save" class="btn save" >
</div>
</div>
</div>
</form>
<script>
      $(document).ready(function(){
      $("input:file").change(function(){
      var id =$(this).attr('id');
        readURL(this,id);
    });
     function readURL(input,id) {
          if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.'+id).attr('src', e.target.result);
            $('#'+id).css('visibility','hidden');
        }

            reader.readAsDataURL(input.files[0]);
        }
    }



      });
</script>
<script type="text/javascript">
        $(document).ready(function(){
$('.owl-carousel').owlCarousel({
loop:true,
    margin:20,
      navigation: true,
    navigationText: [
      "<i class='glyphicon glyphicon-chevron-left lt'></i>",
      "<i class='glyphicon glyphicon-chevron-right rt'></i>"
      ],
    responsiveClass:true,
    slideBy:1,
    items:3,
    
     itemsScaleUp:true,
    responsive:{
        320:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        900:{
            items:3,
            nav:true,
            loop:false
        }
    }
})
});
    </script>
</body>
</html>