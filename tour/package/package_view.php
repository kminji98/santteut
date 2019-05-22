<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css?ver=5">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/package/css/package_view.css?ver=2">

    <title>산뜻 :: 즐거운 산행</title>
  </head>
    <script type="text/javascript">

    </script>
  <body>
    <!--로그인 회원가입 로그아웃-->
    <div id="wrap">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
    <!-- 윗부분  -->
    <div id="head" >
      <div id="top_box">

      <div id="code"><p>상품코드:11111</p></div>
      <div id="name"><b>패키지 이름</b> <p>간단설명</p> </div>
      <div id="image_zone">
        <img src="../../common/img/lights.jpg" alt="">
        <img src="../../common/img/lights.jpg" alt="">
        <img src="../../common/img/lights.jpg" alt="">
      </div>
      </div>
    </div>
    <!-- 일정 방문도시 예약현황  -->
    <div id="middle">

      <table id="toptbl">
        <tr>
          <td rowspan="3" class="left" id="sch">일정</td>
          <td id="period">6일</td>
        </tr>

        <tr>
          <td id="go"><div class="gb">한국출발</div> </td>

        </tr>

        <tr>
          <td id="back"><div class="gb" >한국도착</div> </td>

        </tr>

        <tr>
          <td class="left" id="arr" >도착산</td>
          <td id="arr_mt">???</td>
        </tr>

        <tr>
          <td class="left" id="res">예약현황</td>
          <td id="res_now">예약: 0명 좌석: 40 (최소출발 20명)</td>
        </tr>
      </table>

      <div id="detail_view1">
        <p class="d1">상</p>
        <p class="d1">세</p>
        <p class="d1">페</p>
        <p class="d1">이</p>
        <p class="d1">지</p>
        <p class="d1">입</p>
        <p class="d1">니</p>
        <p class="d1">다</p>
      </div>
    </div>

    <div id="detail_menu">
      <div id="select_people">
        <p id="adult">성인</p>
        <p id="kid">아동</p>
        <p id="baby">유아</p>
        <select id="sel1" name="">
          <option value="1">1</option>
          <option value="">2</option>
          <option value="">3</option>
          <option value="">4</option>
          <option value="">5</option>
          <option value="">6</option>
          <option value="">7</option>
          <option value="">8</option>
          <option value="">9</option>
          <option value="">10</option>
        </select>

        <select id="sel2" name="">
          <option value="">0</option>
          <option value="">1</option>
          <option value="">2</option>
          <option value="">3</option>
          <option value="">4</option>
          <option value="">5</option>
          <option value="">6</option>
          <option value="">7</option>
          <option value="">8</option>
          <option value="">9</option>
          <option value="">10</option>
        </select>

        <select id="sel3" name="">
          <option value="">0</option>
          <option value="">1</option>
          <option value="">2</option>
          <option value="">3</option>
          <option value="">4</option>
          <option value="">5</option>
          <option value="">6</option>
          <option value="">7</option>
          <option value="">8</option>
          <option value="">9</option>
          <option value="">10</option>
        </select>
      </div>
      <div id="pay_view">
        <p id="total_pay">총 예정금액</p>
        <b id="money">999,000</b> <p id="won">원</p>
        <p class="subtext1">유류할증료,제세공과금 포함</p>
        <p class="subtext1">※유류할증료 및 제세공과금은 유가와 환율에</p>
        <p class="subtext1">따라 변동될 수 있습니다.</p>
        <p class="subtext1">※ 아동, 유아요금은 성인 2인과 같은 방 사용조건이며,</p>
        <p class="subtext1">미충족시 아동추가 요금이 발생합니다.</p>
        <p class="subtext1">※ 1인 객실 사용시 추가요금 발생</p>
        <p id="line">-------------------------------------------------------------------</p>
      </div>
      <div id="button">
        <a href="../reserve/reserve_view.php"><div id="reserve_status"> <b>예약마감</b></div></a><br>
        <a href="../cart/cart_list.php"><div id="go_cart"> <b>장바구니</b></div></a>
      </div>
      <div id="right_footer"></div>
    </div>

    </div>
  </body>


<br><br><br>
<footer>
  <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
</footer>
</html>
