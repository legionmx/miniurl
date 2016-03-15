<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/class/User.php');
if(!isset($activePage)){
  $activePage = 'Home';
}
$headLinks = array('Home'=>'/');
if(isset($_SESSION['authToken'])){
  $headLinks['Statistics'] = "/stats/";
  $headLinks['CSV Upload'] = "/upload/";
  $headLinks['CSV Download'] = "/download/";
  $headLinks['Logout'] = "/auth/logout.php";
}
else{
  $headLinks['Login'] = "/auth/";
  $headLinks['Sign up'] = "/auth/vwSignUp.php";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>lnkCool - <?php echo $activePage;?></title>

	<!-- CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="/css/sticky-footer.css" rel="stylesheet">
	<link href="/css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/owl.carousel.css"/>
    <link rel="stylesheet" href="/css/owl.theme.css"/>
  <link rel="stylesheet" type="text/css" href="/css/lnkcool.css">

</head>
<body>
	<nav id="section_header" class="navbar navbar-fixed-top navbar-inverse">
		<div class="container">
			<div class="navbar-header navbar-header-short">
				<a class="navbar-brand"><img src="/images/logo_white.png" height="73" width="230" /></a>
			</div>
			<div id="navbar">
				<ul class="nav navbar-nav navbar-right">
          <?php
          foreach ($headLinks as $title => $link) {
            ?>
            <li<?php if($title == $activePage ){ echo ' class="active"';} ?>>
              <a href="<?php if($title == $activePage && false ){ echo '#'; } else{ echo $link;}?>"><?php echo $title; ?></a>
            </li>
            <?php
          }
          ?>
	  
	  <?php
	  if(isset($_SESSION['authToken'])){
	      $user = new User;
	      $userName = $user->getNamebyId($_SESSION['uid']);
	      $userNameOk = preg_filter('/firstName/', '', $userName);
	  
	  
	  ?>
	      <li><a>Welcome: <?php echo $userNameOk; ?></a></li>
	  
	  <?php }?>
	  
	  
<!-- <li><a href="/stats/">Estad&iacute;sticas</a></li>
            <li class="active"><a href="#">Carga masiva</a></li> -->
				</ul>
			</div>
		</div>
	</nav>

	<!-- Slider start -->
    <section id="slider_part">
         <div class="carousel slide" id="carousel-example-generic" data-ride="carousel">
            <!-- Indicators -->
         	 <ol class="carousel-indicators text-center">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
             </ol>

           	<div class="carousel-inner">
           	 	<div class="item active">
           	 		<div class="overlay-slide">
           	 			<img src="../images/bg2.jpg" alt="" class="img-responsive">
           	 		</div>
           	 	</div>
                <div class="item">
                    <div class="overlay-slide">
                        <img src="../images/bg2.jpg" alt="" class="img-responsive">
           	 		</div>
           	 	</div>

           	 </div> 	 <!-- End Carousel Inner -->

            <!-- Controls -->
            <div class="slides-control ">
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                	<span><i class="fa fa-angle-left"></i></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                	<span><i class="fa fa-angle-right"></i></span>
                </a>
            </div>
        </div>
  	</section>
    <!--/ Slider end -->