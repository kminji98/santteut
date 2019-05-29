<?php
/*
=================================================================
+ [DESC] 내가 쓴 글 목록 확인
+ [DATE] 2019-05-19
+ [NAME] 김민지
=================================================================
*/
session_start();
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css?ver=1">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/mypage/myboard/css/myboard.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/side_bar.css">
    <title>산뜻 :: 즐거운 산행</title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        // tap 메뉴 onclick action
        for (var i = 1; i < 4; i++) {
          $("#list_head"+i).click(function(){
            if($(this).css("background-color")!=="white"){
              $("#list_head_tr").children('td').css('background-color', '#f2f2f2');
              $("#list_head_tr").children('td').css('border', '1px solid #dedede');
              $(this).css('background-color', 'white');
              $(this).css('border', '1px solid black');
              $(this).css('border-bottom-color', 'white');
              $(this).css('border-left-color', 'black');
            }
          });
        }

      });
    </script>

  </head>
  <body>
    <div id="wrap">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/side_bar.php";?>
    </header>
    <hr>
    <!--마이페이지 리스트-->
    <div id="myboard_list">
        <h3 id="title" >참여내역</h3>
      <fieldset id="list_field">
        <table id="list_tbl_head"><tr id="list_head_tr"><td id="list_head1">상담문의</td><td id="list_head2">여행후기</td>
          <td id="list_head3">자유게시판</td>
        </tr></table>
        <table id="list_tbl_body">
          <tr>
            <td>제목</td>
            <td>작성일</td>
            <td></td>
            <td>총 결제금액</td>
            <td>인원</td>
            <td>출발일/귀국일</td>
            <!-- 취소내역 -> 예약상태 : 예약 취소  -->
            <td>예약상태</td>
            <td>결제상태</td>
            <td>후기</td>
          </tr>
          <output id="list_tbl_body_output">
            <tr><td colspan="9" style="padding:40px;">예약 내역이 없습니다.</td></tr>
          </output>
        </table>
      </fieldset>
    </div> <!-- end of div "reserve_list" -->
    <footer> <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?> </footer>
    </div>  <!-- end of div "wrap" -->
  </body>
</html>
