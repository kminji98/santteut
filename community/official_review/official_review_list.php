<?php
//******************************************************************
$mode=$find=$search=$q_search=$sql=$result=$total_record=$total_page="";
$page=$start=$number=$i=$row=$num=$title=$content=$regist_day=$main_img="";
//******************************************************************
session_start();
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/create_table_base.php";
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

create_table($conn, 'official_review');//공식산행후기 메인 테이블 생성
define('SCALE', 10);
$sql="SELECT * FROM `official_review` order by num desc";

if(isset($_GET["mode"]) && $_GET["mode"]=="search"){
  if(empty($_POST["search"])){alert_back('검색어를 입력해주세요.');}

  $find = test_input($_POST["find"]);
  $search = test_input($_POST["search"]);
  $q_search = mysqli_real_escape_string($conn, $search);
  $sql = "SELECT * FROM `official_review` where $find like '%$q_search%';";
}//end of if(search)

$result = mysqli_query($conn,$sql);
$total_record = mysqli_num_rows($result);

$total_page=($total_record % SCALE == 0)?($total_record/SCALE):(ceil($total_record/SCALE));

//2. 페이지가 없으면 디폴트 페이지 1페이지
$page=(!isset($_GET['page']))?(1):(test_input($_GET['page']));

//3. 현재페이지 시작번호계산함.
$start=($page-1) * SCALE;
//4. 리스트에 보여줄 번호를 최근순으로 부여함.
$number=$total_record - $start;
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>공식산행후기</title>
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/community/official_review/css/official_review_list.css?ver=0">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>

    <div class="community_section">
      <section>
        <div id="official_review">공식산행후기</div>
      </section>
      <section>
        <?php
          $sql = "SELECT * FROM `official_review` ORDER BY regist_day DESC;";
          $result = mysqli_query($conn, $sql) or die(mysqli_error($con));

          for($i=0;$i<$total_record;$i++){
            $row = mysqli_fetch_array($result);
            $num = $row['num'];
            $title = $row['title'];
            $content = $row['content'];
            $regist_day = $row['regist_day'];
            $main_img = $row['main_img'];
            ?>
            <a href="./official_review_view.php?num=<?=$num?>" id="review_a">
              <div class="review">
              <div class="review_img"><img src="./img/<?=$main_img?>" width="350px" height="400px"></div>
              <div class="review_title"><b><?=$title?></b></div><br>
              </div>
            </a>
            <?php
            }
            ?>
      </section>
    </div>
    <div class="clear"></div>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
