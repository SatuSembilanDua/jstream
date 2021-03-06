<?php

require('simplehtmldom/simple_html_dom.php');

function e_url( $s ) {
	return rtrim(strtr(base64_encode($s), '+/', '-_'), '='); 
}
 
function d_url($s) {
	return base64_decode(str_pad(strtr($s, '-_', '+/'), strlen($s) % 4, '=', STR_PAD_RIGHT));
}

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}


function get_vid($url){
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

	//echo htmlentities($html);


	$title = $html->find(".entry-title",0)->text();
	$img = $html->find(".attachment-",0)->src;
	
	$ninfo = $html->find(".ninfo",0);
	$ninfo =  htmlentities($ninfo);

	$sinop = $html->find(".synp",0);
	$sinop =  htmlentities($sinop);
	$epcheck = $html->find(".epcheck",0);
	//echo $epcheck;
	$eps = [];
	foreach ($epcheck->find(".eplister>ul>li") as $li) {
		//echo $li;
		$a = $li->find("a",0);
		//echo $a;
		$no = $a->find(".epl-num",0)->text();
		$atitle = $a->find(".epl-title",0)->text();
		$date = $a->find(".epl-date",0)->text();
		$eps[] = array(
						"link" => $a->href,
						"no" => $no,
						"title" => $atitle,
						"date" => $date,
						);
	}
	/*echo $sinop; */

	return [
			"title" => $title,
			"img" => $img,
			"ninfo" => $ninfo,
			"sinop" => $sinop,
			"eps" => $eps,
			];
	
}


function get_vid_real($url){
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
	
	$ret = [];

	$title = $html->find(".entry-title",0)->text();

	foreach ($html->find("#pembed") as $pembed) {
		//echo htmlentities($pembed);
		$iframe = $pembed->find("iframe",0);
		$video = htmlentities($iframe);
	}

	$ret = ["title" => $title, "video" => $video];
	return $ret;
}


?>
