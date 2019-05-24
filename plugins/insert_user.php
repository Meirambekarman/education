<?php
session_start();
require("../config.php");

if(isset($_SESSION['login_education'])){

  if(isset($_POST['add_new_user'])){

    if(!empty($_FILES['img']['tmp_name'])){

      if(!empty($_FILES['img']['error'])){
        $_SESSION['user_update_success'] = '2';
      }
    
      if($_FILES['img']['size']>2*1024*1024){
        $_SESSION['user_update_success'] = '2';
      }

      $user = $_POST['login'];
    
      if(!move_uploaded_file($_FILES['img']['tmp_name'], "../img/users/$user".'_'.$_FILES['img']['name'])){
        $upload_img = '2';
      }

      $name_img = $user."_".$_FILES['img']['name'];

    }else{
      $name_img = "no_ava.jpg";
    }
    
    $pasw = md5($_POST['password']);

    $insert_new_user = mysql_query("INSERT INTO db_users (login, 
                                                          password, 
                                                          user_ava, 
                                                          user_sname, 
                                                          user_name, 
                                                          user_mname,
                                                          user_phone,
                                                          user_email,
                                                          user_type ) 
                                                  VALUES ('$_POST[login]',
                                                          '$pasw', 
                                                          '$name_img', 
                                                          '$_POST[user_sname]', 
                                                          '$_POST[user_name]', 
                                                          '$_POST[user_mname]', 
                                                          '$_POST[user_phone]', 
                                                          '$_POST[user_email]', 
                                                          '$_POST[user_type]' 
                                                         )");

    if($insert_new_user == true){
      if($_POST['user_type'] == '2') header('Location:../?tutors');
      else if($_POST['user_type'] == '3') header('Location:../?students');
    }else echo "Error";
  }
}else header('Location:login.php');
?>
