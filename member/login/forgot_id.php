<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forgot ID</title>
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/login/css/login.css">
  </head>
  <body>
    <div class="login_form">
      <h3>Forgot ID</h3>
      <table border="1">
        <tr>
          <th><label><h4>이메일로 찾기</h4></label></th>
          <th><label><h4>핸드폰으로 찾기</h4></label></th>
          <th></th>
        </tr>
        <tr>
          <th><label>이메일</label></th>
          <td><input type="email" name="find_email"></td>
          <td> <button type="button" name="button">보내기</button></td>
        </tr>
        <tr>
          <td colspan="3">이메일로 아이디를 가르켜드립니다.</td>
        </tr>
      </table>
    </div>
  </body>
</html>
