<?php
include(APP_PATH.'libs/head.php');
?>
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/page/404.min.css">
</head>
<body id="page404" class="page404">
	<!-- Header -->
	<?php include(APP_PATH.'/libs/header.php'); ?>
	<main>
		<section class="page_404 ">
			<h2 class="page-title text-center"><span>4</span>04</h2>
			<div class='text-center'>
				<p class="taC ">
					アクセスしようとしたページは、移動したか削除されました。<br />下記リンクに移動して下さい。
					<br><br>
					<a href="<?php echo esc_url( home_url( '/' ) )?>"><?php echo esc_url( home_url( '/' ) )?></a>
				</p>
			</div>
		</section>
	</main>
	<!-- Footer -->
	<?php include(APP_PATH.'/libs/footer.php'); ?>
<!-- End Document
================================================== -->
</body>
</html>