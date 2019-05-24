<?php
session_start();
require("../config.php");

if(isset($_SESSION['login_education'])){

  if(isset($_POST['add_student_to_curs'])){

    $add_student_to_curs = mysql_query("INSERT INTO db_student_curs (user_id, id_curs, id_group) VALUES ('$_POST[user_id]', '$_POST[id_curs]', '$_POST[id_group]') ");
    if($add_student_to_curs == true) header("Location:../?objects=$_POST[id_curs]");

  }else if(isset($_POST['add_new_group'])){

  	if(isset($_POST['mo'])) $mo = "1"; else $mo = "0"; 
  	if(isset($_POST['tu'])) $tu = "1"; else $tu = "0"; 
  	if(isset($_POST['we'])) $we = "1"; else $we = "0"; 
  	if(isset($_POST['th'])) $th = "1"; else $th = "0"; 
  	if(isset($_POST['fr'])) $fr = "1"; else $fr = "0"; 
  	if(isset($_POST['sa'])) $sa = "1"; else $sa = "0"; 
  	if(isset($_POST['su'])) $su = "1"; else $su = "0";

  	$time = $_POST['time1']." - ".$_POST['time2'];

    $add_new_group = mysql_query("INSERT INTO db_groups (name_group, id_curs, user_id, mo, tu, we, th, fr, sa, su, time) 
    																						 VALUES ('$_POST[name_group]', '$_POST[id_curs]', '$_POST[user_id]', '$mo', '$tu', '$we', '$th', '$fr', '$sa', '$su', '$time') ");
    if($add_new_group == true) header("Location:../?objects=$_POST[id_curs]");

  }
}else header('Location:login.php');
?>
