

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css?ver=1">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/customer_support/faq/css/faq.css?ver=1">
    <title>산뜻 :: 즐거운 산행</title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      $("#faq_mini").css("font-weight","bold");
      $("#faq_mini").css("color","black");
      $("#faq_mini").css("font-size","23px");
      $("#li1").click(function(){
        $("#li1_1").slideToggle("fast");
        if($("#li1").css("color")=="rgb(0, 0, 0)"){
          $("#li1").css("color","#2F9D27");
          $("#li1").css("font-weight","bold");
        }else{
          $("#li1").css("color","rgb(0, 0, 0)");
          $("#li1").css("font-weight","normal");
        }
      });
    });
    </script>
  </head>
  <body>
    <div id="wrap">

    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/custom_menu.php";?>
    <!--FAQ 자주 찾는 질문 페이지-->
    <div id="faq_main">
     <br>
     <h1 style="margin-left:15%;"></h1>
     <table id="table1">
       <tr id="faq"><td id="faq_td1"></td><td width="400px"><br></td></tr>
       <tr><td></br></td><td></td></tr>
       <!-- slidetoggle 액션  -->
       <tr><td>➊&nbsp;</td><td id="li1">여권에 이름은 띄어쓰기가 되어 있는데 괜찮나요?</td></tr>
       <tr><td></td><td id="li1_1" style="display:none;">
        <small>항공권 예약은 띄어쓰기가 없습니다.영문 철자만 정확히 입력하셨다면 상관없습니다.</small></td></tr>
       <tr><td>➋&nbsp;</td><td id="li2">항공사 예약번호 확인가능 한가요?</td></tr>
       <tr><td>➌&nbsp;</td><td id="li3">영문 명 & 성별 수정 가능한가요?</td></tr>
       <tr><td>➍&nbsp;</td><td>상품 주문은 어떻게 하나요?</td></tr>
       <tr><td>➎&nbsp;</td><td>상품 주문은 어떻게 하나요?</td></tr>
       <tr><td>➏&nbsp;</td><td>상품 주문은 어떻게 하나요?</td></tr>
       <tr><td>➐&nbsp;</td><td>상품 주문은 어떻게 하나요?</td></tr>
       <tr id="faq"><td id="faq_td1"></td><td width="400px"><br></td></tr>
     </table>
    </div>
    <footer> <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?> </footer>

    </div>

  </body>
</html>
