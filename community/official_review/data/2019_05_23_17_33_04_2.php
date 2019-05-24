<?php
session_start();

 include $_SERVER['DOCUMENT_ROOT']."/JK1/lib/db_connector.php";
 include $_SERVER['DOCUMENT_ROOT']."/JK1/lib/create_table.php";

create_table($conn, 'free');//자유게시판 테이블 생성
create_table($conn, 'free_ripple');//자유게시판댓글 테이블 생성

define('SCALE', 10);
//******************************************************
$sql=$result=$total_record=$total_page=$start="";
$row="";
$memo_id=$memo_num=$memo_date=$memo_nick=$memo_content="";
$total_record=0;
//******************************************************
if(isset($_GET["mode"])&&$_GET["mode"]=="search"){
  //제목, 내용, 아이디
  $find = test_input($_POST["find"]);
  $search = test_input($_POST["search"]);
  $q_search = mysqli_real_escape_string($conn, $search);
  $sql ="SELECT * FROM `free` WHERE $find like '%$q_search%' order by num desc;";
}else{
  $sql="SELECT * FROM `free` order by num desc";
}

$result=mysqli_query($conn,$sql);
$total_record=mysqli_num_rows($result);
$total_page=($total_record % SCALE == 0)?
($total_record/SCALE):(ceil($total_record/SCALE));

//2. 페이지가 없으면 디폴트 페이지 1페이지
if(empty($_GET['page'])){
  $page=1;
}else{
  $page=$_GET['page'];
}
//3. 현재페이지 시작번호계산함.
$start=($page -1) * SCALE;

//4. 리스트에 보여줄 번호를 최근순으로 부여함.
$number = $total_record - $start;
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/greet.css">
    <script type="text/javascript" src="../js/member_form.js"></script>
    <title></title>
  </head>
  <body>
    <div id="wrap">
      <div id="header">
        <?php include "../lib/top_login2.php"; ?>
      </div><!--end of header -->
      <div id="menu">
        <?php include "../lib/top_menu2.php"; ?>
      </div><!--end of menu -->
      <div id="content">
        <div id="col1">
          <div id="left_menu">
            <?php include "../lib/left_menu.php"; ?>
          </div>
        </div><!--end of col1 -->
        <div id="col2">
          <div id="title">
            <p style="font-size:20px; color:gray; font-weight:bold;">콩쿨결과</p>
          </div>
          <form name="board_form" action="list.php?mode=search" method="post">
            <table>
            <tr id="list_search">
              <td id="list_search1">총 <?=$total_record?>개의 게시물이 있습니다.</td>
              <td id="list_search2" style="font-size:12px; font-weight:bold">SELECT</td>
              <td id="list_search3">
                <select name="find">
                  <option value="subject">제목</option>
                  <option value="content">내용</option>
                  <option value="nick">별명</option>
                  <option value="name">이름</option>
                  <option value="id">아이디</option>
                </select>
              </td><!--end of list_search3-->
              <td id="list_search4"><input type="text" name="search"></td>
              <td id="list_search5"><input type="submit" value="검색" style="width:50px; height:22px; background-color:DarkSlateGray; color:white;"></td>
            </tr><!--end of list_search-->
          </table>
          </form>
          <div id="clear"></div>
          <div id="list_top_title">
            <ul>
              <li id="list_title1" style="font-size:12.5px; margin-left:11px;">번호</li>
              <li id="list_title2" style="font-size:12.5px;">제목</li>
              <li id="list_title3" style="font-size:12.5px;">글쓴이</li>
              <li id="list_title4" style="font-size:12.5px;">등록일</li>
              <li id="list_title5" style="font-size:12.5px;">조회</li>
            </ul>
          </div><!--end of list_top_title-->
          <div id="list_content">
            <table>
          <?php
            for ($i = $start; $i <$start+SCALE && $i< $total_record; $i++){
              mysqli_data_seek($result,$i);
              $row=mysqli_fetch_array($result);
              $num=$row['num'];
              $id=$row['id'];
              $name=$row['name'];
              $nick=$row['nick'];
              $hit=$row['hit'];
              $date=substr($row['regist_day'],0,10);
              $subject=$row['subject'];
              $subject=nl2br($subject);
              $subject=str_replace(" ", "&nbsp;", $subject);
          ?>
            <tr id="list_item">
              <td id="list_item1"><?=$number?></td>
              <td id="list_item2">
                <a href="./view.php?num=<?=$num?>&page=<?=$page?>&hit=<?=$hit+1?>"><?=$subject?></a>
              </td>
              <td id="list_item3"><?=$nick?></td>
              <td id="list_item4"><?=$date?></td>
              <td id="list_item5"><?=$hit?></td>
              <td id="memo_content"><?=$memo_content?></td>
            </tr><!--end of list_item -->
          <?php
              $number--;
            }//end of for
          ?>
        </table>
          <div id="page_button">
          <div id="page_num">이전 &nbsp;&nbsp;&nbsp;&nbsp;
            <?php
              for ($i=1; $i<=$total_page;$i++) {
                if($page==$i){
                  echo "<b>&nbsp;$i&nbsp;</b>";
                }else{
                  echo "<a href='./list.php?page=$i'>&nbsp;$i&nbsp;</a>";
                }
              }
             ?>
              &nbsp;&nbsp;&nbsp;&nbsp; 다음
              <br><br><br><br><br><br><br>
          </div><!--end of page_num -->
          <div id="button">
            <a href="./list.php?page=<?=$page?>"><input type="button" style="width:50px; height:23px; background-color:DarkSlateGray; color:white;" value="목록">&nbsp;</a>
            <?php //세션아이디가 있으면 글쓰기 버튼을 보여줌.
              if(!empty($_SESSION['userid'])){
              echo '<a href="write_edit_form.php"><input type="button" style="width:60px; height:23px; background-color:DarkSlateGray; color:white;" value="글쓰기"></a>';
              }
             ?>
          </div><!--end of button -->
        </div><!--end of page_button -->
        </div><!--end of list_content -->
        </div><!--end of col2 -->
      </div><!--end of content -->
    </div><!--end of wrap  -->
  </body>
</html>
