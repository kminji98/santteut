<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>회원가입</title>
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/introduction/css/history.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/member/join/css/join_member.css">
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
              <td colspan="3"><input type="text" name="join_id" placeholder="영문소문자/숫자 4~16자" size="40"></td>
            </tr>

            <!--비밀번호-->
            <tr>
              <th><label>비밀번호</label>&nbsp;<span>*</span></th>
              <td colspan="3"><input type="password" name="join_passwd" placeholder="영문대소문자/숫자 4~16자" size="40"></td>
            </tr>

            <!--비밀번호확인-->
            <tr>
              <th>&nbsp;<label>비밀번호확인</label>&nbsp;<span>*</span></th>
              <td colspan="3"><input type="password" name="join_passwdconfirm" placeholder="영문대소문자/숫자 4~16자" size="40"></td>
            </tr>

            <!--이름-->
            <tr>
              <th><label>이름</label>&nbsp;<span>*</span></th>
              <td colspan="3"><input type="text" name="join_name" size="40"></td>
            </tr>

            <!--주소_우편번호-->
            <tr>
              <th rowspan="3"><label>주소</label>&nbsp;<span>*</span></th>
              <td colspan="3" id="td_this"><input type="text" name="join_zip" size="10">
                <button type="button" name="button" id="zip_btn">우편번호</button>
              </td>

            </tr>

            <!--주소_기본-->
            <tr>
              <td colspan="3"><input type="text" name="join_foundational" placeholder="기본주소" size="40"></td>
            </tr>

            <!--주소_상세-->
            <tr>
              <td colspan="3"><input type="text" name="join_detail" placeholder="상세주소" size="40"></td>
            </tr>

            <!--일반전화-->
            <tr>
              <th><label>일반전화</label></th>
              <td colspan="3" id="join_tr7">
                <input type="tel" name="join_landline1" size="8">-<input type="tel" name="join_landline2" size="10">-<input type="tel" name="join_landline3" size="10">
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

              <input type="tel" name="join_cellphone" size="19">
              <button id="hp_btn" type="button" name="button">인증하기</button>
              </td>
            </tr>

            <!--인증번호입력-->
            <tr>
              <td colspan="4"><input type="text" name="cellphone_authentication" placeholder="인증번호를 입력하세요." size="69"></td>
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
          <button id="end_btn" type="button" name="button">가입</button>
          &nbsp;&nbsp;
          <button id="end_btn" type="button" name="button">취소</button>
        </div><!--end of join_form div-->
      </form>
    </section>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
