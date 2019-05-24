<?php
include $_SERVER['DOCUMENT_ROOT']."/JK1/lib/session_call.php";
include $_SERVER['DOCUMENT_ROOT']."/JK1/lib/db_connector.php";
?>
<meta charset="utf-8">
<?php
$content= $q_content = $sql= $result = $userid="";
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$usernick = $_SESSION['usernick'];

if(isset($_GET["mode"])&&$_GET["mode"]=="insert"){
    $content = trim($_POST["content"]);
    $subject = trim($_POST["subject"]);
    if(empty($content)||empty($subject)){
      alert_back('1.내용이나제목입력요망!');
    }
    $subject = test_input($_POST["subject"]);
    $content = test_input($_POST["content"]);
    $userid = test_input($userid);
    $hit = 0;
    $is_html=(isset($_POST["is_html"]))?('y'):('n');
    $q_subject = mysqli_real_escape_string($conn, $subject);
    $q_content = mysqli_real_escape_string($conn, $content);
    $q_userid = mysqli_real_escape_string($conn, $userid);
    $regist_day=date("Y-m-d (H:i)");

    //include 파일업로드기능
    include "./lib/file_upload.php";

    //8. 파일의 실제명과 저장된 파일명을 삽입한다.
    $sql="INSERT INTO `free` VALUES (null,'$q_userid','$username','$usernick','$q_subject','$q_content','$regist_day',0,'$is_html','$upfile_name','$copied_file_name','$type[0]');";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('5.Error: ' . mysqli_error($conn));
      //die('Error: ' . mysqli_error($conn));
    }

    //등록된 사용자가 최근 입력한 이미지게시판을 보여주기 위하여 num을 찾아서 전달하기 위함이다.
    $sql="SELECT num from `free` where id ='$userid' order by num desc limit 1;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('6.Error: ' . mysqli_error($conn));
      //die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $num=$row['num'];
    mysqli_close($conn);

    echo "<script>location.href='./view.php?num=$num&hit=$hit';</script>";

}else if(isset($_GET["mode"])&&$_GET["mode"]=="delete"){
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    //삭제할 게시물의 이미지파일명을 가져와서 삭제한다.
    $sql="SELECT `file_copied_0` from `free` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('6.Error: ' . mysqli_error($conn));
      //die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $file_copied_0=$row['file_copied_0'];

    if(!empty($file_copied_0)){
      unlink("./data/".$file_copied_0);
    }

    $sql ="DELETE FROM `free` WHERE num=$q_num";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    $sql ="DELETE FROM `free_ripple` WHERE parent=$q_num";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    mysqli_close($conn);
    echo "<script>location.href='./list.php';</script>";

}else if(isset($_GET["mode"]) && $_GET["mode"] == "update"){
  $content = trim($_POST["content"]);
  $subject = trim($_POST["subject"]);
  if(empty($content)||empty($subject)){
    echo "<script>alert('내용이나제목입력요망!');history.go(-1);</script>";
    exit;
  }
  $subject = test_input($_POST["subject"]);
  $content = test_input($_POST["content"]);
  $num = test_input($_POST["num"]);
  $hit = test_input($_POST["hit"]);
  $userid = test_input($userid);
  $is_html=(isset($_POST["is_html"]))?('y'):('n');
  $q_subject = mysqli_real_escape_string($conn, $subject);
  $q_content = mysqli_real_escape_string($conn, $content);
  $q_userid = mysqli_real_escape_string($conn, $userid);
  $q_num = mysqli_real_escape_string($conn, $num);
  $regist_day=date("Y-m-d (H:i)");

  //1번과 2번이 해당된다. 파일삭제만 체크한다.
  if(isset($_POST['del_file']) && $_POST['del_file'] =='1'){
    //삭제할 게시물의 이미지파일명을 가져와서 삭제한다.
    $sql="SELECT `file_copied_0` from `free` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('6.Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $file_copied_0=$row['file_copied_0'];
    if(!empty($file_copied_0)){
      unlink("./data/".$file_copied_0);
    }

    $sql="UPDATE `free` SET `file_name_0` = '', `file_copied_0` = '', `file_type_0` = '' WHERE `num` = $q_num;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
  }

  //1번과 2번 파일삭제 신경쓰지않고 업로드가 됐느냐? 안됐느냐?
  if(!empty($_FILES['upfile']['name'])){
    //include 파일업로드기능
    include "./lib/file_upload.php";

    $sql= "UPDATE `free` SET `file_name_0` = '$upfile_name', `file_copied_0` = '$copied_file_name', `file_type_0` = '$type[0]' WHERE num = $q_num; ";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
  }

  //3번 파일과 상관없이 무조건 내용중심으로 업데이트한다.
    $sql= "UPDATE `free` SET `subject` = '$q_subject', `content` = '$q_content', `regist_day` = '$regist_day', `is_html` = '$is_html' WHERE num = $q_num; ";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    echo "<script>location.href='./view.php?num=$num&page=1&hit=$hit';</script>";
}else if(isset($_GET["mode"]) && $_GET["mode"] == "insert_ripple"){
  if(empty($_POST["ripple_content"])){
    echo "<script>alert('내용입력요망!');history.go(-1);</script>";
    exit;
  }
  //덧글을 다는 사람은 로그인을 해야된다는 것을 말한 것이다.
  $userid = $_SESSION['userid'];
  $q_userid = mysqli_real_escape_string($conn, $userid);
  $sql="select * from member where id='$q_userid'";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
    $rowcount = mysqli_num_rows($result);

    if(!$rowcount){
      echo "<script>alert('없는 아이디!!');history.go(-1);</script>";
      exit;
    }else{
  $content = test_input($_POST["ripple_content"]);
  $page = test_input($_POST["page"]);
  $parent = test_input($_POST["parent"]);
  $hit = test_input($_POST["hit"]);
  $q_usernick = mysqli_real_escape_string($conn, $_SESSION['usernick']);
  $q_username = mysqli_real_escape_string($conn, $_SESSION['username']);
  $q_content = mysqli_real_escape_string($conn, $content);
  $q_parent = mysqli_real_escape_string($conn, $parent);
  $regist_day = date("Y-m-d (H:i)");

  $sql="INSERT INTO `free_ripple` VALUES (null,'$q_parent','$q_userid','$q_username','$q_usernick','$q_content','$regist_day')";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  mysqli_close($conn);
  echo "<script>location.href='./view.php?num=$parent&page=$page&hit=$hit';</script>";
  }//end of if rowcount
}else if(isset($_GET["mode"]) && $_GET["mode"] == "delete_ripple"){
  $page = test_input($_GET["page"]);
  $hit = test_input($_GET["hit"]);
  $num = test_input($_POST["num"]);
  $parent = test_input($_POST["parent"]);
  $q_num = mysqli_real_escape_string($conn, $num);

  $sql = "DELETE FROM `free_ripple` WHERE num=$q_num";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  mysqli_close($conn);
  echo "<script>location.href='./view.php?num=$parent&page=$page&hit=$hit';</script>";
}

//end of if insert

?>
