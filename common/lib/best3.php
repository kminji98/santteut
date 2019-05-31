<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/best3.css?ver=3">
<body>
<?php

$divide_flag='';
  if(isset($_GET['divide'])){
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

  for ($best3_record=0; $best3_record < 3 ; $best3_record++) {
    $row = mysqli_fetch_array($best3_result);
    $p_code[$best3_record]=$row['p_code'];
    $p_name[$best3_record]=$row['p_name'];
    $p_dp_date[$best3_record]=$row['p_dp_date'];
    $p_pay[$best3_record]=$row['p_pay'];
    $p_main_img_copy1[$best3_record]=$row['p_main_img_copy1'];
    $p_period[$best3_record]=$row['p_period'];
    $timestamp = strtotime("$p_dp_date[$best3_record]+$p_period[$best3_record] days");
    $p_arr_date1[$best3_record] = date('y-m-d', $timestamp);
    $p_arr_date2[$best3_record] = "20".$p_arr_date1[$best3_record];
    $yoil = array("일","월","화","수","목","금","토");
    $day[$best3_record] = $yoil[date('w', strtotime(isset($p_dp_date)))];
    $day2[$best3_record] = $yoil[date('w', strtotime(isset($p_arr_date2)))];
    $p_pay[$best3_record]=number_format($p_pay[$best3_record]);

 ?>
 <div class="container" id="con<?=($best3_record+1)?>">
   <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/lib/editor/data/<?=$p_main_img_copy1[$best3_record]?>" alt="Avatar" class="image">
   <div class="content">
     TOP<?=($best3_record+1)?>
   </div>
     <div class="overlay">
       <div class="text">
         <h3><?=$p_name[$best3_record]?></h3>
       </div>
       <b>
         <?=$p_pay[$best3_record].' \\'?>
       </b>
       <br><br>
       <div class="text1">
         &nbsp; <?=$p_dp_date[$best3_record]?> (<?=$day[$best3_record]?>) ~
        <?php echo $p_arr_date2[$best3_record]." "."(".$day2[$best3_record].")"?>
       </div>
       <br>
       <div class="button1">
         <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/tour/package/package_view.php?mode=<?=$p_code[$best3_record]?>"><button style="margin-top: 1%;padding:3%; border: 1px solid #2F9D27; font-size: 12px; color: white; background-color: #2F9D27; cursor: pointer; border-radius: 5px;" type="button" name="button">상품보기</button></a>
       </div>
     </div>
   </div>

<?php
} //end of for
 ?>

</body>

</html>
