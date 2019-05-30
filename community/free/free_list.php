<!DOCTYPE html>
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
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
<style media="screen">
table{  border-collapse: collapse;}
  .t1 td{ border-bottom: 1px solid black;
}
</style>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/side_bar.css">
    <title></title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#free_mini").css("font-weight","bold");
        $("#free_mini").css("color","black");
      });
      </script>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/commu_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/side_bar.php";?>
    </header>
<section>


    <form class="" action="free_list.php?mode=search" method="post">
<table style="width : 800px; margin : auto;">
  <tr>
    <th style="text-align : left;">total <?=$total_record?></th>
    <td style="float : right;"><input type="submit" name="" value="검색"></td>
    <td style="float : right;"><input type="text" name="" value=""></td>
    <td style="float : right;"><select  name="find">
      <option value="title">제목</option>
      <option value="content">내용</option>
      <option value="name">이름</option>
      <option value="id">아이디</option>
    </select></td>
  </tr>
</table>
    </form>
    <table style="width : 800px; margin : auto;">
      <tr class ="t1">
        <td>번호</td>
        <td style="width : 550px; text-align : center;">제목</td>
        <td style="text-align : right;">글쓴이</td>
        <td style="width : 100px;text-align : right;">등록일</td>
        <td style="text-align : right;">조회</td>
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
      $date= substr($row['regist_day'],2,9);
    ?>
<tr class ="t1";style="border-bottom : 1px solid gray;">
<td style="padding-left : 17px;"><?=$num?></td>
<td style="width : 500px; padding-left: 15px;"><a href="./view.php?num=<?=$num?>&page=<?=$page?>&hit=<?=$hit+1?>"><?=$title?></a></td>
<td style="text-align : center;"><?=$id?></td>
<td style="text-align : right;"><?=$date?></td>
<td style="padding-left : 30px;"><?=$hit?></td>
</tr>
<?php  }
$number--;
?>
<tr>
  <td colspan="2" style="text-align : center; padding-left : 30px;">
    이전< &nbsp;&nbsp;&nbsp;&nbsp;
  <?php
    for ($i=1; $i <= $total_page ; $i++) {
      if($page==$i){
        echo "<b>&nbsp;$i&nbsp;</b>";
      }else{
        echo "<a href='./free_list.php?page=$i'>&nbsp;$i&nbsp;</a>";
      }
    }
  ?>
  &nbsp;&nbsp;&nbsp;&nbsp;> 다음
</td>
  <td></td>
  <td style="padding-left : 35px;"><?php
    if(!empty($_SESSION['id'])){
    echo '<a href="write_edit_form.php"><input type="button" name="" value="글쓰기"></a>';
    }
  ?></td>
  <td><a href="./free_list.php?page=<?=$page?>"><input type="button" name="" value="목록"> </a></td>
</tr>
    </table>
    </section>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
