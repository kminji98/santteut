// <!-- =================================================================
// + [DESC] 회원관리 query총괄
// + [DATE] 2019-05-26
// + [NAME] 이우주
// ================================================================= -->

<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

session_start();
if(!(isset($_SESSION['id']) &&  $_SESSION['id']=="admin")){
  echo "<script>alert('권한없음!');history.go(-1);</script>";
  exit;
}
?>
<meta charset="utf-8">
<?php
// 변수선언
$sql= $result = $name="";

$name = $_SESSION['name'];

if(isset($_GET["mode"]) && $_GET["mode"]=="delete"){

    // ex )  admin/wooju00/minji00/
    $del_value= $_POST["del_value"];

    // 삭제할 아이디를 배열로 생성
    $del_ids = explode("/",$del_value);
    for ($i=0; $i < count($del_ids); $i++) {

      $sql ="DELETE FROM `member` WHERE `id`='$del_ids[$i]'";
      $result = mysqli_query($conn,$sql);
      if (!$result) {die('Error: ' . mysqli_error($conn));}
      $row=mysqli_fetch_array($result);
    }
    mysqli_close($conn);

    echo "<script>location.href='./member_admin_list.php?num=$num';</script>";
}

?>
