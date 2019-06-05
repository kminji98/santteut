<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/tour/lib/tour_query.php";
if(isset($_COOKIE["cookie2"])){  setcookie("cookie3",$_COOKIE["cookie2"],time() + 3600,'/');}
if(isset($_COOKIE["cookie1"])){  setcookie("cookie2",$_COOKIE["cookie1"],time() + 3600,'/');}
setcookie("cookie1",$p_code,time() + 3600,'/');
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/package/css/package_view.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/member_review/css/member_review_list.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/side_bar.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <style media="screen">
      a{color:#000;}
      .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 10; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
      }

      /* Modal Content/Box */
      .modal-content {
      text-align: center;
      background-color: #fefefe;
      margin: 10% auto; /* 15% from the top and centered */
      padding: 20px;
      border: 1px solid #888;
      width: 500px; /* Could be more or less, depending on screen size */
      height: auto;
      border-radius: 10px;
      }
    </style>
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

      wrap.style.height=parseInt(middle.offsetHeight)+615+"px";

    }

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
          <td class="left" id="arr" >출발지</td>
          <td id="arr_mt"><?=$p_dp_city?> (<?=$city?>종합버스터미널)</td>
        </tr>

        <tr>
          <td class="left" id="arr" >도착산</td>
          <td id="arr_mt"><?=$p_arr_mt?></td>
        </tr>

        <tr>
          <td class="left" id="arr" >옵션</td>
          <td id="arr_mt">추가경비: <?=$p_add_pay?>&nbsp;&nbsp;&nbsp;&nbsp; 자유일정: <?=$p_free_time?></td>
        </tr>

        <tr>
          <td class="left" id="res">예약현황</td>
          <td id="res_now">예약: <?=$total?>명 좌석: <?=$p_bus?>석 (최소출발 <?=$p_bus_half?>명)</td>
        </tr>
      </table>
      <script type="text/javascript">
      function modal_close(){
        var modal = document.getElementById('myModal');
        modal.style.display="none";
      }
      var terms = document.getElementById('terms');
      $(document).ready(function() {
       $("#terms").click(function(event) {
         terms_form();
       });

       function terms_form(){
        var modal = document.getElementById('myModal');
        var term = $("#term").html();
        $("#modal-content").html("");
        $("#modal-content").append("<h2>이용약관</h2><hr>");
        $("#modal-content").append("<div name='message_content' style='margin-top:10px; overflow:scroll; height: 400px;'>"+term+"</div>");
        $("#modal-content").append('<div class="button-8" id="button-3">');
        $("#button-3").append('<div class="eff-8"></div>');
        $("#button-3").append('<div class="btn" onclick="modal_close()"><span>확인</span></div>');
        $("#modal-content").append("</div>");

        modal.style.display="block";
      }
      });

      </script>
      <div id="term" style="display:none;">
        <h2>여행약관</h2><br>


        <h3>제1조 (목적)</h3>
        <hr>
        <p>이 약관은 (주)산뜻(이하 ‘당사’라 한다.)과 여행자가 체결한 국외 여행계약의 세부 이행 및 준수 사항을 정함을 목적으로 합니다.</p>


        <h3>제2조 (당사와 여행자 의무)</h3>
        <hr>
        <p>1. 당사는 여행자에게 안전하고 만족스러운 여행서비스를 제공하기 위하여 여행알선 및 안내, 운송, 숙박 등 여행 계획의 수립 및 실행 과정에서 맡은 바 임무를 충실히 수행하여야 합니다.</p>
        <p>2. 여행자는 안전하고 즐거운 여행을 위하여 여행자 간 화합도모 및 당사의 여행 질서 유지에 적극 협조하여야 합니다.</p>


        <h3>제3조 (용어의 정의)</h3>
        <hr>
        <p>여행의 종류 및 정의, 해외여행 수속대행업의 정의는 다음과 같습니다.</p>
        <p>1) 기획여행 : 당사가 미리 여행 목적지 및 관광 일정, 여행자에게 제공될 운송 및 숙식 서비스 내용(이하 ‘여행서비스’라 함), 여행 요금을 정하여 광고 또는 기타 방법으로 여행자를 모집하여 실시하는 여행.</p>
        <p>2) 희망여행 : 여행자(개인 또는 단체)가 희망하는 여행 조건에 따라 당사가 운송, 숙식, 관광 등 여행에 관한 전반적인 계획을 수립하여 실시하는 여행.</p>
        <p>3) 해외여행 수속대행(이하 수속대행 계약이라 함) : 당사가 여행자로부터 소정의 수속대행 요금을 받기로 약정하고, 여행자의 위탁에 따라 다음에 열거하는 업무(이하 수속대행 업무라 함)를 대행하는 것.</p>
        <p>- 표시/광고에 관한 기록 : 6개월 (전자상거래등에서의 소비자보호에 관한 법률)</p>
        <p>- 계약 또는 청약철회 등에 관한 기록 : 5년 (전자상거래등에서의 소비자보호에 관한 법률)</p>
        <p>- 신용정보의 수집/처리 및 이용 등에 관한 기록 : 3년 (신용정보의 이용 및 보호에 관한 법률)</p>
        <p>가. 사증, 재입국 허가 및 각종 증명서 취득에 관한 수속</p>
        <p>나. 출입국 수속 서류 작성 및 기타 관련 업무</p>


        <h3>제4조(계약의 구성)</h3>
        <hr>
        <p>1. 여행계약은 여행 계약서(붙임)와 여행약관, 여행 일정표(또는 여행 설명서)를 계약내용으로 합니다.</p>
        <p>2. 여행 일정표(또는 여행 설명서)에는 여행일자 별 여행지와 관광 내용, 교통수단, 쇼핑 횟수, 숙박장소, 식사 등 여행 실시 일정 및 여행사 제공 서비스 내용과 여행자 유의사항이 포함되어야 합니다.</p>


        <h3>제5조 (특약)</h3>
        <hr>
        <p>당사와 여행자는 관계 법규에 위반되지 않는 범위 내에서 서면으로 특약을 맺을 수 있습니다. 이 경우 표준 약관과 다름을 당사는 여행자에게 설명하여야 합니다.</p>
        <p>- 제공하는 개인정보 항목 : ID, 이메일, 서비스 이용기록, 접속</p>
        <p>- 제공정보의 이용 목적 : 콘텐츠 제공, 서비스 이용에 대한 통계</p>
        <p>단, 당사는 이들 제3자가 당사 사이트에서 귀하에 대한 개인연락처 (이메일 주소 등) 정보를 수집하도록 허가하지 아니하며 또는 그들과 귀하의 개인정보를 공유하지 않습니다. 당사는 이들 제3자가 귀하의 관심사에 대한 정보를 수집하는데 사용하는 쿠키나 기타 기술에 대하여 접근하거나 통제할 수 없으며 이들 제3자의 정보수집행위에는 이 개인정보취급방침이 적용되지 않음을 유의하시기 바랍니다. 귀하는 제3자의 웹사이트에 게시된 개인정보취급방침을 검토하여 그들의 개인정보 수집, 사용 및 공개에 관한 절차를 확인할 수 있습니다.</p>


        <h3>제6조 (계약서 및 약관 등 교부 간주)</h3>
        <hr>
        <p>당사와 여행자는 다음 각 호의 경우 여행 계약서와 여행약관 및 여행 일정표(또는 여행 설명서)가 교부된 것으로 간주합니다.</p>
        <p>1) 여행자가 인터넷 등 전자 정보망으로 제공된 여행 계약서, 약관 및 여행 일정표(또는 여행 설명서)의 내용에 동의하고 여행계약의 체결을 신청한 데 대해 당사가 전자 정보망 내지 기계적 장치 등을 이용하여 여행자에게 승낙의 의사를 통지한 경우</p>
        <p>2) 당사가 팩시밀리 등 기계적 장치를 이용하여 제공한 여행 계약서, 약관 및 여행 일정표(또는 여행 설명서)의 내용에 대하여 여행자가 동의하고 여행계약의 체결을 신청하는 서면을 송부한 데 대해 당사가 전자 정보망 내지 기계적 장치 등을 이용하여 여행자에게 승낙의 의사를 통지한 경우</p>


        <h3>제7조 (당사의 책임)</h3>
        <hr>
        <p>당사는 여행 출발 시부터 도착 시까지 당사 본인 또는 그 고용인, 현지 여행업자 또는 그 고용인 등(이하 ‘사용인’이라 함)이 제2조 제1항에서 규정한 당사 임무와 관련하여 여행자에게 고의 또는 과실로 손해를 가한 경우 책임을 집니다.</p>


        <h3>제8조 (최저 행사 인원 미 충족 시 계약해제)</h3>
        <hr>
        <p>1. 당사가 최저 행사 인원 충족되지 아니하여 여행계약을 해제하는 경우 여행개시 7일 전까지 여행자에게 통지하여야 합니다.</p>
        <p>2. 당사가 여행 참가자 수 미달로 전항의 기일 내 통지를 하지 아니하고 계약을 해제하는 경우 이미 지급받은 계약금 환급 외에 다음 각 항목의 1의 금액을 여행자에게 배상하여야 합니다.</p>
        <p>  1) 여행개시 1일전까지 통지 시 : 여행요금의 30%</p>
        <p>  2) 여행 당일 통지 시 : 여행요금의 50%</p>
        <p>  (※ 여행요금이란 일정표상 명시된 총 상품 가격을 의미한다)</p>

        <h3>제9조 (계약 체결 거절)</h3>
        <hr>
        <p>당사는 여행자에게 다음 각 호의 1에 해당하는 사유가 있을 경우에는 여행자와의 계약 체결을 거절할 수 있습니다.</p>
        <p>1) 다른 여행자에게 폐를 끼치거나 여행의 원활한 실시에 지장이 있다고 인정될 때</p>
        <p>2) 질병 기타 사유로 여행이 어렵다고 인정될 때</p>
        <p>3) 명시한 최대 행사 인원이 초과되었을 때</p>
        <p>4) 일정표에 최저 행사 인원이 미달되었을 때</p>


        <h3>제10조 (여행요금)</h3>
        <hr>
        <p>1. 여행 계약서의 여행요금에는 다음 각 호가 포함됩니다. 단, 다음의 1)~9)호는 여행자 본인이 직접 여행지에서 지불하여야 할 금액이나 당사가 여행자 편의를 위하여 수탁 받아 이를 대신 지불합니다.</p>
        <p>1) 항공기, 선박, 철도 등 이용 운송 기관의 운임(보통운임기준)</p>
        <p>2) 공항, 역, 부두와 호텔 사이 등 송영 버스 요금</p>
        <p>3) 숙박요금 및 식사 요금</p>
        <p>4) 안내자 경비</p>
        <p>5) 여행 중 필요한 각종 세금</p>
        <p>6) 국내외 공항, 항만세</p>
        <p>7) 관광진흥개발기금</p>
        <p>9) 기타 개별 계약에 따른 비용</p>
        <p>10) 여행 알선 수수료</p>
        <p>2. 여행자는 계약 체결 시 계약금(여행요금 중 계약금으로 별도 고지된 금액)을 당사에게 지급하여야 하며, 계약금은 여행요금 또는 손해배상액의 전부 또는 일부로 취급합니다.</p>
        <p>3. 여행자는 제1항의 여행요금 중 계약금을 제외한 잔금을 여행 출발 7일전까지 당사에게 지급하여야 합니다.</p>
        <p>4. 여행자는 제1항의 여행요금을 당사자가 약정한 바에 따라 카드, 계좌이체, 또는 무통장입금 등의 방법으로 지급하여야 합니다.</p>
        <p>5. 희망여행요금에 여행자 보험료가 포함되는 경우 당사는 보험 회사명, 보상 내용 등을 여행자에게 설명하여야 합니다.</p>
      </div>

      <div id="myModal" class="modal">
       <div class="modal-content" id="modal-content">

        </div>
      </div>

      <div id="tour_text2">  <b class="label_img">></b>  <b id="sel_text">상품약관</b>&nbsp;&nbsp; <input type="button" id="terms" name="" value="약관보기"> </div>
      <br>
      <div id="tour_text2">  <b class="label_img">></b>  <b id="sel_text">상세페이지</b></div>
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
        <p id="line">------------------------------------------</p>
      </div>
      <div id="button">
        <div id="reserve_status" onclick="people_submit()" <?php if(isset($disabled)){ echo $disabled;} ?>> <b id="status"><?=$status?></b></div><br>
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

          function back(){
            var status = document.getElementById('status');
            if(status.innerHTML=="예약마감" || status.innerHTML=="마감"){
              alert("마감되었습니다.");
              location.href='../../index.php';
              return false;
            }else{
              var code = <?=json_encode($p_code)?>;
              location.href='../cart/cart_list.php?mode=insert&code='+code;
            }
          }
        </script>
        <div id="go_cart" onclick="back()" style="cursor:pointer;"> <b>장바구니</b></div>
      </div>
    </div>
  </div>
    <div class="" style="max-height:20000px;">
          <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/tour/member_review/member_review_list.php";?>
    </div>

  </body>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
  </footer>

</html>
