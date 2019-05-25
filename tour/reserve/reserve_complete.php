<?php
/*
=================================================================
+ [DESC] 장바구니 목록
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
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/reserve/css/reserve_complete.css">
  <title>산뜻 :: 즐거운 산행</title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

  </head>
  <body>
    <div id="wrap">
    <header><?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?></header>
    <hr>
    <!--장바구니 리스트 페이지-->
    <div id="cart_list">
      <h2 id="title" >예약완료</h2>
      <div id="done_content">

      <h3 id="done_text">예약이 정상적으로 완료되었습니다</h3>
      <p id="p1">예약정보는 <b>예약 내역확인</b>에서 다시 확인하실 수 있으며, 이메일로도 확인 가능합니다.</p>
      <p id="p2">※고객님! 예금주가 산뜻인지 확인해주세요. 산뜻은 고객 직접입금을 권장합니다.</p>
      <fieldset id="list_field2" >
        <table id="list_tbl_body2" style="">
          <tr>
            <td class="tbl_left">예약코드</td>
            <td width="800px">코드값</td>
          </tr>
          <tr>
            <td class="tbl_left" id="name_td">상품명</td>
            <td>상품명</td>
          </tr>
          <tr>
            <td class="tbl_left">예약인원</td>
            <td>총 1명 (성인 1명)</td>

          </tr>
        </table>
        <br>
        <input type="button" id="res_btn" value="예약내역 확인하기" >
      </fieldset>
      </div>

    </div> <!-- end of div "reserve_list" -->
    <footer> <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?> </footer>
    </div>  <!-- end of div "wrap" -->
  </body>
</html>
