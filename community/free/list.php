<!DOCTYPE html>
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/santtuet/common/lib/db_connector.php";
define('SCALE', 10);
//*****************************************************
$sql=$result=$total_record=$total_page=$start="";
$row="";
$memo_id=$memo_num=$memo_date=$memo_nick=$memo_content="";
$total_record=0;
//*****************************************************
if(isset($_GET["mode"])&&$_GET["mode"]=="search"){
  //제목, 내용, 아이디
  $find = test_input($_POST["find"]);
  $search = test_input($_POST["search"]);
  $q_search = mysqli_real_escape_string($conn, $search);
  $sql="SELECT * from `free` where $find like '%$q_search%' order by num desc;";
}else{
  $sql="SELECT * from `free` order by num desc";
}
$result=mysqli_query($conn,$sql);
$total_record=mysqli_num_rows($result);
$total_page=ceil($total_record/SCALE);
//2.페이지가 없으면 디폴트 페이지 1페이지
if(empty($_GET['page'])){
  $page=1;
}else{
  $page=$_GET['page'];
}
//3.현재페이지 시작번호계산함.
$start=($page -1) * SCALE;
//4. 리스트에 보여줄 번호를 최근순으로 부여함.
$number = $total_record - $start;
?>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>산뜻 :: 즐거운 산행</title>
  </head>
  <body>
    <form class="" action="list.php?mode=search" method="post">
<table>
  <tr>
    <td>총 <?=$total_record?>개의 게시물이 있습니다.</td>
    <td><select  name="find">
      <option value="subject">제목</option>
      <option value="content">내용</option>
      <option value="name">이름</option>
      <option value="id">아이디</option>
    </select></td>
    <td><input type="text" name="search" value=""></td>
    <td><input type="submit" name="" value="검색"></td>
  </tr>
</table>
    </form>
    <table>
      <tr>
        <td>번호</td>
        <td style="width : 300px; text-align : center;" >제목</td>
        <td style="text-align : center;">글쓴이</td>
        <td style="text-align : center;">등록일</td>
        <td style="text-align : center;">조회</td>
      </tr>
    <?php
    for ($i = $start; $i < $start+SCALE && $i<$total_record; $i++){
      mysqli_data_seek($result,$i);
      $row=mysqli_fetch_array($result);
      $num=$row['num'];
      $id=$row['id'];
      $name=$row['name'];
      $hit=$row['hit'];
      $title=$row['title'];
      $date= substr($row['regist_day'],0,10);
    ?>
<tr style="border-bottoms : 1px solid gray;">
<td style="text-align : center;"><?=$num?></td>
<td style="padding-left: 15px;"><a href="./view.php?num=<?=$num?>&page=<?=$page?>&hit=<?=$hit+1?>"><?=$title?></a></td>
<td style="text-align : center;"><?=$id?></td>
<td><?=$date?></td>
<td style="text-align : center;"><?=$hit?></td>
</tr>
<?php  }
$number--;
?>
<tr>
  <td colspan="2" style="text-align : center; padding-left : 30px;">
    이전◀ &nbsp;&nbsp;&nbsp;&nbsp;
  <?php
    for ($i=1; $i <= $total_page ; $i++) {
      if($page==$i){
        echo "<b>&nbsp;$i&nbsp;</b>";
      }else{
        echo "<a href='./list.php?page=$i'>&nbsp;$i&nbsp;</a>";
      }
    }
  ?>
  &nbsp;&nbsp;&nbsp;&nbsp;▶ 다음
</td>
  <td></td>
  <td><?php
    if(!empty($_SESSION['id'])){
    echo '<a href="write_edit_form.php"><input type="button" value="글쓰기"></a>';
    }
  ?></td>
  <td><a href="./list.php?page=<?=$page?>"><input type="button" name="" value="목록"> </a></td>
</tr>
    </table>
  </body>
</html>
