<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/css/forgot_id.css?ver=1">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/introduction/css/history.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <title>아이디/패스워드 찾기</title>
    <script type="text/javascript">
    $(document).ready(function(){
      $("#forgot_id").click(function(){
        $("#id").css('display', 'none');
      });
      $("#forgot_pw").click(function(){
        $("#id").css('display', 'inherit');
        document.getElementById("id_input").colSpan = "2";
      });
    });

    </script>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
    <section id="forgot_id_pw">
    <div class="forgot_id_pw_form">
      <br>
      <br>
      <br>
      <br>
      <br>
      <table>
        <tr>
          <th id="forgot_id"  >ID찾기</th>
          <th id="forgot_pw">비밀번호찾기</th>
          <th style="border:0;"></th>
        </tr>
        <tr>
          <td id="find_by_email">이메일로 찾기</td>
          <td id="find_by_phone">핸드폰으로 찾기</td>
          <td></td>
        </tr>
        <tr id="id">
          <td>ID</td>
          <td colspan="2" id="id_input"><input type="text" name="" value="">  </td>
        </tr>
        <tr>
          <td style="height:1%;">이메일</td>
          <td colspan="2">
            <input type="text" name="email1" value="" size="7"> @
            <input type="text" name="email2" value="" size="7">
            <button type="button" name="button" style="font-size: 13px;">인증하기</button>
          </td>

        </tr>
        <tr>
          <td colspan="3">본인확인 이메일 주소와 입력한 이메일 주소가 같아야,
            인증번호를 받을 수 있습니다.</td>
        </tr>
      </table>
    </div>
    </section>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
