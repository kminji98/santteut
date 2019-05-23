<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/santteut/tour/package/package_list_query.php";
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css?ver=3">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/package/css/package_list.css?ver=3">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/side_bar.css?ver=0.1">
    <link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/lib/calendar/css/style.css?ver=6" rel="stylesheet">
    <script src="http://127.0.0.1/santteut/common/lib/calendar/js/script.js"></script>
    <script type="text/javascript">
    window.onscroll = function() {
      window.onscroll = function() {
      check_offsetTop();
      };
    }
    window.onload = function () {
      kCalendar('kCalendar');
    };
    function check_offsetTop(){
      var value = document.getElementById("package_list_view_btn");
      var value2 = document.getElementById("kCalendar");
      var value3 = document.getElementById("package_search");
        if(value.offsetTop<=value2.offsetTop+250){
          value2.style.position="static";
        }
        // else{
        //   value2.style.position="sticky";
        // }
    }
    </script>
    <title>산뜻 :: 즐거운 산행</title>
  </head>
  <script type="text/javascript">
  var flag=false;
  function control_display2(){
      var con = document.getElementById("package_search_detail_control_sub");
      var con2 = document.getElementById("package_search_detail_control");
      if(con.style.display=='none'){
        con2.innerHTML="상세검색▲";
          con.style.display = 'block';
      }else{
          con.style.display = 'none';
          con2.innerHTML="상세검색▼";
      }
  }
  function button_change(value){
    var btn = document.getElementById(value);
    if(btn.value==value+"순▼"){
      btn.value=value+"순▲";
    }else{
      btn.value=value+"순▼";
    }
  }
  </script>
  <body>

    <!-- <div id="kCalendar"></div> -->
    <!--로그인 회원가입 로그아웃-->
    <div id="wrap">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
    <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/side_bar.php";?>
    <hr>
    <div id="head_text">
      <h2>국내산행</h2>
    </div>
    <!--인기 산행 일정 TOP3-->
    <div id="best3">
      <div id="best_text">
        <h1>인기 산행 일정 TOP3</h1>
      </div>
    </div>
    <div id="main_big3">
      <div id="best3" >
        <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/best3.php";?>
      </div>
    </div>
      <div id="kCalendar" onclick="KCalendar_go()"></div>
      <!-- 검색/상세검색 -->
      <div id="package_search" >
          <select id="package_search_select" name="find">
            <option value="subject">패키지명</option>
            <option value="content">산 이름</option>
          </select><!-- 산 이름일 때에 placeholder ->산 이름을 입력하세요 -->
          <input id="package_search_input" placeholder="패키지명을 입력하세요" type="text" name="" value="">
          <button id="package_search_btn" type="button" name="button"><b>검색</b></button>
          <strong  id="package_search_detail_control" onclick="control_display2()">상세검색▼</strong>
      </div>
      <br>
      <div id="package_search_detail_control_sub" style="display :none">

        <table id="package_search_detail_top">

          <tr>
            <td class="package_search_detail_option" >출발일</td>
                  <td><input type="date" name="" value=""></td>
            <td id="nbsp"></td><td id="nbsp">
            <td id="nbsp"></td><td id="nbsp">
            <td class="package_search_detail_option">출발도시</td>
            <td>
              <select id="package_search_detail_option_city">
                <option >도시1</option>
                <option >도시2</option>
                <option >도시3</option>
              </select>
              <td id="nbsp">
            </td>
          </tr>
          <table id="package_search_detail">
          <tr >
            <td class="package_search_detail_option">여행기간</td>
            <td><div class="package_search_detail_option_all">전체</div></td>
            <td>당일</td>
            <td>2일</td>
            <td>3일</td>
            <td>4일</td>
            <td>5일</td>
            <td>6일</td>
            <td>7일~9일</td>
            <td>10일 이상</td>
            </td><td id="nbsp"></td>
          </tr>
          <tr>
            <td class="package_search_detail_option">상품가격</td>
            <td><div class="package_search_detail_option_all">전체</div></td>
            <td>5~20 만원</td>
            <td>21~40만원</td>
            <td>41~60만원</td>
            <td>61~80만원</td>
            <td>81~100만원</td>
            <td>100     만원 이상</td>
            </td></td><td id="nbsp"></td></td></td><td id="nbsp"></td></td></td><td id="nbsp"></td>
          </tr>
          <tr>
            <td class="package_search_detail_option">출발시간</td>
            <td><div class="package_search_detail_option_all">전체</div></td>
            <td>오전</td>
            <td>오후</td>
            <td>저녁</td>
            <td>심야</td>
            </td><td id="nbsp"></td></td><td id="nbsp"></td></td><td id="nbsp"></td></td><td id="nbsp"></td>
            </td></td><td id="nbsp"></td>
          </tr>
          <tr>
            <td class="package_search_detail_option">출발요일</td>
            <td><div class="package_search_detail_option_all">전체</div></td>
            <td>월</td>
            <td>화</td>
            <td>수</td>
            <td>목</td>
            <td>금</td>
            <td>토</td>
            <td>일</td>
            </td></td><td id="nbsp"></td></td></td><td id="nbsp"></td>
          </tr>
          <tr>
            <td class="package_search_detail_option">추가경비</td>
            <td><div class="package_search_detail_option_all">전체</div></td>
            <td>포함</td>
            <td>불포함</td>
            <td id="nbsp">
            <td class="package_search_detail_option">자유일정</td>
            <td><div class="package_search_detail_option_all">전체</div></td>
            <td>포함</td>
            <td>불포함</td>
            <td id="nbsp"></td><td id="nbsp">
          </tr>
        </table>
        <br>
        <button id="package_search_detail_btn" type="button" name="button"><b>상세검색</b></button>
        <button id="package_search_detail_reset" type="button" name="button"><b>초기화</b></button>
      </div>

      <div id="package_list_view_btn">
        <form class="" action="index.html" method="post">
          <input onclick="button_change('최신')" id="최신" class="package_list_view_btn_value" type="button" name="" value="최신순▼">
          <input onclick="button_change('요금')" id="요금" class="package_list_view_btn_value" type="button" name="" value="요금순▼">
          <input onclick="button_change('인기')" id="인기" class="package_list_view_btn_value" type="button" name="" value="인기순▼">
        </form>
      </div>
      <div id="package_list_view">
        <table id="package_list_view_table">
          <tr>
            <td id="package_list_view_img">사진</td>
            <td id="package_list_view_time">출발/도착</td>
            <td id="package_list_view_period">기간</td>
            <td id="package_list_view_name">상품명</td>
            <td id="package_list_view_pay">가격</td>
            <td id="package_list_view_state">상태</td>
          </tr>

          <?php
          for ($record = $start_record; $record  < $start_record+ROW_SCALE && $record<$total_record; $record++){
            mysqli_data_seek($result,$record);
            $row=mysqli_fetch_array($result);
            $p_code=$row['p_code'];
            $p_name=$row['p_name'];
            $p_dp_date=$row['p_dp_date'];
            $p_dp_time=$row['p_dp_time'];
            $p_arr_time=$row['p_arr_time'];
            $p_pay=$row['p_pay'];
            $p_main_img_copy1=$row['p_main_img_copy1'];
            $p_period=$row['p_period'];
            $timestamp = strtotime("$p_dp_date +$p_period days");
            $p_arr_date1 = date('y-m-d', $timestamp);
            $p_arr_date2 = "20".$p_arr_date1;
            $yoil = array("일","월","화","수","목","금","토");
            $day = $yoil[date('w', strtotime($p_dp_date))];
            $day2 = $yoil[date('w', strtotime($p_arr_date2))];
            $p_pay=number_format($p_pay);



           ?>

          <tr class="package_list_view_value">
            <td>
              <img class="package_list_view_img_value" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/lib/editor/data/<?=$p_main_img_copy1?>">
            </td>
            <td class="package_list_view_time" >
              <output class="package_list_view_time_s" > &nbsp; <?=$p_dp_date?> (<?=$day?>)<?=$p_dp_time?> </output><br><br>
              <output><?php echo $p_arr_date2." "."(".$day2.")".$p_arr_time; ?></output>
            </td>
            <td class="package_list_period_value"><?=$p_period?>일</td>
            <td class="package_list_view_name_value"><a href="package_view.php?mode=<?=$p_code?>"><?=$p_name?></a></td>
            <td class="package_list_view_pay_value"><?=$p_pay?></td>
            <td>
              <output class="package_list_view_state_value">예약가능</output>
            </td>
          </tr>
          <?php
            }
           ?>
        </table>
    </div>
      <br><br><br><br><br><br><br><br><br><br>
</div>
</body>
<footer>
  <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
</footer>
</html>
