<?php
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/session_call.php";
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/db_connector.php";

if(isset($_GET["mode"])&&$_GET["mode"]=="download"){
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    //등록된 사용자가 최근 입력한 다운로드게시판을 보여주기 위하여 num을 찾아서 전달하기 위함이다.
    $sql="SELECT * from `free` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('Error: 1' . mysqli_error($conn));
      //die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $file_name_0=$row['file_name_0'];
    $file_copied_0=$row['file_copied_0'];
    $file_type_0=$row['file_type_0'];
    mysqli_close($conn);
}
//1. 테이블에서 파일명이 있는지 점검
if(empty($file_copied_0)||$file_type_0=="image"){
  alert_back('테이블에 파일이 존재하지 않거나 이미지 파일입니다. ');
}
$file_path = "./data/$file_copied_0";

//2 서버의 Data영역에 실제 파일이 있는지 점검
if(file_exists($file_path)){
  $fp=fopen($file_path, "rb"); //$fp 파일 핸들값
  //지정된 파일타입일경우에는 모든 브라우저 프로토콜 규약이 되어있음.
  if($file_type_0){
    Header("Content-type: application/x-msdownload");
    Header("Content-Length: ".filesize($file_path));
    Header("Content-Disposition: attachment; filename=$file_name_0");
    Header("Content-Transfer-Encoding: binary");
    Header("Content-Description: File Transfer");
    Header("Expires: 0");
    //지정된 파일타입이 아닌경우
  }else{
    //타입이 알려지지 않았을때 익스플로어 프로토콜 통신방식
    if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)",$_SERVER['$HTTP_USER_AGENT'])){
      Header("Content-type: application/octet-stream");
      Header("Content-Length: ".filesize($file_path));
      Header("Content-Disposition: attachment; filename=$file_name_0");
      Header("Content-Transfer-Encoding: binary");
      Header("Expires: 0");
    }else{
      Header("Content-type: file/unknown");
      Header("Content-Length: ".filesize($file_path));
      Header("Content-Disposition: attachment; filename=$file_name_0");
      Header("Content-Description: PHP3 Generated Data");
      Header("Expires: 0");
    }
  }
  fpassthru($fp);
  fclose($fp);
}else{
  alert_back('서버에 실제 파일이 존재 하지 않습니다.');
}
?>
