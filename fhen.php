<style type="text/css">
	iframe{
		width: 100% !important;
		height: 500px;
	}
	@media (min-width: 320px) and (max-width: 480px) {
		iframe{
			height: 280px;
		}
	}
</style>
<?php
//echo $link;
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
<br><br>
<?= html_entity_decode($vhen['single_info']); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("a[rel='tag']").each(function(i, v){
			var link = $(v).attr("href");
			$.get("func.php?e_url="+link, function(data, status){
			    //console.log("Data: " + data + "\nStatus: " + status);
				$(v).attr("href","index.php?page=hento&g="+data);
			});
		});
	});
</script>