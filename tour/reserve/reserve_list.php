<?php
/*
=================================================================
+ [DESC] 예약/결제 목록 확인
+ [DATE] 2019-05-18
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
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/reserve/css/reserve_list.css?ver=1">
    <title>산뜻 :: 즐거운 산행</title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#list_head1").click(function(){
          if($("#list_head1").css("background-color")!="white"){
            $("#list_head1").css('background-color', 'white');
            $("#list_head1").css('border', '1px solid #3d3d3d');
            $("#list_head1").css('border-bottom-color', 'white');
            $("#list_head2").css('background-color', '#f2f2f2');
            $("#list_head2").css('border', '1px solid #dedede');
            $("#list_head1").css('border-right-color', '#3d3d3d');
          }
        });
        $("#list_head2").click(function(){
          if($("#list_head2").css('background-color')!="white"){
            $("#list_head2").css('background-color', 'white');
            $("#list_head2").css('border', '1px solid #3d3d3d');
            $("#list_head2").css('border-bottom-color', 'white');
            $("#list_head1").css('background-color', '#f2f2f2');
            $("#list_head1").css('border', '1px solid #dedede');
            $("#list_head1").css('border-right-color', '#3d3d3d');
          }
        });
      });
    </script>

  </head>
  <body>
    <div id="wrap">
    <header><?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?></header>
    <hr>
    <!--예약 리스트 페이지-->
    <div id="reserve_list">
      <h3 id="title" >예약 및 결제 확인</h3>
      <fieldset id="i_field">
        <div id="i"><b>ⓘ</b></div><!-- end of div "i" -->
        <div id="i_div_ul">
          <ul>
            <li>예약코드를 클릭하시면 예약상세 페이지 확인이 가능하시며, 개별상품별 결제가 가능합니다.</li>
            <li>미결제로 취소된 예약 건의 경우 취소일로부터 3개월 경과 시 조회되지 않습니다.</li>
            <li>안내사항3</li>
            <li>안내사항4</li>
          </ul>
        </div>
      </fieldset>
      <br>
      <fieldset id="search_field" >
        <span id="search_date">출발일</span>&nbsp;&nbsp;&nbsp;
        <select class="date_select" name="year1" >
          <option value="">2019</option>
        </select>년
        <select class="date_select" name="month1" >
          <option value="">05</option>
        </select>월
        <select class="date_select" name="day1" >
          <option value="">20</option>
        </select>일
        &nbsp;~&nbsp;
        <select class="date_select" name="year1" >
          <option value="">2019</option>
        </select>년
        <select class="date_select" name="month1" >
          <option value="">05</option>
        </select>월
        <select class="date_select" name="day1" >
          <option value="">20</option>
        </select>일
          &nbsp;&nbsp;
        <input type="button" id="search_btn" name="" value="검색하기" >
      </fieldset>
      <br><br>
      <fieldset id="list_field" >
         <h4 id="sub_title"><b class="symbol_greater_than">></b>산뜻 예약/결제</h4>
        <table id="list_tbl_head"><tr><td id="list_head1">예약내역</td><td id="list_head2">취소내역</td></tr></table>
        <table id="list_tbl_body">
          <tr>
            <td>예약날짜</td>
            <td>예약코드</td>
            <td>상품명</td>
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