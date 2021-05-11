<?php
?>
<h2>LIST PARN</h2>
<div class="row">
<?php
	foreach ($menime_list as $k => $v):
		$img = "https://menime.herokuapp.com/assets/img/icon.png";
		$link = "index.php?page=film&a=$k";
		if(!isset($v['judul'])){
			$link = "index.php?page=episode&a=$k";
			$v['thumbnail'] = $v[0]['thumbnail'];
			$v['judul'] = $v[0]['judul'];
		}
		if(isset($v['thumbnail'])){
			$img = $v['thumbnail'];
		}
?>
		<div class="col-md-2 col-xs-6 col-list">
			<div class="anime-list">
				<a href="<?= $link;?>" title="<?= $v['judul']; ?>">
					<div class="poster-img">
						<div class="img-list" style="background-image: url(<?= $img; ?>);" ></div>
						<!-- <div class="see"><i class="fa fa-play"></i></div> -->
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