<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/best3.css">
</head>
<?php
define(SCALE, 3);

  if($_GET['divide']){
    switch ($_GET['divide']) {
      case 'domestic':
      $divide_flag="where `package`.`p_airplane_num`='0'";
      break;
      case 'abroad':
      $divide_flag="where `package`.`p_airplane_num`!='0'";
      break;
      default:
      $divide_flag='';
        break;
    }

  }
  $best3_sql = "SELECT * ,sum(`r_adult`+`r_kid`+`r_baby`) from `reserve` join `package` on `reserve`.`r_code`=`package`.`p_code` $divide_flag group by `r_code` order by sum(`r_adult`+`r_kid`+`r_baby`) desc limit 3;";
  $best3_result=mysqli_query($conn,$best3_sql);

  for ($best3_record=0; $best3_record < SCALE ; $best3_record++) {
    $row = mysqli_fetch_array($best3_result);
    $p_code[$best3_record]=$row['p_code'];
    $p_name[$best3_record]=$row['p_name'];
    $p_dp_date[$best3_record]=$row['p_dp_date'];
    $p_pay[$best3_record]=$row['p_pay'];
    $p_main_img_copy1[$best3_record]=$row['p_main_img_copy1'];
    $p_period[$best3_record]=$row['p_period'];
    $timestamp = strtotime("$p_dp_date[$best3_record] +$p_period[$best3_record] days");
    $p_arr_date1[$best3_record] = date('y-m-d', $timestamp);
    $p_arr_date2[$best3_record] = "20".$p_arr_date1[$best3_record];
    $yoil = array("일","월","화","수","목","금","토");
    $day[$best3_record] = $yoil[date('w', strtotime($p_dp_date))];
    $day2[$best3_record] = $yoil[date('w', strtotime($p_arr_date2))];
    $p_pay[$best3_record]=number_format($p_pay[$best3_record]);
  }
 ?>

<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/best3.css?ver=2">
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
