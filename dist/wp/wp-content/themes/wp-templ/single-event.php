<?php
$thisPageName = 'event';
$title_sg = get_the_title();
$desPage = mb_substr(preg_replace('/\r\n|\n|\r/','',strip_tags($post->post_content)),0,120);
if(!empty($_POST['actionFlag'])) {
	include_once('single-event-confirm.php');
	exit();
} elseif(!empty(get_query_var('actionFlag'))) {
	if(get_query_var('actionFlag') == 'complete') {
		include_once('single-event-complete.php');
		exit();
	} else header('location: '.get_the_permalink());
}

include(APP_PATH.'libs/head.php');
?>
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/page/contact.min.css">
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/page/event.min.css">
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/form/validationEngine.jquery.css">
</head>
<body id="event" class="single">
	<!-- HEADER -->
	<?php include(APP_PATH.'libs/header.php'); ?>
	<div id="container">
		<div class="clearfix">
			<div id="mainContent" class="container">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h1><?php the_title() ?></h1>
				<?php the_content();?>

				<div id="contact" style="margin-top: 40px;">
					<form method="post" class="form-1" id="form-1" action="confirm/?g=<?php echo time() ?>" name="form1" onSubmit="return check()">
						<div class="formBlock container">
							<div class="stepImg">
								<img src="<?php echo APP_ASSETS; ?>img/common/form/img_step01.svg" width="714" height="45" alt="フォームからのお問い合わせ　Step" class="pc" />
								<img src="<?php echo APP_ASSETS; ?>img/common/form/img_step01SP.svg" width="345" height="55" alt="フォームからのお問い合わせ　Step" class="sp" />
							</div>
						
							<p class="hid_url">Leave this empty: <input type="text" name="url"></p><!-- Anti spam part1: the contact form -->
							<table class="tableContact" cellspacing="0">
								<tr>
									<th><em>【必須】</em>お問い合わせの種類</th>
									<td>
										<select name="sl01" id="sl01" class="validate[required]">
											<option value=""></option>
											<option value="selectContent1">selectContent1</option>
											<option value="selectContent2">selectContent2</option>
										</select>
									</td>
								</tr>
								<tr>
									<th><em>【必須】</em>お名前</th>
									<td><input type="text" name="nameuser" id="nameuser" class="validate[required]"></td>
								</tr>
								<tr>
									<th><em>【必須】</em>性別</th>
									<td>
										<span class="chkradio" id="radioarray01">
										<input type="radio" id="male" name="gender" value="男性" class="mr10 validate[required]">
										<label for="male" class="mr50">男性</label>
										<input type="radio" id="female" name="gender" value="女性" class="mr10 validate[required]">
										<label for="female">女性</label>
										</span>
									</td>
								</tr>
								<tr>
									<th><em>【必須】</em>Checkbox1</th>
									<td>
										<span class="chkcheckbox" id="checkbox01">
										<input type="checkbox" name="check01[]" id="check01" value="01" class="validate[required]"><label for="check01" class="mr50">01</label>
										<input type="checkbox" name="check01[]" id="check02" value="02" class="validate[required]"><label for="check02" class="mr50">02</label>
										<input type="checkbox" name="check01[]" id="check03" value="03" class="validate[required]"><label for="check03" class="mr50">03</label>
										<input type="checkbox" name="check01[]" id="check04" value="04" class="validate[required]"><label for="check04" class="mr50">04</label>
										<input type="checkbox" name="check01[]" id="check05" value="05" class="validate[required]"><label for="check05" class="mr50">05</label>
										</span>
									</td>
								</tr>
								<tr>
								<th>【任意】会社名</th>
								<td><input type="text"  name="company" id="company"></td>
								</tr>
								<tr>
									<th>【任意】部署</th>
									<td><input type="text"  name="department" id="department"></td>
								</tr>
								<tr>
									<th><em>【必須】</em>お電話番号</th>
								<td>
									<p class="floatL">
										<input placeholder="例) 000-000-0000" type="tel"  name="tel" id="tel" class="validate[required,custom[phone]]">
									</p>
										<p class="floatL ml10">※半角数字でご記入ください。</p>
								</td>
								</tr>
								<tr>
									<th>【任意】おFAX番号</th>
									<td>
										<p class="floatL"><input placeholder="例) 000-000-0000" type="tel"  name="fax" id="fax" class="validate[custom[phone]]"></p>
										<p class="floatL ml10">※半角数字でご記入ください。</p>
									</td>
								</tr>
								<tr>
									<th><em>【必須】</em>郵便番号</th>
									<td>
										<div class="clearfix t0b10">
											<div class="dIB">〒</div>
											<div class="dIB size01">
												<input type="text" placeholder="例) 000-0000" name="zipcode" id="zipcode" onKeyUp="AjaxZip3.zip2addr(this,'address','address','address')" class="validate[required,custom[zipcode]]">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<th><em>【必須】</em>住所</th>
									<td class="clearfix">
										<div class="clearfix mt10">
											<p class="floatL"><input placeholder="例) ○○○○3F" type="text" name="address" id="address"></p>
											<p class="floatL ml10">建物名など</p>
										</div>
									</td>
								</tr>
								<tr>
									<th><em>【必須】</em>メールアドレス</th>
									<td>
										<p><input placeholder="例) xxxxx@sample.co.jp" type="email" name="email" id="email" class="validate[required,custom[email]]"></p>
										<p class="mt10"><input placeholder="例) xxxxx@sample.co.jp" type="email"  name="cemail" id="cemail" value="" class="validate[equals[email]]"></p>
									</td>
								</tr>
								<tr>
									<th><span>【任意】</span>連絡希望の時間帯</th>
									<td><input type="text"  name="time" id="time"></td>
								</tr>
								<tr>
									<th><em>【必須】</em>お問い合わせ内容</th>
									<td><textarea name="content" id="content" class="validate[required]"></textarea></td>
								</tr>
							</table>
							<div class="txtContact01">
								<p class="t0b10">【個人情報の取扱いについて】</p>
								<ul class="t0b20">
									<li>・本フォームからお客様が記入・登録された個人情報は、資料送付・電子メール送信・電話連絡などの目的で利用・保管し、第三者に開示・提供することはありません。</li>
								</ul>
							</div>
							<div class="taC">
								<p><label><input type="checkbox" name="check1" value="ok"><span class="fz14"> 個人情報の取扱いに同意する</span></label></p>
								<p class="t30b20">
									<button id="btnConfirm"><span>入力内容を確認する</span></button>
									<input type="hidden" name="actionFlag" value="confirm">
								</p>
							</div>
							<p class="taC t30b0 txtContact01">上記フォームで送信できない場合は、必要項目をご記入の上、<br class="hidden-xs " />
							<a id="mailContact" href="#"></a>までメールをお送りください。</p><!-- Anti spam part2: clickable email address -->
						</div>
					</form>
				</div>
			<?php endwhile; endif; ?>
			</div>
		</div>
	</div>
	<!-- HEADER -->
	<?php include(APP_PATH.'libs/footer.php'); ?>
<script src="<?php echo APP_ASSETS; ?>js/form/ajaxzip3.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/form/jquery.cookie.js"></script>
<!-- Document: https://github.com/posabsolute/jQuery-Validation-Engine -->
<script src="<?php echo APP_ASSETS; ?>js/form/jquery.validationEngine.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/form/languages/jquery.validationEngine-ja.js"></script>
<script>
	$(document).ready(function(){
		$("#form-1").validationEngine({
			promptPosition: "topLeft" ,
			scrollOffset: 100
		});
	})
	function check(){
		if(!document.form1.check1.checked){
			window.alert('「個人情報の取扱いに同意する」にチェックを入れて下さい');
			return false;
		}
	}
	$(document).ready(function() {
		var address = "xxx" + "@" + "xxxxxxx.com";
		$("#mailContact").attr("href", "mailto:" + address);
		$("#mailContact").text(address);

		$('#btnSend').click(function(){
			$(this).html('<span>送信中...</span>').attr('disabled', 'disabled').css('opacity', '0.7');
			$('.form-1').submit();
			consolo.log("send");
		});
	});
</script>
</body>
</html>