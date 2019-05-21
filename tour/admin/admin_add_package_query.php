<?php
session_start();
include '../../common/lib/db_connector.php';


//--------------------------------------
if(!empty($_POST['p_code'])){
    $code = $_POST['p_code'];
}else{
    $code = "";
}
if(!empty($_POST['p_name'])){
    $name = $_POST['p_name'];
}else{
    $name = "";
}
if(!empty($_POST['p_period'])){
    $period = $_POST['p_period'];
}else{
    $period = "";
}
if(!empty($_POST['p_dp_date'])){
    $dp_date = $_POST['p_dp_date'];
}else{
    $dp_date = "";
}
if(!empty($_POST['p_dp_time'])){
    $dp_time = $_POST['p_dp_time'];
}else{
    $dp_time = "";
}
if(!empty($_POST['p_arr_time'])){
    $arr_time = $_POST['p_arr_time'];
}else{
    $arr_time = "";
}
if(!empty($_POST['p_pay'])){
    $pay = $_POST['p_pay'];
}else{
    $pay = "";
}
if(!empty($_POST['p_add_pay'])){
    $add_pay = $_POST['p_add_pay'];
}else{
    $add_pay = "";
}
if(!empty($_POST['p_free_time'])){
    $free_time = $_POST['p_free_time'];
}else{
    $free_time = "";
}
if(!empty($_POST['p_dp_city'])){
    $dp_city = $_POST['p_dp_city'];
}else{
    $dp_city = "";
}
if(!empty($_POST['p_arr_mt'])){
    $arr_mt = $_POST['p_arr_mt'];
}else{
    $arr_mt = "";
}
if(!empty($_POST['p_detail_content'])){
    $detail_content = $_POST['p_detail_content'];
}else{
    $detail_content = "";
}
if(!empty($_POST['p_main_img1'])){
    $main_img1 = $_POST['p_main_img1'];
}else{
    $main_img1 = "";
}
if(!empty($_POST['p_main_img2'])){
    $main_img2 = $_POST['p_main_img2'];
}else{
    $main_img2 = "";
}
if(!empty($_POST['p_main_img3'])){
    $main_img3 = $_POST['p_main_img3'];
}else{
    $main_img3 = "";
}
if(!empty($_POST['p_main_img_copy1'])){
    $main_img_copy1 = $_POST['p_main_img_copy1'];
}else{
    $main_img_copy1 = "";
}
if(!empty($_POST['p_main_img_copy2'])){
    $main_img_copy2 = $_POST['p_main_img_copy2'];
}else{
    $main_img_copy2 = "";
}
if(!empty($_POST['p_main_img_copy3'])){
    $main_img_copy3 = $_POST['p_main_img_copy3'];
}else{
    $main_img_copy3 = "";
}
if(!empty($_POST['p_bus'])){
    $bus = $_POST['p_bus'];
}else{
    $bus = "";
}


$sql= "insert into package (`p_code`, `p_name`, `p_period`, `p_dp_date`, `p_dp_time`, `p_arr_time`, `p_pay`, `p_add_pay`, `p_free_time`, `p_dp_city`, `p_arr_mt`, `p_detail_content`, `p_main_img1`, `p_main_img2`, `p_main_img3`, `p_main_img_copy1`, `p_main_img_copy2`, `p_main_img_copy3`, `p_bus`) ";
// $sql.= "values ('$code', '$name', '$period', '$dp_date', '$dp_time', '$arr_time', '$pay', '$add_pay, '$free_time', '$dp_city',
//  '$arr_mt', '$detail_content', '$main_img1', '$main_img2', '$main_img3', '$main_img_copy1', '$main_img_copy2', '$main_img_copy3', '$bus')";
$sql.= "values ('1', '2', '3', '4', '5', '6', 7, 'a', 'b', 'c','d', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 1)";
mysqli_query($conn, $sql) or die(mysqli_error($conn));


mysqli_close($conn);

echo "<script>alert('패키지가 등록되었습니다.')</script>";

?>
