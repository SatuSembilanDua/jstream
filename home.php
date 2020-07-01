<h2>LIST</h2>
<pre>
<?php
//https://drive.google.com/thumbnail?authuser=0&sz=w320&id=[fileid]

$file = fopen("data/a.csv","r");
$data = [];
$i = 0;
while(!feof($file)){
	$dd = fgetcsv($file);
  	if($i>0){
  		//echo "<br>$i<br>";
  		//print_r($dd);
  		$judul = str_replace("Copy of [NekoPoi]_", "", $dd[3]);
  		$judul = str_replace("_[480P]_[nekopoi.co.uk]", "", $judul);
  		$judul = str_replace("Salinan [NekoPoi]_", "", $judul);
  		$judul = str_replace("[480P]_[nekopoi.loan]-muxed-muxed", "", $judul);
  		$judul = str_replace("_[480P]_[nekopoi.loan]", "", $judul);
  		$judul = str_replace("_[360P]_[Sub_Indo]_[nekopoi.pro]", "", $judul);
  		$judul = str_replace(".MP4", "", $judul);
  		$judul = str_replace(".mp4", "", $judul);

  		
  		$tmp = array(
  			"link" => "https://drive.google.com/uc?export=download&id=".$dd[5],
  			"thumbnail" => "https://drive.google.com/thumbnail?authuser=0&sz=w320&id=".$dd[5],
  			"kategori" => $dd[1],
  			"group" => $dd[2],
  			"judul" => $judul,
  			"id" => $dd[5],
  		);
  		array_push($data, $tmp);
  	}
  	$i++;
}

fclose($file);
$gr = [];
foreach ($data as $key => $value) {
	if($key>23){
		array_push($gr, $value);
		unset($data[$key]);
	}
}
//print_r($data);
//print_r($gr);
$arr = array();
foreach ($gr as $key => $item) {
   $arr[$item['group']][$key] = $item;
}
ksort($arr, SORT_NUMERIC);
foreach ($arr as $key => $value) {
	$arr[$key] = array_values($value);
}
//print_r($arr);
$data = array_merge($data, $arr);
/*print_r($data);


$myfile = fopen("data/jstream.json", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($data));
fclose($myfile);*/
?>
</pre>
<!-- <video controls>
	<source src=" https://dl.dropboxusercontent.com/s/yq5qpxhjhtefbxz/AmpliTube%203%20%28Full%20version%20%2B%20unlocked%29.mp4?dl=0" type='video/mp4'/>
	<source src=" https://dl.dropboxusercontent.com/s/yq5qpxhjhtefbxz/AmpliTube%203%20%28Full%20version%20%2B%20unlocked%29.mp4?dl=0" type='video/webm'/>
</video> -->
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