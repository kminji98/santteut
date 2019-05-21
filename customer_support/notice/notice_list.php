<?php
session_start();
//0-0. 인클루드 디비
// include "../lib/db_connector.php";

//0-1. 인클루드 크리테이블
// include "../lib/create_table.php";

//0-2. 공지사항테이블생성
create_table($conn,'notice');

//1. 게시물수 정의
define('SCALE', 10);

//2. 변수정의
// $view_num 보여지는번호, $num은 DB에서 프라이머리키 번호
// $total_record 전체 게시물수, $start_record 한 페이지의 처음 게시물
// $record 는 게시물1개, $total_pages는 전체 페이지를 의미
$sql=$result=$total_record=$total_page=$start_record=$row="";
$total_record=0;


//3. 검색모드를 세팅(제목,내용)
if(isset($_GET["mode"])&&$_GET["mode"]=="find_input"){

  // find_option 는 select의 값들 문자열로 받아옴
  $find_option = test_input($_POST["find_option"]);

  // find_input 는 input의 값을 문자열로 받아옴
  $find_input = test_input($_POST["find_input"]);
  $q_find_input = mysqli_real_escape_string($conn, $find_input);

  if(empty($find_input)){
    echo ("<script>window.alert('검색할 단어를 입력해 주세요')history.go(-1)</script>");
    exit;
  }

  $sql="SELECT * from `notice` where $_option like '%$q_find_input%';";
}else{
  $sql="SELECT * from 'notice' order by num desc";
}

// 쿼리문실행문장
$result=mysqli_query($conn,$sql);

$total_record=mysqli_num_rows($result);

// 조건?참:거짓
$total_page=($total_record % SCALE == 0 )?($total_record/SCALE):(ceil($total_record/SCALE));

// 페이지가 없으면 디폴트 페이지 1페이지
if(empty($_GET['present_page'])){
  $present_page=1;
}else{
  $present_page=$_GET['present_page'];
}

// 현재페이지 시작번호계산함.
$start_record=($present_page -1) * SCALE;

// 리스트에 보여줄 번호를 최근순으로 부여함.
$view_num = $total_record - $start_record;

?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/customer_support/notice/css/notice_list.css">
    <title>공지사항</title>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/mini_menu.php";?>
    </header>
    <br><br><br>
    <section id="notice">
      <form name="notice_form" action="notice_list?mode=find_input" method="post">
      <div class="notice_list_find_input">
        <select>
          <option value="">제목</option>
          <option value="">내용</option>
        </select>
        <input type="text" name="" value="">
        <button type="button" name="button">검색</button>
      </div>
      </form>
      <br>
      <div class="total_title">
        <h4>total<?=$total_record?>개</h4>
      </div>

      <!--게시물 제목-->
      <table border="1">
        <tr>
          <th>번호</th>
          <th id="notice_list_title" style="width:600px;">제목</th>
          <th>작성자</th>
          <th>작성일</th>
          <th>조회</th>
        </tr>

      <!--게시물 내용-->
      <?php
        for ($record = $start_record; $record  < $start_record+SCALE && $record<$total_record; $record++){
          mysqli_data_seek($result,$record);
          $row=mysqli_fetch_array($result);
          $num=$row['num'];
          $name=$row['name'];
          $title=$row['title'];
          $date= substr($row['regist_day'],0,10);
          $hit=$row['hit'];
          $title=str_replace("\n", "<br>",$title);
          $title=str_replace(" ", "&nbsp;",$title);
      ?>
            <tr>
              <!--번호-->
              <td><?=$view_num?></td>
              <!--제목-->
              <td><a href="./notice_view.php?num=<?=$num?>&present_page=<?=$present_page?>&hit=<?=$hit+1?>"><?=$title?></a></td>
              <!--작성자-->
              <td><?=$name?></td>
              <!--작성일-->
              <td><?=$regist_day?></td>
              <!--조회-->
              <td><?=$hit?></td>
            </tr>
          </table>
        <?php
          $view_num--;
         }//end of for
        ?>
        <br>
<?php
if(!empty($_SESSION['userid'])){
  echo '<a href="notice_form.php"><button id="admin_write_btn" type="button" name="button">
  글쓰기</button></a>';
}
?>
<br>
<!--$page 는 현재페이지가 아닌 다른페이지를 의미함-->
        <!--바꾸기 -->
        <div id="page_button">
          <div id="page_num">이전◀ &nbsp;&nbsp;&nbsp;&nbsp;
          <?php
            for ($page=1; $page <= $total_page ; $page++) {
              if($present_page==$page){
                echo "<b>&nbsp;$page&nbsp;</b>";
              }else{
                echo "<a href='./list.php?page=$page'>&nbsp;$page&nbsp;</a>";
              }
            }
          ?>
          &nbsp;&nbsp;&nbsp;&nbsp;▶ 다음
          <br><br><br><br><br><br><br>
        </div><!--end of page num -->
      <!--바꾸기의 끝-->

      <div class="page_button_group">
        <button type="button" name="button" title="맨첨으로"><<</button>
        <button type="button" name="button" title="앞으로"><</button>
        <button type="button" name="button">1</button>
        <button type="button" name="button">2</button>
        <button type="button" name="button">3</button>
        <button type="button" name="button">4</button>
        <button type="button" name="button">5</button>
        <button type="button" name="button">6</button>
        <button type="button" name="button">7</button>
        <button type="button" name="button">8</button>
        <button type="button" name="button">9</button>
        <button type="button" name="button">10</button>
        <button type="button" name="button" title="뒤로">></button>
        <button type="button" name="button" title="맨뒤로">>></button>
      </div>

    </section>
    <br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
