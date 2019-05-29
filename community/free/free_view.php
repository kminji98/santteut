<!DOCTYPE html>
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

 ?>

<html lang="ko" dir="ltr">
<?php
$num = test_input($_GET["num"]);
$hit = test_input($_GET["hit"]);
$q_num = mysqli_real_escape_string($conn, $num);

$sql="UPDATE `free` SET `hit`=$hit WHERE `num`=$q_num;";
$result = mysqli_query($conn,$sql);
if (!$result) {
  die('Error: ' . mysqli_error($conn));
}
  $num=$_GET['num'];
  $sql="SELECT * from `free` where num ='$num';";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  $row=mysqli_fetch_array($result);
  $id=$row['id'];
  $name=$row['name'];
  $title=$row['title'];
  $content= $row['content'];
  $destination= $row['destination'];
  $file_name= $row['file_name'];
  $update= $row['del'];
  $day=$row['regist_day'];
  $id=$row['hit'];
 ?>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<table style="width : 80%;">
  <tr>
    <td style="width : 500px;"><?=$title?></td>
    <td style="float : right;"><?=$name?><?php
        if(!empty($_SESSION['userid'])&&!empty($destination)){
        $file_size = filesize($destination)/1024;
        $file_size = floor($file_size);
          echo ("
            ▷ 첨부파일 : $file_name &nbsp; [ $file_size KB]
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href='download.php?mode=download&num=$num'>저장</a><br><br>
          ");
        }
      ?></td>
  </tr>
  <tr>
    <td colspan="2"><?=$content?></td>
  </tr>
  <tr>
    <td colspan="2" ><a style="float : right; margin-left : 15px;" href="./free_query.php?mode=delete&num=<?=$num?>"><input type="button" name="" value="삭제"></a>
      <a style="float : right;" href="./free_form.php?mode=update&num=<?=$num?>"><input type="button" name="" value="수정"></a>
    </td>
  </tr>
</table>


  </body>
</html>
