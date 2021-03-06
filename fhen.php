<style type="text/css">
	iframe{
		height: 500px;
	}
	/*.naveps {
	    font-size: 13px;
	    padding: 3px 0;
	}

	.naveps.bignav {
	    float: none;
	    overflow: hidden;
	    margin-bottom: 15px;
	}
	.naveps .nvs {
	    float: left;
	}
	.naveps.bignav .nvs {
	    width: 33.33333%;
	    text-align: center;
	}
	.naveps.bignav .nvs a {
		border-radius: 3px;
    	display: block;
		padding: 10px 0;
	    background: #222;
	    color: #CCC;
	    box-shadow: 0 3px 0 0 #0f0f0f;
	}
	.naveps.bignav .nvs.nvsc {
	    margin: 0;
	    color: #FFF;
	    background: #ffb7b7;
	}*/
</style>
<?php

//echo e_url("Amanee!: Tomodachinchi de Konna Koto ni Naru Nante! (2013)");



//$link = "http://209.126.6.6/amanee-tomodachinchi-de-konna-koto-ni-naru-nante-2013-episode-1-sub-indo/";


/*print_r($a);*/

echo "<h2>$vhen[title]</h2>";

echo html_entity_decode($vhen['video']);


?>
<br><br>
<div class="container nav_bottom">
	<div class="col-xs-4">
		<a href="index.php?page=fhen&b=<?= $nav_link; ?>&j=<?= $nav_txt; ?>&g=<?= e_url($vhen['nav_list'][0]['link']); ?>" class="btn btn-danger2 btn-nav-bottom btn-seb <?= $vhen['nav_list'][0]['link']==""?"disabled":""; ?>">	
			<i class="fa fa-angle-double-left"></i> <?= $vhen['nav_list'][0]['text']; ?>
		</a>
	</div>
	<div class="col-xs-4">
		<a href="index.php?page=vhen&b=<?= $nav_link; ?>" class="btn btn-danger btn-nav-bottom btn-lis">List Episode</a>
	</div>
	<div class="col-xs-4">
		<a href="index.php?page=fhen&b=<?= $nav_link; ?>&j=<?= $nav_txt; ?>&g=<?= e_url($vhen['nav_list'][2]['link']); ?>" class="btn btn-danger2 btn-nav-bottom btn-seb <?= $vhen['nav_list'][2]['link']==""?"disabled":""; ?>">	
			<?= $vhen['nav_list'][2]['text']; ?> <i class="fa fa-angle-double-right"></i> 
		</a>
	</div>
</div>