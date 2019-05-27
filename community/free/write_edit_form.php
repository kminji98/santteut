<!DOCTYPE html>
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/santtuet/common/lib/db_connector.php";
if(!isset($_SESSION['userid'])){echo "<script>alert('권한없음!');history.go(-1);</script>";
exit;}
$mode="insert";
$update="";
$num=$id=$title=$content=$day=$hit=$content="";

if(isset($_GET["mode"])&&$_GET["mode"]=="update"){
    $mode="update";
    $num=$_GET['num'];
    $sql="SELECT * from `free` where num ='$num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $id=$row['id'];
    $name=$row['name'];
    $title=$row['title'];
    $content= $row['content'];
    $update= $row['del'];
    $day=$row['regist_day'];
    $file_name=$row['file_name'];
    $hit=$row['hit'];
    mysqli_close($conn);

}
?>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      var del = "";
       $('#summernote').summernote({
               height: 1000,
               minHeight: null,
               maxHeight: null,
               focus: true,
               callbacks: {
                 onImageUpload : function(files, editor, welEditable){
                  sendFile(files[0], editor, welEditable);

                }
               }
             });
               function sendFile(file,editor,welEditable){
                 data = new FormData();
                 data.append("file", file);
                 $.ajax({
                   data: data,
                   type: "POST",
                   url: "./saveimage.php",
                   cache: false,
                   contentType: false,
                   processData: false,
                   success: function(url) {
                     del = $('#del').val();
                     del = del.concat("!"+url);
                     $('#del').val(del);
                     var html = '<img src="'+url+'">';
                     $('#summernote').summernote('pasteHTML', html);
                     $('#summernote').summernote('insertImage', url, filename);

                   }
       });
     }

    });

    </script>
  </head>
  <body>
    <header style="text-align : center; margin-bottom : 30px; font-size : 30px;">
      자유게시판
    </header>
    <form class="" action="dml_board.php?mode=<?=$mode?>" method="post" enctype="multipart/form-data">
      <input type="hidden" name="num" value="<?=$num?>">
      <input type="hidden" name="hit" value="<?=$hit?>">
      <input type="hidden" id="del" name="del" value="<?=$update?>">
    <table style="border-bottom: 1px solid gray; border-top : 1px solid gray; margin: 0 auto; width : 70%;">
      <tr>
      <td>subject <input style="margin-bottom : 10px; margin-top : 10px;" type="text" name="title" value="<?=$title?>"size="35"></td>
      <td><input type="file" name="upfile" value=""style="float : right;">    <?php
            if($mode=="update" && !empty($file_name)){
              echo "$file_name 파일등록";
              echo '<input type="checkbox" id="del_file" name="del_file" value="1">삭제';
              echo '<div class="clear"></div>';
            }
          ?></td>
      </tr>
      <tr>
      <td colspan="2"><textarea name="content" id="summernote" value=""><?=$content?></textarea>
      </tr>
      <tr>
      <td colspan="2">image choose a file</td>
      </tr>
      <tr>
      <td colspan="2">list
        <input style="float : right; margin-left : 10px;" type="button" name="" value="cancle">
        <input style="float : right;" type="submit" name="" value="ok"></td>
        </tr>
    </table>
    </form>
  </body>
</html>
