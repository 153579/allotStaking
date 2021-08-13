<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

$type = $_REQUEST['type'];
$email = $_REQUEST['email'];
$code = $_REQUEST['code'];

if($type == "send_code"){

	$sql = "select * from g5_member where mb_email = '{$email}'";
	$result = sql_query($sql);

	if($result->num_rows > 0){
		echo json_encode(
				array("result" => "405",
						"code" =>$code , "email" => $email));
		exit();
	}

	$sql = "delete from g5_email_code where email = '{$email}'";
	$result = sql_query($sql);
	if(isset($email)){
		$code = GenerateString(5);
		$sql = "insert into g5_email_code set email = '{$email}' , code = '{$code}'";
		$result = sql_query($sql);
		
		
		$subject = "ALLOT [이메일 인증코드 발송]";
		ob_start();
        include_once ('./code_mail.php');
        $content = ob_get_contents();
        ob_end_clean();
        
        mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $email, $subject, $content, 1);
		//Gmailer($email, $subject, $content, 1);
		echo json_encode(
				array("result" => "00",
						"code" =>$code , "email" => $email));
		exit();
	}
}

if($type == "code_confirm") {

	$sql = "select * from g5_email_code where email = '{$email}' and code = '{$code}'";
	$result = sql_query($sql);
	
	if($result->num_rows > 0){
		echo json_encode(
				array("result" => "00",
						"code" =>$code , "email" => $email));
		exit();
	}else {
		echo json_encode(
				array("result" => "404",
						"code" =>$code , "email" => $email));
		exit();
	}

}




?>