<?php
/*
=================================================================
+ [DESC] 예약/결제 목록 확인
+ [DATE] 2019-05-26
+ [NAME] 김민지
=================================================================
*/
session_start();
$id=$_SESSION['id'];
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
$sql=$result=$total_record=$total_pages=$start_record=$row="";
$total_record=0;


//@@@@@@ MINJI 테스트
define('ROW_SCALE', 10);
define('PAGE_SCALE', 10);
//@@@ id 세션 아이디로 바꿔야 함 지금테스트중 !!
$sql="SELECT * from `reserve` join `package` on `reserve`.`r_code` = `package`.`p_code` where `reserve`.`r_id` = '$id';";

if(isset($_GET['mode'])){
    $date=$_GET['mode'];
    $sql=$sql." where `package`.`p_dp_date` = '$date';";
}

// 쿼리문실행문장
$result=mysqli_query($conn,$sql);
$total_record=mysqli_num_rows($result);
// 조건?참:거짓
$total_pages=ceil($total_record/ROW_SCALE);


// 페이지가 없으면 디폴트 페이지 1페이지
$page=(empty($_GET['page']))?1:$_GET['page'];

if(isset($_POST['page'])){
  $page=(empty($_POST['page']))?1:$_POST['page'];
}

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


// 리스트에 보여줄 번호를 최근순으로 부여함.
// 출력될 숫자

?>
<?php
  $now = new DateTime();
  $Y = $now -> format("Y");
  $m = $now -> format("m");
  $d = $now -> format("d");
  //t = the number of days in the given month
  $t = $now -> format("t");




 ?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css?ver=2">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/reserve/css/reserve_list.css?ver=3">
    <title>산뜻 :: 즐거운 산행</title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
    // 예약내역 취소내역 선택 부분
      $(document).ready(function() {
        $("#list_head1").click(function(){
          if($("#list_head1").css("background-color")!="white"){
            $("#list_head1").css('background-color', 'white');
            $("#list_head1").css('border', '1px solid #3d3d3d');
            $("#list_head1").css('border-bottom-color', 'white');
            $("#list_head2").css('background-color', '#f2f2f2');
            $("#list_head2").css('border', '1px solid #dedede');
            $("#list_head1").css('border-right-color', '#3d3d3d');
          }
        });
        $("#list_head2").click(function(){
          if($("#list_head2").css('background-color')!="white"){
            $("#list_head2").css('background-color', 'white');
            $("#list_head2").css('border', '1px solid #3d3d3d');
            $("#list_head2").css('border-bottom-color', 'white');
            $("#list_head1").css('background-color', '#f2f2f2');
            $("#list_head1").css('border', '1px solid #dedede');
            $("#list_head1").css('border-right-color', '#3d3d3d');
          }
        });
        //월 클릭 -> days 변화 이벤트
        $("#month1").click(function(event) {
          var days = lastday($("#year1").val(), $(this).val());
          $("#day1").html("");
          for(var i=1; i<=days; i++){
            $("#day1").append("<option value="+i+">"+i+"</option>");
          }
        });
        $("#month2").click(function(event) {
          var days = lastday($("#year2").val(), $(this).val());
          $("#day2").html("");
          for(var i=1; i<=days; i++){
          $("#day2").append("<option value="+i+">"+i+"</option>");
          }
        });
      });
      function lastday(year, month){
        var res = new Date(year, month,0);
        res = res.getDate();
        return res;
      }
    </script>
  </head>
  <body>
    <div id="wrap">
    <header><?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?></header>
    <hr>
    <!--예약 리스트 페이지-->
    <div id="reserve_list">
      <h3 id="title" >예약 및 결제 확인</h3>
      <fieldset id="i_field">
        <div id="i"><b>ⓘ</b></div><!-- end of div "i" -->
        <div id="i_div_ul">
          <ul>
            <li>예약코드를 클릭하시면 예약상세 페이지 확인이 가능하시며, 개별상품별 결제가 가능합니다.</li>
            <li>미결제로 취소된 예약 건의 경우 취소일로부터 3개월 경과 시 조회되지 않습니다.</li>
            <li>안내사항3</li>
            <li>안내사항4</li>
          </ul>
        </div>
      </fieldset>
      <br>
      <fieldset id="search_field">
        <span id="search_date">출발일</span>&nbsp;&nbsp;&nbsp;
        <select class="date_select" name="year1" id="year1" >
        <?php
          // 현재 연도 +- 2
          for ($i=$Y+2; $i > $Y-2 ; $i--) {
            if($i==$Y){
              echo '<option value="'.$i.'" selected >'.$i.'</option>';
            }else {
              echo '<option value="'.$i.'">'.$i.'</option>';
            }
          }
        ?>
        </select>년
        <select class="date_select" name="month1" id="month1">
          <?php
            // MONTH
            for ($i=1; $i <= 12 ; $i++) {
              if($i==$m){
                echo '<option value="'.$i.'" selected >'.$i.'</option>';
              }else {
                echo '<option value="'.$i.'">'.$i.'</option>';
              }
            }
          ?>
        </select>월

        <select class="date_select" name="day1" id="day1">
          <?php
            // DAYS
            for ($i=1; $i <= $t ; $i++) {
              if($i==$d){
                echo '<option value="'.$i.'" selected >'.$i.'</option>';
              }else {
                echo '<option value="'.$i.'">'.$i.'</option>';
              }
            }
          ?>
        </select>일
        &nbsp;~&nbsp;

        <select class="date_select" name="year2" id="year2" >
        <?php
          // 현재 연도 +- 2
          for ($i=$Y+2; $i > $Y-2 ; $i--) {
            if($i==$Y){
              echo '<option value="'.$i.'" selected >'.$i.'</option>';
            }else {
              echo '<option value="'.$i.'">'.$i.'</option>';
            }
          }
        ?>
        </select>년
        <select class="date_select" name="month2" id="month2">
          <?php
            // MONTH
            for ($i=1; $i <= 12 ; $i++) {
              if($i==$m){
                echo '<option value="'.$i.'" selected >'.$i.'</option>';
              }else {
                echo '<option value="'.$i.'">'.$i.'</option>';
              }
            }
          ?>
        </select>월
        <select class="date_select" name="day2" id="day2" >
          <?php
            // DAYS
            for ($i=1; $i <= $t ; $i++) {
              if($i==$d){
                echo '<option value="'.$i.'" selected >'.$i.'</option>';
              }else {
                echo '<option value="'.$i.'">'.$i.'</option>';
              }
            }
          ?>
        </select>일
          &nbsp;&nbsp;
        <input type="button" id="search_btn" name="" value="검색하기" >
      </fieldset>
      <br><br>
      <fieldset id="list_field" >
         <h4 id="sub_title"><b class="symbol_greater_than">></b>산뜻 예약/결제</h4>
        <table id="list_tbl_head"><tr><td id="list_head1">예약내역</td><td id="list_head2">취소내역</td></tr></table>
        <table id="list_tbl_body">
          <tr>
            <td>예약날짜</td>
            <td>예약코드</td>
            <td>상품명</td>
            <td>총 결제금액</td>
            <td>인원</td>
            <td>출발일/귀국일</td>
            <td>예약상태</td>
            <td>결제상태</td>
            <td>후기</td>
          </tr>
          <output id="list_tbl_body_output">
            <?php
            mysqli_data_seek($result,$start_record);
            for ($record = $start_record; $record  < $start_record+ROW_SCALE && $record<$total_record; $record++){
              $row=mysqli_fetch_array($result);
              //예약날짜/ 예약 코드/ 상품명/ 총 결제금액/ 인원/ 출발일*귀국일 / 예약상태 /결제상태 / 후기
              $r_date = $row['r_date'];
              $r_code=$row['r_code'];

              var_dump($r_kid);
              //상품명
              $p_name=$row['p_name'];
              //총 결제금액(결제 해야할 금액 - reserve.r_pay)
              $r_pay=$row['r_pay'];
              //인원
              $r_adult=$row['r_adult'];
//@@@@@@@@@@@MINJI
              $r_kid=$row['r_kid'];
              $r_baby=$row['r_baby'];
              $r_total = $r_adult + $r_kid + $r_baby;
              //출발일/귀국일
              $p_dp_date=$row['p_dp_date'];
              $p_period=$row['p_period'];
              $timestamp = strtotime("$p_dp_date +$p_period days");
              $p_arr_date1 = date('y-m-d', $timestamp);
              $p_arr_date2 = "20".$p_arr_date1;
              //예약상태
              //총 상품금액
              $b_pay=$row['b_pay'];


              $bill_sql = "SELECT * FROM `bill` where `b_code`=$r_code";
              //결제상태
              $bill_result=mysqli_query($conn,$bill_sql);
              $count=mysqli_num_rows($bill_result);
              $bill_row=mysqli_fetch_array($bill_result);

              $bill_status =$bill_row['b_pay'];
              if(empty($count)){
                $bill_status = "결제미완료";
              }
              // $b_pay=$bill_row['b_pay'];

              $p_pay=$row['p_pay'];
              //후기

              $reserve_status_sql = "SELECT sum(`r_adult`+`r_kid`+`r_baby`),`p_bus` from `package` inner join `reserve` on `package`.`p_code` = `reserve`.`r_code` where `reserve`.`r_code` = '$r_code';";
              $result_status_sql=mysqli_query($conn,$reserve_status_sql);
              $total=0;
              $states="";
              for($i=0;$i<mysqli_num_rows($result_status_sql);$i++){
                $row1 = mysqli_fetch_array($result_status_sql);
                $sum = $row1['sum(`r_adult`+`r_kid`+`r_baby`)'];
                $p_bus = $row1['p_bus'];
                $p_bus_half =(ceil($p_bus / 2));
                $total+=$sum;
              }



              if($total<$p_bus_half){
                $status="예약완료";
              }
              if($total>=$p_bus_half){
                $status="<a style='color:red;' href='../bill/bill_view.php'>결제대기</a>";
              }
             ?>
             <tr>
               <td><?=$r_date?></td >
               <td><?=$r_code?></td>
               <td><?=$p_name?></td>
               <td><?=$r_pay?></td>
               <td><?=$r_total?></td>
               <td><?=$p_dp_date?><br><?=$p_arr_date2?></td>

               <!-- //예약상태
               //결제상태
               //후기 -->
               <td><?=$status?></td>
               <td><?=$bill_status?></td>
               <td></td>
             </tr>
             <?php
               }
              ?>
          </output>
        </table>
      </fieldset>
      <?php
      if(empty($total_record)){
        echo '<p id="no_result" style="text-align:center; padding:2%;margin-bottom:3%;">예약된 산행 내역이 없습니다.</p>';
      }

       ?>


    </div> <!-- end of div "reserve_list" -->
    <footer> <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?> </footer>
    </div>  <!-- end of div "wrap" -->
  </body>
</html>
