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
