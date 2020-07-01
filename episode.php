<?php
	$a = $_GET['a'];
	$ml_current = $menime_list[$a];
?>
<h2><?= strtoupper($anime_txt); ?></h2>
<div class="row">
<?php
	foreach ($ml_current as $k => $v):
		$img = "https://menime.herokuapp.com/assets/img/icon.png";
		$link = "index.php?page=film&a=$a&id=$k";
		
		if(isset($v['thumbnail'])){
			$img = $v['thumbnail'];
		}
?>
		<div class="col-md-2 col-xs-4 col-list">
			<div class="anime-list">
				<a href="<?= $link;?>" title="<?= $v['judul']; ?>">
					<div class="poster-img">
						<div class="img-list" style="background-image: url(<?= $img; ?>);" ></div>
						<div class="see"><i class="fa fa-play"></i></div>
					</div>
				</a>
				<div class="film-judul">
					<div class="mark">
						<i class="icon-local_play"></i> 
					</div>
					<h3>
						<a href="<?= $link;?>" title="<?= $v['judul']; ?>">
							<?= $v['judul']; ?>
						</a>
					</h3>
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
<?php endforeach; ?>
</div>