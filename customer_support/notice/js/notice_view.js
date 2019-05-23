function check_delete(num) {
  var result=confirm("삭제하시겠습니까?\n Either OK or Cancel.");
  if(result){
        window.location.href='./notice_query.php?mode=delete&num='+num;
  }
}
