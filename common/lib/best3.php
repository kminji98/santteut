<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
//best3 SCALE=>3
define(SCALE, 3);

  $sql = "SELECT * ,sum(`r_adult`+`r_kid`+`r_baby`) from `reserve` join `package` on `reserve`.`r_code`=`package`.`p_code` where `package`.`p_airplane_num` ='0' group by `r_code` order by sum(`r_adult`+`r_kid`+`r_baby`) desc limit 3;";
  $result=mysqli_query($conn,$sql);
  $total_records = mysqli_num_rows($result);
  for ($record=0; $record < SCALE ; $record++) {
    $row = mysqli_fetch_array($result);
    $p_code[$record]=$row['p_code'];
    $p_name[$record]=$row['p_name'];
    $p_dp_date[$record]=$row['p_dp_date'];
    $p_pay[$record]=$row['p_pay'];
    $p_main_img_copy1[$record]=$row['p_main_img_copy1'];
    $p_period[$record]=$row['p_period'];
    $timestamp = strtotime("$p_dp_date[$record] +$p_period[$record] days");
    $p_arr_date1[$record] = date('y-m-d', $timestamp);
    $p_arr_date2[$record] = "20".$p_arr_date1[$record];
    $yoil = array("일","월","화","수","목","금","토");
    $day[$record] = $yoil[date('w', strtotime($p_dp_date))];
    $day2[$record] = $yoil[date('w', strtotime($p_arr_date2))];
    $p_pay[$record]=number_format($p_pay[$record]);
  }
 ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/best3.css?ver=2">
</head>
<body>
    <div class="container" id="con1">
      <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/lib/editor/data/<?=$p_main_img_copy1[0]?>" alt="Avatar" class="image">
          <div class="content">
            TOP1
          </div>
          <div class="overlay">

            <div class="text">
              <h3><?=$p_name[0]?></h3>
            </div>
            <b>
              <?=$p_pay[0]?>
            </b>
            <br><br>
            <div class="text1">
              &nbsp; <?=$p_dp_date[0]?> (<?=$day[0]?>) ~
              <?=$p_dp_time[0]?><?php echo $p_arr_date2[0]." "."(".$day2[0].")"?>

            </div>
            <br>
            <div class="button1">
              <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/package/package_view.php?mode=<?=$p_code[0]?>">상품보기></a>
            </div>

          </div>
        </div>
        <div class="container" id="con2">
          <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/lib/editor/data/<?=$p_main_img_copy1[1]?>" alt="Avatar" class="image">

              <div class="content">
                TOP2
              </div>
              <div class="overlay">
                <div class="text">
                  <h3><?=$p_name[1]?></h3>
                </div>
                <b>
                  <?=$p_pay[1]?>
                </b>
                <br><br>
                <div class="text1">
                  &nbsp; <?=$p_dp_date[1]?> (<?=$day[1]?>) ~
                  <?=$p_dp_time[1]?><?php echo $p_arr_date2[1]." "."(".$day2[1].")"?>
                </div>
                <br>
                <div class="button1">
                  <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/package/package_view.php?mode=<?=$p_code[1]?>">상품보기></a>
                  <!-- <button type="button" name="button">상품보기></button> -->
                </div>
              </div>
</div>
    <div class="container" id="con3">
      <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/lib/editor/data/<?=$p_main_img_copy1[2]?>" alt="Avatar" class="image">
          <div class="content">
            TOP3
          </div>
          <div class="overlay">
            <div class="text">
              <h3><?=$p_name[2]?></h3>
            </div>
            <b>
              <?=$p_pay[2]?>
            </b>
            <br><br>
            <div class="text1">
              &nbsp; <?=$p_dp_date[2]?> (<?=$day[2]?>) ~
              <?=$p_dp_time[2]?><?php echo $p_arr_date2[2]." "."(".$day2[2].")"?>
            </div>
            <br>
            <div class="button1">
              <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/package/package_view.php?mode=<?=$p_code[2]?>">상품보기></a>
            </div>
          </div>
        </div>
</body>
</html>
