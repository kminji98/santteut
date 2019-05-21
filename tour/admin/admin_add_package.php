<?php
session_start();
include '../../common/lib/db_connector.php';
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/admin/css/admin_add_package.css?ver=1">
    <title>산뜻 :: 즐거운 산행</title>

    <script type="text/javascript">
      function select_area(){
        var popupX = (window.screen.width / 2) - (800 / 2);
      	var popupY= (window.screen.height /2) - (500 / 2);
      	window.open('../../common/lib/google3.php', '', 'status=no, width=800, height=500, left='+ popupX + ', top='+ popupY + ', screenX='+ popupX + ', screenY= '+ popupY);
      }
      function check_input(){
        if(!document.add_package.p_name.value){
        	alert("이름을 입력해주세요");
        	document.add_package.name.focus();
        	return ;
        }
        document.add_package.submit();
      }
    </script>

    <!-- 패키지 코드 랜덤 생성 -->
    <?php
    $package_str = "";
        for($i=0;$i<2;$i++) {
            $capi = rand()%26+65;
            $package_str .= chr($capi);
        }
    $package_num = mt_rand(100000, 999999);
    $package_number = $package_str . $package_num;
    ?>
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
      <form name="add_package" action="admin_add_package_query.php" method="post">

      <table id="insert_form">
        <tr>
          <td><p>패키지 코드</p></td>
          <td> <input type="text" name="p_code" value="<?=$package_number?>" readonly> </td>
        </tr>

        <tr>
          <td><p>메인 이미지</p></td>
          <td>  <input type="file" class="up_img" name="p_main_img1"> <input type="file" class="up_img" name="p_main_img2"> <input type="file" class="up_img" name="p_main_img3"> </td>
        </tr>

        <tr>
          <td><p>패키지 이름</p></td>
          <td> <input type="text" name="p_name" value="" size="50"> </td>

        </tr>

        <tr>
          <td><p>패키지 기간</p></td>
          <td> <select  name="p_period">
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
          <td> <input type="date" name="p_dp_date" value="" > </td>
        </tr>

        <tr>
          <td><p>출발 시간</p></td>
          <td> <input type="time" name="p_dp_time" value=""> </td>
        </tr>

        <tr>
          <td><p>도착 시간</p></td>
          <td> <input type="time" name="p_arr_time" value=""> </td>
        </tr>

        <tr>
          <td><p>패키지 요금</p></td>
          <td> <input type="text" name="p_pay" value=""><b>원</b> </td>
        </tr>

        <tr>
          <td><p>추가요금</p></td>
          <td> <b>Y</b><input type="radio" name="p_add_pay" value="Y"> <b>N</b><input type="radio" name="p_add_pay" value="N"> </td>
        </tr>

        <tr>
          <td><p>자유일정</p></td>
          <td> <b>Y</b><input type="radio" name="p_free_time" value="Y"> <b>N</b><input type="radio" name="p_free_time" value="N"> </td>
        </tr>

        <tr>
          <td><p>출발지</p></td>
          <td> <input type="text" name="p_dp_city" value="" onclick="select_area()"> </td>
        </tr>

        <tr>
          <td><p>도착지</p></td>
          <td> <input type="text" name="p_arr_mt" value="" onclick="select_area()"> </td>
        </tr>

        <tr>
          <td><p>버스선택</p></td>
          <td><b>일반</b><input type="radio" name="p_bus" value="28"><b>우등</b><input type="radio" name="p_bus" value="41"></td>
        </tr>

        <tr>
          <td><p>상세페이지</p></td>
          <td> <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/editor/editor.php"; ?> </td>
        </tr>
      </table><br><br><br>
      <input type="button" id="insert_btn" onclick="check_input()" value="등록">
      </form>
    </div>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>

    </div>

  </body>
</html>
