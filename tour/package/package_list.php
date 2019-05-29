<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/tour/package/package_list_query.php";

?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/package/css/package_list.css?ver=2">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/side_bar.css">
    <link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/lib/calendar/css/style.css?ver=0" rel="stylesheet">
    <script type="text/javascript">
      var divide=<?=json_encode($divide)?>;
    </script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="../../common/lib/calendar/js/script.js"></script>
    <style media="screen">
    .page_button_group button{border-radius: 3px; margin-bottom:3%; width: 35px; height: 35px; font-weight: bold; margin-right: 5px; cursor: pointer; border: 1px solid #464646; background-color: white;}
    .page_button_group button:hover{background-color: #2F9D27; color: white; border-radius: 3px; border: 1px solid #2F9D27;}
    .page_button_group{ position: relative; margin-top: auto; margin-left: auto;text-align:center;}
    a{text-decoration: none;}
    </style>
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
      // 상세검색 조건에 따른 결과
      document.getElementsByName('output')[0].value=<?=json_encode($output)?>;
      document.getElementsByName('sql')[0].value=<?=json_encode($sql)?>;
      document.getElementsByName('order_condition')[0].value=<?=json_encode($order_condition)?>;
      document.getElementsByName('order_option')[0].value=<?=json_encode($order_option)?>;
      document.getElementsByName('order_btn')[0].value=<?=json_encode($order_btn)?>;
      // document.getElementsByName('order_sql')[0].value=<?=json_encode($sql)?>;
      // 최신순/요금순/ 조건에 따른 결과
      var order_condition = <?=json_encode($order_condition)?>;
      var order_option = <?=json_encode($order_option)?>;
      var order_btn = <?=json_encode($order_btn)?>;
      document.getElementById(order_condition).value=<?=json_encode($order_btn)?>;

      var list_status = document.getElementById('list_status');
      if(list_status.innerHTML=="예약마감"){
        list_status.style.color ="grey";
      }
    };


    function detail_search_function(){
      var period_value="";var pay_value="";var time_value="";var day_value="";var add_value="";var free_value="";var after_pay_value="";

      var period_div=document.getElementsByName('period_div');
      var pay_div=document.getElementsByName('pay_div');
      var time_div=document.getElementsByName('time_div');
      var day_div=document.getElementsByName('day_div');
      var add_div=document.getElementsByName('add_div');
      var free_div=document.getElementsByName('free_div');
      var package_search_detail_option_city=document.getElementById('package_search_detail_option_city');
      var dp_date_value = document.getElementById('dp_date_value');
      var after_pay_value =document.getElementsByName('상품가격');
      var after_period_value =document.getElementsByName('여행기간');
      var after_time_value =document.getElementsByName('출발시간');
      var after_day_value =document.getElementsByName('출발요일');
      var after_add_value =document.getElementsByName('추가경비');
      var after_free_value =document.getElementsByName('자유일정');
      var output = '※해당 게시물의 검색조건 → | ';


        for(var i=0;i<=period_div.length-1;i++){
          id = after_period_value[i].id;
          if(period_div[i].style.backgroundColor!='white'){
            period_value=period_div[i].value;
            keyword=document.getElementById(id);
            output += "여행기간 : " + keyword.id+" | ";
          }
        }
        for(var i=0;i<=pay_div.length-1;i++){
          id = after_pay_value[i].id;
          if(pay_div[i].style.backgroundColor!='white'){
            pay_value=pay_div[i].value;
            keyword=document.getElementById(id);
            output+= "상품검색 : " + keyword.id+" | ";
          }
        }
        for(var i=0;i<=time_div.length-1;i++){
          id = after_time_value[i].id;
          if(time_div[i].style.backgroundColor!='white'){
            time_value=time_div[i].value;
            keyword=document.getElementById(id);
            output+= "출발시간 : " + keyword.id+" | ";
          }
        }
        for(var i=0;i<=day_div.length-1;i++){
          id = after_day_value[i].id;
          if(day_div[i].style.backgroundColor!='white'){
            day_value=day_div[i].value;
            keyword=document.getElementById(id);
            output+= "출발요일 : " + keyword.id+" | ";
          }
        }
        for(var i=0;i<=add_div.length-1;i++){
          id = after_add_value[i].id;
          if(add_div[i].style.backgroundColor!='white'){
            add_value=add_div[i].value;
            keyword=document.getElementById(id);
            output+= "추가경비 : " + keyword.id+" | ";
          }
        }
        for(var i=0;i<=free_div.length-1;i++){
          id = after_free_value[i].id;
          if(free_div[i].style.backgroundColor!='white'){
            free_value=free_div[i].value;
            keyword=document.getElementById(id);
            output+= "자유일정 : " + keyword.id+" | ";
          }
        }
        document.getElementsByName('output')[0].value=output;
        $.ajax({
          url: 'package_list_detail.php',
          type: 'POST',
          data: {
            mode:'detail'
            ,dp_date_value:dp_date_value.value
            ,city: package_search_detail_option_city.value
            ,period_value: period_value
            ,pay_value:pay_value
            ,time_value:time_value
            ,day_value:day_value
            ,add_value:add_value
            ,free_value:free_value
            ,divide:divide
          }
        })
        .done(function(result) {
          alert(result);
         var sql=document.getElementById('sql');
         sql.value=result;
         document.query_form.submit();
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");

        });

      }

    //[PAGE BUTTON ACTION]
    function detail_search_mv_page(p){
        $.ajax({
          url: 'package_list_post_page.php',
          type: 'POST',
          data: {
            page: p
          }
        })
        .done(function(result) {
         document.query_form.page.value = result;
         document.query_form.submit();
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

  }
    //[PAGE BUTTON ACTION]
    function order_mv_page(p){
        $.ajax({
          url: 'package_list_post_page.php',
          type: 'POST',
          data: {
            page: p
          }
        })
        .done(function(result) {
         document.order_form.page.value = result;
         document.order_form.submit();
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

  }

    function reset_btn(){
      var dp_date_value = document.getElementById('dp_date_value');
      var package_search_detail_option_city = document.getElementById('package_search_detail_option_city');
      dp_date_value.value="";
      package_search_detail_option_city.value="서울특별시";
      default_detail_value('period_div');
      default_detail_value('pay_div');
      default_detail_value('time_div');
      default_detail_value('day_div');
      default_detail_value('add_div');
      default_detail_value('free_div');
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
      detail_name[0].style.backgroundColor='#2F9D27';
      detail_name[0].style.color='white';
    }
    function check_offsetTop(){
      var value = document.getElementById("package_list_view_btn");
      var value2 = document.getElementById("kCalendar");
      var value3 = document.getElementById("package_search");
        if(value.offsetTop<=value2.offsetTop+250){
          value2.style.position="static";
        }
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
      document.order_form.order_option.value = "asc";
      btn.value=value+"순▲";
    }else{
      document.order_form.order_option.value = "desc";
      btn.value=value+"순▼";
    }
    $.ajax({
      url: 'package_list_btn_change.php',
      type: 'POST',
      data: {
        order_btn : btn.value,
        order_condition: value,
        order_option :document.order_form.order_option.value
      }
    })
    .done(function(result) {
      var output = $.parseJSON(result);
      document.order_form.order_condition.value = output[0].order_condition;
      document.order_form.order_option.value = output[0].order_option;
      document.order_form.order_btn.value = output[0].order_btn;
      document.order_form.submit();
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });


  }
  </script>
  <body>
    <!--로그인 회원가입 로그아웃-->
    <div id="wrap">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
    <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/side_bar.php";?>
    <hr>
    <div id="head_text">
      <h2><?=$head_text?></h2>
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
        <form name="search_form" action="package_list.php" method="get">
          <input type="hidden" name="mode" value="search">
          <select id="package_search_select" name="find_option">
            <option value="p_name" <?php if(isset($find_option) && $find_option==="p_name") echo "selected";?>>패키지명</option>
            <option value="p_arr_mt" <?php if(isset($find_option) && $find_option==="p_arr_mt") echo "selected";?>>산 이름</option>
          </select><!-- 산 이름일 때에 placeholder ->산 이름을 입력하세요 -->
          <input id="package_search_input" placeholder="검색어를 입력하세요" type="text" name="find_input" <?php if(isset($find_input)) echo "value='$find_input'";?>>
          <button id="package_search_btn" type="button" name="button" onclick="document.search_form.submit()"><b>검색</b></button>
          <strong  id="package_search_detail_control" onclick="control_display2();">상세검색▼</strong>
          <input type="hidden" name="divide" value="<?=$divide?>">
        </form>
      </div>

      <!-- [DETAIL] 상세 검색 버튼 액션 -->
      <form id="query_form" name="query_form" action="package_list.php?mode=detail&divide=<?=$divide?>" method="post">
        <input id="sql" type="hidden" name="sql" value="">
        <input id="page" type="hidden" name="page" value="">
        <input type="hidden" name="output" value="">
      <br>
      <div id="package_search_detail_control_sub" style="display :none">
        <table id="package_search_detail_top">
          <tr>
            <td class="package_search_detail_option">출발일</td>
            <td><input type="date" name="" value=""  id="dp_date_value"></td>
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
            <td   onclick="detail_function('period_all','period_div','')"><div  id="period_all" name="period_div" class="package_search_detail_option_all"><p id="전체" name="여행기간" style="display:inline;">전체</p></div></td>
            <td   onclick="detail_function('period_1','period_div','and `p_period` =1')" ><div  id="period_1" name="period_div" class="package_search_detail_option_all"><p id="당일" name="여행기간" style="display:inline;">당일</p></div></td>
            <td   onclick="detail_function('period_2','period_div','and `p_period` =2')" ><div  id="period_2" name="period_div" class="package_search_detail_option_all"><p id="2일" name="여행기간" style="display:inline;">2일</p></div></td>
            <td   onclick="detail_function('period_3','period_div','and `p_period` =3')" ><div  id="period_3" name="period_div" class="package_search_detail_option_all"><p id="3일" name="여행기간" style="display:inline;">3일</p></div></td>
            <td   onclick="detail_function('period_4','period_div','and `p_period` =4')" ><div  id="period_4" name="period_div" class="package_search_detail_option_all"><p id="4일" name="여행기간" style="display:inline;">4일</p></div></td>
            <td   onclick="detail_function('period_5','period_div','and `p_period` =5')" ><div  id="period_5" name="period_div" class="package_search_detail_option_all"><p id="5일" name="여행기간" style="display:inline;">5일</p></div></td>
            <td   onclick="detail_function('period_6','period_div','and `p_period` =6')" ><div  id="period_6" name="period_div" class="package_search_detail_option_all"><p id="6일" name="여행기간" style="display:inline;">6일</p></div></td>
            <td   onclick="detail_function('period_7_9','period_div','and `p_period` between 7 and 9')" ><div  id="period_7_9" name="period_div" class="package_search_detail_option_all"><p id="7일~9일" name="여행기간" style="display:inline;">7일~9일</p></div></td>
            <td   onclick="detail_function('period_10','period_div','and `p_period` =10')" ><div  id="period_10" name="period_div" class="package_search_detail_option_all"><p id="10일↑" name="여행기간" style="display:inline;">10일<b>↑</b></p></div></td>
            </td><td id="nbsp"></td>
          </tr>
        <!-- 상세검색 함수 -->
          <script type="text/javascript">

            function detail_function(id, name ,value){
              var detail_id =document.getElementById(id);
              var detail_name=document.getElementsByName(name);
              for(var i=0;i<=detail_name.length-1;i++){
                detail_name[i].style.backgroundColor='white';
                detail_name[i].style.color='black';
                detail_name[i].style.border='none';
              }
              detail_id.style.backgroundColor="#2F9D27";
              detail_id.style.color="white";
              detail_id.style.border="1px solid #2F9D27";
              detail_id.value=value;
            }

          </script>

          <tr>
            <td class="package_search_detail_option">상품가격</td>
            <td onclick="detail_function('pay_1','pay_div','')"><div id="pay_1" name="pay_div" class="package_search_detail_option_all"><p id="전체" name="상품가격" style="display:inline;">전체</p></div></td>
            <td onclick="detail_function('pay_2','pay_div','<?=$pay_2_query?>')"><div id="pay_2" name="pay_div" class="package_search_detail_option_all"><p id="<?=$pay_2?>" name="상품가격" style="display:inline;"><?=$pay_2?></p></div></td>
            <td onclick="detail_function('pay_3','pay_div','<?=$pay_3_query?>')"><div id="pay_3" name="pay_div" class="package_search_detail_option_all"><p id="<?=$pay_3?>" name="상품가격" style="display:inline;"><?=$pay_3?></p></div></td>
            <td onclick="detail_function('pay_4','pay_div','<?=$pay_4_query?>')"><div id="pay_4" name="pay_div" class="package_search_detail_option_all"><p id="<?=$pay_4?>" name="상품가격" style="display:inline;"><?=$pay_4?></p></div></td>
            <td onclick="detail_function('pay_5','pay_div','<?=$pay_5_query?>')"><div id="pay_5" name="pay_div" class="package_search_detail_option_all"><p id="<?=$pay_5?>" name="상품가격" style="display:inline;"><?=$pay_5?></p></div></td>
            <td onclick="detail_function('pay_6','pay_div','<?=$pay_6_query?>')"><div id="pay_6" name="pay_div" class="package_search_detail_option_all"><p id="<?=$pay_6?>" name="상품가격" style="display:inline;"><?=$pay_6?></p></div></td>
            <td onclick="detail_function('pay_7','pay_div','<?=$pay_7_query?>')"><div id="pay_7" name="pay_div" class="package_search_detail_option_all"><p id="<?=$pay_7?>" name="상품가격" style="display:inline;"><?=$pay_7?><b></b></p></div></td>
            <td onclick="detail_function('pay_8','pay_div','<?=$pay_8_query?>')"><div id="pay_8" name="pay_div" class="package_search_detail_option_all"><p id="<?=$pay_8?>" name="상품가격" style="display:inline;"><?=$pay_8?></p></div></td>
          </td><td id="nbsp"><b><?=$won?></b></td></td></td><td id="nbsp"></td></td></td><td id="nbsp"></td>
          </tr>

          <tr>
            <td class="package_search_detail_option">출발시간</td>
            <td onclick="detail_function('time_1','time_div','')"><div id="time_1" name="time_div" class="package_search_detail_option_all"><p id="전체" name="출발시간" style="display:inline;">전체</p></div></td>
            <td onclick="detail_function('time_2','time_div','and `p_dp_time` between 6 and 12')"><div id="time_2" name="time_div" class="package_search_detail_option_all"><p id="오전" name="출발시간" style="display:inline;">오전</p></div></td>
            <td onclick="detail_function('time_3','time_div','and `p_dp_time` between 12 and 18')"><div id="time_3" name="time_div" class="package_search_detail_option_all"><p id="오후" name="출발시간" style="display:inline;">오후</p></div></td>
            <td onclick="detail_function('time_4','time_div','and `p_dp_time` between 18 and 0')"><div id="time_4" name="time_div" class="package_search_detail_option_all"><p id="저녁" name="출발시간" style="display:inline;">저녁</p></div></td>
            <td onclick="detail_function('time_5','time_div','and `p_dp_time` between 0 and 6')"><div id="time_5" name="time_div" class="package_search_detail_option_all"><p id="심야" name="출발시간" style="display:inline;">심야</p></div></td>
            </td><td id="nbsp"></td></td><td id="nbsp"></td></td><td id="nbsp"></td></td><td id="nbsp"></td>
            </td></td><td id="nbsp"></td>
          </tr>
          <tr>
            <td class="package_search_detail_option">출발요일</td>
            <td onclick="detail_function('day_1','day_div','')"><div id="day_1" name="day_div" class="package_search_detail_option_all"><p id="전체" name="출발요일" style="display:inline;">전체</p></div></td>
            <td onclick="detail_function('day_2','day_div','and `p_dp_day` = 1')"><div id="day_2" name="day_div" class="package_search_detail_option_all"><p id="월" name="출발요일" style="display:inline;">월</p></div></td>
            <td onclick="detail_function('day_3','day_div','and `p_dp_day` = 2')"><div id="day_3" name="day_div" class="package_search_detail_option_all"><p id="화" name="출발요일" style="display:inline;">화</p></div></td>
            <td onclick="detail_function('day_4','day_div','and `p_dp_day` = 3')"><div id="day_4" name="day_div" class="package_search_detail_option_all"><p id="수" name="출발요일" style="display:inline;">수</p></div></td>
            <td onclick="detail_function('day_5','day_div','and `p_dp_day` = 4')"><div id="day_5" name="day_div" class="package_search_detail_option_all"><p id="목" name="출발요일" style="display:inline;">목</p></div></td>
            <td onclick="detail_function('day_6','day_div','and `p_dp_day` = 5')"><div id="day_6" name="day_div" class="package_search_detail_option_all"><p id="금" name="출발요일" style="display:inline;">금</p></div></td>
            <td onclick="detail_function('day_7','day_div','and `p_dp_day` = 6')"><div id="day_7" name="day_div" class="package_search_detail_option_all"><p id="토" name="출발요일" style="display:inline;">토</p></div></td>
            <td onclick="detail_function('day_8','day_div','and `p_dp_day` = 0')"><div id="day_8" name="day_div" class="package_search_detail_option_all"><p id="일" name="출발요일" style="display:inline;">일</p></div></td>
            </td></td><td id="nbsp"></td></td></td><td id="nbsp"></td>
          </tr>
          <tr>
            <td class="package_search_detail_option">추가경비</td>
            <td onclick="detail_function('add_1','add_div','')"><div id="add_1" name="add_div" class="package_search_detail_option_all"><p id="전체" name="추가경비" style="display:inline;">전체</p></div></td>
            <td onclick="detail_function('add_2','add_div','and `p_add_pay` = 1')"><div id="add_2" name="add_div" class="package_search_detail_option_all"><p id="포함" name="추가경비" style="display:inline;">포함</p></div></td>
            <td onclick="detail_function('add_3','add_div','and `p_add_pay` = 2')"><div id="add_3" name="add_div" class="package_search_detail_option_all"><p id="불포함" name="추가경비" style="display:inline;">불포함</p></div></td>
            <td id="nbsp">
            <td class="package_search_detail_option">자유일정</td>
            <td onclick="detail_function('free_1','free_div','')"><div id="free_1" name="free_div" class="package_search_detail_option_all"><p id="전체" name="자유일정" style="display:inline;">전체</p></div></td>
            <td onclick="detail_function('free_2','free_div','and `p_free_time` = 1')"><div id="free_2" name="free_div" class="package_search_detail_option_all"><p id="포함" name="자유일정" style="display:inline;">포함</p></div></td>
            <td onclick="detail_function('free_3','free_div','and `p_free_time` = 2')"><div id="free_3" name="free_div" class="package_search_detail_option_all"><p id="불포함" name="자유일정" style="display:inline;">불포함</p></div></td>
            <td id="nbsp"></td><td id="nbsp">
          </tr>
        </table>
        <br>
       <button id="package_search_detail_btn" type="button" name="button" onclick="detail_search_function();"><b>상세검색</b></button>
        <button id="package_search_detail_reset" type="button" name="button" onclick="reset_btn();" ><b>초기화</b></button>
      <!--[DETAIL] 상세 검색 버튼 액션   -->

      </div>
      <p style="position: relative; margin-top: auto; margin-left: auto;text-align:center; font-weight: bold; font-size:13px;"><?=isset($output)?></p>
    </form>
      <div id="package_list_view_btn">
        <form name="order_form" action="package_list.php?mode=order&divide=<?=$divide?>" method="post">
          <input type="hidden" name="page" value="">
          <input type="hidden" name="order_sql" value="">
          <input type="hidden" name="order_condition" value="">
          <input type="hidden" name="order_option" value="desc">
          <input type="hidden" name="order_btn" value="">
          <input onclick="button_change('최신')" id="최신" class="package_list_view_btn_value" type="button" value="최신순▼">
          <input onclick="button_change('요금')" id="요금" class="package_list_view_btn_value" type="button" value="요금순▼">
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



          mysqli_data_seek($result,$start_record);

          for ($record = $start_record; $record  < $start_record+ROW_SCALE && $record<$total_record; $record++){
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

            $total=0;
            $status ="예약가능";
            $reserve_status_sql = "SELECT sum(`r_adult`+`r_kid`+`r_baby`),`p_bus` from `package` inner join `reserve` on `package`.`p_code` = `reserve`.`r_code` where `package`.`p_code` = '$p_code';";
            $result_status_sql=mysqli_query($conn,$reserve_status_sql);
            for($i=0;$i<mysqli_num_rows($result_status_sql);$i++){
              $row1 = mysqli_fetch_array($result_status_sql);
              $sum = $row1['sum(`r_adult`+`r_kid`+`r_baby`)'];
              $p_bus = $row1['p_bus'];
              $total +=$sum;
            }
            if($total>=$p_bus/2){
              $status="출발가능";
            }
            if($total==$p_bus){
              $status="예약마감";
            }

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
            <td class="package_list_view_name_value"><a id="<?=$p_code?>" href="package_view.php?mode=<?=$p_code?>"><?=$p_name?></a></td>
            <td class="package_list_view_pay_value"><?=$p_pay?></td>
            <td>
              <output class="package_list_view_state_value" id="list_status"><?=$status?></output>
            </td>
          </tr>
          <?php

          }
           ?>
        </table>
        <!-- 쿠키값 저장 함수 -->
      <!-- <script type="text/javascript">
        var num=0;
        function cookie_start(id){
          var id=document.getElementById(id);
          document.cookie = id.id+"="+id.id;
          alert(document.cookie);
          // var val = document.cookie.split(';');
          // val[1]=val[0];
          // vla[2]=val[1];
          // val[0]=id_val.id;
          // alert(val[0]);
          // alert(val[1]);
          // alert(val[2]);
        }
      </script> -->
    </div>
    <br><br><br>
    <!--$page 는 현재페이지를 의미 x / 각 페이지를 의미-->
          <div class="page_button_group">
            <?php
            //현재 블럭의 시작 페이지가 페이지 스케일 보다 클 때 -> 처음으로 버튼 생성 + 이전 블럭 존재
            //[ex]  page가 9개 있고 현재 페이지가 6페이지인 경우  / 12345/ 6789     =>  <<(처음으로) <(이전) 6 7 8 9
            if( $start_page > PAGE_SCALE ){

              // echo( '<a href='package_list.php?page=1'> << </a>' );

              // 이전 블럭 클릭 시 -> 현재 블럭의 시작 페이지 - 페이지 스케일
              // 현재 6 page 인 경우 '<(이전블럭)' 클릭 -> $pre_page = 6-PAGE_SCALE  -> 1 페이지로 이동
              $pre_block= $start_page - PAGE_SCALE;
               if(isset($_GET['mode'])){
                 switch ($_GET['mode']) {
                   case 'search':
                    echo( '<a href="package_list.php?mode=search&find_option='.$find_option.'&find_input='.$find_input.'&page=1&$divide='.$_GET['divide'].'"><button type="button" name="button" title="처음으로"><<</button></a>' );
                    echo( '<a href="package_list.php?mode=search&find_option='.$find_option.'&find_input='.$find_input.'&page='.$pre_block.'&divide='.$divide.'"><button type="button" name="button" title="이전"><</button></a>' );
                    break;
                  case 'detail':
                    echo( '<button type="button" title="처음으로" onclick="detail_search_mv_page(1)"><<</button>' );
                    echo( '<button type="button" title="이전" onclick="detail_search_mv_page('.$pre_block.')"><</button>' );
                    break;
                  case 'order':
                    echo( '<button type="button" title="처음으로" onclick="order_mv_page(1)"><<</button>' );
                    echo( '<button type="button" title="이전" onclick="order_mv_page('.$pre_block.')"><</button>' );
                    break;
                  default:
                    break;
                }
               }else{
                 echo( '<a href="package_list.php?page=1&divide='.$divide.'"><button type="button" name="button" title="처음으로"><<</button></a>');
                 echo( '<a href="package_list.php?page='.$pre_block.'&divide='.$divide.'"><button type="button" name="button" title="이전"><</button></a>');
               }
            }


            //현재 블럭에 해당하는 페이지 나열
            for( $i = $start_page; $i <= $end_page; $i++ ){
                //현재 블럭에 현재 페이지인 버튼
                if ( $i == $page ){
                  echo( '<a href="#"><button type="button" name="button" style="background-color: #2F9D27; border: 1px solid #2F9D27; color: white;">'.$i.'</button></a>' );
                }else if(isset($_GET['mode'])){
                  switch ($_GET['mode']) {
                    case 'search':
                      echo( '<a href="package_list.php?mode=search&find_option='.$find_option.'&find_input='.$find_input.'&page='.$i.'&divide='.$divide.'"><button type="button" name="button">'.$i.'</button></a>' );
                      break;
                    case 'detail':
                      echo( '<button type="button" onclick="detail_search_mv_page('.$i.')">'.$i.'</button>' );
                      break;
                    case 'order':
                      echo( '<button type="button" onclick="order_mv_page('.$i.')">'.$i.'</button>' );
                      break;
                    default:
                      break;
                  }
                }else{
                  echo( '<a href="package_list.php?page='.$i.'&divide='.$divide.'"><button type="button" name="button">'.$i.'</button></a>' );
                }
            }

            if( $total_pages > $end_page ){
              $next_block= $start_page + PAGE_SCALE;
              if(isset($_GET['mode'])){
                switch ($_GET['mode']) {
                  case 'search':
                    echo( '<a href="package_list.php?mode=search&find_option='.$find_option.'&find_input='.$find_input.'&page='.$next_block.'&divide='.$divide.'"  title="다음"><button type="button" name="button">></button></a>' );
                    echo( '<a href="package_list.php?mode=search&find_option='.$find_option.'&find_input='.$find_input.'&page='.$total_pages.'&divide='.$divide.'" title="맨끝으로"><button type="button" name="button">>></button></a>' );
                    break;
                  case 'detail':
                    echo( '<button type="button" title="다음" onclick="detail_search_mv_page('.$next_block.')">></button>' );
                    echo( '<button type="button" title="맨끝으로" onclick="detail_search_mv_page('.$total_pages.')">>></button>' );
                    break;
                  case 'order':
                    echo( '<button type="button" title="다음" onclick="order_mv_page('.$next_block.')">></button>' );
                    echo( '<button type="button" title="맨끝으로" onclick="order_mv_page('.$total_pages.')">>></button>' );
                    break;
                  default:
                    break;
                }
              }else{
                echo( '<a href="package_list.php?page='.$next_block.'&divide='.$divide.'"><button type="button" name="button" title="다음">></button></a>' );
                echo( '<a href="package_list.php?page='.$total_pages.'&divide='.$divide.'"><button type="button" name="button" title="맨끝으로">>></button></a>' );
              }
            }
            ?>
          </div>

      <br><br><br><br><br><br><br><br><br><br>
</div>
</body>
<footer>
  <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
</footer>
</html>
