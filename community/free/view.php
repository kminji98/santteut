<!DOCTYPE html>
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
?>

<html lang="ko" dir="ltr">
<?php
function free_ripple_delete($id1,$num1,$page1,$page,$hit,$parent){
  $message="";
  if($_SESSION['id']=="admin"||$_SESSION['id']==$id1){
    $message='<form style="display:inline" action="'.$page1.'?mode=delete_ripple&page='.$page.'&hit='.$hit.'" method="post">
    <input type="hidden" name="num" value="'.$num1.'">
    <input type="hidden" name="parent" value="'.$parent.'">
    <input type="submit" value="삭제">
    </form>';
  }
  return $message;
}
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
    
<table style="width : 800px; margin : auto;">
  <tr>
    <td colspan="2" style="width : 700px; border-bottom : 1px solid black;">제목 : <?=$title?><span style="float : right;">작성자 : <?=$name?>
    <?php
        if(!empty($_SESSION['id'])&&!empty($destination)){
        $file_size = filesize($destination)/1024;
        $file_size = floor($file_size);
          echo ("
            첨부파일 : $file_nsame &nbsp; [ $file_size KB]
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href='download.php?mode=download&num=$num'>저장</a><br><br>
          ");
        }
      ?></span>
    </td>

  </tr>
  <tr>
    <td colspan="2" style="width : 700px; border-bottom : 1px solid black;"><?=$content?></td>

  </tr>
  <tr>
    <td colspan="2">
      <a style="float : right; margin-left : 10px;" href="./dml_board.php?mode=delete&num=<?=$num?>"><input type="button" name="" value="삭제"></a>
      <a style="float : right; margin-left : 10px;" href="./write_edit_form.php?mode=update&num=<?=$num?>"><input type="button" name="" value="수정"></a>
      <a style="float : right;" href="./list.php?page=<?=$page?>"><input type="button" name="" value="목록"></a>
    </td>
    <
  </tr>
</table>
<br><br>
<div id="ripple2">
  <?php
    $sql="select * from `free_ripple` where parent='$q_num' ";
    $ripple_result= mysqli_query($conn,$sql);
    while($ripple_row=mysqli_fetch_array($ripple_result)){
      $ripple_num=$ripple_row['num'];
      $ripple_id=$ripple_row['id'];
      $ripple_date=$ripple_row['regist_day'];
      $ripple_name=$ripple_row['name'];
      $ripple_content=$ripple_row['content'];
      $ripple_content=str_replace("\n", "<br>",$ripple_content);
      $ripple_content=str_replace(" ", "&nbsp;",$ripple_content);
  ?>
  <table style="width : 800px; margin : auto;">
<tr>
  <td><?=$ripple_name."&nbsp;&nbsp;".$ripple_date?></td>
  <td>  <?php
    $message=free_ripple_delete($ripple_id,$ripple_num,'dml_board.php',$page,$hit,$q_num);
    echo $message;
    ?></td>

</tr>
<tr>
  <td style="margin : auto;"colspan="2"><?=$ripple_content?></td>
</tr>

  </table>
  <?php
    }//end of while
    mysqli_close($conn);
  ?>

  <form name="ripple_form" action="dml_board.php?mode=insert_ripple" method="post">
    <input type="hidden" name="parent" value="<?=$q_num?>">
    <input type="hidden" name="page" value="<?=$page?>">
    <input type="hidden" name="hit" value="<?=$hit?>">
    <table style="width : 800px; margin : auto;">
      <tr>
        <td><textarea name="ripple_content" rows="3" cols="110"></textarea></td>
        <td><input type="submit" name="" value="댓글달기"></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
      </tr>
    </table>
    </form>
</div><!--end of ripple2  -->

  </body>
</html>
