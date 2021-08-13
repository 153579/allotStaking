<?php
// 회원가입축하 메일 (회원님께 발송)
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>ALLOT 이메일 인증</title>
</head>

<body>

<div style="margin:30px auto;width:600px;border:10px solid #f7f7f7">
    <div style="border:1px solid #dedede">
		<p style="font-size:30px;">인증코드는 <?php echo $code; ?> 입니다.</p>
    </div>
</div>

</body>
</html>
