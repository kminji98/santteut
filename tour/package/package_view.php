<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/tour/lib/tour_query.php";
if(isset($_COOKIE["cookie2"])){  setcookie("cookie3",$_COOKIE["cookie2"],time() + 3600);  }
if(isset($_COOKIE["cookie1"])){  setcookie("cookie2",$_COOKIE["cookie1"],time() + 3600);  }
setcookie("cookie1",$p_code,time() + 3600);
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/package/css/package_view.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/member_review/css/member_review_list.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/side_bar.css">
    <title>산뜻 :: 즐거운 산행</title>
  </head>
    <script type="text/javascript">
    window.onload = function() {
      onload_button_status();
      var middle=document.getElementById('middle');
      var wrap=document.getElementById('wrap');
      var wrap=document.getElementById('wrap');
      var plus=wrap.offsetHeight;
      var middle=document.getElementById('middle');
      // var middle=middle.offsetHeight;
      // wrap.height=detail_view1.offsetHeight;
      // middle.height=detail_view1.offsetHeight;
      // alert(middle.height);
      wrap.style.height=parseInt(middle.offsetHeight)+615+"px";
      alert(parseInt(detail_view1.offsetHeight));
      // alert(parseInt(plus));
      // alert(parseInt(middle));
      // body_1.style.height=detail_view1.offsetHeight+"px";
    }


    // window.onscroll = function() {
    //     window.onscroll = function() {
    //   var detail_view1=document.getElementById('detail_view1');
    //   var wrap=document.getElementById('wrap');
    //   var middle=document.getElementById('middle');
    //   // wrap.style.height=detail_view1.offsetHeight+"px";
    //
    //   // middle.style.height=detail_view1.offsetHeight+"px";
    //   // alert(wrap.style.height);
    //   }
    // }

    </script>


  <body id="body_1">
    <!--로그인 회원가입 로그아웃-->
    <div id="wrap">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
        <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/side_bar.php";?>
    <!-- 윗부분  -->
    <div id="head" >
      <div id="top_box">

      <div id="code"><p>상품코드:<?= $p_code?></p></div>
      <div id="name"><b><?= $p_name?></b> <p><?=$p_arr_mt?> 트레킹 코스 중 가장 인기있는 코스. <?=$p_arr_mt?> 정상까지 가는 일정 입니다.</p> </div>
      <div id="image_zone">
        <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/lib/editor/data/<?=$p_main_img_copy1?>" alt="">
        <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/lib/editor/data/<?=$p_main_img_copy2?>" alt="">
        <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/lib/editor/data/<?=$p_main_img_copy3?>" alt="">
      </div>
      </div>
    </div>
    <!-- 일정 방문도시 예약현황  -->
    <div id="middle">

      <table id="toptbl">
        <tr>
          <td rowspan="3" class="left" id="sch">일정</td>
          <td id="period"><?=$p_period?>일</td>
        </tr>

        <tr>
          <td id="go"><div class="gb" style="display:inline-block;">한국출발</div> <?php echo $dp_date[0]."년 ".$dp_date[1]."월 ".$dp_date[2]."일 "." (".$day.") ".$p_dp_time ?></td>
        </tr>

        <tr>
          <td id="back"><div class="gb" style="display:inline-block;" >한국도착</div> <?php echo $dp_date2[0]."년 ".$dp_date2[1]."월 ".$dp_date2[2]."일 "." (".$day2.") ".$p_arr_time ?> </td>

        </tr>

        <tr>
          <td class="left" id="arr" >도착산</td>
          <td id="arr_mt"><?=$p_arr_mt?></td>
        </tr>

        <tr>
          <td class="left" id="res">예약현황</td>
          <td id="res_now">예약: <?=$total?>명 좌석: <?=$p_bus?>석 (최소출발 <?=$p_bus_half?>명)</td>
        </tr>
      </table>

      <div id="detail_view1">
        <?=$p_detail_content?>
      </div>

    </div>


    <div id="detail_menu">
      <div id="select_people">
        <p id="adult">성인</p>
        <p id="kid">아동</p>
        <p id="baby">유아</p>
        <script type="text/javascript">
          var adult_pay=parseInt(<?=json_encode($p_pay)?>);
          var kid_pay=0;
          var baby_pay=0;
          var member =1;
          var member2=0;
          var member3=0;
          function select_people_number(person){
            var pay=<?=json_encode($p_pay)?>;
            var money=document.getElementById('money');
            var adult_val=document.getElementById('adult_val');
            var kid_val=document.getElementById('kid_val');
            var baby_val=document.getElementById('baby_val');

            if(person=="adult"){
            var sel1 =document.getElementById('sel1');
            member = parseInt(sel1.options[sel1.selectedIndex].text);
            pay = pay*member;
            adult_pay=pay;

          }else if (person=="kid") {
            var sel2 =document.getElementById('sel2');
            member2 = parseInt(sel2.options[sel2.selectedIndex].text);
            pay = pay*member2*0.7;
            kid_pay=pay;

          }else if (person=="baby") {
            var sel3 =document.getElementById('sel3');
            member3 = parseInt(sel3.options[sel3.selectedIndex].text);
            pay = pay*member3*0.5;
            baby_pay=pay;
          }
            money.innerHTML=(adult_pay+kid_pay+baby_pay).toLocaleString();
            adult_val.value=member;
            kid_val.value=member2;
            baby_val.value=member3;
          }
        </script>
        <select id="sel1" onclick="select_people_number('adult')" name="">
          <option  value="1" >1</option>
          <option  value="2">2</option>
          <option  value="3">3</option>
          <option  value="4">4</option>
          <option  value="5">5</option>
          <option  value="6">6</option>
          <option  value="7">7</option>
          <option  value="8">8</option>
          <option  value="9">9</option>
          <option  value="10">10</option>
        </select>

        <select id="sel2" onclick="select_people_number('kid')" name="">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
        </select>

        <select id="sel3" onclick="select_people_number('baby')" name="">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
        </select>
      </div>
      <div id="pay_view">
        <p id="total_pay">총 예정금액</p>
        <?php
        $p_pay= number_format($p_pay);
         ?>
        <b id="money"><?=$p_pay?></b> <p id="won">원</p>
        <p class="subtext1">유류할증료,제세공과금 포함</p>
        <p class="subtext1">※유류할증료 및 제세공과금은 유가와 환율에</p>
        <p class="subtext1">따라 변동될 수 있습니다.</p>
        <p class="subtext1">※ 아동, 유아요금은 성인 2인과 같은 방 사용조건이며,</p>
        <p class="subtext1">미충족시 아동추가 요금이 발생합니다.</p>
        <p class="subtext1">※ 1인 객실 사용시 추가요금 발생</p>
        <p id="line">-------------------------------------------------------------------</p>
      </div>

      <div id="button">
        <div id="reserve_status" onclick="people_submit()" <?=$disabled?>> <b id="status"><?=$status?></b></div><br>
        <form id="people_form" name="people_form" action="../reserve/reserve_view.php?mode=<?=$p_code?>" method="post">
          <input id="adult_val" type="hidden" name="adult_val" value="">
          <input id="kid_val" type="hidden" name="kid_val" value="">
          <input id="baby_val" type="hidden" name="baby_val" value="">
        </form>

        <script type="text/javascript">
          function onload_button_status(){
          var reserve_status = document.getElementById('reserve_status');
          var status = document.getElementById('status');
          if(status.innerHTML=="예약마감" || status.innerHTML=="마감"){
            reserve_status.style.backgroundColor = "#aaaaaa";
          }
        }
        </script>


        <script type="text/javascript">
          function people_submit(){
            var empty_flag =<?=json_encode($_SESSION['id'])?>;
            var reserve_status = document.getElementById('reserve_status');
            var status = document.getElementById('status');

            if(empty_flag==null){
              alert('로그인 해주세요!');
              location.href='../../member/login/login.php';
              return false;
            }

            if(status.innerHTML=="예약마감" || status.innerHTML=="마감"){
              alert("마감되었습니다.");
              location.href='../../index.php';
              return false;
            }

            document.people_form.submit();

          }
        </script>
        <a href="../cart/cart_list.php?mode=insert&code=<?=$p_code?>"><div id="go_cart"> <b>장바구니</b></div></a>
      </div>
    </div>




    </div>


    <div class="" style="margin:auto; max-height:20000px;">
          <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/tour/member_review/member_review_list.php";?>
    </div>

  </body>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
  </footer>

</html>
