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
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/cart/css/cart_list.css?ver=2">
  <title>산뜻 :: 즐거운 산행</title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

  </head>
  <body>
    <div id="wrap">
    <header><?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?></header>
    <hr>
    <!--장바구니 리스트 페이지-->
    <div id="cart_list">
      <h3 id="title" >장바구니</h3>
      <fieldset id="list_field" >
        <table id="list_tbl_body" style="">
          <tr>
            <td><input type="checkbox" name="" value=""></td>
            <td width="800px">상품명/상품코드</td>
            <td>출발일자</td>
            <td>상품가격</td>
          </tr>
          <output id="list_tbl_body_output">
            <tr><td colspan="4" style="padding:40px;">장바구니 내역이 없습니다.</td></tr>
          </output>
        </table>
        <br>
        <input type="button" id="del_btn" value="삭제하기" >
      </fieldset>


    </div> <!-- end of div "reserve_list" -->
    <footer> <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?> </footer>
    </div>  <!-- end of div "wrap" -->
  </body>
</html>
