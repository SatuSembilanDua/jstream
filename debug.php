<?php

require('func.php');


function lista($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_PROXY, null);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	/*pre($info);
	pre($error);*/

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	$html = $dom->load($data, true, true);
	$list_episode = array();

	//echo htmlentities($html);

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

//$halaman_link = "http://209.126.6.6/";
/*$halaman_link = "http://209.126.6.6/genres/milf/";
$menime_list = [];
$menime_list = lista($halaman_link);\
pre($menime_list);*/



//http://209.126.6.6/wp-admin/admin-ajax.php

// 11847  

cek("http://209.126.6.6/wp-admin/admin-ajax.php");

function cek($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
            "id=1457&action=tooltip_action");

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...

	curl_setopt($ch, CURLOPT_PROXY, null);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	pre($info);
	pre($error);
	echo htmlentities($data);
}

?>