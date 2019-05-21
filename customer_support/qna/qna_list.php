<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/customer_support/qna/css/qna_list.css">
    <title>문의하기</title>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/mini_menu.php";?>
    </header>
    <br><br><br>
    <section id="qna">
      <div class="qna_list_search">
        <select>
          <option value="">제목</option>
          <option value="">내용</option>
          <option value="">작성자</option>
        </select>
        <input type="text" name="" value="">
        <button type="button" name="button">검색</button>
      </div>
      <br>
      <table border="1">
        <tr>
          <th>번호</th>
          <th id="qna_list_title" style="width:490px;">제목</th>
          <th>작성자</th>
          <th>작성일</th>
          <th>조회</th>
          <th>답변</th>
        </tr>

      </table>
    <br>
    <button id="admin_write_btn" type="button" name="button">글쓰기</button>
    <br>
      <div class="page_button_group">
        <button type="button" name="button"><</button>
        <button type="button" name="button"><<</button>
        <button type="button" name="button">1</button>
        <button type="button" name="button">2</button>
        <button type="button" name="button">3</button>
        <button type="button" name="button">4</button>
        <button type="button" name="button">5</button>
        <button type="button" name="button">6</button>
        <button type="button" name="button">7</button>
        <button type="button" name="button">8</button>
        <button type="button" name="button">9</button>
        <button type="button" name="button">10</button>
        <button type="button" name="button">></button>
        <button type="button" name="button">>></button>
      </div>
    </section>
<br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
