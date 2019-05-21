
<?php

$mode = "send";

function SocketPost($posts) {
   $host = "jmunja.com";
   $target = "/sms/web/api.php";
   $port = 80;
   $socket  = fsockopen($host, $port);
   if( is_array($posts) ) {
      foreach( $posts AS $name => $value )
      $postValues .= urlencode($name)."=".urlencode( $value )."&";
      $postValues = substr($postValues, 0, -1);
   }

   $postLength = strlen($postValues);
   $request = "POST $target HTTP/1.0\r\n";
   $request .= "Host: $host\r\n";
   $request .= "Content-type: application/x-www-form-urlencoded\r\n";
   $request .= "Content-length: ".$postLength."\r\n\r\n";
   $request .= $postValues."\r\n";
   fputs($socket, $request);

   $ret = "";
   while( !feof($socket) ){
      $ret .= trim(fgets($socket,4096));
   }
   fclose( $socket );
   $std_bar = ":header_stop:";
   return substr($ret,(strpos($ret,$std_bar)+strLen($std_bar)));
}

if($mode == "send") {
   //UTF-8로 데이터를 전송해야 합니다.
   $hp = "01055949559";
   $name = "오성훈";
   $title = "잘됩니다";
   $message = "api로 보내는 문자입니다 감사합니다";
   $id = "tjdgns0523";
   $pw = "04e169271c5af54309c84650187d86" ;

   $array['mode']    = "send"; //'send' 고정
   $array['id']      = $id; //제이문자 아이디 입력
   $array['pw']      = $pw; //제이문자 API 인증키(로그인 비밀번호 아닙니다.!!!)
   $array['title']   = $title; //제목
   $array['message'] = $message; //내용
   $array['reqlist'] = $hp; //수신자: 휴대폰번호|휴대폰번호|휴대폰번호

   $ret = SocketPost($array);
   if($ret){
     echo "{$ret}건 발송 성공";
   } else echo "발송 실패";
   exit;
}


 ?>
