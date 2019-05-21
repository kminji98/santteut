<?php
include './Sendmail.php';
srand((double)microtime()*1000000); //난수값 초기화
$email =$_POST["email"];
$code=rand(100000,999999);
echo $code;
$count=1;
$to=$email;
$from="관리자";
$subject="산뜻 회원 가입 인증번호입니다.";
$body="산뜻 회원가입 인증번호 입니다.\n인증번호 : ".$code."\n정확히 입력해주세요.";
$cc_mail="";
$bcc_mail=""; /* 메일 보내기*/

$sendmail->send_mail($to, $from, $subject, $body,$cc_mail,$bcc_mail);
?>
