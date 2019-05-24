<?php
include "../../common_lib/common.php";

$flag = "NO";
$sql = "show tables from ticketdreamDB";
$result = mysqli_query($con, $sql) or die("실패원인:" . mysqli_error($con));
while ($row = mysqli_fetch_row($result)) {
    if ($row[0] === "membership") {
        $flag = "OK";
        break;
    }
}
if ($flag !== "OK") {
    $sql = "create table membership (
      id char(12) not null primary key,
      pass char(16) not null,
      name char(10) not null,
      birth char(10) not null,
      gender char(6) not null,
      bank char(10),
      accountNum char(30),
      zip char(7) not null,
      address char(100) not null,
      phone char(13) not null,
      email char(30) not null,
      login char(10)
      )char set utf8";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('membership 테이블이 생성되었습니다.')</script>";
    } else {
        echo "실패원인:" . mysqli_error($con);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8>
<link href="../../common_css/common.css" rel="stylesheet">
<link href="../css/member.css" rel="stylesheet">
<script>
		var conf="y";
		function check_exp(elem, exp, msg){
			if(!elem.value.match(exp)){
				alert(msg);
				return true;
			}
		}
		function check_id(){
			window.open("check_id.php?id="+document.join_form.id.value, "IDcheck", "left=200, top=200, width=700, height=450, scrollbars=no, resizable=yes");
		}

		function check_email(){
			window.open("check_email.php", "IDEmail", "left=200, top=200, width=700, height=550, scrollbars=no, resizable=yes");
		}

		function check_input(){
			// 연락처 검사
			var exp_hp1= /^0[1-9][0-9]$/;
			var exp_hp2= /^[0-9]{4}$/;

			if(!document.join_form.hp1.value){
				alert("연락처를 입력해주세요");
				document.join_form.hp1.focus();
				return;
			}
			if(!document.join_form.hp2.value){
				alert("연락처를 입력해주세요");
				document.join_form.hp2.focus();
				return;
			}
			if(!document.join_form.hp3.value){
				alert("연락처를 입력해주세요");
				document.join_form.hp3.focus();
				return;
			}
			// 연락처 유효성 검사
			if(check_exp(document.join_form.hp1, exp_hp1, "연락처를 정확히 입력해주세요!")){
				document.join_form.hp1.focus();
				document.join_form.hp1.select();
				return;
			}
			if(check_exp(document.join_form.hp2, exp_hp2, "연락처를 정확히 입력해주세요!")){
				document.join_form.hp2.focus();
				document.join_form.hp2.select();
				return;
			}
			if(check_exp(document.join_form.hp3, exp_hp2, "연락처를 정확히 입력해주세요!")){
				document.join_form.hp3.focus();
				document.join_form.hp3.select();
				return;
			}

			// 이메일 확인
			if(!document.join_form.email1.value){
				alert("e-mail 인증을 해주세요");
				document.join_form.email1.focus();
				document.join_form.email1.select();
				return;
			}

			// 아이디 검사
			if(!document.join_form.id.value){
				alert("아이디를 입력해주세요!");
				document.join_form.id.focus();
				document.join_form.id.select();
				return;
			}

			var exp_id= /^[0-9a-zA-Z]{6,12}$/;
			if(check_exp(document.join_form.id, exp_id, "아이디는 6~12자리 영문 또는 숫자만 입력해주세요!")){
				document.join_form.id.focus();
				document.join_form.id.select();
				return;
			}

	        //비밀번호 입력여부 체크
	        if (!document.join_form.pass.value) {
	            alert("비밀번호를 입력하지 않았습니다.");
	            document.join_form.pass.focus();
	            return;
	        }

	        if (join_form.pass.value == join_form.id.value) {
	            alert("아이디와 비밀번호가 같습니다.");
	            document.join_form.pass.focus();
	            return;
	        }

			// 암호 검사
			var exp_pass= /^[0-9a-zA-Z~!@#$%^&*()]{10,16}$/;
			if(!document.join_form.pass.value){
				alert("암호를 입력해주세요");
				document.join_form.pass.focus();
				return;
			}
			if(check_exp(document.join_form.pass, exp_pass, "암호는 6~12자리 영문 또는 숫자만 입력해주세요!")){
				document.join_form.pass.focus();
				document.join_form.pass.select();
				return;
			}

			// 암호 일치 확인
			if(document.join_form.pass.value != document.join_form.pass_conf.value){
				alert("암호가 일치하지 않습니다. 다시 입력해주세요");
				document.join_form.pass.focus();
				document.join_form.pass.select();
				return;
			}

			// 이름 검사
			var exp_name= /^[가-힣]{2,5}$/;
			if(!document.join_form.name.value){
				alert("이름을 입력해주세요");
				document.join_form.name.focus();
				return;
			}
			if(check_exp(document.join_form.name, exp_name, "이름을 정확히 입력해주세요!(한글 입력!)")){
				document.join_form.name.focus();
				document.join_form.name.select();
				return;
			}

			// 성별 검사
			if(!document.join_form.gender.value){
				alert("성별을 선택해주세요");
				document.join_form.gender.focus();
				return;
			}

			// 주소 검사
 			if(!document.join_form.zip.value){
				alert("우편번호를 선택해주세요");
				document.join_form.zip.focus();
				return;
			}

			if(!document.join_form.address1.value){
				alert("주소를 입력해주세요");
				document.join_form.address1.focus();
				return;
			}

			if(!document.join_form.address2.value){
				alert("나머지 주소를 입력해주세요");
				document.join_form.address2.focus();
				return;
			}
			if(!document.getElementById("contract").checked){
				alert("이용 약관에 동의해주세요");
				return;
			}
 			document.join_form.submit();
		}
	</script>
<!-- 우편번호 검색API -->
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
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

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('postcode').value = data.zonecode; //5자리 새우편번호 사용
                    document.getElementById('address1').value = fullAddr;

                    // 커서를 상세주소 필드로 이동한다.
                    document.getElementById('address2').focus();
                }
            }).open();
        }
    </script>
<!-- end of 우편번호 검색API -->

<style type="text/css">
table tr td {
	height: 60px;
	padding-left: 20px;
	text-align: left;
}

.my_box {
	height: 25px;
}

.my_box2 {
	overflow: scroll;
	width: 900px;
	font-weight: bold;
}

#section {
	text-align: center;
}

#article {
	min-width: 800px;
	height: 500px;
	display: inline-table;
}
</style>
</head>

<body>
	<header>
	 <?php include "../../common_lib/top_login2.php"; ?>
</header>
	<div id="top_div">
    <?php include "../../common_lib/common_top2.php"; ?>
</div>

	<div id="section">
		<div id="article">
			<div id="head">
				<h2>회원가입</h2>
			</div>
			<hr>
			<div class=clear></div>

			<form name="join_form" method="post" action="./insert.php">
				<table id="join_form_content" border="0" cellpadding="5"
					cellspacing="0">
					<caption>
						<div id="join_form_title1">
							<b><font color="red">필수</font> 정보입력</b>
						</div>
						<div id="join_form_title2">
							<font color="red"><b>*</b></font> 표시가 된 항목은 필수 항목입니다.
						</div>
					</caption>

					<tr>
						<td class="col1"><font color="red"><b>*</b></font> 연락처</td>
						<td class="col2"><input class="my_box" type="text" name="hp1"
							size="2"> - <input class="my_box" type="text" name="hp2" size="3">
							- <input class="my_box" type="text" name="hp3" size="3"> <span
							id="must">* 전화번호 또는 휴대전화번호 중 하나를 입력하셔야 합니다.</span></td>
					</tr>
					<tr>
						<td class=col1><font color=red><b>*</b></font> 이메일주소</td>
						<td class=col2><input type=text name=email1 size=10 readonly  style="height: 30px;"> @ <input
							type=text name=email2 size=10 readonly style="width : 150px; height: 30px; " > <a href="#">
							<img src="../image/email_conf.jpg" onclick="check_email()" style="height: 25px"></a></td>
					</tr>

					<tr>
						<td class=col1><font color=red><b>*</b></font> 회원 ID</td>
						<td class=col2><input class="my_box" type=text name=id size=15
							readonly> <a href="#"><img src=../image/btn_chk_id.gif
								onclick="check_id()"></a> <span id=must>* 아이디는 6~12자리의 영문 또는 숫자
								혼용, 특수문자 제외</span></td>
					</tr>
					<tr>
						<td class=col1><font color=red><b>*</b></font> 비밀번호</td>
						<td class=col2><input class="my_box" type=password name=pass
							size=15> <span id=must>* 비밀번호는 10~16자리의 영문/숫자 또는
								영문/숫자/특수문자[!@#$%^&*()] 혼용</span></td>
					</tr>
					<tr>
						<td class=col1><font color=red><b>*</b></font> 비밀번호 확인</td>
						<td class=col2><input class="my_box" type=password name=pass_conf
							size=15> <span id=must>* 비밀번호를 한번 더 입력하세요.</span></td>
					</tr>
					<tr>
						<td class=col1><font color=red><b>*</b></font> 성명</td>
						<td class=col2><input class="my_box" type=text name=name size=15>
						</td>
					</tr>

					<tr>
						<td class=col1><font color=red><b>*</b></font> 생년월일</td>
						<td class=col2><select name="year" class="my_box">
    				<?php
        for ($i = 0; $i < 60; $i ++) {
            $year = 2018 - $i;
            echo "<option value=$year>$year</option>";
        }
        ?>
    			</select> 년 <select name="month" class="my_box">
    				<?php
        for ($i = 1; $i <= 12; $i ++) {
            echo "<option value=$i>$i</option>";
        }
        ?>
    			</select> 월 <select name="day" class="my_box">
    				<?php
        for ($i = 1; $i <= 31; $i ++) {
            echo "<option value=$i>$i</option>";
        }
        ?>
    			</select> 일</td>
					</tr>
					<tr>
						<td class=col1><font color=red><b>*</b></font> 성별</td>
						<td class=col2>
							<input type=radio name=gender value=male> 남자
							<input type=radio name=gender value=female> 여자
						</td>
					</tr>
					<tr>
						<td class=col1><font color=red><b>*</b></font> 환불 계좌</td>
						<td class=col2>
							<select name="bank_name" style="height: 40px;">
								<option value="" selected="selected">은행선택</option>
								<option value="국민">국민</option>
								<option value="우리">우리</option>
								<option value="하나">하나</option>
								<option value="농협">농협</option>
								<option value="카카오">카카오</option>
								<option value="기업">기업</option>
							</select>
							<input type=text name=accountNum style="height: 30px;">
						<span id=must>* 하이픈 (-)을 제외하고 입력해주세요.</span>
						</td>
					</tr>
					<tr>
						<td class=col1><font color=red><b>*</b></font> 우편번호</td>
						<td class=col2><input class="my_box" type="text" id="postcode"
							name="zip" placeholder="우편번호" readonly> <input type="button"
							onclick="execDaumPostcode()" value="도로명주소찾기"></td>
					</tr>
					<tr>
						<td class=col1 rowspan=2><font color=red><b>*</b></font>주소</td>
						<td class=col2><input class="my_box" type="text" id="address1"
							name="address1" placeholder="주소" readonly></td>
					</tr>
					<tr>
						<td class=col2><input class="my_box" type="text" id="address2"
							name="address2" placeholder="나머지 주소"> <span id=must>* 나머지 주소를
								입력하세요.</span></td>
					</tr>
				</table>
				<br> <br>


				<table border=0 cellpadding=5 cellspacing=0>
					<caption>
						<div id=join_form_title1>
							<b><font color=red>필수</font> 약관동의</b>
						</div>
					</caption>
					<tr>
						<td colspan="2"><b>티켓드림 이용약관 (필수)</b> <a href="#">약관전체보기 ></a></td>
					</tr>
					<tr>
						<td>
						<div class="my_box2">
						본 약관 중요사항 고지는 티켓드림 이용약관에 포함된 티켓드림,이용자,제공서비스,개인정보 보호정책, 회원탈퇴에 대한 정의를 요약한 것으로
						이용약관에 따른 구체적인 권리관계 및 의무사항은 반드시 전문보기를 확인하고 동의를 진행하여야 합니다.
						</div>
						</td>
					</tr>
					<tr>
						<td colspan="2"><b>전자금융거래 이용약관 (필수)</b> <a href="#">약관전체보기 ></a></td>
					</tr>
					<tr>
						<td>
						<div class="my_box2">
						본 약관 중요사항 고지는 전자금융거래 이용약관에 포함된 전자지급결제대행서비스, 결제대금예치서비스, 선불식전자지급수단 등의 정의를 요약한 것으로 이용약관에 따른 구체적인 권리관계 및 의무사항은 반드시 전문보기를 확인하고 동의를 진행 하여야 합니다
						본 약관은 주식회사 티켓드림 (이하 '회사'라 합니다)이 제공하는 전자금융거래 서비스를 ‘이용자’가 이용함에 있어, ‘회사’와 ‘이용자’ 간 권리, 의무 및 ‘이용자’의 서비스 이용절차 등에 관한 사항을 정함에 그 목적이 있습니다.
						</div>
						</td>
					</tr>
					<tr>
						<td colspan="2"><b>개인정보 수집 동의서 (필수)</b></td>
					</tr>
					<tr>
						<td>
						<div class="my_box2">
						티켓드림은 티켓드림회원에게 티켓 예매 서비스와 회원관리서비스, 그리고 보다 다양한 서비스 제공을 위하여 아래와 같이 회원의 개인정보를 수집, 활용합니다.
						* 본 수집동의서 상의 용어의 정의는 "티켓드림 이용약관 및 개인정보처리방침"에 준용하며 티켓드림 서비스 제공을 위해서 필요한 최소한의 개인정보이므로 동의를 해주셔야만 서비스를 이용 하실 수 있습니다.
						</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center;">
						<input type="checkbox" id="contract" value="y">필수약관 전체동의
						</td>
					</tr>
				</table>
				<div>
					<a href="#"> <img src="../image/btn_member_apply.jpg"
						onclick="check_input()">
					</a>
				</div>
			</form>
			<br>
		</div>
	</div>
	<footer>
	<?php include "../../common_lib/footer2.php"; ?>
</footer>
</body>
</html>
