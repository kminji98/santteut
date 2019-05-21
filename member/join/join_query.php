<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
$id = $_POST['join_id'];
$q_id = mysqli_real_escape_string($conn, $id);

if(isset($_POST['mode']) && $_POST['mode']=='facebook'){
  $q_id = $q_id."@f";
}else if(isset($_POST['mode']) && $_POST['mode']=='kakao'){
  $q_id = $q_id."@k";
}
$sql="select * from member where id = '$q_id'";
$result = mysqli_query($conn,$sql);
if (!$result) {
  die('Error: ' . mysqli_error($conn));
}
$rowcount=mysqli_num_rows($result);

if($rowcount){
  //kakao OR facebook login
  if(isset($_POST['mode'])){
    $_SESSION['name'] =$join_name;
    $_SESSION['email'] =$email;
    $_SESSION['id'] =$q_id;
    echo "<script>location.href='../../index.php';</script>";
    exit;
  }
  echo "<script>alert('존재하는 아이디입니다.');history.go(-1);</script>";
  exit;
}

$join_passwd = $_POST["join_passwd"];
$join_passwdconfirm = $_POST["join_passwdconfirm"];
$join_name= $_POST["join_name"];
$join_zip= $_POST["join_zip"];
$join_foundational= $_POST["join_foundational"];
$join_detail= $_POST["join_detail"];
$join_landline1= $_POST["join_landline1"];
$join_landline2= $_POST["join_landline2"];
$join_landline3= $_POST["join_landline3"];
$join_landline = $join_landline1."-".$join_landline2."-".$join_landline3;
$hp1 = $_POST["join_select"];
$hp2 = $_POST["join_cellphone"];
$hp =$hp1."-".$hp2;
$email = $_POST["email"];
$regist_day=date("Y-m-d (H:i)");

$sql="INSERT INTO member (id,passwd,passwd_confirm,name,zip,address1,address2,hp1,hp2,email) ";
$sql.=" VALUES ('$q_id','$join_passwd','$join_passwdconfirm','$join_name','$join_zip','$join_foundational','$join_detail','$join_landline','$hp','$email')";
$result = mysqli_query($conn,$sql);
if (!$result) {
  die('Error: ' . mysqli_error($conn));
}
mysqli_close($conn);
$_SESSION['name'] =$join_name;
$_SESSION['email'] =$email;
$_SESSION['id'] =$q_id;
echo "<script>location.href='../../index.php';</script>";

?>
