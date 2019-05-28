<?php
$id=$_SESSION['id'];
$after_sql = "SELECT * FROM `member_review` where `r_code`='$p_code' and `id`='$id';";
$after_result = mysqli_query($conn,$after_sql);

$total_record=mysqli_num_rows($after_result);
$total_page=($total_record % SCALE == 0)?($total_record/SCALE):(ceil($total_record/SCALE));

//2. 페이지가 없으면 디폴트 페이지 1페이지
$page=(!isset($_GET['page']))?(1):(test_input($_GET['page']));

//3. 현재페이지 시작번호계산함.
$start=($page -1) * SCALE;
//4. 리스트에 보여줄 번호를 최근순으로 부여함.
$number = $total_record - $start;

?>
<table id="tbl1">
  <tr>
    <td class="td1">NO</td>
    <td class="td2">제목</td>
    <td class="td3">작성자</td>
    <td class="td4">등록날짜</td>
    <td class="td5">평점</td>
  </tr>
<?php
 for ($i = $start; $i < $start+SCALE && $i<$total_record; $i++){
   mysqli_data_seek($after_result,$i);
   $row = mysqli_fetch_array($after_result);
   $num = $row['num'];
   $id = $row['id'];
   $title = $row['title'];
   $w_date = $row['write_date'];
   $grade = $row['grade'];
?>
  
    <tr>
      <td class="td1"><?=$number?></td>
      <td class="td2"><?=$title?></td>
      <td class="td3"><?=$id?></td>
      <td class="td4"><?=$w_date?></td>
      <td class="td5"><?=$grade?></td>
    </tr>
    <?php
        $number--;
     }//end of for
    ?>
  </table>
  <br><br>
