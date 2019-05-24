<?php
session_start();
require("../config.php");

if(isset($_SESSION['login_education'])){

  if(isset($_POST['add_new_section'])){

    $i = 1;

    while($i <= $_POST['col_section']){
      $number = $_POST['col_list_curses_sections'] + $i;
      $name_curses_sections = "Бөлім-".$number;      
      $insert_new_section = mysql_query("INSERT INTO db_curses_sections (id_group, name_curses_sections) VALUES ('$_POST[id_group]', '$name_curses_sections') ");
      $i++;
    }

  }

  header("Location:../?objects=$_POST[id_group]");

}else header('Location:login.php');
?>
