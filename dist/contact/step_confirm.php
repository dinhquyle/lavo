<?php
session_start();
ob_start();
include_once(dirname(__DIR__) . '/app_config.php');
if(empty($_POST['actionFlag']) && empty($_SESSION['statusFlag'])) header('location: '.APP_URL);

$gtime = time();

//always keep this
$actionFlag       = (!empty($_POST['actionFlag'])) ? htmlspecialchars($_POST['actionFlag']) : '';
$reg_url          = (!empty($_POST['url'])) ? htmlspecialchars($_POST['url']) : '';
//end always keep this

//お問い合わせフォーム内容
$reg_sl01         = (!empty($_POST['sl01'])) ? $_POST['sl01'] : '';
$reg_name         = (!empty($_POST['nameuser'])) ? htmlspecialchars($_POST['nameuser']) : '';
$reg_company      = (!empty($_POST['company'])) ? htmlspecialchars($_POST['company']) : '';
$reg_gender       = (!empty($_POST['gender'])) ? htmlspecialchars($_POST['gender']) : '';
$reg_check01      = (!empty($_POST['check01'])) ? $_POST['check01'] : array();
$reg_checkAll01   = (!empty($_POST['checkAll01'])) ? htmlspecialchars($_POST['checkAll01']) : '';
$reg_department   = (!empty($_POST['department'])) ? htmlspecialchars($_POST['department']) : '';
$reg_tel          = (!empty($_POST['tel'])) ? htmlspecialchars($_POST['tel']) : '';
$reg_fax          = (!empty($_POST['fax'])) ? htmlspecialchars($_POST['fax']) : '';
$reg_zipcode      = (!empty($_POST['zipcode'])) ? htmlspecialchars($_POST['zipcode']) : '';
$reg_address01    = (!empty($_POST['address01'])) ? htmlspecialchars($_POST['address01']) : '';
$reg_address02    = (!empty($_POST['address02'])) ? htmlspecialchars($_POST['address02']) : '';
$reg_pref_name    = (!empty($_POST['pref_name'])) ? htmlspecialchars($_POST['pref_name']) : '';
$reg_email        = (!empty($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
$reg_time         = (!empty($_POST['time'])) ? htmlspecialchars($_POST['time']) : '';
$reg_content      = (!empty($_POST['content'])) ? htmlspecialchars($_POST['content']) : '';
$br_reg_content   = nl2br($reg_content);

if($actionFlag == "confirm") {
	$thisPageName = 'contact';
	include(APP_PATH.'libs/head.php');
	$_SESSION['ses_from_step2'] = true;
	if(!isset($_SESSION['ses_gtime_step2'])) $_SESSION['ses_gtime_step2'] = $gtime;
?>
	<meta http-equiv="Expires" content="86400">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/page/contact.min.css">
	<!-- Anti spam part1: the contact form start -->

	<?php if(GOOGLE_RECAPTCHA_KEY_API != '' && GOOGLE_RECAPTCHA_KEY_SECRET != '') { ?>
		<script src="https://www.google.com/recaptcha/api.js?hl=ja" async defer></script>
		<script>function onSubmit(token) { document.getElementById("formSend").submit(); }</script>
		<style>.grecaptcha-badge {display: none}</style>
	<?php } ?>

	</head>
	<body id="contact">
		<!-- HEADER -->
		<?php include(APP_PATH.'libs/header.php'); ?>
		<div class="mainImg"><h2>CONTACT<span>お問い合わせ</span></h2></div>
		<form method="post" class="form-1" action="../complete/?g=<?php echo $gtime ?>" name="form1" id="formSend">
			<div class="formBlock container">
				
				<div class="stepImg">
					<img src="<?php echo APP_ASSETS; ?>img/common/form/img_step02.svg" width="714" height="45" alt="フォームからのお問い合わせ　Step" class="pc" />
					<img src="<?php echo APP_ASSETS; ?>img/common/form/img_step02SP.svg" width="345" height="55" alt="フォームからのお問い合わせ　Step" class="sp" />
				</div>

				<div>
					<p class="hid_url">Leave this empty: <input type="text" name="url" value="<?php echo $reg_url ?>"></p><!-- Anti spam part1: the contact form -->
					<table class="tableContact" cellspacing="0">
						<tr>
							<th>お問い合わせの種類</th>
							<td><?php echo $reg_sl01 ?></td>
						</tr>
						<tr>
							<th>お名前</th>
							<td><?php echo $reg_name; ?></td>
						</tr>
						<tr>
							<th>性別</th>
							<td><?php echo $reg_gender ?></td>
						</tr>
						<tr>
							<th>Checkbox1</th>
							<td>
								<?php
								$strCheckbox = implode(',', $reg_check01);
								echo $strCheckbox;
								?>
							</td>
						</tr>
						<?php if(!empty($reg_company)) { ?>
							<tr>
								<th>会社名</th>
								<td><?php echo $reg_company ?></td>
							</tr>
						<?php } ?>
						<?php if(!empty($reg_department)) { ?>
							<tr>
								<th>部署</th>
								<td><?php echo $reg_department ?></td>
							</tr>
						<?php } ?>
						<tr>
							<th>お電話番号</th>
							<td><?php echo $reg_tel ?></td>
						</tr>
						<tr>
							<th>FAX番号</th>
							<td><?php echo $reg_fax ?></td>
						</tr>
						<tr>
							<th>郵便番号</th>
							<td><?php echo $reg_zipcode ?></td>
						</tr>
						<tr>
							<th>住所</th>
							<td><p><?php echo $reg_pref_name.$reg_address01.$reg_address02 ?></p></td>
						</tr>
						<tr>
							<th>メールアドレス</th>
							<td><?php echo $reg_email ?></td>
						</tr>
						<?php if(!empty($reg_time)) { ?>
							<tr>
								<th>連絡希望の時間帯</th>
								<td><?php echo $reg_time ?></td>
							</tr>
						<?php } ?>
						<tr>
							<th>お問い合わせ内容</th>
							<td><?php echo $br_reg_content ?></td>
						</tr>
					</table>
				</div>
				<input type="hidden" name="sl01" value="<?php echo $reg_sl01 ?>">
				<input type="hidden" name="nameuser" value="<?php echo $reg_name ?>">
				<input type="hidden" name="gender" value="<?php echo $reg_gender ?>">
				<input type="hidden" name="checkAll01" value="<?php echo $strCheckbox ?>">
				<input type="hidden" name="company" value="<?php echo $reg_company ?>">
				<input type="hidden" name="department" value="<?php echo $reg_department ?>">
				<input type="hidden" name="tel" value="<?php echo $reg_tel ?>">
				<input type="hidden" name="fax" value="<?php echo $reg_fax ?>">
				<input type="hidden" name="email" value="<?php echo $reg_email ?>">
				<input type="hidden" name="zipcode" value="<?php echo $reg_zipcode ?>">
				<input type="hidden" name="pref_name" value="<?php echo $reg_pref_name ?>">
				<input type="hidden" name="address01" value="<?php echo $reg_address01 ?>">
				<input type="hidden" name="address02" value="<?php echo $reg_address02 ?>">
				<input type="hidden" name="time" value="<?php echo $reg_time ?>">
				<input type="hidden" name="content" value="<?php echo $reg_content ?>">
				<!-- always keep this -->
				<input type="hidden" name="url" value="<?php echo $reg_url ?>">
				<!-- end always keep this -->

				<p class="taR">
				<a href="javascript:history.back()">
				入力内容を修正する
				</a>
				</p>
				<p class="taC t20b20">
					<?php if(GOOGLE_RECAPTCHA_KEY_API != '') { ?>
						<button name="actionFlag" value="send" class="g-recaptcha" data-size="invisible" data-sitekey="<?php echo GOOGLE_RECAPTCHA_KEY_API ?>" data-callback="onSubmit"><span>この内容で送信する</span></button>
					<?php } else { ?>
						<button id="btnSend"><span>この内容で送信する</span></button>
					<?php } ?>
					<input type="hidden" name="actionFlag" value="send">
				</p>
				<p class="taC t30b0">上記フォームで送信できない場合は、必要項目をご記入の上、<br>
				<a id="mailContact" href="#"></a>までメールをお送りください。</p><!-- Anti spam part2: clickable email address -->
			</div>
		</form> 

		<!-- FOOTER -->
		<?php include(APP_PATH.'libs/footer.php'); ?>
		<script>
			$(document).ready(function() {
				var address = "xxx" + "@" + "xxxxxxx.com";
				$("#mailContact").attr("href", "mailto:" + address).text(address);
			})
		</script>
	</body>
	</html>
<?php } ?>