<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/introduction/css/history.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/css/login.css?ver=1.1">
    <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
    <script type="text/javascript">
      window.addEventListener('load', function() {
        var naver_id_login = new naver_id_login("SrlAW6CBDScYywp943rw", "http://localhost/santteut/member/login/naver_callback.html");
        var state = naver_id_login.getUniqState();
        naver_id_login.setButton("green", 3,38);
        naver_id_login.setDomain("http://localhost/santteut/index.php");
        naver_id_login.setState(state);
        naver_id_login.setPopup();
        naver_id_login.init_naver_id_login();
      });

      function login_action(){
        if(login_form.login_id.value == ''){
          alert('ID를 입력하세요.');
          login_form.login_id.focus();
          return false;
        }
        if(login_form.login_passwd.value == ''){
          alert('패스워드를 입력하세요.');
          login_form.login_passwd.focus();
          return false;
        }

        document.login_form.submit();
      }
    </script>
    <title>로그인</title>
  </head>
  <body >
    <!--로그인 회원가입 로그아웃-->
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
    <section id="login">
    <hr>
    <h2>로그인</h2>
    <hr>
    <div class="login_div">
      <h3> 로그인</h3>

      <table>
       <form name="login_form" action="login_query.php" method="post">
         <input type="hidden" name="mode" value="login">
        <tr>
          <th><label>아이디</label></th>
          <td><input type="text" name="login_id"></td>
          <th rowspan="2"><button type="button" name="button" id="login_button" onclick="login_action()">로그인</button> </th>
        </tr>
        <tr>
          <th><label>비밀번호</label> </th>
          <td><input type="password" name="login_passwd"></td>
        </tr>
      </form>
        <tr>
          <td id="empty_row" colspan="3"><br></td>
        </tr>
        <tr><td id="id_storage" colspan="3"><input type="checkbox" name="id_storage">아이디저장&nbsp;&nbsp;<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/join/join_member.php"><b>회원가입</b></a></td></tr>
        <tr>
          <td id="empty_row" colspan="3"><br></td>
        </tr>
        <tr><td colspan="3">&nbsp;&nbsp;<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/forgot_id.php">아이디 찾기</a>&nbsp; / &nbsp;<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/forgot_passwd.php">패스워드 찾기</a></td></tr>
        <tr>
          <td id="empty_row" colspan="3"><br></td>
        </tr>
        <tr>
          <td colspan="3">
            <div id="naver_id_login" style="display:inline;">
            </div>
            <script type="text/javascript">
              var naver_id_login = new naver_id_login("SrlAW6CBDScYywp943rw", "http://localhost/santteut/member/login/naver_callback.html");
              var state = naver_id_login.getUniqState();
              naver_id_login.setButton("green", 3,38);
              naver_id_login.setDomain("http://localhost/santteut/index.php");
              naver_id_login.setState(state);
              naver_id_login.setPopup();
              naver_id_login.init_naver_id_login();
            </script>
            <?php include_once './facebook.php'; ?>
            <?php 	echo '<a href="' . $loginUrl . '">'; ?><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/img/facebook.jpg" alt="페이스북계정로그인"></a><br>
              <a href="kakao.php"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/img/kakao.jpg" alt="카카오계정로그인"></a>
            <a href="#"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/img/google.jpg" alt="구글계정로그인"></a>
          </td>
        </tr>
      </table>
    </div>
    </section>
  <br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
