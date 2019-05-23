<?php
//**********************************************************************
$mode=$num=$q_num=$sql=$result=$row="";
$file_name_0=$file_copied_0=$file_type_0="";
$file_name_1=$file_copied_1=$file_type_1="";
$file_name_2=$file_copied_2=$file_type_2="";
$file_name_3=$file_copied_3=$file_type_3="";
$file_name_4=$file_copied_4=$file_type_4="";
$title=$content=$regist_day=$checked="";
//**********************************************************************
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
$mode="insert";
if(isset($_GET["mode"]) && $_GET["mode"]=='update'){
  $mode = "update";
  $num = test_input($_GET["num"]);
  $q_num = mysqli_real_escape_string($conn, $num);

  $sql = "SELECT * FROM `official_review` WHERE num='$q_num';";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    die('Error: '.mysqli_error($conn));
  }
  $row=mysqli_fetch_array($result);
  $file_name_0 = $row['file_name_0'];
  $file_copied_0 = $row['file_copied_0'];
  $file_type_0 = $row['file_type_0'];
  $file_name_1 = $row['file_name_1'];
  $file_copied_1 = $row['file_copied_1'];
  $file_type_1 = $row['file_type_1'];
  $file_name_2 = $row['file_name_2'];
  $file_copied_2 = $row['file_copied_2'];
  $file_type_2 = $row['file_type_2'];
  $file_name_3 = $row['file_name_3'];
  $file_copied_3 = $row['file_copied_3'];
  $file_type_3 = $row['file_type_3'];
  $file_name_4 = $row['file_name_4'];
  $file_copied_4 = $row['file_copied_4'];
  $file_type_4 = $row['file_type_4'];

  //script 오류 방어
  $title = htmlspecialchars($row['title']);
  $title = str_replace("\n", "<br>", $title);
  $title = str_replace(" ", "&nbsp;", $title);

  $content = htmlspecialchars($row['content']);
  $content = str_replace("\n","<br>",$content);
  $content = str_replace(" ","&nbsp;",$content);
  $regist_day = $row['regist_day'];
  mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/community/official_review/css/official_review_form.css">
    <!-- include libraries(jQuery,bootstrap) -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <!-- include summernote css/js -->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="./js/official_review_form.js?ver=0"></script>
    <script type="text/javascript">
        function checked_del(){
          document.getElementById("del_file").checked = true;
        }
    </script>
    <title>공식산행후기</title>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php";?>
    </header>
    <br>
    <br>
    <section id="notice">
      <form name="board_form" action="official_review_query.php?mode=<?=$mode?>" method="post" enctype="multipart/form-data">
      <table border="1">
        <tr>
          <th>작성자</th>
          <td style="width:600px; text-align:center;">관리자</td>
        </tr>
        <tr>
          <th>제목</th>
          <td><input type="text" name="title" value="" style="font-size:15px; width:400px;"></td>
        </tr>
        <tr style="height:300px;">
          <th>내용</th>
          <td><textarea name="content" id="summernote"></textarea></td>
        </tr>
        <tr>
          <th>파일</th>
          <td>
            <?php
            if($mode=="insert"){
             echo '<input type="file" name="upfile[]">';
              echo '<input type="file" name="upfile[]">';
              echo '<input type="file" name="upfile[]">';
              echo '<input type="file" name="upfile[]">';
              echo '<input type="file" name="upfile[]">';
            }else{
             ?>
             <input type="file" name="upfile[]" onclick='document.getElementById("del_file").checked=true; document.getElementById("del_file").disabled=true;'>
             <input type="file" name="upfile[]" onclick='document.getElementById("del_file").checked=true; document.getElementById("del_file").disabled=true;'>
             <input type="file" name="upfile[]" onclick='document.getElementById("del_file").checked=true; document.getElementById("del_file").disabled=true;'>
             <input type="file" name="upfile[]" onclick='document.getElementById("del_file").checked=true; document.getElementById("del_file").disabled=true;'>
             <input type="file" name="upfile[]" onclick='document.getElementById("del_file").checked=true; document.getElementById("del_file").disabled=true;'>
             <?php
              }
              ?>
              <?php
                if($mode=="update" && !empty($file_name_0)){
                  echo "$file_name_0 파일등록";
                  echo '<input type="checkbox" id="del_file" name="del_file" value="1">삭제';
                  echo '<div class="clear"></div>';
                }
               ?>
          </td>
        </tr>
      </table>
      <div id="write_button">
        <input type="submit" style="width:50px; height:24px; background-color:DarkSlateGray; color:white;" value="완료">&nbsp;
        <a href="./official_review_list.php"><input type="button" style="width:50px; height:24px; background-color:DarkSlateGray; color:white;" value="목록"></a>
      </div><!--end of write_button-->
    </form>
    </section>
    <br>
    <br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php"; ?>
    </footer>
  </body>
</html>
