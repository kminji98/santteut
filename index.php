<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/create_table.php";
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./search.css?ver=0">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css?ver=3">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <title>산뜻 :: 즐거운 산행</title>
  </head>

  <body>

    <!--로그인 회원가입 로그아웃-->
    <div id="wrap">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>

    <!--검색(국가명/도시명/산이름)-->

      <div id="main_search">
        <br><br><br><br><br><br><br>
        <div id="search1" >
        <form name="main_search_form" action="./tour/package/main_search_list.php" method="post" style=" margin-left: 32%;">
          <div class="search_center" style="background-color: rgba(22, 43, 62, 0.48); width: 50%; height: 150px;">
            <div id="search_div" style="width:95%; padding: 20px;">
              <input type="text" id="tex1" style="margin-right: 1%; text-align:center;" onkeydown="JavaScript:main_search2()"  name="search" size="30" placeholder="국가명 / 도시명 / 산 이름으로 검색">

              <input type="hidden" name="main_search_word" id="main_search_word" value="">
              <i class='fas fa-search' style='font-size:36px' onclick="main_search()"></i>

              <!-- <button type="button" name="button" onclick="main_search()">검색</button> -->
            </div>
            <b style="color: white; margin-left: 3%; font-weight:normal;">추천산행 : 수락산, 지리산</b>
          </div>

        </form>
        </div>
      </div>

    <script type="text/javascript">
      function main_search(){
        var tex1 = document.getElementById('tex1');
        var word = document.getElementById('main_search_word');
        word.value = tex1.value;
        document.main_search_form.submit();
      }


      function main_search2(){
        if(event.keyCode == 13){
          var tex1 = document.getElementById('tex1');
          var word = document.getElementById('main_search_word');
          word.value = tex1.value;
          document.main_search_form.submit();
        }
      }
      
    </script>

<br>
<br>
<br>
    <!--인기 산행 일정 TOP3-->
    <div id="main_big3">
      <h2>산뜻에서 산행을 시작하세요!</h2>
      <div id="best3">
        <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/best3.php";?>
      </div>
    </div>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer id="foo">
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>

    </div>

  </body>
</html>
