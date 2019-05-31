<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css?ver=1">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/customer_support/faq/css/faq.css?ver=7">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/side_bar.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <title>산뜻 :: 즐거운 산행</title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      $("#faq_mini").css("font-weight","bold");
      $("#faq_mini").css("color","black");
      for (var i = 1; i <= 8; i++) {
        $("#li"+i).click(function(){
          $("#"+this.id +"_1").slideToggle("fast");
          if($(this).css("color")=="rgb(0, 0, 0)"){
            $(this).css("color","#2F9D27");
            $(this).css("font-weight","bold");
          }else{
            $(this).css("color","rgb(0, 0, 0)");
            $(this).css("font-weight","normal");
          }
        });
      }
    });
    </script>
    <style media="screen">
      #faq_mini{color:red;}
    </style>
  </head>
  <body>
    <div id="wrap">

    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/custom_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/side_bar.php";?>
    <!--FAQ 자주 찾는 질문 페이지-->
    <div id="faq_main" style="height: 600px; max-height:2000px;">
     <br>
     <table id="table1">
       <tr id="faq"><td id="faq_td1"></td><td ><br></td></tr>
       <tr><td></br></td><td></td></tr>
       <!-- slidetoggle 액션  -->
       <tr><td id="li1">➊&nbsp;여권에 이름은 띄어쓰기가 되어 있는데 괜찮나요?</td></tr>
       <tr id="li1_1" style="display:none;"><td >
        <small>항공권 예약은 띄어쓰기가 없습니다.<br>영문 철자만 정확히 입력하셨다면 상관없습니다.</small></td></tr>
       <tr><td id="li2">➊&nbsp;여권에 이름은 띄어쓰기가 되어 있는데 괜찮나요?</td></tr>
       <tr id="li2_1" style="display:none;"><td >
        <small>항공권 예약은 띄어쓰기가 없습니다.<br>영문 철자만 정확히 입력하셨다면 상관없습니다.</small></td></tr>
       <tr><td id="li3">➊&nbsp;여권에 이름은 띄어쓰기가 되어 있는데 괜찮나요?</td></tr>
       <tr id="li3_1" style="display:none;"><td >
        <small>항공권 예약은 띄어쓰기가 없습니다.<br>영문 철자만 정확히 입력하셨다면 상관없습니다.</small></td></tr>
       <tr><td id="li4">➊&nbsp;여권에 이름은 띄어쓰기가 되어 있는데 괜찮나요?</td></tr>
       <tr id="li4_1" style="display:none;"><td >
        <small>항공권 예약은 띄어쓰기가 없습니다.<br>영문 철자만 정확히 입력하셨다면 상관없습니다.</small></td></tr>
       <tr><td id="li5">➊&nbsp;여권에 이름은 띄어쓰기가 되어 있는데 괜찮나요?</td></tr>
       <tr id="li5_1" style="display:none;"><td >
        <small>항공권 예약은 띄어쓰기가 없습니다.<br>영문 철자만 정확히 입력하셨다면 상관없습니다.</small></td></tr>
       <tr><td id="li6">➊&nbsp;여권에 이름은 띄어쓰기가 되어 있는데 괜찮나요?</td></tr>
       <tr id="li6_1" style="display:none;"><td >
        <small>항공권 예약은 띄어쓰기가 없습니다.<br>영문 철자만 정확히 입력하셨다면 상관없습니다.</small></td></tr>
       <tr><td id="li7">➊&nbsp;여권에 이름은 띄어쓰기가 되어 있는데 괜찮나요?</td></tr>
       <tr id="li7_1" style="display:none;"><td >
        <small>항공권 예약은 띄어쓰기가 없습니다.<br>영문 철자만 정확히 입력하셨다면 상관없습니다.</small></td></tr>
       <tr><td id="li8">➊&nbsp;여권에 이름은 띄어쓰기가 되어 있는데 괜찮나요?</td></tr>
       <tr id="li8_1" style="display:none;"><td >
        <small>항공권 예약은 띄어쓰기가 없습니다.<br>영문 철자만 정확히 입력하셨다면 상관없습니다.</small></td></tr>
       <tr id="faq"><td id="faq_td1"></td><td width=""><br></td></tr>
     </table>
    </div>
    <footer> <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?> </footer>

    </div>

  </body>
</html>
