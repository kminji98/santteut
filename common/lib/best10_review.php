<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

if(!empty($_POST['standard'])){
  $standard = $_POST['standard'];
}else{
  $standard = '';
}
if(!empty($_POST['divide'])){
  $divide = $_POST['divide'];
}else{
  $divide = '';
}
  switch($standard){
    case 'average' :
    $standard_flag = "avg((`satisfaction_grade`+`schedule_grade`+`cost_grade`+`meal_grade`)/4)";
    $standard_title = "평점";
    break;

    case 'satisfaction':
    $standard_flag = "avg(`satisfaction_grade`)";
    $standard_title = "만족도";
    break;

    case 'schedule':
    $standard_flag = "avg(`schedule_grade`)";
    $standard_title = "일정";
    break;

    case 'cost':
    $standard_flag = "avg(`cost_grade`)";
    $standard_title = "가격";
    break;

    case 'meal':
    $standard_flag = "avg(`meal_grade`)";
    $standard_title = "식사";
    break;

    case '':
    $standard_flag = "avg((`satisfaction_grade`+`schedule_grade`+`cost_grade`+`meal_grade`)/4)";
    $standard_title = "평점";
    break;
  }

  switch($divide){
    case 'domestic':
    $divide_flag = "WHERE `package`.`p_airplane_num` = '0'";
    $divide_title = "국내";
    break;

    case 'abroad':
    $divide_flag = "WHERE `package`.`p_airplane_num` != '0'";
    $divide_title = "해외";
    break;

    case '':
    $divide_flag = '';
    $divide_title = "국내외";
    break;
  }
  $sql = "SELECT `r_code`, `package`.`p_arr_mt`, $standard_flag FROM `member_review` JOIN `package` ON `member_review`.`r_code` = `package`.`p_code` $divide_flag GROUP BY `r_code` ORDER BY $standard_flag DESC LIMIT 10;";
  $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
  mysqli_data_seek($result, 0);
  $row = mysqli_fetch_array($result);
    $p_code0 = $row[0];
    $p_name0 = $row[1];
    $sum0 = $row[2];
    if($sum0==NULL){
      $sum0=0;
    }
  mysqli_data_seek($result, 1);
  $row = mysqli_fetch_array($result);
    $p_code1 = $row[0];
    $p_name1 = $row[1];
    $sum1 = $row[2];
    if($sum1==NULL){
      $sum1=0;
    }

  mysqli_data_seek($result, 2);
    $row = mysqli_fetch_array($result);
    $p_code2 = $row[0];
    $p_name2 = $row[1];
    $sum2 = $row[2];
    if($sum2==NULL){
      $sum2=0;
    }

  mysqli_data_seek($result, 3);
  $row = mysqli_fetch_array($result);
  $p_code3 = $row[0];
  $p_name3 = $row[1];
  $sum3 = $row[2];
  if($sum3==NULL){
    $sum3=0;
  }

  mysqli_data_seek($result, 4);
  $row = mysqli_fetch_array($result);
  $p_code4 = $row[0];
  $p_name4 = $row[1];
  $sum4 = $row[2];
  if($sum4==NULL){
    $sum4=0;
  }

  mysqli_data_seek($result, 5);
  $row = mysqli_fetch_array($result);
  $p_code5 = $row[0];
  $p_name5 = $row[1];
  $sum5 = $row[2];
  if($sum5==NULL){
    $sum5=0;
  }
  mysqli_data_seek($result, 6);
  $row = mysqli_fetch_array($result);
  $p_code6 = $row[0];
  $p_name6 = $row[1];
  $sum6 = $row[2];
  if($sum6==NULL){
    $sum6=0;
  }

  mysqli_data_seek($result, 7);
  $row = mysqli_fetch_array($result);
  $p_code7 = $row[0];
  $p_name7 = $row[1];
  $sum7 = $row[2];
  if($sum7==NULL){
    $sum7=0;
  }
  mysqli_data_seek($result, 8);
  $row = mysqli_fetch_array($result);
  $p_code8 = $row[0];
  $p_name8 = $row[1];
  $sum8 = $row[2];
  if($sum8==NULL){
    $sum8=0;
  }

  mysqli_data_seek($result, 9);
  $row = mysqli_fetch_array($result);
  $p_code9 = $row[0];
  $p_name9 = $row[1];
  $sum9 = $row[2];
  if($sum9==NULL){
    $sum9=0;
  }

 ?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <style media="screen">
    #submit{border-radius: 5px; width: 60px; height: 30px; font-weight: bold; margin-left: 1%; cursor: pointer; border: 1px solid #464646; background-color: white;}
    #submit:hover{background-color: #2F9D27; color: white; border-radius: 5px; border: 1px solid #2F9D27;}
    </style>
    <meta charset="utf-8">
    <title>패키지평점TOP10</title>
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
        var data = google.visualization.arrayToDataTable([
          ['패키지', '평점', { role: 'style' }],
          ['[<?=$p_code0.']'.$p_name0?>', <?=$sum0?>, '#5e44d9'],
          ['[<?=$p_code1.']'.$p_name1?>', <?=$sum1?>, '#db5531'],
          ['[<?=$p_code2.']'.$p_name2?>', <?=$sum2?>, '#f98113'],
          ['[<?=$p_code3.']'.$p_name3?>', <?=$sum3?>, '#00c113'],
          ['[<?=$p_code4.']'.$p_name4?>', <?=$sum4?>, '#ea0aee'],
          ['[<?=$p_code5.']'.$p_name5?>', <?=$sum5?>, '#66a5e7'],
          ['[<?=$p_code6.']'.$p_name6?>', <?=$sum6?>, '#fa8cdb'],
          ['[<?=$p_code7.']'.$p_name7?>', <?=$sum7?>, '#9bf4de'],
          ['[<?=$p_code8.']'.$p_name8?>', <?=$sum8?>, '#fcfb3d'],
          ['[<?=$p_code9.']'.$p_name9?>', <?=$sum9?>, '#f67600']
      ]);

        // 차트 설정 옵션
        var options = {
        'title' : '[<?=$divide_title?>] 패키지 <?=$standard_title?> TOP 10 ',
        'titleTextStyle': {
          fontSize: 20,
          bold: true
        },
        'width': 1200, 'height' : 700,
        'legend' : 'none',
        'bar': {groupWidth: "50%"},
        'hAxis': {
                minValue: 0,
                maxValue: 5
              }
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data,options);
      }

    //]]>
    </script>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
    <section style="margin-left: 44%; margin-top: 6%;">
    <form name="form" action="best10_review.php" method="post">
      <select name="divide" style="width: 100px; height:30px;">
        <option value="" hidden>선택</option>
        <option value="domestic">국내</option>
        <option value="abroad">해외</option>
        <option value="">국내외</option>
      </select>
      <select name="standard" style="width: 100px; height:30px;">
        <option value="" hidden>선택</option>
        <option value="satisfaction">만족도</option>
        <option value="schedule">일정</option>
        <option value="cost">가격</option>
        <option value="meal">식사</option>
        <option value="average">평점</option>
      </select>
      <input type="submit" id="submit" value="검색">
    </form>
  </section>
    <!--파이 차트를 저장할 div-->
    <div id="chart_div" style="margin-left: 22%;"></div>
    <footer id="foo">
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
