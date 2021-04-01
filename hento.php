<?php

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

	$html = $dom->load($data, true, true);
	$list_episode = array();

	foreach ($html->find(".listupd") as $lst) {
		foreach ($lst->find("article.bs") as $bs) {
			$judul = $bs->find(".tt>h2",0)->text();
			$img = $bs->find("img",0)->src;
			$a = $bs->find("a",0)->href;
			$rel = $bs->find("a",0)->attr["rel"];
			$epx = ($bs->find(".epx",0))?$bs->find(".epx",0)->text():'';
			$sub = ($bs->find(".sb",0))?$bs->find(".sb",0)->text():'';
			$list_episode[] = array(
									"judul" => $judul,
									"img" => $img,
									"link" => "index.php?page=vhen&b=".e_url($a),
									"epx" => $epx,
									"sub" => $sub,
									"rel" => $rel
									);
									
			
		}
	}
	$list_pagin = [];
	$html = $dom->load($data, true, true);
	foreach ($html->find(".pagination") as $page) {
		if($page->find(".current",0)){

			$current = $page->find(".current",0)->text();
			foreach ($page->find(".page-numbers") as $num) {
				if($num->href){
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
	}
	$main_judul = "";
	foreach ($html->find(".postbody") as $postbody) {
		foreach ($postbody->find(".bixbox") as $bixbox) {
			foreach ($postbody->find(".releases") as $releases) {
				$main_judul = $releases->text();
			}
		}
	}

	return ["judul" => $main_judul, "main" => $list_episode, "pagin" => $list_pagin];
}


function lista_main($url){
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
	$list_episode = array();

	foreach ($html->find(".excstf") as $lst) {
		foreach ($lst->find("article.bs") as $bs) {

			$judul = $bs->find(".tt>h2",0)->text();
			$img = $bs->find("img",0)->src;
			$a = $bs->find("a",0)->href;
			$rel = $bs->find("a",0)->attr["rel"];
			$list_episode[] = array(
									"judul" => $judul,
									"img" => $img,
									"link" => "index.php?page=fhen&g=".e_url($a),
									"rel" => $rel,
									);
									
		}
	}
	
	return ["judul" => "hentai", "main" => $list_episode, "pagin" => []];
}

$halaman_link = "http://209.126.6.6/";
$menime_list = [];
if(isset($_GET['g'])){
	$g = d_url($_GET['g']);
	$halaman_link = $g;
	$menime_list = lista($halaman_link);
}else{
	$menime_list = lista_main($halaman_link);
}
$pagination = $menime_list["pagin"];
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
<h2><?= strtoupper($menime_list['judul']); ?></h2>
<div class="row">
<?php
	foreach ($menime_list["main"] as $k => $v):
		$img = "https://menime.herokuapp.com/assets/img/icon.png";
		//$link = "index.php?page=vhen&b=".e_url($v['link']);
		$link = $v['link'];
		if(isset($v['img'])){
			$img = $v['img'];
		}
?>
		<div class="col-md-2 col-xs-6 col-list">
			<div class="anime-list">
				<a href="<?= $link;?>" title="<?= $v['judul']; ?>" class="poster-img-a" rel="<?= $v['rel']; ?>" data-show="0" >
					<div class="poster-img"  >
						<div class="img-list" style="background-image: url(<?= $img; ?>);" ></div>
						<div class="see">
							<i class="fa fa-play-circle-o"></i>
						</div>
						<div class="see_ext">
							<div class="bt">
								<span class="epx"><?= $v['epx']; ?></span>
								<span class="sb Sub"><?= $v['sub']; ?></span>			
							</div>
						</div>
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
<?php if(!empty($pagination)): ?>
<style type="text/css">
	nav.navigation{
		text-align: center;
	}
	ul.pagination{
		clear: both;
		float: none;
		text-align: center;
	}
</style>
<nav class="navigation" aria-label="page navigation">
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
<?php endif; ?>

<script type="text/javascript">
	$(document).ready(function(){
		/*$(".poster-img-a").mouseenter(function(e, h){
			var rel = $(this).attr("rel");
			var ts = $(this).attr("data-show");
			if(ts==0){
					//clientX: 646
					//clientY: 239
				
				console.log(e);
				console.log(rel);
				$(this).attr("data-show",1);
			}else{
				$(this).attr("data-show",0);
			}
		});*/
	});
</script>
<!-- 
<div class="load_tooltip">
	
</div>

<div class="tooltip tooltip-ini">
   <div class="thumbnail"><img src="http://i0.wp.com/209.126.6.6/wp-content/uploads/2020/04/1586888095-105097.jpg" class="wp-post-image" loading="lazy" /></div>
   <div class="detail">
      <div class="rating">
         <strong>Rating 6.17</strong> 
         <div class="rating-prc" itemscope="itemscope" itemprop="aggregateRating" itemtype="//schema.org/AggregateRating">
            <meta itemprop="ratingValue" content="6.17">
            <meta itemprop="worstRating" content="1">
            <meta itemprop="bestRating" content="10">
            <meta itemprop="ratingCount" content="10">
            <div class="rtp">
               <div class="rtb"><span style="width:61.7%"></span></div>
            </div>
         </div>
      </div>
      <table>
         <tr>
            <td><b>Type</b></td>
            <td>Anime</td>
         </tr>
         <tr>
            <td><b>Status</b></td>
            <td>Ongoing</span> 
         <tr>
            <td><b>Duration</b></td>
            <td>Unknown</span> 
         <tr>
            <td><b>Genres</b></td>
            <td><a href="http://209.126.6.6/genres/big-oppai/" rel="tag">Big Oppai</a>, <a href="http://209.126.6.6/genres/creampie/" rel="tag">Creampie</a>, <a href="http://209.126.6.6/genres/forced/" rel="tag">Forced</a>, <a href="http://209.126.6.6/genres/hentai/" rel="tag">Hentai</a>, <a href="http://209.126.6.6/genres/maid/" rel="tag">Maid</a>, <a href="http://209.126.6.6/genres/masturbation/" rel="tag">Masturbation</a>, <a href="http://209.126.6.6/genres/milf/" rel="tag">MILF</a>, <a href="http://209.126.6.6/genres/netorare/" rel="tag">Netorare</a>, <a href="http://209.126.6.6/genres/paizuri/" rel="tag">Paizuri</a>, <a href="http://209.126.6.6/genres/rape/" rel="tag">Rape</a>, <a href="http://209.126.6.6/genres/virgin/" rel="tag">Virgin</a></td>
         </tr>
      </table>
      <div class="contexcerpt">Jitaku Keibiin 2 (2020) Sinopsis Ini merupakan seri kedua dari Jitaku Keibiin. Haibara Shikimori yang seharusnya mewarisi vila dari kakeknya namun vila itu jatuh ke tangan sepupunya si Rena. Berdasarkan...</div>
   </div>
</div>


 -->
