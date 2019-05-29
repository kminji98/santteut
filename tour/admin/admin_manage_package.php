<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/tour/package/package_list_query.php";
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/package/css/package_list.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/side_bar.css">

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

    <style media="screen">
    .page_button_group button{border-radius: 3px; margin-bottom:3%; width: 35px; height: 35px; font-weight: bold; margin-right: 5px; cursor: pointer; border: 1px solid #464646; background-color: white;}
    .page_button_group button:hover{background-color: #2F9D27; color: white; border-radius: 3px; border: 1px solid #2F9D27;}
    .page_button_group{ position: relative; margin-top: auto; margin-left: auto;text-align:center;}
    </style>
    <script type="text/javascript">
    window.onscroll = function() {
      window.onscroll = function() {
      check_offsetTop();
      };
    }

    window.onload = function () {

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
          }
        })
        .done(function(result) {
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
    <style media="screen">
    .page_button_group button{border-radius: 3px; margin-bottom:3%; width: 35px; height: 35px; font-weight: bold; margin-right: 5px; cursor: pointer; border: 1px solid #464646; background-color: white;}
    .page_button_group button:hover{background-color: #2F9D27; color: white; border-radius: 3px; border: 1px solid #2F9D27;}
    .page_button_group{ position: relative; margin-top: auto; margin-left: auto;text-align:center; margin-left: 12%; width: 100%; height: auto;}
    a{text-decoration: none;}
    </style>
  </head>

  <body>
    <!--로그인 회원가입 로그아웃-->
    <div id="wrap">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
    <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/side_bar.php";?>
    <hr>
    <div id="head_text">
      <h2>전체상품관리</h2>
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
          $sql = "SELECT * FROM `package`;";
          $manage_result=mysqli_query($conn,$sql);
          $total_record=mysqli_num_rows($manage_result);

          if($total_record==0){
            echo "<script>alert('검색결과가 없습니다.');
                history.go(-1);
                </script>";
          }

          $total_pages=ceil($total_record/ROW_SCALE);


          // 페이지가 없으면 디폴트 페이지 1페이지
          $page=(empty($_GET['page']))?1:$_GET['page'];



          // 현재 블럭의 시작 페이지 = (ceil(현재페이지/블럭당 페이지 제한 수)-1) * 블럭당 페이지 제한 수 +1
          //[[  EX) 현재 페이지 5일 때 => ceil(5/3)-1 * 3  +1 =  (2-1)*3 +1 = 4 ]]
          $start_page= (ceil($page / PAGE_SCALE ) -1 ) * PAGE_SCALE +1 ;


          // 현재페이지 시작번호 계산함.
          //[[  EX) 현재 페이지 1일 때 => (1 - 1)*10 -> 0   ]]
          //[[  EX) 현재 페이지 5일 때 => (5 - 1)*10 -> 40  ]]
          $start_record=($page -1) * ROW_SCALE;


          // 현재 블럭 마지막 페이지
          // 전체 페이지가 (시작 페이지+페이지 스케일) 보다 크거나 같으면 마지막 페이지는 (시작페이지 + 페이지 스케일) -1 / 아니면 전체페이지 수 .
          //[[  EX) 현재 블럭 시작 페이지가 6/ 전체페이지 : 10 -> '10 >= (6+10)' 성립하지 않음 -> 10이 현재블럭의 가장 마지막 페이지 번호  ]]
          $end_page= ($total_pages >= ($start_page + PAGE_SCALE)) ? $start_page + PAGE_SCALE-1 : $total_pages;

          mysqli_data_seek($manage_result,$start_record);
          for ($record = $start_record; $record  < $start_record+ROW_SCALE && $record<$total_record; $record++){
            $row=mysqli_fetch_array($manage_result);
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
            for($j=0;$j<mysqli_num_rows($result_status_sql);$j++){
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
            <td class="package_list_view_name_value"><a href="admin_up_del_package.php?mode=<?=$p_code?>"><?=$p_name?></a></td>
            <td class="package_list_view_pay_value"><?=$p_pay?></td>
            <td>
              <output class="package_list_view_state_value" id="list_status"><?=$status?></output>
            </td>
          </tr>
          <?php

          }
           ?>
        </table>

    </div>
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
    <br><br><br>

      <br><br><br><br><br><br><br><br><br><br>
</div>
</body>
<footer>
  <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
</footer>
</html>4
