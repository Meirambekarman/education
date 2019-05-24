<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Education</title>

    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/medium-editor/css/medium-editor.css" rel="stylesheet">
    <link href="lib/medium-editor/css/default.css" rel="stylesheet">

    <link rel="stylesheet" href="css/slim.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  </head>
  <body>

    <?php
    session_start();
    require("config.php");

    if(isset($_SESSION['login_education'])){

      $query_user_info = mysql_query("SELECT * FROM db_users u, db_users_type t
                                              WHERE u.login = '$_SESSION[login_education]'
                                                AND t.user_type = u.user_type ");
      $user_info       = mysql_fetch_array($query_user_info);

      require "pages/modules/header.php";
      require "pages/modules/main.php";
      require "pages/content.php";

    }else header('Location:login.php');
    ?>

    <script src="lib/jquery/js/jquery.js"></script>
    <script src="lib/popper.js/js/popper.js"></script>
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script src="lib/jquery.cookie/js/jquery.cookie.js"></script>
    <script src="lib/medium-editor/js/medium-editor.js"></script>
    <script src="lib/jquery.maskedinput/js/jquery.maskedinput.js"></script>

    <script src="js/script.js"></script>
    <script src="js/ajax.js"></script>
  </body>
</html>
