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

//echo html_entity_decode($vhen['video']);

?>
<div class="load_video_box"></div>
<div class="before_player" data-href="<?= e_url($vhen['iframe_src']); ?>">
	<h1>
		<i class="fa fa-play"></i>
	</h1>
</div>
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
<pre id="pre_print_error" style="display:none;"></pre>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$(".before_player").click(function(){
			var lnk = $(this).attr("data-href");
			$(".before_player").html('<img src="assets/img/loading.svg" alt="loading">');
			var url = "anime_load.php?vid&link="+lnk;
			url += "&sub=11&eps=959";			
			$.ajax({
				url: url, 
				success: function(res){
    				var result = JSON.parse(res);
    				//console.table(result)
    				if(result.error != []){
    					console.log(result.error);
    					$("#pre_print_error").show();
    					$("#pre_print_error").html(JSON.stringify(result.error, null, 2));
    					swal("Error!", "FIle Not Found!", "error");
    					//$(".idframe").attr("src", '404.php');
	    				$(".before_player").show();
	    				$(".before_player").html('<h1><i class="fa fa-play"></i></h1>');
	    				//$(".idframe").show();
    				}else{
	    				$(".before_player").hide();
	    				//$(".load_video_box").html('<iframe src="'+result.video+'" allowfullscreen="true" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="idframe"></iframe>');
	    				$/*(".idframe").attr("src", result.video);
	    				$(".idframe").show();*/
	    				$(".load_video_box").show();
	    				$(".load_video_box").html(result.video);
    				}
  				},
  				error: function(xhr,status,error){
  					console.log(xhr);
  					console.log(status);
  					console.log(error);
  					$("#pre_print_error").show();
  					$("#pre_print_error").append(xhr);
  					$("#pre_print_error").append(status);
  					$("#pre_print_error").append(error);
  				}
  			});
		});

		$("a[rel='tag']").each(function(i, v){
			var link = $(v).attr("href");
			$.get("func.php?e_url="+link, function(data, status){
			    //console.log("Data: " + data + "\nStatus: " + status);
				$(v).attr("href","index.php?page=hento&g="+data);
			});
		});
	});
</script>