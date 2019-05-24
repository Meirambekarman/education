<?php
session_start();
require("../config.php");

if(isset($_SESSION['login_education'])){

  if(isset($_POST['update_profile'])){

    if(!empty($_FILES['img']['tmp_name'])){

      if(!empty($_FILES['img']['error'])){
        $_SESSION['user_update_success'] = '2';
      }
    
      if($_FILES['img']['size']>2*1024*1024){
        $_SESSION['user_update_success'] = '2';
      }

      $user = $_SESSION['login_education'];
    
      if(!move_uploaded_file($_FILES['img']['tmp_name'], "../img/users/$user".'_'.$_FILES['img']['name'])){
        $upload_img = '2';
      }

      $name_img = $user."_".$_FILES['img']['name'];

    }else{
      $name_img = $_POST['img_old'];
    }
    
    $update_profile = mysql_query("UPDATE db_users SET 
                                                   user_ava = '$name_img', 
                                                   user_sname = '$_POST[user_sname]', 
                                                   user_name = '$_POST[user_name]', 
                                                   user_mname = '$_POST[user_mname]', 
                                                   user_phone = '$_POST[user_phone]', 
                                                   user_email = '$_POST[user_email]' 
                                                 WHERE login='$_SESSION[login_education]' ");

    if($update_profile == true) header('Location:../');
    else echo "Error";

  }else if(isset($_GET['password_old'])){

    $old_pass = $_GET['password_old'];
    $new_pass = $_GET['password_new'];

    $old_pass = stripslashes($old_pass);
    $old_pass = htmlspecialchars($old_pass);
    $old_pass = trim($old_pass);

    $new_pass = stripslashes($new_pass);
    $new_pass = htmlspecialchars($new_pass);
    $new_pass = trim($new_pass);

    if($new_pass != ''){

      $old_pass = md5($old_pass);
      
      $q = mysql_query("SELECT * FROM db_users 
                                WHERE login = '$_SESSION[login_education]'
                                  AND password = '$old_pass' ");
      $r = mysql_fetch_array($q);

      if($r['user_id'] != ''){

        $new_pass = md5($new_pass);
        $update_pass = mysql_query("UPDATE db_users SET password = '$new_pass' WHERE login = '$_SESSION[login_education]' ");
        if($update_pass == true) echo "<p class='text-success'> Құпиясөз сәтті ауысты </p>";

      }else echo "<p class='text-danger'> Ескі құпиясөз дұрыс емес </p>";

    }else echo "<p class='text-danger'> Жаңа құпиясөз бос </p>";
  }

}else header('Location:login.php');
?>
