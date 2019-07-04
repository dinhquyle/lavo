<?php
$thisPageName = 'blog';
$title_sg = get_the_title();
$desPage = mb_substr(preg_replace('/\r\n|\n|\r/','',strip_tags($post->post_content)),0,120);
include(APP_PATH.'libs/head.php');
?>
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/page/blog.min.css">
</head>
<body id="blog" class="single">
	<!-- HEADER -->
	<?php include(APP_PATH.'libs/header.php'); ?>
	<div id="container">
		<div class="clearfix">
			<div id="mainContent">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php the_content();?>
			<?php endwhile; endif; ?>
			</div>
		</div>
	</div>
	<!-- HEADER -->
	<?php include(APP_PATH.'libs/footer.php'); ?>
</body>
</html>