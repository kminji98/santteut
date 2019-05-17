<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>회원가입</title>
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/introduction/css/history.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/join/css/join_member.css">
  </head>
  <body>
    <!--로그인 회원가입 로그아웃-->
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
    <h2>회원가입</h2>
    <hr>
    <div class="login_form">
      <h3>회원가입</h3>
      <table border="1">
        <!--필수입력사항-->
        <tr>
          <th><span>*</span><label>필수입력사항</label></th>
          <td><input type="text" name="join_id" placeholder="영문소문자/숫자 4~16자"></td>
          <td></td>
          <td><button type="button" name="button" id="">중복확인</button></td>
        </tr>

        <!--아이디-->
        <tr>
          <th><label>아이디</label><span>*</span></th>
          <td><input type="text" name="join_id" placeholder="영문소문자/숫자 4~16자"></td>
          <td></td>
          <td><button type="button" name="button" id="">중복확인</button></td>
        </tr>

        <!--비밀번호-->
        <tr>
          <th><label>비밀번호</label><span>*</span></th>
          <td><input type="password" name="join_passwd" placeholder="영문대소문자/숫자 4~16자"></td>
          <td></td>
          <td></td>
        </tr>

        <!--비밀번호확인-->
        <tr>
          <th><label>비밀번호확인</label><span>*</span></th>
          <td><input type="password" name="join_passwdconfirm" placeholder="영문대소문자/숫자 4~16자"></td>
          <td></td>
          <td></td>
        </tr>

        <!--이름-->
        <tr>
          <th><label>이름</label><span>*</span></th>
          <td><input type="text" name="join_name"></td>
          <td></td>
          <td></td>
        </tr>

        <!--주소_우편번호-->
        <tr>
          <th><label>주소</label><span>*</span></th>
          <td><input type="text" name="join_zip"></td>
          <td></td>
          <td><button type="button" name="button">우편번호</button></td>
        </tr>

        <!--주소_기본-->
        <tr>
          <th><label>주소</label><span>*</span></th>
          <td><input type="text" name="join_foundational"></td>
          <td></td>
          <td></td>
        </tr>

        <!--주소_상세-->
        <tr>
          <th><label>주소</label><span>*</span></th>
          <td><input type="text" name="join_detail"></td>
          <td></td>
          <td></td>
        </tr>

        <!--일반전화-->
        <tr>
          <th><label>일반전화</label></th>
          <td><input type="tel" name="join_landline"></td>
          <td></td>
          <td></td>
        </tr>

        <!--휴대전화-->
        <tr>
          <th><label>휴대전화</label><span>*</span></th>
          <td><section>
            <option value="010"></option>
            <option value="011"></option>
            <option value="016"></option>
            <option value="017"></option>
            <option value="018"></option>
            <option value="019"></option>
          </section></td>
          <td><input type="tel" name="join_cellphone"></td>
          <td></td>
        </tr>
      </table>
    </div>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
