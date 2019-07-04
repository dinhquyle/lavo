<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php
// set viewport by user agent.
require_once 'ua.class.php';
$ua = new UserAgent();
if($ua->set() === 'tablet') echo '<meta content="width=1024" name="viewport">';
else echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">';

include(APP_PATH.'libs/argument.php');  
?>
<title><?php echo $titlepage?></title>
<meta name="description" content="<?php echo $desPage; ?>">
<meta name="keywords" content="<?php echo $keyPage; ?>">

<!--facebook-->
<meta property="og:title" content="<?php echo $titlepage?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo htmlspecialchars($current_url);?>">
<meta property="og:image" content="<?php echo (!empty($ogimg)) ? $ogimg : APP_ASSETS.'img/common/other/fb_image.png'; ?>">
<meta property="og:site_name" content="<?php echo (function_exists('get_bloginfo') && get_bloginfo('name')) ? get_bloginfo('name') : '' ?>">
<meta property="og:description" content="<?php echo $desPage; ?>">
<meta property="fb:app_id" content="">
<!--/facebook-->

<!-- Twitter -->
<meta name="twitter:card" value="summary">
<meta name="twitter:url" content="<?php echo htmlspecialchars($current_url);?>">
<meta name="twitter:title" content="">
<meta name="twitter:description" content="<?php echo $desPage; ?>">
<meta name="twitter:image" content="<?php echo (!empty($ogimg)) ? $ogimg : APP_ASSETS.'img/common/other/fb_image.png'; ?>">
<meta name="twitter:site" content="<?php echo (function_exists('get_bloginfo') && get_bloginfo('name')) ? get_bloginfo('name') : '' ?>">
<meta name="twitter:creator" content="<?php echo (function_exists('get_bloginfo') && get_bloginfo('name')) ? get_bloginfo('name') : '' ?>">
<!-- /Twitter -->

<!--css-->
<link href="<?php echo APP_ASSETS; ?>css/style.min.css" rel="stylesheet" media="all">
<link href="<?php echo APP_ASSETS; ?>css/custom.css" rel="stylesheet" media="all">
<!--/css-->

<!-- Favicons -->
<link rel="icon" href="<?php echo APP_ASSETS; ?>img/common/icon/favicon.ico" type="image/vnd.microsoft.icon">