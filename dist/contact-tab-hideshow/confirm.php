<?php
session_start();
ob_start();
include_once(dirname(__DIR__) . '/app_config.php');
if(empty($_POST['actionFlag'])) header('location: '.APP_URL.'contact/');
$thisPageName = 'contact';
include(APP_PATH.'libs/head.php');
require(APP_PATH."libs/form/jphpmailer.php");

$gtime = time();

//always keep this
$actionFlag       = (!empty($_POST['actionFlag'])) ? htmlspecialchars($_POST['actionFlag']) : '';
$reg_url          = (!empty($_POST['url'])) ? htmlspecialchars($_POST['url']) : '';
//end always keep this


//お問い合わせフォーム内容
$reg_selectRadio   = (!empty($_POST['selectRadio'])) ? htmlspecialchars($_POST['selectRadio']) : '';
$reg_name          = (!empty($_POST['nameuser'])) ? htmlspecialchars($_POST['nameuser']) : '';
$reg_company       = (!empty($_POST['company'])) ? htmlspecialchars($_POST['company']) : '';
$reg_tel           = (!empty($_POST['tel'])) ? htmlspecialchars($_POST['tel']) : '';
$reg_email         = (!empty($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
$reg_content       = (!empty($_POST['content'])) ? htmlspecialchars($_POST['content']) : '';
$reg_radio         = (!empty($_POST['radio'])) ? htmlspecialchars($_POST['radio']) : '';
$reg_select        = (!empty($_POST['select'])) ? htmlspecialchars($_POST['select']) : '';
$reg_homepage      = (!empty($_POST['homepage'])) ? htmlspecialchars($_POST['homepage']) : '';
$br_reg_content    = nl2br($reg_content);

$_SESSION['statusFlag'] = 1;

if($actionFlag == "send") {
	$aMailto = array('t.t.anh@alive-web.co.jp');
	if(count($aBccToContact)) $aBccTo = $aBccToContact;
	$from = $fromContact;
	$fromname = "";
	$subject_admin = "ホームページからお問い合わせがありました";
	$subject_user = "お問い合わせありがとうございました";
	$email_head_ctm_admin = "ホームページからお問い合わせがありました。";
	$email_head_ctm_user = "この度はお問い合わせいただきまして誠にありがとうございます。
こちらは自動返信メールとなっております。
弊社にて確認した後、改めてご連絡させていただきます。

以下、お問い合わせ内容となっております。
ご確認くださいませ。";
	$email_body_footer = "
		About company
	";

	$entry_time = gmdate("Y/m/d H:i:s",time()+9*3600);
	$entry_host = gethostbyaddr(getenv("REMOTE_ADDR"));
	$entry_ua = getenv("HTTP_USER_AGENT");

$msgBody  = "■Select: {$reg_selectRadio}\n\n";
$msgBody .= "■会社名: {$reg_company}\n\n";
$msgBody .= "■担当者名: {$reg_name}\n\n";
$msgBody .= "■電話番号: {$reg_tel}\n\n";

if(!empty($reg_email)) $msgBody .= "■メールアドレス: {$reg_email}\n\n";
if(!empty($reg_radio)) $msgBody .= "■配布予定部数: {$reg_radio}\n\n";
if(!empty($reg_select)) $msgBody .= "■配布物のサイズ: {$reg_select}\n\n";
if(!empty($reg_homepage)) $msgBody .= "■ホームページのURL: {$reg_homepage}\n\n";
if(!empty($reg_content)) $msgBody .= "■お問い合わせ内容: {$reg_content}\n\n";



//お問い合わせメッセージ送信
	$body_admin = "
登録日時：$entry_time
ホスト名：$entry_host
ブラウザ：$entry_ua


$email_head_ctm_admin


$msgBody


";

//お客様用メッセージ
	$body_user = "
$reg_name 様

$email_head_ctm_user

---------------------------------------------------------------

$msgBody

---------------------------------------------------------------
".$email_body_footer."
---------------------------------------------------------------";

	// ▼ ▼ ▼ START Detect SPAMMER ▼ ▼ ▼ //
	try {
		$allow_send_email = 1;
		// Anti spam advanced version 3 start: Verify by google invisible reCaptcha
		if(GOOGLE_RECAPTCHA_KEY_SECRET != '') {
			$response = $_POST['g-recaptcha-response'];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "secret=".GOOGLE_RECAPTCHA_KEY_SECRET."&response={$response}");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$returnJson = json_decode(curl_exec ($ch));
			curl_close ($ch);
			if( !empty($returnJson->success) ) {} else throw new Exception('Protect by Google Invisible Recaptcha');
		}

		// Anti spam advanced version 3 start: Verify by google invisible reCaptcha
		if(empty($_SESSION['ses_from_step2'])) throw new Exception('Step confirm must be display');

		// check spam mail by gtime
		$gtime_step2 = $_GET['g'];
		// submit form dosen't have g
		if(!$gtime_step2) {
			throw new Exception('Miss g request');
		} else {
			$cur_time = time();
			if(strlen($cur_time)!=strlen($gtime_step2)) {
				throw new Exception('G request\'s not a time');
			} elseif( $_SESSION['ses_gtime_step2'] == $gtime_step2 && ($cur_time-$gtime_step2 < 1) ) {
				throw new Exception('Checking confirm too fast');
			}
		}

		// Anti spam advanced version 2 start: Don't send blank emails
		if(empty($reg_name) || empty($reg_email)) {
			throw new Exception('Miss reg_name or reg_email');
		}

		// Anti spam advanced version 1 start: The preg_match() is there to make sure spammers can’t abuse your server by injecting extra fields (such as CC and BCC) into the header.
		if(preg_match( "/[\r\n]/", $reg_email)) {
			throw new Exception('Email\'s not correct');
		}

		// Anti spam: the contact form start
		if($reg_url != "") {
			throw new Exception('Url request must be empty');
		}

		// Anti spam: check session complete contact
		if(!isset($_SESSION['ses_step3'])) $_SESSION['ses_step3'] = false;
		if($_SESSION['ses_step3']) {
			throw new Exception('Session step 3 must be destroy');
		}
	} catch (Exception $e) {
		$returnE = '<pre class="preanhtn">';
		$returnE .= $e->getMessage().'<br>';
		$returnE .= 'File: '.$e->getFile().' at line '.$e->getLine();
		$returnE .= '</pre>';
		$allow_send_email = 0;
		// die($returnE);
	}
	// ▲ ▲ ▲ END Detect SPAMMER ▼ ▼ ▼ //


	if($allow_send_email) {
		//////// メール送信
		mb_language("ja");
		mb_internal_encoding("UTF-8");

		//////// お客様受け取りメール送信
		$email = new JPHPmailer();
		$email->addTo($reg_email);
		$email->setFrom($from,$fromname);
		$email->setSubject($subject_user);
		$email->setBody($body_user);
		
		if($email->send()) { /*Do you want to debug somthing?*/ }

		//////// メール送信
		$email->clearAddresses();
		for($i = 0; $i < count($aMailto); $i++) $email->addTo($aMailto[$i]);
		for($i = 0; $i < count($aBccTo); $i++) $email->addBcc($aBccTo[$i]);
		$email->setSubject($subject_admin);
		$email->setBody($body_admin);
		
		if($email->Send()) { /*Do you want to debug somthing?*/ }

		$_SESSION['ses_step3'] = true;
	} else die('Spam detected!');

	$_SESSION['statusFlag'] = 1;
	header("Location: ".APP_URL."contact-tab-02/complete/");
	exit;
} elseif($actionFlag == "confirm") {
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
		<form method="post" class="form-1" action="?g=<?php echo $gtime ?>" name="form1" id="formSend">
			<div class="formBlock container">
				
				<div class="stepImg">
					<img src="<?php echo APP_ASSETS; ?>img/common/form/img_step02.svg" width="714" height="45" alt="フォームからのお問い合わせ　Step" class="pc" />
					<img src="<?php echo APP_ASSETS; ?>img/common/form/img_step02SP.svg" width="345" height="55" alt="フォームからのお問い合わせ　Step" class="sp" />
				</div>

				<div>
					<p class="hid_url">Leave this empty: <input type="text" name="url" value="<?php echo $reg_url ?>"></p><!-- Anti spam part1: the contact form -->
					<table class="tableContact" cellspacing="0">
						<tr>
							<th>会社名</th>
							<td><?php echo $reg_company ?></td>
						</tr>
						<tr>
							<th>担当者名</th>
							<td><?php echo $reg_name ?></td>
						</tr>
						<tr>
							<th>電話番号</th>
							<td><?php echo $reg_tel ?></td>
						</tr>
						<?php if(!empty($reg_email)) { ?>
							<tr>
								<th>メールアドレス</th>
								<td><?php echo $reg_email ?></td>
							</tr>
						<?php } ?>
						<?php if(!empty($reg_radio)) { ?>
							<tr>
								<th>配布予定部数</th>
								<td><?php echo $reg_radio ?></td>
							</tr>
						<?php } ?>
						<?php if(!empty($reg_select)) { ?>
							<tr>
								<th>配布物のサイズ</th>
								<td><?php echo $reg_select ?></td>
							</tr>
						<?php } ?>
						<?php if(!empty($reg_homepage)) { ?>
							<tr>
								<th>ホームページのURL</th>
								<td><?php echo $reg_homepage ?></td>
							</tr>
						<?php } ?>
						<?php if(!empty($br_reg_content)) { ?>
							<tr>
								<th>お問い合わせ内容</th>
								<td><?php echo $br_reg_content ?></td>
							</tr>
						<?php } ?>
					</table>
				</div>
				<input type="hidden" name="selectRadio" value="<?php echo $reg_selectRadio ?>">
				<input type="hidden" name="company" value="<?php echo $reg_company ?>">
				<input type="hidden" name="nameuser" value="<?php echo $reg_name ?>">
				<input type="hidden" name="tel" value="<?php echo $reg_tel ?>">
				<input type="hidden" name="email" value="<?php echo $reg_email ?>">
				<input type="hidden" name="radio" value="<?php echo $reg_radio ?>">
				<input type="hidden" name="select" value="<?php echo $reg_select ?>">
				<input type="hidden" name="homepage" value="<?php echo $reg_homepage ?>">
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
	</body>
	</html>
<?php } ?>