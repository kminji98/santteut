<?php
session_start();
// isset함수는 불리언값을 리턴 true or false
// 비회원이면 권한없음
if(!isset($_SESSION['id'])){
  echo "<script>alert('회원가입 후 이용해주세요.');history.go(-1);</script>";
  exit;
}
$name = $_SESSION['name'];
//0-0. 인클루드 디비
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
//1. 게시물수 정의
define('ROW_SCALE', 10);
define('PAGE_SCALE', 5);
$sql=$result=$total_record=$total_page=$start_record=$row="";
$total_record=0;
if(isset($_GET["mode"])&&$_GET["mode"]=="search"){
  //제목, 내용, 작성자
  $find_option = test_input($_POST["find_option"]);

  $find_input = test_input($_POST["find_input"]);
  $q_find_input = mysqli_real_escape_string($conn, $find_input);

  if(empty($find_input)){
    echo ("<script>window.alert('검색할 단어를 입력해 주세요')history.go(-1)</script>");
    exit;
  }
//검색시
  $sql="SELECT num, groupnum, depth, ord, name, title, content, regist_day, hit, pw from `qna` inner join member on `qna`.`id` = `member`.`id` where $find_option like '%$q_find_input%' order by num desc;";
}else{
  //"select num, groupnum, depth, ord, name, title, content, regist_day, hit FROM qna inner join member on qna.id = member.id;"
  $sql="SELECT num, groupnum, depth, ord, name, title, content, regist_day, hit, pw FROM `qna` inner join member on `qna`.`id` = `member`.`id` order by `groupnum` desc, `ord` asc;";
}
// 쿼리문실행문장
$result=mysqli_query($conn,$sql);

$total_record=mysqli_num_rows($result);
// 조건?참:거짓
$total_pages=ceil($total_record/ROW_SCALE);
// 페이지가 없으면 디폴트 페이지 1페이지
// if(empty($_GET['page'])){$page=1; }else{ $page=$_GET['page']; }
$page=(empty($_GET['page']))?1:$_GET['page'];
// 현재 블럭의 시작 페이지 = (ceil(현재페이지/블럭당 페이지 제한 수)-1) * 블럭당 페이지 제한 수 +1
//[[  EX) 현재 페이지 5일 때 => ceil(5/3)-1 * 3  +1 =  (2-1)*3 +1 = 4 ]]
$start_page= (ceil($page / PAGE_SCALE ) -1 ) * PAGE_SCALE +1 ;
// 현재페이지 시작번호 계산함.
//[[  EX) 현재 페이지 1일 때 => (1 - 1)*10 -> 0   ]]
//[[  EX) 현재 페이지 5일 때 => (5 - 1)*10 -> 40  ]]
$start_record=($page -1) * ROW_SCALE;
// 현재 블럭 마지막 페이지
// 전체 페이지가 (시작 페이지+페이지 스케일) 보다 크거나 같으면 마지막 페이지는 (시작페이지 + 페이지 스케일) -1 / 아니면 전체페이지 수 .
//[[  EX) 현재 블럭 시작 페이지가 6/ 전체페이지 : 10 -> '10 >= (6+10)' 성립하지 않음 -> 10이 현재블럭의 가장 마지막 페이지 번호  ]]
$end_page= ($total_pages >= ($start_page + PAGE_SCALE)) ? $start_page + PAGE_SCALE-1 : $total_pages;
// 리스트에 보여줄 번호를 최근순으로 부여함.
// 출력될 숫자
$view_num = $total_record - $start_record;
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/customer_support/qna/css/qna_list.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/side_bar.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <title>문의하기</title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#qna_mini").css("font-weight","bold");
        $("#qna_mini").css("color","black");
      });
    </script>
    <script type="text/javascript">
      function modal_alert(msg1,msg2){
        var modal = document.getElementById('myModal');
        $("#modal-content").html("");
        $("#modal-content").append("<form name='pw_check_form' id='pw_check_form' action='qna_modal_query.php?mode=pass' method='post'>");
        $("#pw_check_form").append("<h2>"+msg1+"</h2>");
        $("#pw_check_form").append("<h3>"+msg2+"</h3>");
        $("#pw_check_form").append('<div class="button-8" id="button-3">');
        $("#button-3").append('<div class="eff-8"></div>');
        $("#button-3").append("<a class=\'btn\' onclick=\'document.pw_check_form.submit()\' ><span>확인</span></a>");
        $("#button-3").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class=\'btn\' onclick=\'modal_close();\' ><span>취소</span></a>");
        $("#pw_check_form").append("</div>");
        $("#modal-content").append("</form>");
        modal.style.display="block";
      }
      function modal_close(){
        var modal = document.getElementById('myModal');
        modal.style.display="none";

      }

      function modal_alert_cancel(msg1,msg2,msg3){
        var modal = document.getElementById('myModal');
        modal.style.display="block";

        $("#modal-content").html("<i class='fas fa-exclamation-circle 9x'></i>");
        $("#modal-content").append("<h2>"+msg1+"</h2>");
        $("#modal-content").append("<h3>"+msg2+"</h3>");
        $("#modal-content").append("<div class='button-8' id='button-3' onclick='alert_confirm(\""+msg3+"\")'>");
        $("#button-3").append("<div class='eff-8'></div>");
        $("#button-3").append("<a href='#'><span>확인</span></a>");
        $("#modal-content").append("</div>");
        $("#modal-content").append("<div class='button-8' id='button-4'>");
        $("#button-3").append("<div class='eff-8'></div>");
        $("#button-3").append("<a href='#'><span>취소</span></a>");
        $("#modal-content").append("</div>");
      }

      function alert_confirm(local){
        var modal = document.getElementById('myModal');
        modal.style.display = "none";
        if(local!="undefined"){
          window.location.href=local;
        }
      }

      window.onclick = function(event) {
        if (event.target == "modal") {
          var modal = document.getElementById('myModal');
            modal.style.display = "none";
        }
      };
    </script>
  </head>
  <body>
    <div id="myModal" class="modal">
       <div class="modal-content" id="modal-content">
        </div>
        </div>
    </div>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/custom_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/side_bar.php";?>
    </header>
    <br><br><br>
    <section id="qna">
      <div class="qna_list_search">
        <form name="board_form" action="qna_list.php?mode=search" method="post">
          <select name="find_option">
            <option value="title">제목</option>
            <option value="content">내용</option>
            <option value="name">작성자</option>
          </select>
          <input type="text" name="find_input">
          <input type="submit" value="검색" style="width:53px; height:27px; background-color: #2F9D27; border: 1px solid #2F9D27; color: white;"></input>
        </form>
      </div>
      <br>
      <table border="1">
        <tr>
          <th>번호</th>
          <th id="qna_list_title" style="width:490px;">제목</th>
          <th>작성자</th>
          <th>작성일</th>
          <th>조회</th>
          <th style="width:50px;">공개</th>
        </tr>

        <!--게시물 내용-->
        <?php
          for ($record = $start_record; $record  < $start_record+ROW_SCALE && $record<$total_record; $record++){
            mysqli_data_seek($result,$record );
            $row=mysqli_fetch_array($result);
            $num=$row['num'];
            $name=$row['name'];
            $pw=$row['pw'];
            if(empty($pw)){
              $secret="공개";
            }else{
              $secret="비공개";
            }
            $hit=$row['hit'];
            $regist_day= substr($row['regist_day'],0,10);
            $title=$row['title'];
            $title=str_replace("\n", "<br>",$title);
            $title=str_replace(" ", "&nbsp;",$title);
            $depth=(int)$row['depth'];//공간을 몆칸을 띄어야할지 결정하는 숫자임
            $space="";

            for($j=0;$j<$depth;$j++){
              $space="&nbsp;&nbsp;".$space;
            }
        ?>
          <tr>
            <!--보여지는번호-->
            <td><?=$view_num?></td>
            <!--제목-->
            <td>
              <script type="text/javascript">
                function view_pw(num_val,page,hit){
                  $.ajax({
                    url: 'qna_modal.php?mode=pass',
                    type: 'POST',
                    data: {
                      num: num_val
                    }
                  })
                  .done(function(result) {
                    if(result != ''){
                       modal_alert('비밀번호를 입력해주세요','<input style=\'height:34px;width:220px;\' type=\'password\' name=\'pw\'><input type=\"hidden\" name=\"num\" value=\''+num_val+'\'>');
                    }
                    console.log("success");
                  })
                  .fail(function() {
                    console.log("error");
                  })
                  .always(function() {
                    console.log("complete");
                  });

                }
              </script>
              <a onclick="view_pw(<?=$num?>,<?=$page?>,<?=$hit?>)"><?=$space.$title?></a>
            </td>
            <!--작성자-->
            <td><?=$name?></td>
            <!--작성일-->
            <td><?=$regist_day?></td>
            <!--조회-->
            <td><?=$hit?></td>
            <td><?=$secret?></td>
          </tr>

          <?php
            $view_num--;
           }//end of for
          ?>
      </table>
      <?php
      if(!empty($_SESSION['id'])){
        echo '<a href="qna_form.php"><button id="admin_write_btn" type="button" name="button">
        글쓰기</button></a>';
      }
      ?>
      <br>
      <!--$page 는 현재페이지를 의미 x / 각 페이지를 의미-->
            <div class="page_button_group">
              <?php
              //현재 블럭의 시작 페이지가 페이지 스케일 보다 클 때 -> 처음으로 버튼 생성 + 이전 블럭 존재
              //[ex]  page가 9개 있고 현재 페이지가 6페이지인 경우  / 12345/ 6789     =>  <<(처음으로) <(이전) 6 7 8 9
              if( $start_page > PAGE_SCALE ){
                // echo( '<a href='qna_list.php?page=1'> << </a>' );
                echo( '<a href="qna_list.php?page=1"><button type="button" name="button" title="처음으로"><<</button></a>' );

                // 이전 블럭 클릭 시 -> 현재 블럭의 시작 페이지 - 페이지 스케일
                // 현재 6 page 인 경우 '<(이전블럭)' 클릭 -> $pre_page = 6-PAGE_SCALE  -> 1 페이지로 이동
                $pre_block= $start_page - PAGE_SCALE;
                if(isset($_GET['mode']) && $_GET['mode']=="search"){
                  echo( '<a href="qna_list.php?mode=search&find_option=$find_option&find_input=$find_input&page='.$pre_block.'"><button type="button" name="button" title="이전"><</button></a>' );
                }else{
                  echo( '<a href="qna_list.php?page='.$pre_block.'"><button type="button" name="button" title="이전"><</button></a>' );
                }
              }

              //현재 블럭에 해당하는 페이지 나열
              for( $i = $start_page; $i <= $end_page; $i++ ){
                  //현재 블럭에 현재 페이지인 버튼
                  if ( $i == $page ){
                    echo( '<a href="#"><button type="button" name="button" style="background-color: #2F9D27; border: 1px solid #2F9D27; color: white;">'.$i.'</button></a>' );
                  }else if(isset($_GET['mode']) && $_GET['mode']=="search"){
                    echo( '<a href="qna_list.php?mode=search&find_option=$find_option&find_input=$find_input&page='.$i.'"><button type="button" name="button">'.$i.'</button></a>' );
                  }else{
                    echo( '<a href="qna_list.php?page='.$i.'"><button type="button" name="button">'.$i.'</button></a>' );
                  }
              }

              // 현재 블럭의 마지막 페이지 보다 총 페이지 수가 큰 경우, >(다음) 버튼 / >>(맨끝으로) 버튼 생성
              //[ex]  page가 9개 있고 현재 페이지가 6페이지인 경우  / 12345/ 6789     =>  <<(처음으로) <(이전) 6 7 8 9
              //[ex]  page가 9개 있고 현재 페이지가 1페이지인 경우  / 12345/ 6789     =>  1 2 3 4 5 >(다음) >>(맨끝으로)
              if( $total_pages > $end_page ){
                // 다음블럭 => 현재 블럭의 시작페이지 + 스케일
                // 클릭 시 다음 블럭의 첫 번째 페이지로 이동
                // [ex]  총 page 9개 있고 페이지가 3인  경우 / >(다음) 버튼 누르면 '6'으로 이동
                $next_block= $start_page + PAGE_SCALE;

                if(isset($_GET['mode']) && $_GET['mode']=="search"){
                  echo( '<a href="qna_list.php?mode=search&find_option=$find_option&find_input=$find_input&page='.$next_block.'"><button type="button" name="button">></button></a>' );
                }else{
                  echo( '<a href="qna_list.php?page='.$next_block.'"><button type="button" name="button" title="다음">></button></a>' );
                }

                //맨끝페이지로 이동
                echo( '<a href="qna_list.php?page='.$total_pages.'"><button type="button" name="button" title="맨끝으로">>></button></a>' );
              }
              ?>
            </div>
          </section>
  </body>
  <footer>
<?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
</footer>
</html>
