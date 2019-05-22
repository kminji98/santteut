<div id="logo">
  <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/index.php">
    <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/img/sanlogo.png" border=0></a>
  <div id="menus">
  <ul id="top_menu">
    <li><a href="#">국내산행</a></li>
    <li><a href="#">해외산행</a></li>
    <li><a href="#">날짜별 산행</a></li>
  </ul>
  </div>
  <div id="login_menu">
    <ul id="login_menu_ul" >
      <?php
      // 비회원일때
      if(!isset($_SESSION['id'])){
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

        //관리자일때
      }else if(!($_SESSION['id']=="admin")){
        echo (" {$_SESSION['name']} 님 환영합니다. ");
        echo ('<li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/member/login/logout.php">로그아웃</a></li> ');
        echo ('<li id="top_my" class="hov">관리자모드<small>▼</small>
          <div id="top_my_content">
            <ul id="top_my_content_ul">
              <li><a href="#">상품등록</a></li>
              <li><a href="#">예약/결제목록</a></li>
              <li><a href="#">답변글관리</a></li>
              <li><a href="#">매출관리</a></li>
              <li><a href="#">회원관리</a></li>
            </ul>
          </div>
        </li> ');

        //회원일때
      }else{
        echo (" {$_SESSION['name']} 님 환영합니다. ");
        echo ('<li><a href="#">로그아웃</a></li> ');
        echo ('<li id="top_my" class="hov">My<small>▼</small>
          <div id="top_my_content">
            <ul id="top_my_content_ul">
              <li><a href="#">예약/결제내역</a></li>
              <li><a href="#">참여내역</a></li>
              <li><a href="#">내글관리</a></li>
              <li><a href="#">상담문의</a></li>
              <li><a href="#">장바구니</a></li>
            </ul>
          </div>
        </li> ');
      }
      ?>
  </ul>
  </div>
</div>
