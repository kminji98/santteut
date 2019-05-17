<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>

    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css?ver=0">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/customer_support/faq/css/faq.css?ver=0">
    <title>산뜻 :: 즐거운 산행</title>
  </head>
  <body>
    <div id="wrap">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
    <!--FAQ 자주 찾는 질문 페이지-->
    <div>
     <br>
     <h1 style="margin-left:15%;"></h1>
     <table id="table1">
       <tr id="faq"><td><b>FAQ</b></td><td><br></td></tr>
       <tr><td>➊&nbsp;&nbsp;&nbsp;</td><td>상품 주문은 어떻게 하나요?</td></tr>
       <tr><td>➊&nbsp;&nbsp;&nbsp;</td><td>상품 주문은 어떻게 하나요?</td></tr>
       <tr><td>➊&nbsp;&nbsp;&nbsp;</td><td width="400px">상품 주문은 어떻게 하나요?</td></tr>
     </table>
    </div>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>

    </div>

  </body>
</html>
