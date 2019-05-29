<?php
$id=isset($_SESSION['id'])?$_SESSION['id']:'';
$r_code = isset($_GET["code"]);

define('ROW_SCALE', 10);
define('PAGE_SCALE', 10);


$after_sql = "SELECT * FROM `member_review` where `r_code`='$p_code' and `id`='$id';";
$after_result = mysqli_query($conn,$after_sql);
$total_record=mysqli_num_rows($after_result);

// 조건?참:거짓
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


?>
<style media="screen">
.page_button_group button{border-radius: 3px; margin-bottom:3%; width: 35px; height: 35px; font-weight: bold; margin-right: 5px; cursor: pointer; border: 1px solid #464646; background-color: white;}
.page_button_group button:hover{background-color: #2F9D27; color: white; border-radius: 3px; border: 1px solid #2F9D27;}
.page_button_group{ position: relative; margin-top: auto; margin-left: auto;text-align:center; margin-left: 12%; width: 100%; height: auto;}
a{text-decoration: none;}
</style>
<table id="tbl1">
  <tr>
    <td class="td1">NO</td>
    <td class="td2">제목</td>
    <td class="td3">작성자</td>
    <td class="td4">등록날짜</td>
    <td class="td5">평점</td>
  </tr>
<?php
mysqli_data_seek($after_result,$start_record);

for ($record = $start_record; $record  < $start_record+ROW_SCALE && $record<$total_record; $record++){
  //예약날짜/ 예약 코드/ 상품명/ 총 결제금액/ 인원/ 출발일*귀국일 / 예약/결제상태 /취소 / 후기
  $row = mysqli_fetch_array($after_result);
  $num = $row['num'];
  $id = $row['id'];
  $title = $row['title'];
  $w_date = $row['write_date'];
  $grade = $row['grade'];
  $pk = $row['r_pk'];


 ?>
    <tr>
      <td class="td1"><?=$num?></td>
      <td class="td2"><a href="../member_review/member_review.php?mode=view&r_pk=<?=$pk?>"><?=$title?></a></td>
      <td class="td3"><?=$id?></td>
      <td class="td4"><?=$w_date?></td>
      <td class="td5"><?=$grade?></td>
    </tr>
  <?php } ?>
  </table>
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
  <br><br>
