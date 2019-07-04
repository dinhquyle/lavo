<?php
// for rewrite URL
function getArrUrl($var) {
	$nvar = Array();
	$na = explode("/", $var);
	for($i=0; $i<count($na)-1;$i+=4) {
		$nvar["$na[$i]"] = $na[$i+1];
	}
	return $nvar;
}
$args = (!empty($_GET['args'])) ? getArrUrl($_GET['args']) : '';

function cutString($str,$len, $moreStr = "...") {		
	$mystr = "";
	$str = strip_tags($str);
	$str = preg_replace('/\r\n|\n|\r|[[\/\!]*?[^\[\]]*?]|si/','',$str);
	if(mb_strlen($str) > $len) {
		$newstr = mb_substr($str,0,$len);			
		$mystr = $newstr.$moreStr;
	} else $mystr = $str;
	return $mystr;			
}

//get image from content
function get_first_image($cnt, $noimg = true){
	$first_img = '';
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $cnt, $matches);
	if(!empty($matches) && !empty($matches[1])) {
		for($i=0;$i<=10;$i++){
			$first_img = $matches[1][$i];
			$ext = substr($first_img, strrpos($first_img, '.') + 1);
			if(($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'bmp' || $ext == 'webb' || $ext == 'gif' || $ext == 'svg') && strpos($first_img,'file://') === false) return $first_img;
		}
	}
	if((empty($first_img) || $first_img == "") && $noimg) $first_img = APP_URL . "assets/img/common/other/img_nophoto.jpg";
	elseif(empty($noimg)) return false;
	return $first_img;
}

function curPageURL() {
	$pageURL = 'http';
	if (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") $pageURL .= "s";
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	else $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	return $pageURL;
}
$current_url = curPageURL();

function get_curl($url){
	if(function_exists('curl_init')){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
		$output = curl_exec($ch);
		echo curl_error($ch);
		curl_close($ch);
		return $output;
	} else return file_get_contents($url);
}