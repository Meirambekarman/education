<?php
session_start();
require("../config.php");

if(isset($_SESSION['login_education'])){

  if(isset($_POST['insert_new_curs'])){

    if(!empty($_FILES['img']['tmp_name'])){

      if(!empty($_FILES['img']['error'])){
        $_SESSION['user_update_success'] = '2';
      }
    
      if($_FILES['img']['size']>2*1024*1024){
        $_SESSION['user_update_success'] = '2';
      }

      $user = rand(10, 99);
    
      if(!move_uploaded_file($_FILES['img']['tmp_name'], "../img/curses/$user".'_'.$_FILES['img']['name'])){
        $upload_img = '2';
      }

      $name_img = $user."_".$_FILES['img']['name'];

    }else{
      $name_img = "no_image.jpg";
    }

    $insert_new_curs = mysql_query("INSERT INTO db_curses (name_curs, 
                                                           discription_curs, 
                                                           img_curs ) 
                                                   VALUES ('$_POST[name_curs]',
                                                           '$_POST[discription_curs]',
                                                           '$name_img')");

    if($insert_new_curs == true) header('Location:../?objects');
    else echo "Error";
  }
}else header('Location:login.php');
?>
