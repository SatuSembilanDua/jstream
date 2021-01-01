<?php
	
	
	/*echo '<pre>';
	print_r($menime_list);*/
	//https://drive.google.com/file/d/1oVG3nJu2gCiaeXsbImF8PuaTkOR3zrdm/view?usp=sharing
	//https://drive.google.com/file/d/1oVG3nJu2gCiaeXsbImF8PuaTkOR3zrdm/view?usp=sharing
	//https://drive.google.com/file/d/1tgfTE4b8u8_GNWfsmlYs4XpWEVv-WWyx/view?usp=sharing
	/*$sdmm = [
				array(
						"link" => "https://drive.google.com/uc?export=download&id=1oVG3nJu2gCiaeXsbImF8PuaTkOR3zrdm",
						"thumbnail" => "https://drive.google.com/thumbnail?authuser=0&sz=w320&id=1oVG3nJu2gCiaeXsbImF8PuaTkOR3zrdm",
						"kategori" => "JAV",
						"group" => "31",
						"judul" => "01_SDMM-040 Magic Mirror No. Couple NTR Adhesive Foam Massage Experience At A Distance Of 30cm Through The Mirror To The Boyfriend! Even She Who Is Lovable And Desperate Can Not Refuse Others ○ Port In The Pleasure Of Rubbing Between The Crotch! ?",
						"id" => "1oVG3nJu2gCiaeXsbImF8PuaTkOR3zrdm",
				),array(
						"link" => "https://drive.google.com/uc?export=download&id=1tgfTE4b8u8_GNWfsmlYs4XpWEVv-WWyx",
						"thumbnail" => "https://drive.google.com/thumbnail?authuser=0&sz=w320&id=1tgfTE4b8u8_GNWfsmlYs4XpWEVv-WWyx",
						"kategori" => "JAV",
						"group" => "31",
						"judul" => "02_SDMM-040 Magic Mirror No. Couple NTR Adhesive Foam Massage Experience At A Distance Of 30cm Through The Mirror To The Boyfriend! Even She Who Is Lovable And Desperate Can Not Refuse Others ○ Port In The Pleasure Of Rubbing Between The Crotch! ?",
						"id" => "1tgfTE4b8u8_GNWfsmlYs4XpWEVv-WWyx",
				),

			];
	$menime_list[30] = $sdmm;
	$myfile = fopen("data/jstream.json", "w") or die("Unable to open file!");
	fwrite($myfile, json_encode($menime_list));
	fclose($myfile);*/
	/*echo '</pre>';*/
?>
<h2>LIST</h2>
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