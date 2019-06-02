
<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

session_start();

// isset함수는 불리언값을 리턴 true or false
// 회원 or 비회원이면 권한없음, 관리자일때만 입장
if(!isset($_SESSION['id'])){
  echo "<script>history.go(-1);</script>";
  exit;
}
?>

<?php
// 변수선언
$content = $sql= $result = $name="";
$q_title=$q_content=$regist_day=$hit=$file_name=$file_copied=$file_extension="";
$name = $_SESSION['name'];

//mode가 insert일때
if(isset($_GET["mode"])&&$_GET["mode"]=="insert"){
    $content = trim($_POST["content"]);
    $title = trim($_POST["title"]);

    if(empty($content)||empty($title)){
      alert_back('1. 내용이나제목입력요망!');
    }
    $title = test_input($_POST["title"]);
    $q_content = $_POST["content"];
    $name = test_input($name);
    $hit = 0;
    $q_title = mysqli_real_escape_string($conn, $title);
    $q_name = mysqli_real_escape_string($conn, $name);
    $regist_day=date("Y-m-d (H:i)");

    //include 파일업로드기능
    include $_SERVER['DOCUMENT_ROOT']."/santteut/community/free/free_file_upload.php";

    // 파일의 실제명과 저장되는 명을 삽입한다. 디비변수명 적지x
    $sql="INSERT INTO `free` VALUES (null,'$q_title','$q_content','$file_name','$file_extension','$file_copied','$regist_day','$hit');";

    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('Error:5 ' . mysqli_error($conn));
    }

    //등록된사용자가 최근 입력한 free_list를 보여주기 위하여 num 찾아서 전달하기 위함이다.
    $sql="SELECT num from `free` order by num desc limit 1;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('Error: 6' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $num=$row['num'];
    mysqli_close($conn);
    echo "<script>location.href='./free_view.php?num=$num&hit=$hit';</script>";

// 댓글입력
  }else if(isset($_GET["mode"]) && $_GET["mode"] == "insert_ripple"){
    if(empty($_POST["ripple_content"])){
      echo "<script>alert('댓글 내용을 입력하세요.');history.go(-1);</script>";
      exit;
    }
    if(empty($_SESSION['id']) || empty($_SESSION['name'])){
      echo "<script>alert('로그인 후 이용해주세요.');history.go(-1);</script>";
      exit;
    }else{
    $content = test_input($_POST["ripple_content"]);
    $parent = test_input($_POST["parent"]);
    $q_id = mysqli_real_escape_string($conn, $_SESSION['id']);
    $q_name = mysqli_real_escape_string($conn, $_SESSION['name']);
    $q_content = mysqli_real_escape_string($conn, $content);
    $q_parent = mysqli_real_escape_string($conn, $parent);
    $regist_day = date("Y-m-d (H:i)");

    $sql = "INSERT INTO `free_ripple` VALUES (null, '$q_parent', '$q_id', '$q_name', '$q_content', '$regist_day')";
    $result = mysqli_query($conn, $sql);
    if(!$result){
      die('Error: ' . mysqli_error($conn));
    }
    $sql="SELECT hit from `free` where num = $parent;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('Error: 6' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $hit=$row['hit'];
    mysqli_close($conn);
    echo "<script>location.href='./free_view.php?num=$parent&hit=$hit';</script>";
}
// 댓글삭제
  }else if(isset($_GET["mode"]) && $_GET["mode"] == "delete_ripple"){
    $ripple_num = $_POST['num'];
    $sql = "SELECT * FROM `free_ripple` WHERE num='$ripple_num';";
    $result = mysqli_query($conn, $sql);
    if(!$result){
      alert_back('Error: ' .mysqli_error($conn));
    }
    $row = mysqli_fetch_array($result);
    $id = $row['id'];

    if(!($_SESSION["id"]=="admin" || $id==$_SESSION["id"])){
      alert_back('삭제 권한이 없습니다.');
    }
    $num = test_input($_POST["num"]);
    $parent = test_input($_POST["parent"]);
    $q_num = mysqli_real_escape_string($conn, $num);
    $sql = "DELETE FROM `free_ripple` WHERE num=$q_num";
    $result = mysqli_query($conn, $sql);
    if(!$result){
      die('Error: '.mysqli_error($conn));
    }
    mysqli_close($conn);
    echo "<script>location.href='free_view.php?num=$parent';</script>";


}else if(isset($_GET["mode"]) && $_GET["mode"]=="delete"){
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    //삭제할 게시물의 파일명을 가져와서 삭제한다.
    $sql="SELECT `file_copied` from `free` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('Error: 6' . mysqli_error($conn));
      // die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $file_copied=$row['file_copied'];

    if(!empty($file_copied)){
      unlink("./data/".$file_copied);
    }

    $sql ="DELETE FROM `free` WHERE num=$q_num";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $sql ="DELETE FROM `free_ripple` WHERE num=$q_num";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    mysqli_close($conn);
    echo "<script>location.href='./free_list.php?page=1';</script>";

}else if(isset($_GET["mode"])&&$_GET["mode"]=="update"){
  $content = trim($_POST["content"]);
  $title = trim($_POST["title"]);

  if(empty($content)||empty($title)){
    echo "<script>alert('내용이나제목수정요망!');history.go(-1);</script>";
    exit;
  }
  $title = test_input($_POST["title"]);
  $q_content = $_POST["content"];
  $name = test_input($name);
  $num = test_input($_POST["num"]);
  $hit = test_input($_POST["hit"]);
  $q_title = mysqli_real_escape_string($conn, $title);
  $q_name = mysqli_real_escape_string($conn, $name);
  $q_num = mysqli_real_escape_string($conn, $num);
  $regist_day=date("Y-m-d (H:i)");

  //삭제할게 있으면 삭제하라.
  if(isset($_POST['del_file']) && $_POST['del_file'] =='1'){
    //삭제할 게시물의 텍스트파일명을 가져와서 삭제한다.
    $sql="SELECT `file_copied` from `free` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('Error: 6' . mysqli_error($conn));
      // die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $file_copied=$row['file_copied'];
    if(!empty($file_copied)){
      unlink("./data/".$file_copied);
    }

    //삭제된 파일 정보를 free에서 해당되는 필드에 수정을 해야된다.
    $sql="UPDATE `free` SET `file_name`='', `file_copied` ='' , `file_type` ='' WHERE `num`=$q_num;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
  }

  //파일첨부
  // 첨부되어있을때
  //empty는 isset함수와 반대 비어있다면 true 비어있지않다면 false
  if(!empty($_FILES['upfile']['name'])){
    //include 파일업로드기능
    include $_SERVER['DOCUMENT_ROOT']."/santteut/community/free/free_file_upload.php";
    $sql="UPDATE `free` SET `title`='$q_title',`content`='$q_content',`regist_day`='$regist_day',`hit`='$hit',`file_name`= '$file_name', `file_copied` ='$file_copied',`file_type`='$file_type' WHERE `num`=$q_num;";

    // 이미지는 안대
  //첨부되어있지 않을때
  }else{
    $sql="UPDATE `free` SET `title`='$q_title',`content`='$q_content',`regist_day`='$regist_day',`hit`='$hit' WHERE `num`=$q_num;";
  }

  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  echo "<script>location.href='./free_view.php?num=$num&hit=$hit';</script>";
}//end of if insert

?>
