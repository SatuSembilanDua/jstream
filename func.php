<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");

require('simplehtmldom/simple_html_dom.php');

function e_url( $s ) {
	return rtrim(strtr(base64_encode($s), '+/', '-_'), '='); 
}
 
function d_url($s) {
	return base64_decode(str_pad(strtr($s, '-_', '+/'), strlen($s) % 4, '=', STR_PAD_RIGHT));
}

function pre($isi=''){
	echo "<pre>";
	print_r($isi);
	echo "</pre>";
}

if(isset($_GET['e_url'])){
	echo e_url($_GET['e_url']);
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

	$iframe_src = "";

	foreach ($html->find("#pembed") as $pembed) {
		$iframe = $pembed->find("iframe",0);
		$video = htmlentities($iframe);
		$iframe_src = $iframe->src;
	}

	$nav_list = [];
	foreach ($html->find(".bignav") as $nav) {
		foreach ($nav->find(".nvs") as $nvs) {
			if($nvs->find("a",0)){
				$nav_list[] = array(
									"link" => $nvs->find("a",0)->href,
									"text" => $nvs->find("a",0)->text(),
									);
			}else{
				$nav_list[] = array(
									"link" => "",
									"text" => $nvs->find("span",0)->text(),
									);
			}
			
		}
	}

	$single_info = $html->find(".single-info",0);
	//echo htmlentities($single_info);

	$ret = ["title" => $title, "video" => $video, "nav_list" => $nav_list, "single_info" => htmlentities($single_info)
			,"iframe_src" => $iframe_src
			];
	return $ret;
}
/*
$a = get_vid_real("http://209.126.6.6/inmou-2020-episode-1-subtitle-indonesia/");
//pre($a);
$b = //get_vid_iframe($a["iframe_src"]);
$b = get_vid_iframe("https://mplayer.xyz//embed.php?data=q96F7jdq2QFdRiT+YaaFCmyZHueTDLBnojulp+jYQXYz+qx9uFwg2iV0ZaBXMkAzv0+qscdgAqClvAN6q64FgcUIJMT5J07cIKGfxUBAXoTAic0QbaYBxkFxWyuoOAsL7Z1CIwbj51j4EHaTd85D7Pbm9IGh7StVgR7W6CPtfHoQhKI2QeOnyfLCYYb9vzqWeSD9F+6JHKZn1XwHkYo6+LnKxT7xVox/Y7a6QFJNegca9JvKSETVE5oPXNFvWqgt6PY6RzZpAu8AYHfr8VLJi3CDUWHSmbgbw2INKjnpF2M=");
*/
function get_vid_iframe($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_setopt($ch, CURLOPT_PROXY, null);

	$data = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	curl_close($ch);
	$dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

	$html = $dom->load($data, true, true);
	echo htmlentities($data);
	//echo $html;
}



/*$menime_list = json_decode(file_get_contents("data/jstream.json") ,true);
//pre($menime_list);
$a = $menime_list[7];
$a['link'] = "https://drive.google.com/uc?export=download&id=1sWdfa8il3YgsejSQDgRRpd8Q8vTLcMX_";
$a['thumbnail'] = "https://drive.google.com/thumbnail?authuser=0&sz=w320&id=1sWdfa8il3YgsejSQDgRRpd8Q8vTLcMX_";
$a['kategori'] = 'Jav';
$a['group'] = '32';
$a['judul'] = 'CRS-045 Roh Flower 乃 Momose Sex Slaves Young Wife';
$a['id'] = '1sWdfa8il3YgsejSQDgRRpd8Q8vTLcMX_';
$menime_list[14] = $a;
pre($menime_list);

$myfile = fopen("data/jstream.json", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($menime_list));
fclose($myfile);*/
?>