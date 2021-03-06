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


function lista($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	//$html = file_get_html($url);
	$html = $dom->load($data, true, true);
	$list_episode = array();

	foreach ($html->find(".listupd") as $lst) {
		foreach ($lst->find("article.bs") as $bs) {
			//echo htmlentities($lst);
			$judul = $bs->find(".tt>h2",0)->text();
			$img = $bs->find("img",0)->src;
			$a = $bs->find("a",0)->href;
			/*echo $judul;
			echo "<br>";
			echo $img;
			echo "<br>";
			echo $a;
			echo "<hr>";*/
			$list_episode[] = array(
									"judul" => $judul,
									"img" => $img,
									"link" => $a,
									);
									
		}
	}
	return $list_episode;
	//echo htmlentities($data);	
}


function pagin($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
	$list_pagin = [];
	$html = $dom->load($data, true, true);
	foreach ($html->find(".pagination") as $page) {
		/*echo $current;
		echo "<br>";*/
		$current = $page->find(".current",0)->text();
		/*
		$list_pagin[] = array("type" => "current", "num" => $current);	*/
		foreach ($page->find(".page-numbers") as $num) {
			if($num->href){
				/*echo $num->text();
				echo "<br>";
				echo $num->href;
				echo "<br>";*/
				$list_pagin[] = array("type" => $num->href, "num" => $num->text());	
			}else{
				if($num->text()==$current){
					$list_pagin[] = array("type" => "current", "num" => $num->text());	
				}else{
					$list_pagin[] = array("type" => "disabled", "num" => $num->text());	
				}
			}
			
		}
	}
	return $list_pagin;
}

$halaman_link = "http://209.126.6.6/genres/milf/";
if(isset($_GET['g'])){
	$g = d_url($_GET['g']);
	$halaman_link = $g;
}
$pagination = pagin($halaman_link);
$menime_list = lista($halaman_link);
?>
<style>
@media only screen and (max-width: 768px) {
	header.main, footer.main, .module .content .items .item:hover>.dtinfo, .pagination {
    	display: block;
	}

	.pagination a, .pagination span {
		margin:5px 0;
	}
}
</style>
<h2>LIST</h2>
<div class="row">
<?php
	foreach ($menime_list as $k => $v):
		$img = "https://menime.herokuapp.com/assets/img/icon.png";
		$link = "index.php?page=vhen&b=".e_url($v['link']);
		/*if(!isset($v['judul'])){
			$link = "index.php?page=episode&a=$k";
			$v['thumbnail'] = $v[0]['thumbnail'];
			$v['judul'] = $v[0]['judul'];
		}*/
		if(isset($v['img'])){
			$img = $v['img'];
		}
?>
		<div class="col-md-3 col-xs-6 col-list">
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
<nav aria-label="Page navigation">
  	<ul class="pagination">
  		<?php
  			foreach ($pagination as $ka => $va) {
  				$cur = "";
  				if($va["type"]=="current"){
  					$cur = "class='active'";
  					echo '<li '.$cur.'><a href="#">'.$va['num'].'</a></li>';
  				}else if($va["type"]=="disabled"){
  					$cur = "class='disabled'";
  					echo '<li '.$cur.'><a href="#">'.$va['num'].'</a></li>';
  				}else{
  					if($va['num']=="&laquo; Sebelumnya"){
  						$va['num'] = "&laquo;";
  					}else if($va['num']=="Berikutnya &raquo;"){
  						$va['num'] = "&raquo;";
  					}
  					$a = "index.php?page=hento&g=".e_url($va["type"]);
  					echo '<li><a href="'.$a.'">'.$va['num'].'</a></li>';
  				}
  			}
  		?>
  	</ul>
</nav>