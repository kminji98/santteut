<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/create_table_base.php";
create_table($conn,'member');
create_table($conn,'package');
create_table($conn,'notice');
create_table($conn,'official_review');
create_table($conn,'official_review_ripple');
create_table($conn,'mt_information');
create_table($conn,'mt_information_ripple');
create_table($conn,'bus');
create_table($conn,'reserve');
create_table($conn,'bill');
create_table($conn,'qna');
create_table($conn,'member_review');
create_table($conn,'cart');
create_table($conn,'free');
create_table($conn,'free_ripple');
 ?>
