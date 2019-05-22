<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."santteut/lib/db_connector.php";

if(empty($_GET['page'])){
  $page=1;
}else{
  $page=$_GET['page'];
}

if(isset($_GET["num"])&&!empty($_GET["num"])){
  $num = test_input($_GET["num"]);
  $hit = test_input($_GET["hit"]);
  $q_num = mysqli_real_escape_string($conn, $num);

  $sql = "UPDATE `official_review` SET `hit`=$hit WHERE `num`=`$q_num`;";
  $result = mysqli_query($conn,$sql);
  if(!$result){
    die('Error: '.mysqli_error($conn));
  }

  $sql = "SELECT * FROM `official_review` WHERE num='$q_num';";
  $result = mysqli_query($conn,$sql);
  if(!$result){
    die('Error: ' . mysqli_error($conn));
  }
  $row=mysqli_fetch_array($result);
  $hit=$row['hit'];
  $title=htmlspecialchars($row['title']);
  $title=str_replace("\n","<br>",$title);
  $title=str_replace(" ","&nbsp;",$title);

  $content=htmlspecialchars($row['content']);
  $content=str_replace("\n","<br>",$content);
  $content=str_replace(" ","&nbsp;",$content);
  $file_name_0=$row['file_name_0'];
  $file_copied_0=$row['file_copied_0'];
  $file_type_0=$row['file_type_0'];
  $regist_day=$row['regist_day'];

  if(!empty($file_copied_0)&&$file_type_0=="image"){
    //이미지 정보를 가져오기 위한 함수 width, height, type
    $image_info=getimagesize("./data/".$file_copied_0);
    $image_width=$image_info[0];
    $image_height=$image_info[1];
    $image_type=$image_info[2];
    if($image_width>400) $image_width=400;
  }else{
    $image_width=0;
    $image_height=0;
    $image_type="";
  }
}
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/common/css/login_menu.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/santteut/community/official_review/css/official_review_form.css">
    <title><?=$title?></title>
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/login_menu.php"; ?>
    </header>
    <br><br><br>
    <section id="notice">
      <table border="1">
        <tr>
          <th>작성자</th>
          <td style="width:689px; text-align:center;">관리자</td>
        </tr>
        <tr>
          <th>제목</th>
          <td><input type="text" name="title" value="<?=$title?>" style="font-size:15px; width:400px;" readonly></td>
        </tr>
        <tr style="height:600px;">
          <th>내용</th>
          <td>
            <?php
              if($file_type_0=="image"){
                echo "<img src='./img/$file_copied_0' width='$image_width'><br>";
              }else if(!empty($_SESSION['userid'])&&!empty($file_copied_0)){
                //1. 해당된 가입자이고, 파일이 있으면, 파일명, 파일사이즈, 실제위치 정보확인
                $file_path = "./data/".$file_copied_0;
                $file_size = filesize($file_path);
                //2. 업로드된 이름을 보여주고 [저장] 할 것인지 선택한다.
                echo ("
                  첨부파일 : $file_name_0 ($file_size Byte)
                  &nbsp;
                  <a href='download.php?mode=download&num=$q_num'>저장</a><br>
                ");
              }
             ?>
             <?=$content?>
          </td>
        </tr>
      </table>
      <table border="1">
        <th>댓글</th>
        <td>
          <?php
            $sql="SELECT * FROM `official_review_ripple` where parent=`$q_num`;";
            $ripple_result = mysqli_query($conn,$sql);
            while($ripple_row=mysqli_fetch_array($ripple_result)){
              $ripple_num=$ripple_row['num'];
              $ripple_id=$ripple_row['id'];
              $ripple_nick=$ripple_row['nick'];
              $ripple_date=$ripple_row['regist_day'];
              $ripple_content=$ripple_row['content'];
              $ripple_content=str_replace("\n", "<br>", $ripple_content);
              $ripple_content=str_replace(" ", "&nbsp;", $ripple_content);
          ?>
          <div id="ripple_title">
              <ul>
                <li><?=$ripple_nick."&nbsp;&nbsp;".$ripple_date?></li>
                <li id="mdi_del">
                <?php
                $message = free_ripple_delete($ripple_id,$ripple_num,'dml_board.php',$page,$hit,$q_num);
                echo $message;
                ?>
                </li>
              </ul>
            </div>
            <div id="ripple_content">
              <?=$ripple_content?>
            </div>
            <?php
            }//end of while
            mysqli_close($conn);
            ?>
            <form name="ripple_form" action="dml_board.php?mode=insert_ripple" method="post">
            <input type="hidden" name="parent" value="<?=$q_num?>">
            <input type="hidden" name="page" value="<?=$page?>">
            <input type="hidden" name="hit" value="<?=$hit?>">
            <div id="ripple_insert">
            <div id="ripple_textarea"><textarea name="ripple_content" rows="3" cols="80"></textarea></div>
            <div id="ripple_button"><input type="submit" value="댓글입력" style="width:102px; height:28px; background-color:DarkSlateGray; color:white;"></div>
            </div><!--end of ripple_insert  -->
            </form>
        </td>
      </table>
      <div id="view_button">
      <a href="./list.php?page=<?=$page?>"><input type="button" style="width:50px; height:24px; background-color:DarkSlateGray; color:white;" value="목록">&nbsp;</a>
                <?php
                  //관리자이거나 해당된 작성자일경우 수정,삭제가 가능하도록 설정
                  // if($_SESSION['userid']=="admin" || $_SESSION['userid']==$id){
                    echo ('<a href="./write_edit_form.php?mode=update&num='.$num.'"><input type="button" style="width:50px; height:24px; background-color:DarkSlateGray; color:white;" value="수정">&nbsp;</a>&nbsp;');
                    echo ('<input type="button" style="width:50px; height:24px; background-color:DarkSlateGray; color:white;" value="삭제" onclick="check_delete('.$num.')">&nbsp;</a>&nbsp;');
                  // }
                 ?>
              </div><!--end of write_button -->
    </section>
    <br>
    <br>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/footer.php";?>
    </footer>
  </body>
</html>
