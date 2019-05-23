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
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="http://127.0.0.1/santteut/common/lib/calendar/js/script.js"></script>
    <script type="text/javascript">
    window.onscroll = function() {
      window.onscroll = function() {
      check_offsetTop();
      };
    }

    window.onload = function () {
      kCalendar('kCalendar');
      default_detail_value('period_div');
      default_detail_value('pay_div');
      default_detail_value('time_div');
      default_detail_value('day_div');
      default_detail_value('add_div');
      default_detail_value('free_div');

    };


    function detail_search_function(){
      var period_value="";var pay_value="";var time_value="";var day_value="";var add_value="";var free_value="";

      var period_div=document.getElementsByName('period_div');
      var pay_div=document.getElementsByName('pay_div');
      var time_div=document.getElementsByName('time_div');
      var day_div=document.getElementsByName('day_div');
      var add_div=document.getElementsByName('add_div');
      var free_div=document.getElementsByName('free_div');
      var package_search_detail_option_city=document.getElementById('package_search_detail_option_city');
      var dp_date_value = document.getElementById('dp_date_value');

        // alert(package_search_detail_option_city.value);
        for(var i=0;i<=period_div.length-1;i++){
          if(period_div[i].style.backgroundColor!='white'){
            period_value=period_div[i].value;
          }
        }
        for(var i=0;i<=pay_div.length-1;i++){
          if(pay_div[i].style.backgroundColor!='white'){
            pay_value=pay_div[i].value;
          }
        }
        for(var i=0;i<=time_div.length-1;i++){
          if(time_div[i].style.backgroundColor!='white'){
            time_value=time_div[i].value;
          }
        }
        for(var i=0;i<=day_div.length-1;i++){
          if(day_div[i].style.backgroundColor!='white'){
            day_value=day_div[i].value;
          }
        }
        for(var i=0;i<=add_div.length-1;i++){
          if(add_div[i].style.backgroundColor!='white'){
            add_value=add_div[i].value;
          }
        }
        for(var i=0;i<=free_div.length-1;i++){
          if(free_div[i].style.backgroundColor!='white'){
            free_value=free_div[i].value;
          }
        }

        // alert(period_value);
        // alert(pay_value);
        // alert(time_value);
        // alert(day_value);
        // alert(add_value);
        // alert(free_value);


        $.ajax({
          url: 'package_list_query.php',
          type: 'POST',
          data: {
            dp_date_value:dp_date_value.value
            ,city: package_search_detail_option_city.value
            ,period_value: period_value
            ,pay_value:pay_value
            ,time_value:time_value
            ,day_value:day_value
            ,add_value:add_value
            ,free_value:free_value
          }
        })
        .done(function(result) {
         alert(result);
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
      }



    function default_detail_value(name){
      var detail_name=document.getElementsByName(name);
      for(var i=0;i<=detail_name.length-1;i++){
        // if(detail_name[0].value!="전체"){
        //   detail_name[0].value="";
        // }
        detail_name[i].style.backgroundColor='white';
        detail_name[i].style.color='black';
        detail_name[i].style.border='none';
      }
      detail_name[0].style.backgroundColor='#429161';
      detail_name[0].style.color='white';
    }
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

                  <td><input type="date" name=""  id="dp_date_value"></td>
            <td id="nbsp"></td><td id="nbsp">
            <td id="nbsp"></td><td id="nbsp">
            <td class="package_search_detail_option">출발도시</td>
            <td>
              <select id="package_search_detail_option_city">
                <option >서울특별시</option>
                <option >인천국제공항</option>
                <option >김포</option>
                <option >부산광역시</option>
                <option >대구</option>
                <option >대전</option>
                <option >광주</option>
                <option >울산</option>
              </select>
              <td id="nbsp">
            </td>
          </tr>
          </table>
          <table id="package_search_detail">
          <tr >
            <td class="package_search_detail_option">여행기간</td>
            <td   onclick="detail_function('period_all','period_div','')"><div  id="period_all" name="period_div" class="package_search_detail_option_all">전체</div></td>
            <td   onclick="detail_function('period_1','period_div','and `p_period` =1')" ><div  id="period_1" name="period_div" class="package_search_detail_option_all">당일</div></td>
            <td   onclick="detail_function('period_2','period_div','and `p_period` =2')" ><div  id="period_2" name="period_div" class="package_search_detail_option_all">2일</div></td>
            <td   onclick="detail_function('period_3','period_div','and `p_period` =3')" ><div  id="period_3" name="period_div" class="package_search_detail_option_all">3일</div></td>
            <td   onclick="detail_function('period_4','period_div','and `p_period` =4')" ><div  id="period_4" name="period_div" class="package_search_detail_option_all">4일</div></td>
            <td   onclick="detail_function('period_5','period_div','and `p_period` =5')" ><div  id="period_5" name="period_div" class="package_search_detail_option_all">5일</div></td>
            <td   onclick="detail_function('period_6','period_div','and `p_period` =6')" ><div  id="period_6" name="period_div" class="package_search_detail_option_all">6일</div></td>
            <td   onclick="detail_function('period_7_9','period_div','and `p_period` between 7 and 9')" ><div  id="period_7_9" name="period_div" class="package_search_detail_option_all">7일~9일</div></td>
            <td   onclick="detail_function('period_10','period_div','and `p_period` =10')" ><div  id="period_10" name="period_div" class="package_search_detail_option_all">10일<b>↑</b></div></td>
            </td><td id="nbsp"></td>
          </tr>
        <!-- 상세검색 함수 -->
          <script type="text/javascript">
            function detail_function(id, name ,value){
              var detail_id =document.getElementById(id);
              var detail_name=document.getElementsByName(name);
              // alert(period_td.value);
              // var id=this.id;
              for(var i=0;i<=detail_name.length-1;i++){
                detail_name[i].style.backgroundColor='white';
                detail_name[i].style.color='black';
                detail_name[i].style.border='none';
              }
              // period_id.style.backgroundColor ="#429161";
              detail_id.style.backgroundColor="#429161";
              detail_id.style.color="white";
              detail_id.style.color="white";
              detail_id.style.color="white";
              // period_id.style.color="white";
              detail_id.style.border="1px solicd #2F9D27";
              detail_id.value=value;
            }






          </script>

          <tr>
            <td class="package_search_detail_option">상품가격</td>
            <td onclick="detail_function('pay_1','pay_div','')"><div id="pay_1" name="pay_div" class="package_search_detail_option_all">전체</div></td>
            <td onclick="detail_function('pay_2','pay_div','and `p_pay` between 50000 and 209999')"><div id="pay_2" name="pay_div" class="package_search_detail_option_all">5~20만원</div></td>
            <td onclick="detail_function('pay_3','pay_div','and `p_pay` between 210000 and 409999')"><div id="pay_3" name="pay_div" class="package_search_detail_option_all">21~40만원</div></td>
            <td onclick="detail_function('pay_4','pay_div','and `p_pay` between 410000 and 609999')"><div id="pay_4" name="pay_div" class="package_search_detail_option_all">41~60만원</div></td>
            <td onclick="detail_function('pay_5','pay_div','and `p_pay` between 610000 and 809999')"><div id="pay_5" name="pay_div" class="package_search_detail_option_all">61~80만원</div></td>
            <td onclick="detail_function('pay_6','pay_div','and `p_pay` between 810000 and 909999')"><div id="pay_6" name="pay_div" class="package_search_detail_option_all">81~99만원</div></td>
            <td onclick="detail_function('pay_7','pay_div','and `p_pay` >=1000000')"><div id="pay_7" name="pay_div" class="package_search_detail_option_all">100만원<b>↑</b></div></td>
            </td><td id="nbsp"></td></td></td><td id="nbsp"></td></td></td><td id="nbsp"></td>
          </tr>



          <tr>
            <td class="package_search_detail_option">출발시간</td>
            <td onclick="detail_function('time_1','time_div','')"><div id="time_1" name="time_div" class="package_search_detail_option_all">전체</div></td>
            <td onclick="detail_function('time_2','time_div','and `p_dp_time` between 6 and 12')"><div id="time_2" name="time_div" class="package_search_detail_option_all">오전</div></td>
            <td onclick="detail_function('time_3','time_div','and `p_dp_time` between 12 and 18')"><div id="time_3" name="time_div" class="package_search_detail_option_all">오후</div></td>
            <td onclick="detail_function('time_4','time_div','and `p_dp_time` between 18 and 0')"><div id="time_4" name="time_div" class="package_search_detail_option_all">저녁</div></td>
            <td onclick="detail_function('time_5','time_div','and `p_dp_time` between 0 and 6')"><div id="time_5" name="time_div" class="package_search_detail_option_all">심야</div></td>
            </td><td id="nbsp"></td></td><td id="nbsp"></td></td><td id="nbsp"></td></td><td id="nbsp"></td>
            </td></td><td id="nbsp"></td>
          </tr>
          <tr>
            <td class="package_search_detail_option">출발요일</td>
            <td onclick="detail_function('day_1','day_div','')"><div id="day_1" name="day_div" class="package_search_detail_option_all">전체</div></td>
            <td onclick="detail_function('day_2','day_div','월')"><div id="day_2" name="day_div" class="package_search_detail_option_all">월</div></td>
            <td onclick="detail_function('day_3','day_div','화')"><div id="day_3" name="day_div" class="package_search_detail_option_all">화</div></td>
            <td onclick="detail_function('day_4','day_div','수')"><div id="day_4" name="day_div" class="package_search_detail_option_all">수</div></td>
            <td onclick="detail_function('day_5','day_div','목')"><div id="day_5" name="day_div" class="package_search_detail_option_all">목</div></td>
            <td onclick="detail_function('day_6','day_div','금')"><div id="day_6" name="day_div" class="package_search_detail_option_all">금</div></td>
            <td onclick="detail_function('day_7','day_div','토')"><div id="day_7" name="day_div" class="package_search_detail_option_all">토</div></td>
            <td onclick="detail_function('day_8','day_div','일')"><div id="day_8" name="day_div" class="package_search_detail_option_all">일</div></td>
            </td></td><td id="nbsp"></td></td></td><td id="nbsp"></td>
          </tr>
          <tr>
            <td class="package_search_detail_option">추가경비</td>
            <td onclick="detail_function('add_1','add_div','')"><div id="add_1" name="add_div" class="package_search_detail_option_all">전체</div></td>
            <td onclick="detail_function('add_2','add_div','and `p_add_pay` = 1')"><div id="add_2" name="add_div" class="package_search_detail_option_all">포함</div></td>
            <td onclick="detail_function('add_3','add_div','and `p_add_pay` = 2')"><div id="add_3" name="add_div" class="package_search_detail_option_all">불포함</div></td>
            <td id="nbsp">
            <td class="package_search_detail_option">자유일정</td>
            <td onclick="detail_function('free_1','free_div','')"><div id="free_1" name="free_div" class="package_search_detail_option_all">전체</div></td>
            <td onclick="detail_function('free_2','free_div','and `p_free_time` = 1')"><div id="free_2" name="free_div" class="package_search_detail_option_all">포함</div></td>
            <td onclick="detail_function('free_3','free_div','and `p_free_time` = 2')"><div id="free_3" name="free_div" class="package_search_detail_option_all">불포함</div></td>
            <td id="nbsp"></td><td id="nbsp">
          </tr>
        </table>
        <br>
       <button id="package_search_detail_btn" type="button" name="button" onclick="detail_search_function()"><b>상세검색</b></button>
        <button id="package_search_detail_reset" type="button" name="button" ><b>초기화</b></button>




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
