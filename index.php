
<?php

require('func.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");
$menime_list = json_decode(file_get_contents("data/jstream.json") ,true);
$file = scandir(".");
unset($file[0], $file[1]);
$title = "JStream ";
$inc = '';
$og_desc = 'JStream Adalah Website Nonton Film.'; 
$og_img = 'jstreams.herokuapp.com/assets/img/logo.png'; 
$og_url = "https://jstreams.herokuapp.com/index.php";
if(isset($_GET['page'])){
	$q = $_GET['page'];
	$p = $q.".php";
	if(in_array($p, $file)){
		if($q=="parn"){
			$inc = $p;
			$anime_txt = "";
			if(isset($_GET['a'])){
				$anime_txt = $menime_list[$_GET['a']]['judul'];
			}
			$nav = '<li><a href="index.php">Home</a></li>';
			$nav .= '<li class="active">'.ucwords($anime_txt).'</li>';
			$title .= " | ".ucwords($anime_txt);
		}elseif($q=="episode"){
			$inc = $p;
			$anime_txt = "";
			if(isset($_GET['a'])){
				$anime_txt = $menime_list[$_GET['a']][0]['judul'];
			}
			$nav = '<li><a href="index.php">Home</a></li>';
			$nav .= '<li class="active">'.ucwords($anime_txt).'</li>';
			$title .= " | ".ucwords($anime_txt);
		}elseif($q=="hento"){
			$inc = $p;
			$nav = '<li><a href="index.php">Home</a></li>';
			$nav .= '<li class="active">'.ucwords("Hentai").'</li>';
			$title .= " | ".ucwords("Hento");
		}elseif($q=="vhen"){
			$inc = $p;

			$hen = get_vid(d_url($_GET['b']));
			$nav = '<li><a href="index.php">Home</a></li>';
			$nav .= '<li><a href="index.php?page=hento">Hentai</a></li>';
			$nav .= '<li class="active">'.ucwords($hen["title"]).'</li>';
			$title .= " | ".ucwords("Hento");
		}elseif($q=="fhen"){
			$inc = $p;
			$link = d_url($_GET['g']);
			$vhen = get_vid_real($link);
			$nav = '<li><a href="index.php">Home</a></li>';
			$nav .= '<li><a href="index.php?page=hento">Hentai</a></li>';
			$nav .= '<li><a href="index.php?page=vhen&b='.$_GET['b'].'">'.d_url($_GET['j']).'</a></li>';
			$nav .= '<li class="active">'.ucwords($vhen['title']).'</li>';
			$title .= " | ".ucwords("Hento");
		}else{
			$inc = $p;
			$sub = $_GET['a'];
			$ml_current = $menime_list[$sub];
			if(isset($ml_current['judul'])){
				$anime_txt = $ml_current['judul'];

				$at = $ml_current['judul'];//join(" ", explode("_", $sub));
				$nav = '<li><a href="index.php">Home</a></li>';
				$nav .= '<li class="active">'.trim($anime_txt).'</li>';
				$title .= " | ".ucwords($at)." ".ucwords($anime_txt);
				$list_anime = $ml_current;
			}else{
				$ml_current = $menime_list[$sub][$_GET['id']];

				$anime_txt = $ml_current['judul'];
				$at = $ml_current['judul'];//join(" ", explode("_", $sub));
				$nav = '<li><a href="index.php">Home</a></li>';
				$nav .= '<li><a href="index.php?page=episode&a='.$sub.'">'.$anime_txt.'</a></li>';
				$nav .= '<li class="active">'.$_GET['id'].'</li>';
				$title .= " | ".ucwords($at)." ".ucwords($anime_txt);
				$list_anime = $ml_current;
			}
		}
	}
}else{
	$inc = "home.php";
	$nav = '<li  class="active">Home</li>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#e50914">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#e50914">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#e50914">
	<meta property="og:url"           content="<?= $og_url; ?>" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="<?= $title; ?>" />
  	<meta property="og:description"   content="<?= $og_desc; ?>" />
  	<meta property="og:image"         content="<?= $og_img; ?>" />
	<title><?= $title; ?></title>
	<link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon"/>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.css">
	<link rel="stylesheet" href="assets/css/icon.css">
	<link rel="stylesheet" href="assets/css/style.css">
	
    <script src="assets/js/jquery.min.js"></script>
</head>
<body>
	<div class="container header-main">
		<a href="index.php">
			<img src="assets/img/icons.png" alt="Logo" height="75px" style="margin:20px 0;">
		</a>
	</div>
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
		      	</button>
		      	<!-- <a class="navbar-brand" href="#">Brand</a> -->
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      	<ul class="nav navbar-nav">
			        <li <?= $inc=="home.php"?'class="active"':''; ?> ><a href="index.php">Home</a></li>
			        <li <?= $inc=="parn.php" || $inc=="film.php"?'class="active"':''; ?> ><a href="index.php?page=parn">Parn</a></li>
			        <li <?= ($inc!="home.php" && $inc!="parn.php" && $inc!="film.php" )?'class="active"':''; ?> ><a href="index.php?page=hento">Hento</a></li>
		      	</ul>
		    </div><!-- /.navbar-collapse -->
  		</div><!-- /.container-fluid -->
	</nav>	
	<ol class="breadcrumb">
		<?php echo $nav; ?>
	</ol>
	<div class="container body-main">
		<?php include $inc; ?>
	</div>
	<div class="footer">
		<div class="container">
			<div class="container">
				<div class="row">
					<div class="col-xs-6 footer-left">
						<a href="index.php">
							<h1>
							<img src="assets/img/icons.png" alt="Logo" height="45px" style="margin:5px 0;">
							</h1>
						</a>
						<p>Powered by <a href="http://heroku.com/" target="blank" style="color:#337ab7;">heroku</a></p>
					</div>
					
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
	<script src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".table-list>tbody>tr").click(function(){
				var link = $(this).children().children().attr("href");
				window.location = link;
			});

		});
	</script>
</body>
</html>