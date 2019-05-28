<!-- =================================================================
// + [DESC] notice_saveimage 총괄
// + [DATE] 2019-05-26
// + [NAME] 이우주
// ================================================================= -->

<?php
if ($_FILES['file']['name']) {
    if (!$_FILES['file']['error']) {
        $name = md5(rand(100, 200));
        $ext = explode('.', $_FILES['file']['name']);
        $filename = $name . '.' . $ext[1];
        $destination = './data/' . $filename; //change this directory
        $location = $_FILES["file"]["tmp_name"];
        move_uploaded_file($location, $destination);
        echo 'http://127.0.0.1/santteut/customer_support/notice/data/'. $filename;//change this URL
    }else{
      echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
    }
}
?>
