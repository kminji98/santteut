<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
//********************************************************************
$p_name="";
$sum=0;
$divide_flag="";
$divide = "";
//********************************************************************

  if(!empty($_POST['divide'])) {
    $divide = $_POST['divide'];
  }else{
    $divide = '';
  }
    switch($divide){
      case 'domestic':
      $divide_flag = "WHERE `package`.`p_airplane_num` ='0'";
      $str_title = "국내";
      break;
      case 'abroad':
      $divide_flag = "WHERE `package`.`p_airplane_num` != '0'";
      $str_title = "해외";
      break;
      case '':
      $divide_flag = '';
      $str_title = "국내외";
      break;
    }

  $sql = "SELECT `package`.`p_code`, `package`.`p_arr_mt`, sum(`r_adult`+`r_kid`+`r_baby`) FROM `reserve` JOIN `package` ON `reserve`.`r_code` = `package`.`p_code` $divide_flag GROUP BY `r_code` ORDER BY sum(`r_adult`+`r_kid`+`r_baby`) DESC LIMIT 10;";
  $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
  //$total_record = mysqli_num_rows($result);
  //var_export($total_record);
  mysqli_data_seek($result, 0);
  $row = mysqli_fetch_array($result);
    $p_code0 = $row[0];
    $p_name0 = $row[1];
    $sum0 = $row[2];
    if($sum0==NULL){
      $sum0=0;
    }
    // var_export($p_code0);
    // var_export($p_name0);
    // var_export($sum0);

  mysqli_data_seek($result, 1);
  $row = mysqli_fetch_array($result);
    $p_code1 = $row[0];
    $p_name1 = $row[1];
    $sum1 = $row[2];
    if($sum1==NULL){
      $sum1=0;
    }
    // var_export($p_code1);
    // var_export($p_name1);
    // var_export($sum1);

  mysqli_data_seek($result, 2);
    $row = mysqli_fetch_array($result);
    $p_code2 = $row[0];
    $p_name2 = $row[1];
    $sum2 = $row[2];
    if($sum2==NULL){
      $sum2=0;
    }
    // var_export($p_code2);
    // var_export($p_name2);
    // var_export($sum2);

  mysqli_data_seek($result, 3);
  $row = mysqli_fetch_array($result);
  $p_code3 = $row[0];
  $p_name3 = $row[1];
  $sum3 = $row[2];
  if($sum3==NULL){
    $sum3=0;
  }
  // var_export($p_code3);
  // var_export($p_name3);
  // var_export($sum3);

  mysqli_data_seek($result, 4);
  $row = mysqli_fetch_array($result);
  $p_code4 = $row[0];
  $p_name4 = $row[1];
  $sum4 = $row[2];
  if($sum4==NULL){
    $sum4=0;
  }
  // var_export($p_code4);
  // var_export($p_name4);
  // var_export($sum4);

  mysqli_data_seek($result, 5);
  $row = mysqli_fetch_array($result);
  $p_code5 = $row[0];
  $p_name5 = $row[1];
  $sum5 = $row[2];
  if($sum5==NULL){
    $sum5=0;
  }
  // var_export($p_code5);
  // var_export($p_name5);
  // var_export($sum5);

  mysqli_data_seek($result, 6);
  $row = mysqli_fetch_array($result);
  $p_code6 = $row[0];
  $p_name6 = $row[1];
  $sum6 = $row[2];
  if($sum6==NULL){
    $sum6=0;
  }
  // var_export($p_code6);
  // var_export($p_name6);
  // var_export($sum6);

  mysqli_data_seek($result, 7);
  $row = mysqli_fetch_array($result);
  $p_code7 = $row[0];
  $p_name7 = $row[1];
  $sum7 = $row[2];
  if($sum7==NULL){
    $sum7=0;
  }
  // var_export($p_code7);
  // var_export($p_name7);
  // var_export($sum7);

  mysqli_data_seek($result, 8);
  $row = mysqli_fetch_array($result);
  $p_code8 = $row[0];
  $p_name8 = $row[1];
  $sum8 = $row[2];
  if($sum8==NULL){
    $sum8=0;
  }
  // var_export($p_code8);
  // var_export($p_name8);
  // var_export($sum8);

  mysqli_data_seek($result, 9);
  $row = mysqli_fetch_array($result);
  $p_code9 = $row[0];
  $p_name9 = $row[1];
  $sum9 = $row[2];
  if($sum9==NULL){
    $sum9=0;
  }
  // var_export($p_code9);
  // var_export($p_name9);
  // var_export($sum9);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style media="screen">
#submit{border-radius: 5px; width: 60px; height: 30px; font-weight: bold; margin-left: 0.5%; cursor: pointer; border: 1px solid #464646; background-color: white;}
#submit:hover{background-color: #2F9D27; color: white; border-radius: 5px; border: 1px solid #2F9D27;}
</style>
<title>패키지예약TOP10 </title>
<!-- Load the AJAX API -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!--jQuery CDN -->
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages' : ['corechart']});
  // Set a callback to run when the Google Visualization API is loaded
  google.charts.setOnLoadCallback(drawChart);
  function drawChart(){
    var data = new google.visualization.DataTable();
    var i = 0;
    data.addColumn('string', '패키지');
    data.addColumn('number', '예약자수');
    data.addRows([
      ['[<?=$p_code0.']'.$p_name0?>', <?=$sum0?>],
      ['[<?=$p_code1.']'.$p_name1?>', <?=$sum1?>],
      ['[<?=$p_code2.']'.$p_name2?>', <?=$sum2?>],
      ['[<?=$p_code3.']'.$p_name3?>', <?=$sum3?>],
      ['[<?=$p_code4.']'.$p_name4?>', <?=$sum4?>],
      ['[<?=$p_code5.']'.$p_name5?>', <?=$sum5?>],
      ['[<?=$p_code6.']'.$p_name6?>', <?=$sum6?>],
      ['[<?=$p_code7.']'.$p_name7?>', <?=$sum7?>],
      ['[<?=$p_code8.']'.$p_name8?>', <?=$sum8?>],
      ['[<?=$p_code9.']'.$p_name9?>', <?=$sum9?>]

  ]);
    // 차트 설정 옵션
    var options = {'title' : '[<?=$str_title?>] 가장 핫한 패키지 TOP 10',
                  'titleTextStyle': {
                    fontSize: 20,
                    bold: true    
                  },
                  'width' :1300,
                  'height' : 800
                  };

    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

   //막대차트로 변경시 아래 주석을 풀면 된다.(변경된 점 PieChart -> BarChart)
   //var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }

//]]>
</script>
</head>
<body>
  <section style="margin-left: 700px; margin-top: 50px;">
  <form name="form" action="best10_reserve.php" method="post">
    <select name="divide" style="width: 100px; height:30px;">
      <option value="" hidden>선택</option>
      <option value="domestic">국내</option>
      <option value="abroad">해외</option>
      <option value="">국내외</option>
    </select>
    <input type="submit" id="submit" value="검색">
  </form>
</section>
  <!--파이 차트를 저장할 div-->
  <div id="chart_div" style="margin-left: 230px;"></div>
</body>
</html>
