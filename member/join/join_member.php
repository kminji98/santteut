<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>회원가입</title>
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/introduction/css/history.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/join/css/join_member.css">
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

    <!-- 아이디중복확인 -->
    <script type="text/javascript">
    $(document).ready(function(){
     $("#join_id").keyup(function(e){
       var sendid = document.getElementById("sendid");
       var possibility = document.getElementById("possibility");
       var join_id = document.getElementById("join_id");
       var idPattern = /^[a-zA-Z0-9]{3,15}$/;
       //나이 검증
       if(!idPattern.test(join_id.value)){
         if(possibility=='아이디가 이미 존재합니다.'){
           $("#possibility").text('아이디가 이미 존재합니다.');
           $("#possibility").css('color', 'red');
           return false;
         }{
           $("#possibility").text("영문,숫자만 입력/3~15글자");
           $("#possibility").css('color', 'red');
           return false;
         }

       }

       $.ajax({
         url: 'check_id2.php?mode=id_check',
         type: 'GET',
         data: {id: $("#join_id").val()}
       })
       .done(function(result) {
         // alert(result);
         if(result=='아이디가 이미 존재합니다.'){
          $("#possibility").text(result);
          $("#possibility").css('color', 'red');
        }else{
          $("#possibility").text(result);
          $("#possibility").css('color', 'blue');
        }

       })
       .fail(function() {
         console.log("error");
       })
       .always(function() {
         console.log("complete");
       });
     });
   });
    </script>





    <!-- 다음 주소찾기 -->
    <script>
      var final_email_che=false;
      function execDaumPostcode() {/* 폼은 다음 주소찾기 빌리면서 입력값은 여기서 받고 처리하네?  */
            new daum.Postcode({
                oncomplete: function(data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var fullAddr = ''; // 최종 주소 변수
                    var extraAddr = ''; // 조합형 주소 변수

                    // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        fullAddr = data.roadAddress;

                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        fullAddr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                    if(data.userSelectedType === 'R'){
                        //법정동명이 있을 경우 추가한다.
                        if(data.bname !== ''){
                            extraAddr += data.bname;
                        }
                        // 건물명이 있을 경우 추가한다.
                        if(data.buildingName !== ''){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                        fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                    }

                    // // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('join_zip').value = data.zonecode; //5자리 새우편번호 사용
                    document.getElementById('join_foundational').value = fullAddr; //실제 주소

                    // 커서를 상세주소 필드로 이동한다.
                    document.getElementById('join_detail').focus();
                }
            }).open();
        }
    </script>


    <!-- 이메일함수 선택 -->
    <script type="text/javascript">
    function choice_email(){
      var e_mail_adress_1 = document.getElementById("e_mail_adress_1");
      var e_mail_adress_2 = document.getElementById("e_mail_adress_2");
      // e_mail_adress_1.options[e_mail_adress_1.selectedIndex].text
      e_mail_adress_2.value=e_mail_adress_1.options[e_mail_adress_1.selectedIndex].text;
    }
    </script>


    <!-- 패턴검사 -->
    <script type="text/javascript">
      function goto_join(){
         var join_id = document.getElementById("join_id");
         var join_passwd = document.getElementById("join_passwd");
         var join_passwdconfirm = document.getElementById("join_passwdconfirm");
         var join_name = document.getElementById("join_name");
         var join_zip = document.getElementById("join_zip");
         var join_foundational = document.getElementById("join_foundational");
         var join_detail = document.getElementById("join_detail");
         var e_mail_id = document.getElementById("e_mail_id");
         var e_mail_adress_1 = document.getElementById("e_mail_adress_1");
         var e_mail_adress_2 = document.getElementById("e_mail_adress_2");
         var join_select = document.getElementById("join_select");
         var join_phone_write = document.getElementById("join_phone_write");
         var cellphone_authentication = document.getElementById("cellphone_authentication");

         var join_id_Patt = /^[a-zA-Z0-9]{3,15}$/;
         var join_passwd_Patt = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15}/;
         var join_name_Patt = /^[가-힣]{2,5}$/;
         var e_mailPatt = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
         // var phoneNumberPatt = /^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/;

         var e_mail_id_value1=e_mail_id.value.concat('@'+e_mail_adress_1.options[e_mail_adress_1.selectedIndex].text);
         var e_mail_id_value2=e_mail_id.value.concat('@'+e_mail_adress_2.value);

         // alert(e_mail_id_value1);
         // alert(e_mail_id_value2);

        if(!join_id_Patt.test(join_id.value)){
           alert("아이디 형식이 잘못 되었습니다");
           join_id.focus();
           join_id.value="";
           return false;
         }else if(!join_passwd_Patt.test(join_passwd.value)){
           alert("비밀번호:적어도 소문자 하나, 대문자 하나,숫자 하나가 포함되어 있는 문자열(8~15)");
           join_passwd.focus();
           join_passwd.value="";
           return false;
         }else if(join_passwd.value!=join_passwdconfirm.value){
           alert("비밀번호가 같지 않습니다.");
           join_passwdconfirm.focus();
           join_passwdconfirm.value="";
           return false;
         }else if(!join_name_Patt.test(join_name.value)){
           alert("이름을 확인해주세요");
           join_name.focus();
           join_name.value="";
           return false;
         }else if(!join_zip.value){
           alert("주소를 입력해주세요");
           join_zip.focus();
           join_zip.value="";
           return false;
         }else if(!join_detail.value){
           alert("상세주소를 입력해주세요");
           join_detail.focus();
           join_detail.value="";
           return false;
         }else if(!e_mail_id.value){
           alert("이메일 아이디를 입력해주세요");
           e_mail_id.focus();
           e_mail_id.value="";
           return false;
         }

      }
    </script>









  </head>
  <body>
    <!--로그인 회원가입 로그아웃-->
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
    <h2 id="join_title">회원가입</h2>
    <hr>
    <section>
      <!-- <form name="member_form" action="check_id.php?mode=insert" method="post"> -->

      <form name="join_member_form" action="" method="">
        <div class="join_form">
          <h3>회원가입</h3>

          <table  id="table1">
            <!--필수입력사항-->
            <tr>
              <td id="join_tr1" colspan="4"><span>*</span> 필수입력사항</td>
            </tr>

            <!--아이디-->
            <tr>
              <th><label>아이디</label>&nbsp;<span>*</span></th>
              <td  colspan="3"><input id="join_id" type="text" name="join_id" placeholder="대/소문자/숫자 3글자 이상 15글자이하" size="40">&nbsp;&nbsp;<p id="possibility" style="display:inline;">z</p></td>
            </tr>

            <!--비밀번호-->
            <tr>
              <th><label>비밀번호</label>&nbsp;<span>*</span></th>
              <td  colspan="3"><input id="join_passwd" type="password" name="join_passwd" placeholder="소,대문자/숫자 모두포함(8~15)" size="40"></td>
            </tr>

            <!--비밀번호확인-->
            <tr>
              <th>&nbsp;<label>비밀번호확인</label>&nbsp;<span>*</span></th>
              <td colspan="3"><input id="join_passwdconfirm" type="password" name="join_passwdconfirm" placeholder="소,대문자/숫자 모두포함(8~15)" size="40"></td>
            </tr>

            <!--이름-->
            <tr>
              <th><label>이름</label>&nbsp;<span>*</span></th>
              <td colspan="3"><input placeholder="2~5글자" id="join_name" type="text" name="join_name" size="40"></td>
            </tr>

            <!--주소_우편번호-->
            <tr>
              <th rowspan="3"><label>주소</label>&nbsp;<span>*</span></th>
              <td colspan="3" id="td_this"><input readonly id="join_zip" type="text" name="join_zip" size="10">
                <button type="button" name="button" id="zip_btn" onclick="execDaumPostcode()" >우편번호</button>
              </td>

            </tr>

            <!--주소_기본-->
            <tr>
              <td colspan="3"><input readonly id="join_foundational" type="text" name="join_foundational" placeholder="기본주소" size="40"></td>
            </tr>

            <!--주소_상세-->
            <tr>
              <td colspan="3"><input id="join_detail" type="text" name="join_detail" placeholder="상세주소" size="40"></td>
            </tr>
            <tr>
              <th><label>이메일</label></th>
              <td>
                <input id="e_mail_id" type="text" name="e_mail_id" size="17"> @
                <select onclick="choice_email()" id="e_mail_adress_1" class="" name="e_mail_adress_1" style=" padding: 9px; font-size:13px;">
                  <option value="" >naver.com</option>
                  <option value="" >gmail.com</option>
                  <option value="" >daum.net</option>
                  <option value="" >nate.com</option>
                  <option value="" >yahoo.com</option>
                  <option value="" >직접입력</option>
                </select>
                <input readonly id="e_mail_adress_2" placeholder="naver.com" type="text" name="e_mail_adress_2" size="13" style="text-align: center;">
                <button id="e_btn" type="button" name="button">인증하기</button>
              </td>
            </tr>
            <!--일반전화-->
            <tr>
              <th><label>일반전화</label></th>
              <td colspan="3" id="join_tr7">
                <input id="join_landline1" type="tel" name="join_landline1" size="8">-<input id="join_landline2" type="tel" name="join_landline2" size="10">-<input id="join_landline3" type="tel" name="join_landline3" size="10">

              </td>
            </tr>

            <!--휴대전화-->
            <tr>
              <th>&nbsp;&nbsp;&nbsp;<label>휴대전화</label>&nbsp;<span>*</span></th>
              <td colspan="3">
                <select id="join_select">
                  <option value="선택">선택</option>
                  <option value="010">010</option>
                  <option value="011">011</option>
                  <option value="016">016</option>
                  <option value="017">017</option>
                  <option value="018">018</option>
                  <option value="019">019</option>
                </select>

              <input id="join_phone_write" type="tel" name="join_cellphone" size="19">
              <button id="hp_btn" type="button" name="button">인증하기</button>
              </td>
            </tr>

            <!--인증번호입력-->
            <tr>
              <td colspan="4"><input id="cellphone_authentication" type="text" name="cellphone_authentication" placeholder="인증번호를 입력하세요." size="25">
              <button id="hp_btn_done" type="button" name="button">확인</button>
              </td>

            </tr>
          </table>

          <br>

          <table id="table2">
            <!--이용약관-->
            <tr>
              <td id="table_tr1" colspan="4"><b><span>필수</span>약관동의</b></td>
            </tr>

            <!--이용약관_모두동의-->
            <tr>
              <td id="table_tr1" colspan="4"> <input type="checkbox" name="" value=""> <b>약관 모두 동의</b></td>
            </tr>

            <!--이용약관1-->
            <tr>
              <td colspan="4">
                <b>개인정보 수집 및 이용에 대한 동의</b>
                <textarea name="name" rows="5" cols="100">
1. 개인정보 수집 및 이용목적
회사는 여행상품의 예약 및 여행관련 서비스 제공 등의 업무처리를 위하여 고객으로부터 최소한의 필수정보를 수집하며, 제공한 모든 개인정보는 별도의 동의가 없는 한 해당목적 이외의 다른 목적으로 사용하지 않습니다.
회사는 수집한 개인정보를 다음의 목적을 위하여 사용합니다.
가. 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산
여행상품 예약, 여행자보험 가입, 항공권/호텔 등의 예약 및 출입국 정보확인, 예약내역의 확인 및 상담, 컨텐츠 제공, 여행서비스 이용 시 회원의 우대 구매 및 요금결제, 하나투어 마일리지 가입 및 적립/사용 (하나투어 마일리지 회원(HC클럽)가입자에 한함), 물품배송 또는 청구서 등 발송, 금융서비스 등
나. 회원관리
회원제 서비스 이용을 위한 식별, 불량회원의 부정 이용 방지와 비인가 사용 방지, 가입 의사 확인, 이용 및 이용횟수 제한, 연령확인, 만14세 미만 아동 개인정보 수집 시 법정 대리인 동의여부 확인, 분쟁조정을 위한 기록보존, 불만처리 등 민원처리, 고지사항 전달 등

2. 개인정보 수집 항목 및 보유 및 이용기간
가. 회사는 적법한 절차와 법적 기준에 의거하여 고객의 개인정보를 수집하고 있으며, 고객의 서비스이용에 필요한 최소한의 정보만을 수집하고 있습니다.
정보통신망법과 개인정보보호법에 의거하여 수집, 이용을 제한하고 있습니다.
나. 회사는 고객의 인권을 침해할 우려가 있는 민감한 개인정보항목(인종, 종교, 사상, 정치적 성향, 건강상태, 성생활정보 등)은 수집하지 않습니다.

--------------------아직 다안했다 바부야-------------------------
                </textarea>
              </td>
            </tr>

            <!--이용약관1 동의?-->
            <tr>
              <td colspan="4">
              <input type="checkbox" name="" value=""> <b>동의</b>
            </tr>

            <!--이용약관2-->
            <tr>
              <td colspan="4">
                <b>개인정보 수집 및 이용에 대한 동의</b>
                <textarea name="name" rows="5" cols="100">
1. 개인정보 수집 및 이용목적
회사는 여행상품의 예약 및 여행관련 서비스 제공 등의 업무처리를 위하여 고객으로부터 최소한의 필수정보를 수집하며, 제공한 모든 개인정보는 별도의 동의가 없는 한 해당목적 이외의 다른 목적으로 사용하지 않습니다.
회사는 수집한 개인정보를 다음의 목적을 위하여 사용합니다.
가. 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산
여행상품 예약, 여행자보험 가입, 항공권/호텔 등의 예약 및 출입국 정보확인, 예약내역의 확인 및 상담, 컨텐츠 제공, 여행서비스 이용 시 회원의 우대 구매 및 요금결제, 하나투어 마일리지 가입 및 적립/사용 (하나투어 마일리지 회원(HC클럽)가입자에 한함), 물품배송 또는 청구서 등 발송, 금융서비스 등
나. 회원관리
회원제 서비스 이용을 위한 식별, 불량회원의 부정 이용 방지와 비인가 사용 방지, 가입 의사 확인, 이용 및 이용횟수 제한, 연령확인, 만14세 미만 아동 개인정보 수집 시 법정 대리인 동의여부 확인, 분쟁조정을 위한 기록보존, 불만처리 등 민원처리, 고지사항 전달 등

2. 개인정보 수집 항목 및 보유 및 이용기간
가. 회사는 적법한 절차와 법적 기준에 의거하여 고객의 개인정보를 수집하고 있으며, 고객의 서비스이용에 필요한 최소한의 정보만을 수집하고 있습니다.
정보통신망법과 개인정보보호법에 의거하여 수집, 이용을 제한하고 있습니다.
나. 회사는 고객의 인권을 침해할 우려가 있는 민감한 개인정보항목(인종, 종교, 사상, 정치적 성향, 건강상태, 성생활정보 등)은 수집하지 않습니다.

--------------------아직 다안했다 바부야-------------------------
                </textarea>
            </tr>

            <!--이용약관2 동의?-->
            <tr>
              <td colspan="4"><input type="checkbox" name="" value=""> <b>동의</b>
            </tr>

            <!--이용약관3-->
            <tr>
              <td colspan="4">
                <b>개인정보 수집 및 이용에 대한 동의</b>
                <textarea name="name" rows="5" cols="100">
1. 개인정보 수집 및 이용목적
회사는 여행상품의 예약 및 여행관련 서비스 제공 등의 업무처리를 위하여 고객으로부터 최소한의 필수정보를 수집하며, 제공한 모든 개인정보는 별도의 동의가 없는 한 해당목적 이외의 다른 목적으로 사용하지 않습니다.
회사는 수집한 개인정보를 다음의 목적을 위하여 사용합니다.
가. 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산
여행상품 예약, 여행자보험 가입, 항공권/호텔 등의 예약 및 출입국 정보확인, 예약내역의 확인 및 상담, 컨텐츠 제공, 여행서비스 이용 시 회원의 우대 구매 및 요금결제, 하나투어 마일리지 가입 및 적립/사용 (하나투어 마일리지 회원(HC클럽)가입자에 한함), 물품배송 또는 청구서 등 발송, 금융서비스 등
나. 회원관리
회원제 서비스 이용을 위한 식별, 불량회원의 부정 이용 방지와 비인가 사용 방지, 가입 의사 확인, 이용 및 이용횟수 제한, 연령확인, 만14세 미만 아동 개인정보 수집 시 법정 대리인 동의여부 확인, 분쟁조정을 위한 기록보존, 불만처리 등 민원처리, 고지사항 전달 등

2. 개인정보 수집 항목 및 보유 및 이용기간
가. 회사는 적법한 절차와 법적 기준에 의거하여 고객의 개인정보를 수집하고 있으며, 고객의 서비스이용에 필요한 최소한의 정보만을 수집하고 있습니다.
정보통신망법과 개인정보보호법에 의거하여 수집, 이용을 제한하고 있습니다.
나. 회사는 고객의 인권을 침해할 우려가 있는 민감한 개인정보항목(인종, 종교, 사상, 정치적 성향, 건강상태, 성생활정보 등)은 수집하지 않습니다.

--------------------아직 다안했다 바부야-------------------------
                </textarea>
            </tr>

            <!--이용약관3 동의?-->
            <tr>
              <td colspan="4"><input type="checkbox" name="" value=""> <b>동의</b></td>
            </tr>
          </table>
          <br>
          <button id="end_btn" type="button" name="button" onclick="goto_join()">가입</button>
          &nbsp;&nbsp;
          <button id="end_btn2" type="button" name="button">취소</button>
        </div><!--end of join_form div-->
      </form>
    </section>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
