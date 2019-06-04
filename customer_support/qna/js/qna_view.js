function check_delete(num) {
  var result=confirm("삭제하시겠습니까? 답변글이 있는 경우, 답변글도 함께 삭제됩니다.");
  if(result){
        window.location.href='./qna_query.php?mode=delete&num='+num;
  }
}
