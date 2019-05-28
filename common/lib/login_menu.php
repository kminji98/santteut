<!-- =================================================================
+ [DESC] 로그인 메뉴 수정
+ [DATE] 2019-05-27
+ [NAME] 이우주
================================================================= -->
<div id="logo">
  <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/index.php">
    <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/img/sanlogo.png" border=0></a>
  <div id="menus">
  <ul id="top_menu">
    <li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/package/package_list.php?divide=domestic">국내산행</a></li>
    <li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/package/package_list.php?divide=abroad">해외산행</a></li>
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
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/community/free/free_list.php" class="hov">자유게시판</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/community/mt_information/mt_information_list.php" class="hov">명산정보</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/community/official_review/official_review_list.php" class="hov">공식산행후기</a></li>
            </ul>
          </div>
        </li> ');

        //관리자일때
      }else if($_SESSION['id']=="admin"){
        echo ("<b> {$_SESSION['name']} </b> 님 환영합니다. ");
        echo ('<li id="logout">[<a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/member/login/logout.php">로그아웃</a>]</li> ');
        echo ('<li id="top_my" class="hov">관리자모드<small>▼</small>
          <div id="top_my_content">
            <ul id="top_my_content_ul">
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/tour/admin/admin_add_package.php" class="hov">상품등록</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/tour/admin/admin_manage_package.php" class="hov">상품관리</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/tour/reserve/reserve_list.php" class="hov">예약/결제목록</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/customer_support/qna/qna_list.php" class="hov">답변글관리</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/revenue/revenue_management.php" class="hov">매출관리</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/member/admin/member_admin_list.php" class="hov">회원관리</a></li>
            </ul>
          </div>
        </li>&nbsp;&nbsp;');
        echo ('<li id="top_my" class="hov">커뮤니티<small>▼</small>
          <div id="top_my_content">
            <ul id="top_my_content_ul">
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/community/free/free_list.php" class="hov">자유게시판</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/community/mt_information/mt_information_list.php" class="hov">명산정보</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/community/official_review/official_review_list.php" class="hov">공식산행후기</a></li>
            </ul>
          </div>
        </li>&nbsp;');

        //회원일때
      }else{
        echo ("<b> {$_SESSION['name']} </b> 님 환영합니다. ");
        echo ('<li id="logout">[<a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/member/login/logout.php">로그아웃</a>]</li> ');
        echo ('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li id="top_my" class="hov">My<small>▼</small>
          <div id="top_my_content">
            <ul id="top_my_content_ul">
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/?" class="hov">쪽지</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/member/join/join_edit.php" class="hov">정보수정</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/mypage/myboard/myboard.php" class="hov">참여내역</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/tour/reserve/reserve_list.php" class="hov">예약/결제내역</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/customer_support//qna/qna_form.php" class="hov">상담문의</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/tour/cart/cart_list.php" class="hov">장바구니</a></li>
            </ul>
          </div>
        </li> ');
        echo ('<li id="top_my" class="hov">커뮤니티<small>▼</small>
          <div id="top_my_content">
            <ul id="top_my_content_ul">
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/community/free/free_list.php" class="hov">자유게시판</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/community/mt_information/mt_information_list.php" class="hov">명산정보</a></li>
              <li><a href="http://'.$_SERVER['HTTP_HOST'].'/santteut/community/official_review/official_review_list.php" class="hov">공식산행후기</a></li>
            </ul>
          </div>
        </li> ');
      }
      ?>
  </ul>
  </div>
</div>
