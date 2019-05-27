<?php
session_start();

// isset함수는 불리언값을 리턴 true or false
// 회원 or 비회원이면 권한없음, 관리자일때만 입장
if(!isset($_SESSION['id'])){
  echo "<script>alert('권한없음.');history.go(-1);</script>";
  exit;
}

$name = $_SESSION['name'];

//0-0. 인클루드 디비
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

//0-1. 인클루드 크리테이블
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/create_table_base.php";
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/revenue/css/revenue_management.css?ver=0">
    <title>매출관리</title>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>

    <section id="revenue">
      <h1>SANTTEUT REVENUE MANAGEMENT</h1>
      <div>
      <div><h4>매출 내역</h4></div>
      <form name="month_form" action="admin_flight_sales.php" method="post">
         <select name="find_option">
               <option value="">2018년</option>
               <option value="">2019년</option>
               <option value="">2020년</option>
               <option value="">2021년</option>
          </select>
          <input type="submit"name="find_input" value="검색">
      </form>
      <div id="linechart"></div>
      <hr>
      <button id="btnExport">매출 내역 상세확인</button>
      <div>
      <table>

      </table>
      </div>
    </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
  </footer>
  </body>
</html>
