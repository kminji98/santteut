<?php
$id=$_SESSION['id'];
$r_code = $_GET["code"];
$after_sql = "SELECT * FROM `member_review` where `r_code`='$p_code' and `id`='$id';";
$after_result = mysqli_query($conn,$after_sql);
$row = mysqli_fetch_array($after_result);
$num = $row['num'];
$id = $row['id'];
$title = $row['title'];
$w_date = $row['write_date'];
$grade = $row['grade'];

?>
  <table id="tbl1">
    <tr>
      <td class="td1">NO</td>
      <td class="td2">제목</td>
      <td class="td3">작성자</td>
      <td class="td4">등록날짜</td>
      <td class="td5">평점</td>
    </tr>

    <tr>
      <td class="td1"><?=$num?></td>
      <td class="td2"><?=$title?></td>
      <td class="td3"><?=$id?></td>
      <td class="td4"><?=$w_date?></td>
      <td class="td5"><?=$grade?></td>
    </tr>
  </table>
  <br><br>
