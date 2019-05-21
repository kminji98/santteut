<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/admin/css/admin_add_package.css?ver=0">
    <title>산뜻 :: 즐거운 산행</title>
    <!-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
     $(document).ready(function() {
       $("#dept").click(function(event) {
         window.open();
       });
     });
    </script> -->
    <script type="text/javascript">
      function select_area(){
        var popupX = (window.screen.width / 2) - (800 / 2);
      	var popupY= (window.screen.height /2) - (500 / 2);
      	window.open('../../common/lib/google3.php', '', 'status=no, width=800, height=500, left='+ popupX + ', top='+ popupY + ', screenX='+ popupX + ', screenY= '+ popupY);
      }
    </script>
  </head>

  <body>
    <!--로그인 회원가입 로그아웃-->
    <div id="wrap">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>

    <div id="content">
      <br><br>
      <h2>패키지 등록</h2><br>
      <table id="insert_form">
        <tr>
          <td><p>패키지 코드</p></td>
          <td> <input type="text" name="" value="" readonly> </td>
        </tr>

        <tr>
          <td><p>메인 이미지</p></td>
          <td>  <?php echo '<input type="file" name="upfile">';?> </td>
        </tr>

        <tr>
          <td><p>패키지 이름</p></td>
          <td> <input type="text" name="" value="" size="50"> </td>

        </tr>

        <tr>
          <td><p>패키지 기간</p></td>
          <td> <select  name="">
            <option value="">기간선택</option>;
            <?php
              for($i=1;$i<=9;$i++){
            ?>
            <option value=""><?=$i?>일</option>;
            <?php
              if($i==9){
            ?>
            <option value="">10일 이상</option>;
            <?php
              }
            }
            ?>
          </select> </td>
        </tr>

        <tr>
          <td><p>출발일</p></td>
          <td> <input type="date" name="" value="" > </td>
        </tr>

        <tr>
          <td><p>출발 시간</p></td>
          <td> <input type="time" name="" value=""> </td>
        </tr>

        <tr>
          <td><p>도착 시간</p></td>
          <td> <input type="time" name="" value=""> </td>
        </tr>

        <tr>
          <td><p>패키지 요금</p></td>
          <td> <input type="text" name="" value=""><b>원</b> </td>
        </tr>

        <tr>
          <td><p>추가요금</p></td>
          <td> <b>Y</b><input type="radio" name="add" value=""> <b>N</b><input type="radio" name="add" value=""> </td>
        </tr>

        <tr>
          <td><p>자유일정</p></td>
          <td> <b>Y</b><input type="radio" name="free" value=""> <b>N</b><input type="radio" name="free" value=""> </td>
        </tr>

        <tr>
          <td><p>출발지</p></td>
          <td> <input type="text" name="" value="" onclick="select_area()"> </td>
        </tr>

        <tr>
          <td><p>도착지</p></td>
          <td> <input type="text" name="" value="" onclick="select_area()"> </td>
        </tr>

        <tr>
          <td><p>버스선택</p></td>
          <td><b>일반</b><input type="radio" name="bus" value=""><b>우등</b><input type="radio" name="bus" value=""></td>
        </tr>

        <tr>
          <td><p>상세페이지</p></td>
          <td> <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/editor/editor.php"; ?> </td>
        </tr>
      </table><br><br><br>
    </div>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>

    </div>

  </body>
</html>
