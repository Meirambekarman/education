<div class="slim-navbar" style="margin-top: -21px;">
  <div class="container">
    <ul class="nav">

      <?php
      if($_SESSION['user_type'] == '1'){

        if(isset($_GET['profile'])) echo '<li class="nav-item active"><a class="nav-link" href="?profile"> <i class="icon far fa-address-card"></i> <span>Профиль</span> </a></li>';
        else echo '<li class="nav-item"><a class="nav-link" href="?profile"> <i class="icon far fa-address-card"></i> <span>Профиль</span> </a></li>';

        if(isset($_GET['objects'])) echo '<li class="nav-item active"> <a class="nav-link" href="?objects"> <i class="icon fas fa-shapes"></i> <span>Курстар</span> </a> </li>';
        else echo '<li class="nav-item"> <a class="nav-link" href="?objects"> <i class="icon fas fa-shapes"></i> <span>Курстар</span> </a> </li>';

        if(isset($_GET['tutors'])) echo '<li class="nav-item active"> <a class="nav-link" href="?tutors"> <i class="icon fas fa-user-tie"></i> <span>Мұғалімдер</span> </a> </li>';
        else echo '<li class="nav-item"> <a class="nav-link" href="?tutors"> <i class="icon fas fa-user-tie"></i> <span>Мұғалімдер</span> </a> </li>';

        if(isset($_GET['students'])) echo '<li class="nav-item active"> <a class="nav-link" href="?students"> <i class="icon fas fa-user-graduate"></i> <span>Оқушылар</span> </a> </li>';
        else echo '<li class="nav-item"> <a class="nav-link" href="?students"> <i class="icon fas fa-user-graduate"></i> <span>Оқушылар</span> </a> </li>';

      }else if($_SESSION['user_type'] == '2'){

        if(isset($_GET['profile'])) echo '<li class="nav-item active"><a class="nav-link" href="?profile"> <i class="icon far fa-address-card"></i> <span>Профиль</span> </a></li>';
        else echo '<li class="nav-item"><a class="nav-link" href="?profile"> <i class="icon far fa-address-card"></i> <span>Профиль</span> </a></li>';

        if(isset($_GET['objects'])) echo '<li class="nav-item active"> <a class="nav-link" href="?objects"> <i class="icon fas fa-shapes"></i> <span>Курстар</span> </a> </li>';
        else echo '<li class="nav-item"> <a class="nav-link" href="?objects"> <i class="icon fas fa-shapes"></i> <span>Курстар</span> </a> </li>';

      }else if($_SESSION['user_type'] == '3'){

        if(isset($_GET['profile'])) echo '<li class="nav-item active"><a class="nav-link" href="?profile"> <i class="icon far fa-address-card"></i> <span>Профиль</span> </a></li>';
        else echo '<li class="nav-item"><a class="nav-link" href="?profile"> <i class="icon far fa-address-card"></i> <span>Профиль</span> </a></li>';

        if(isset($_GET['objects'])) echo '<li class="nav-item active"> <a class="nav-link" href="?objects"> <i class="icon fas fa-shapes"></i> <span>Курстар</span> </a> </li>';
        else echo '<li class="nav-item"> <a class="nav-link" href="?objects"> <i class="icon fas fa-shapes"></i> <span>Курстар</span> </a> </li>';

      }else if($_SESSION['user_type'] == '3'){

        if(isset($_GET['profile'])) echo '<li class="nav-item active"><a class="nav-link" href="?profile"> <i class="icon far fa-address-card"></i> <span>Профиль</span> </a></li>';
        else echo '<li class="nav-item"><a class="nav-link" href="?profile"> <i class="icon far fa-address-card"></i> <span>Профиль</span> </a></li>';

        if(isset($_GET['objects'])) echo '<li class="nav-item active"> <a class="nav-link" href="?objects"> <i class="icon fas fa-shapes"></i> <span>Курстар</span> </a> </li>';
        else echo '<li class="nav-item"> <a class="nav-link" href="?objects"> <i class="icon fas fa-shapes"></i> <span>Курстар</span> </a> </li>';

      }
      ?>
      <li class="nav-item"><a class="nav-link" href="./logout.php"> <i class="icon fas fa-sign-out-alt"></i> <span>Шығу</span> </a></li>
    
    </ul>
  </div>
</div>