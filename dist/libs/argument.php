<?php
$pagename = str_replace(array('/', '.php'), '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$pagename = $pagename ? $pagename : 'default';
$pagename = (isset($thisPageName)) ? $thisPageName : $pagename;
switch ($pagename) {
	case '':
		if(empty($titlepage)) $titlepage = 'About us title';
		if(empty($desPage)) $desPage = '';
		if(empty($keyPage)) $keyPage = '';
		if(empty($txtH1)) $txtH1 = 'H1 content for about us';
	break;
	default:
		if(empty($titlepage)) $titlepage = 'Default';
		if(empty($desPage)) $desPage = '';
		if(empty($keyPage)) $keyPage = '';
		if(empty($txtH1)) $txtH1 = 'H1 Default';
}