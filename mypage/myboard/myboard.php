<?php
/*
=================================================================
+ [DESC] 내가 쓴 글 목록 확인
+ [DATE] 2019-05-19
+ [NAME] 김민지
=================================================================
*/
session_start();
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css?ver=1">
    <title>산뜻 :: 즐거운 산행</title>
    <style media="screen">
    #myboard_list{width:1098px; margin-left:14%;}
    #title, #sub_title{margin-bottom:9px;}
    #i_field{border-bottom: 1px solid grey; border-left: 1px solid grey; border-right: 1px solid grey; border-top:1px solid black;}
    #i{font-size:40px; color:#2F9D27; float:left; padding-left:20px;padding-right:20px;}
    #i_div_ul{float:left;}
    #i_div_ul > ul{list-style-type:circle;}
    #search_field{background-color:#f2f2f2; border:1px solid #f2f2f2; font-size:14px;padding:10px;}
    #search_btn{color:white; border-radius: 3px; margin-bottom:0.5%; width: 85px; height: 36px; font-weight: bold; margin-right: 5px; cursor: pointer; border: 1px solid #2F9D27; background-color: #2F9D27;}
    #search_btn:hover {background-color: #47C83E;}
    #search_date{margin-left: 60px;}
    .date_select{width :100px; padding:10px; margin:2px;}
    #list_field{border: none; margin:0;padding:0;}
    #list_tbl_head{border-collapse: collapse; font-size: 13.5px; border:1px solid #dedede; text-align: center;}
    #list_tbl_head td{font-weight: 600; width:549px; height:37px; background-color: #f2f2f2; border-right:1px solid #dedede;}
    #list_tbl_head td:first-child{background-color: white;border:1px solid #3d3d3d; border-bottom-color: white;}
    #list_tbl_head td:hover {cursor: pointer; text-decoration: underline;}



    #list_tbl_body {-webkit-border-horizontal-spacing: 0px;-webkit-border-vertical-spacing: 0px;border-top-width: 0px;border-right-width: 0px;border-bottom-width: 0px;border-left-width: 0px;font-size: 0.89em; margin: 20px 0; border-collapse: separate; border: 1px solid #3d3d3d; border-bottom-color:#dedede; text-align: center;}
    #list_tbl_body tr:first-child{font-weight:bolder; color:#3d3d3d; background-color:#f2f2f2; }
    #list_tbl_body td{width: 120px; padding:12px; border-left:1px solid #dedede;border-bottom:1px solid #dedede;}
    #list_tbl_body {border-left:none;border-right:none;}
    #list_tbl_body tr td:first-child{border-left:none;}
    #list_tbl_body tr td:last-child{border-right:none;}
    .symbol_greater_than{margin-right: 3px;background-color:#1ae134; color:white; padding-bottom: 1px; font-size: 12px; padding-left:4px; padding-right:4px; border-radius:3px;}

    </style>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        // tap 메뉴 onclick action
        for (var i = 1; i < 4; i++) {
          $("#list_head"+i).click(function(){
            if($(this).css("background-color")!="white"){
              $("#list_head_tr").children('td').css('background-color', '#f2f2f2');
              $("#list_head_tr").children('td').css('border', '1px solid #dedede');
              $(this).css('background-color', 'white');
              $(this).css('border', '1px solid black');
              $(this).css('border-bottom-color', 'white');
            }
          });
        }
        // $("#list_head1").click(function(){
        //   if($("#list_head1").css("background-color")!="white"){
        //     $("#list_head1").css('background-color', 'white');
        //     $("#list_head1").css('border', '1px solid #3d3d3d');
        //     $("#list_head1").css('border-bottom-color', 'white');
        //     $("#list_head2").css('background-color', '#f2f2f2');
        //     $("#list_head2").css('border', '1px solid #dedede');
        //     $("#list_head1").css('border-right-color', '#3d3d3d');
        //   }
        // });
        // $("#list_head2").click(function(){
        //   if($("#list_head2").css('background-color')!="white"){
        //     $("#list_head2").css('background-color', 'white');
        //     $("#list_head2").css('border', '1px solid #3d3d3d');
        //     $("#list_head2").css('border-bottom-color', 'white');
        //     $("#list_head1").css('background-color', '#f2f2f2');
        //     $("#list_head1").css('border', '1px solid #dedede');
        //     $("#list_head1").css('border-right-color', '#3d3d3d');
        //   }
        // });
        // $("#list_head3").click(function(){
        //   if($("#list_head3").css('background-color')!="white"){
        //     $("#list_head3").css('background-color', 'white');
        //     $("#list_head3").css('border', '1px solid #3d3d3d');
        //     $("#list_head2").css('border-bottom-color', 'white');
        //     $("#list_head1").css('background-color', '#f2f2f2');
        //     $("#list_head1").css('border', '1px solid #dedede');
        //     $("#list_head1").css('border-right-color', '#3d3d3d');
        //     $("#list_head2").css('background-color', '#f2f2f2');
        //     $("#list_head2").css('border', '1px solid #dedede');
        //     $("#list_head2").css('border-right-color', '#3d3d3d');
        //   }
        // });
      });
    </script>

  </head>
  <body>
    <div id="wrap">
    <header><?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?></header>
    <hr>
    <!--마이페이지 리스트-->
    <div id="myboard_list">
        <h3 id="title" >참여내역</h3>
      <fieldset id="list_field">
        <table id="list_tbl_head"><tr id="list_head_tr"><td id="list_head1">상담문의</td><td id="list_head2">여행후기</td>
          <td id="list_head3">자유게시판</td>
        </tr></table>
        <table id="list_tbl_body">
          <tr>
            <td>예약날짜</td>
            <td>예약코드</td>
            <td>상품명</td>
            <td>총 결제금액</td>
            <td>인원</td>
            <td>출발일/귀국일</td>
            <!-- 취소내역 -> 예약상태 : 예약 취소  -->
            <td>예약상태</td>
            <td>결제상태</td>
            <td>후기</td>
          </tr>
          <output id="list_tbl_body_output">
            <tr><td colspan="9" style="padding:40px;">예약 내역이 없습니다.</td></tr>
          </output>
        </table>
      </fieldset>
    </div> <!-- end of div "reserve_list" -->
    <footer> <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?> </footer>
    </div>  <!-- end of div "wrap" -->
  </body>
</html>
