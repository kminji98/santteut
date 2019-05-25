<?php
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/db_connector.php";
include $_SERVER['DOCUMENT_ROOT']."/santteut/common/lib/create_table_base.php";
create_table($conn,'member');
create_table($conn,'package');
create_table($conn,'notice');
create_table($conn,'official_review');
create_table($conn,'bus');
// create_table($conn,'qna');
 ?>
