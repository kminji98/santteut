<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";

session_start();

// isset함수는 불리언값을 리턴 true or false
// 비회원이면 권한없음
if(!isset($_SESSION['id'])){
  echo "<script>alert('권한없음!');history.go(-1);</script>";
  exit;
}
?>
<meta charset="utf-8">
<?php
// 변수선언
$content = $sql= $result = $name=$q_title=$q_content=$regist_day=$hit=$secret_ok="";
$name = $_SESSION['name'];

//mode가 insert일때
if(isset($_GET["mode"]) && $_GET["mode"]=="insert"){
    $title = trim($_POST["title"]);
    if(empty($content)||empty($title)){
      alert_back('1. 내용이나제목입력요망!');
      exit;
    }

    $title = test_input($_POST["title"]);
    $q_content = trim($_POST["content"]);
    $id = test_input($_SESSION['id']);
    $hit = 0;
    $secret_ok =test_input($_POST["secret_ok"]);
    $q_title = mysqli_real_escape_string($conn, $title);
    $q_content = mysqli_real_escape_string($conn, $content);
    $q_name = mysqli_real_escape_string($conn, $name);
    $regist_day=date("Y-m-d (H:i)");
    $depth=0;
    $ord=0;
    $groupnum=0;

    // 메인글 저장 삽입한다. (디비변수명 적지x)
    $sql="INSERT INTO `qna` VALUES (null,'$groupnum','$depth','$ord','$id','$q_title','$q_content','$regist_day','$hit','$secret_ok');";

    $result = mysqli_query($conn,$sql);
    if (!$result) {alert_back('Error:5 ' . mysqli_error($conn));}

    //등록된사용자가 최근 입력한 qna_list를 보여주기 위하여 num 찾아서 전달하기 위함이다.
    // 최근에 삽입된 게시물이 큰넘버가 맥스넘
    $sql="SELECT max(num) from qna;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {alert_back('Error: 6' . mysqli_error($conn));}

    $row=mysqli_fetch_array($result);
    $max_num=$row['max(num)'];

    $sql="UPDATE `qna` SET `groupnum`= $max_num WHERE `num`=$max_num;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {die('Error: ' . mysqli_error($conn));}
    mysqli_close($conn);

    echo "<script>location.href='./qna_view.php?num=$max_num&hit=$hit';</script>";

}else if(isset($_GET["mode"]) && $_GET["mode"]=="delete"){
    //1. 삭제할 해당 게시물의 넘버
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    //2. 해당게시물의 ord/depth/groupnum 을 가져온다.
    $sql = "SELECT ord,depth,groupnum from qna where num = $q_num";
    // 쿼리문실행문장
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    $ord = $row['ord'];
    $depth = $row['depth'];
    $groupnum = $row['groupnum'];


    //3. 해당게시물의 답변글들의 범위 체크
    //3-1. 해당게시물과 같은 depth 가 있는 경우.
    //3-1-1. min(ord) = 삭제할 게시물의 depth 와 같고/ ord가 크고 / 그룹넘버가 같은 레코드 중 최소 ord 값
    $sql = "SELECT min(ord) from qna where depth = $depth and ord > $ord and groupnum = $groupnum";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    $min_ord = $row['min(ord)'];
    //3-1-2. 삭제할 게시물의 범위 : 해당게시물 이상 min(ord)미만
    $sql ="DELETE FROM `qna` WHERE `ord`>=$ord and `ord`<$min_ord;";

    //3-2. 해당게시물과 같은 depth 가 없는 경우.
    if(empty($min_ord)){
      $sql ="DELETE FROM `qna` WHERE `ord`>=$ord";
    }

      $result = mysqli_query($conn,$sql);
      if (!$result) {alert_back('Error: 6' . mysqli_error($conn));}

    mysqli_close($conn);
    echo "<script>location.href='./qna_list.php?page=1';</script>";

}else if(isset($_GET["mode"])&&$_GET["mode"]=="update"){
  $content = trim($_POST["content"]);
  $title = trim($_POST["title"]);

  if(empty($content)||empty($title)){
    echo "<script>alert('내용이나제목수정요망!');history.go(-1);</script>";
    exit;
  }
  $title = test_input($_POST["title"]);
  $q_content = $_POST["content"];
  $name = test_input($name);
  $num = test_input($_POST["num"]);
  $secret_ok = test_input($_POST["secret_ok"]);
  $hit = test_input($_POST["hit"]);
  $q_title = mysqli_real_escape_string($conn, $title);
  $q_name = mysqli_real_escape_string($conn, $name);
  $q_num = mysqli_real_escape_string($conn, $num);
  $regist_day=date("Y-m-d (H:i)");

  $sql="UPDATE `qna` SET `title`='$q_title',`content`='$q_content',`regist_day`='$regist_day',`secret_ok`='$secret_ok' WHERE `num`=$q_num;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {die('Error: ' . mysqli_error($conn));}

    echo "<script>location.href='./qna_view.php?num=$num&hit=$hit';</script>";

  }else if(isset($_GET["mode"])&&$_GET["mode"]=="response"){
    $content = trim($_POST["content"]);
    $title = trim($_POST["title"]);

    if(empty($content)||empty($title)){
      echo "<script>alert('내용이나제목입력요망!');history.go(-1);</script>";
      exit;
    }
    $title = test_input($_POST["title"]);
    $content = test_input($_POST["content"]);
    $id = test_input($_SESSION['id']);
    $num = test_input($_POST["num"]);
    $hit = test_input($_POST["hit"]);
    $secret_ok = test_input($_POST["secret_ok"]);

    $hit =0;
    $q_title = mysqli_real_escape_string($conn, $title);
    $q_content = mysqli_real_escape_string($conn, $content);
    $q_id = mysqli_real_escape_string($conn, $id);
    $q_num = mysqli_real_escape_string($conn, $num);
    $regist_day=date("Y-m-d (H:i)");

    $sql="SELECT * from qna where num =$q_num;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {die('1Error: ' . mysqli_error($conn));}
    $row=mysqli_fetch_array($result);
    $groupnum=(int)$row['groupnum'];
    $depth=(int)$row['depth'] + 1;
    $ord=(int)$row['ord'] + 1;

    $sql="UPDATE `qna` SET `ord`=`ord`+1 WHERE `groupnum` = $groupnum and `ord` >= $ord";
    $result = mysqli_query($conn,$sql);
    if (!$result) {die('2Error: ' . mysqli_error($conn));}

    $sql="INSERT INTO `qna` VALUES (null,'$groupnum','$depth','$ord','$id','$q_title','$q_content','$regist_day','$hit','$secret_ok');";

    $result = mysqli_query($conn,$sql);
    if (!$result) {die('3Error: ' . mysqli_error($conn));}

    $sql="SELECT max(num) from qna;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {die('4Error: ' . mysqli_error($conn));}
    $row=mysqli_fetch_array($result);
    $max_num=$row['max(num)'];

  echo "<script>location.href='./qna_view.php?num=$max_num&hit=$hit';</script>";
}//end of response


?>
