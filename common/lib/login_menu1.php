<div id="logo">
  <a href="index.php"><img src="./common/img/logo.png" border=0></a>

  <div id="menus">
  <ul id="top_menu">
    <li><a href="#">국내산행</a></li>
    <!-- <small>|</small>  -->
    <li><a href="#">해외산행</a></li>

    <li><a href="#">날짜별 산행</a></li>
  </ul><!-- end of nav_menu1 -->
  </div>

  <div id="login_menu">
    <?php
    if(!isset($_SESSION['id'])){
      echo ('<a href="#">로그인</a> ');
      echo ('<a href="#">회원가입</a> ');
      echo ('<a href="#">커뮤니티</a> ');
    }else if(!($_SESSION['id']=="admin1")){
      echo (" {$_SESSION['id']} 님 환영합니다. ");
      echo ('<a href="#">로그아웃</a> ');
      echo ('<a href="#">My</a> ');
      echo ('<a href="#">커뮤니티</a> ');
    }
    ?>
  </div>
</div>
<!-- end of logo -->


&nbsp;

<!--국내산행 해외산행 부분-->
