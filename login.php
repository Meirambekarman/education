<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Education</title>
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/slim.css">

  </head>
  <body>

    <div class="d-md-flex flex-row-reverse">
      <div class="signin-right">

        <div class="signin-box">
          <h2 class="signin-title-primary">Қайта келуіңізбен!</h2>
          <h3 class="signin-title-secondary">Жалғастыру үшін жүйеге кіріңіз.</h3>

          <?php
          session_start();
          require("config.php");
          if(isset($_POST['log_in'])){

            $login = $_POST['login'];
            $pass  = $_POST['password'];
            
            $login  = stripslashes($login);
            $login  = htmlspecialchars($login);
            $login  = trim($login);
            $pass = stripslashes($pass);
            $pass = htmlspecialchars($pass);
            $pass = trim($pass);
          
            $password = md5($pass);
            
            $user = mysql_query("SELECT * FROM db_users
                                         WHERE login = '$login' 
                                           AND password = '$password' ");
            $row  = mysql_fetch_array($user);
            
            if($row['user_id'] != ''){
              $_SESSION['login_education'] = $row['login'];
              $_SESSION['user_type'] = $row['user_type'];
              header("Location: ./");
            }
            else{
              echo "<p class='text-danger'> Логин немесе құпиясөз қате! </p>";
            }
          }
          ?>

          <form action="login.php" method="post" required>
            <div class="form-group">
              <input type="text" name="login" class="form-control" placeholder="Логин" required>
            </div>
            <div class="form-group mg-b-50">
              <input type="password" name="password" class="form-control" placeholder="Құпиясөз" required>
            </div>
            <input type="submit" name="log_in" class="btn btn-primary btn-block btn-signin" value="Кіру">            
          </form>

        </div>

      </div>
      <div class="signin-left">
        <div class="signin-box">
          <h2 class="slim-logo"><a href="index.html">education<span>.</span></a></h2>
          <h3>Оқытушыларға оқушылардың білім сапасын анықтауға арналған сайт.</h3>
        </div>
      </div>
    </div>

    <script src="lib/jquery/js/jquery.js"></script>
    <script src="lib/popper.js/js/popper.js"></script>
    <script src="lib/bootstrap/js/bootstrap.js"></script>

    <script src="js/script.js"></script>

  </body>
</html>
