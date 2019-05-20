<script type="text/javascript">
  function control_display(){
      var con = document.getElementById("side_bar");
      if(con.style.display=='none'){
          con.style.display = 'block';
      }else{
          con.style.display = 'none';
      }
  }
</script>
<!-- 사이드바 컨트롤러 -->
<div id="side_bar_control">
  <button title="산뜻바 열기" id="side_bar_open_btn" type="button" name="button" onclick="control_display()"><b>+</b></button><br>
  <a href="#"><button title="맨 위로" id="side_bar_top_btn"  type="button" name="button"><b>▲</b></button></a>
</div>
<!-- 사이드바 -->
<div id="side_bar" style="display: none;">
  <!-- 비로그인->로그인//회원가입 or 로그인  ->장바구니//예약내역,결제내역  -->
  <div id="side_bar_top">
    <a href="#"><img title="장바구니" id="side_bar_cart_img" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/img/장바구니.jpg"></a>
    <a href="#"><img title="예약/결제확인" id="side_bar_confirm_img" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/img/예약결제확인.png"></a>
  </div>
    <!-- 사진경로  변수로 설정해주셔야 합니다 -->
  <div id="side_bar_recent">
    최근 본 상품
    <a href="#"><img class="side_bar_recent_img" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/img/백두산.jpg"></a>
    <div class="side_bar_recent_val"><a href="#">상품명/가격</a></div>
    <a href="#"><img class="side_bar_recent_img" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/img/한라산.jpg"></a>
    <div class="side_bar_recent_val"><a href="#">상품명/가격</a></div>
    <a href="#"><img class="side_bar_recent_img" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/img/지리산.jpg"></a>
    <div class="side_bar_recent_val"><a href="#">상품명/가격</a></div>
  </div>
  <div class="side_bar_middle">
  <br>
   <a class="side_bar_qna" href="#">소개</a><br>
   <a class="side_bar_qna" href="#">자주하는 질문</a><br>
   <a class="side_bar_qna" href="#">커뮤니티</a><br>
   <br>
  </div>
  <div class="side_bar_bottom">
    <a href="#"><button title="맨 위로" id="side_bar_top_btn"  type="button" name="button"><b>▲</b></button></a>
    <button title="산뜻바 닫기" id="side_bar_cancel_btn"  type="button" name="button" onclick="control_display()"><b>X</b></button>
    <br><br><p>TEL:02-000-0000</p>
  </div>
</div>
