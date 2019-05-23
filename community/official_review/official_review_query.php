<?php
//*************************************************************************
$id=$name=$mode=$title=$content=$q_title=$q_content=$regist_day=$main_img="";
$files=$count=$upload_dir="";
for($i=0;$i<5;$i++){
  $upfile_name[$i]="";
  $upfile_tmp_name[$i]="";
  $upfile_type[$i]="";
  $upfile_size[$i]="";
  $upfile_error[$i]="";
  $copied_file_name[$i]="";
}
//*************************************************************************
  include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

// $id = $_SESSION['id'];
// $name = $_SESSION['name'];

if(isset($_GET["mode"])&&$_GET["mode"]=="insert"){
  $title = trim($_POST["title"]);
  $content = trim($_POST["content"]);
  if(empty($content)||empty($title)){
    alert_back('1.제목과 내용 입력요망!');
  }
  $title = test_input($_POST["title"]);
  $content = $_POST["content"];
  // $id = test_input($id);
  $q_title = mysqli_real_escape_string($conn, $title);
  $q_content = mysqli_real_escape_string($conn, $content);
  // $q_id = mysqli_real_escape_string($conn, $id);
  $regist_day=date("Y-m-d (H:i)");
  $main_img = explode('<img src=', $_POST["content"]);
  if(count($main_img)<2){
      alert_back('이미지를 하나 이상 넣어주시기 바랍니다.');
  }
  $main_img = explode('/img/',$main_img[1]);
  $main_img = explode('"', $main_img[1]);
  $main_img =  $main_img[0];

  //include 파일업로드기능
  include $_SERVER['DOCUMENT_ROOT']."/santteut/community/official_review/lib/file_upload.php";

  //파일의 실제명과 저장된 파일명을 삽입한다.
  $sql = "INSERT INTO `official_review` VALUES (null, '$q_title', '$q_content', '$regist_day', '$main_img',
    '$upfile_name[0]', '$copied_file_name[0]', '',
    '$upfile_name[1]', '$copied_file_name[1]', '',
    '$upfile_name[2]', '$copied_file_name[2]', '',
    '$upfile_name[3]', '$copied_file_name[3]', '',
    '$upfile_name[4]', '$copied_file_name[4]', '');";

  $result = mysqli_query($conn,$sql);
  if(!$result){
    alert_back('Error: '.mysqli_error($conn));
  }

  $sql = "SELECT num FROM `official_review` ORDER BY num desc limit 1;";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    alert_back('Error: ' .mysqli_error($conn));
  }
  $row = mysqli_fetch_array($result);
  $num = $row['num'];
  mysqli_close($conn);

  echo "<script>location.href='./official_review_view.php?num=$num';</script>";

}

?>
