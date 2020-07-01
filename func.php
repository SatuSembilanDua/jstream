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


?>
