<div id="logo">
  <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/index.php">
    <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/img/sanlogo.png" border=0></a>
  <div id="menus">
  <ul id="top_menu">
    <li><a href="#">국내산행</a></li>
    <li><a href="#">해외산행</a></li>
    <li><a href="#">날짜별 산행</a></li>
  </ul><!-- end of nav_menu1 -->
  </div>
  <div id="login_menu">
    <ul id="login_menu_ul" >
    <?php
    if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
      echo ('<li ><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/member/login/login.php" class="hov">로그인</a></li>');
      echo ('<li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/member/join/join_member.php" class="hov">회원가입</a></li>');
      echo ('<li id="top_my" class="hov">커뮤니티<small>▼</small>
        <div id="top_my_content">
          <ul id="top_my_content_ul">
            <li><a href="#">자유게시판</a></li>
            <li><a href="#">명산정보</a></li>
            <li><a href="#">공식산행후기</a></li>
          </ul>
        </div>
      </li> ');
    }else if(!($_SESSION['id']=="admin")){
      echo (" {$_SESSION['id']} 님 환영합니다. ");
      echo ('<li><a href="#">로그아웃</a></li> ');
      echo ('<li><a href="#">My</a></li> ');
      echo ('<li><a href="#">커뮤니티</a></li> ');
    }
    ?>
  </ul>
  </div>
</div>
