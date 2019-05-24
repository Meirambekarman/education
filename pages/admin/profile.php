<div class="slim-mainpanel" style="margin-top: -21px;">
  <div class="container">
    <div class="slim-pageheader">
      <ol class="breadcrumb slim-breadcrumb"></ol>
      <h6 class="slim-pagetitle"> Профиль </h6>
    </div>

    <div class="row row-sm">

      <div class="col-lg-8">
        <div class="card card-profile">
          <div class="card-body">
            <div class="media">
              <img src="img/users/<?=$user_info['user_ava']?>">
              <div class="media-body">
                <br>
                <h3 class="card-profile-name"> <?=$user_info['user_sname']." ".$user_info['user_name']." ".$user_info['user_mname']?> </h3>
                <p class="card-profile-position"> <?=$user_info['type_name']?> </p>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <a href="" class="card-profile-direct"></a>
            <div>
              <a href="#edit_profile" class="modal-effect" data-toggle="modal">Профильді өзгерту</a>
              <a href="#change_password" class="modal-effect" data-toggle="modal">Құпиясөз өзгерту</a>
            </div>
          </div>
        </div>

        <ul class="nav nav-activity-profile mg-t-20">
          <li class="nav-item"><a class="nav-link"><i class="icon fas fa-mobile-alt tx-purple"></i> <?=$user_info['user_phone']?> </a></li>
          <li class="nav-item"><a class="nav-link"><i class="icon fas fa-at tx-primary"></i> <?=$user_info['user_email']?> </a></li>
        </ul>
      </div>

      <?php
      $q_col_tutors = mysql_query("SELECT COUNT(login) as col_tutors FROM db_users WHERE user_type = '2' ");
      $r_col_tutors = mysql_fetch_array($q_col_tutors);

      $q_col_students = mysql_query("SELECT COUNT(login) as col_students FROM db_users WHERE user_type = '3' ");
      $r_col_students = mysql_fetch_array($q_col_students);

      $q_col_curses = mysql_query("SELECT COUNT(id_curs) as col_curses FROM db_curses ");
      $r_col_curses = mysql_fetch_array($q_col_curses);
      ?>

      <div class="col-lg-4 mg-t-20 mg-lg-t-0">
        <div class="card card-connection">
          <div class="row row-xs">
            <div class="col-4 tx-teal"><?=$r_col_curses['col_curses']?></div>
            <div class="col-8"> <h5>Курстар</h5> </div>
          </div>
          <hr>
          <div class="row row-xs">
            <div class="col-4 tx-primary"><?=$r_col_tutors['col_tutors']?></div>
            <div class="col-8"> <h5>Мұғалімдер</h5> </div>
          </div>
          <hr>
          <div class="row row-xs">
            <div class="col-4 tx-purple"><?=$r_col_students['col_students']?></div>
            <div class="col-8"> <h5>Оқушылар</h5> </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>

<div id="edit_profile" class="modal fade">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content bd-0 tx-14">
      <div class="modal-header pd-y-20 pd-x-25">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Профильді өзгерту</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="plugins/update_profile.php" method="post" enctype='multipart/form-data' required>

        <div class="modal-body pd-25">
  
          <div class="col-md-12 text-center mg-b-25">
            <div class='picture'>
              <img src="img/users/<?=$user_info['user_ava']?>" class='picture-src' id='wizardPicturePreview'>
              <input name='img' type='file' id='wizard-picture'>
              <input name='img_old' type='hidden' value='<?=$user_info['user_ava']?>'>
            </div>
          </div>
          
          <div class="row">
            
            <div class="col-md-4">
              <div class="form-group mg-b-15">
                <label>Тегі: <span class="tx-danger">*</span></label>
                <input type="text" name="user_sname" class="form-control wd-250" placeholder="Тегі" required style="width: 100%" value="<?=$user_info['user_sname']?>">
              </div>
            </div>
  
            <div class="col-md-4">
              <div class="form-group mg-b-15">
                <label>Аты: <span class="tx-danger">*</span></label>
                <input type="text" name="user_name" class="form-control wd-250" placeholder="Аты" required style="width: 100%" value="<?=$user_info['user_name']?>">
              </div>
            </div>
  
            <div class="col-md-4">
              <div class="form-group mg-b-15">
                <label>Әкесінің аты:</label>
                <input type="text" name="user_mname" class="form-control wd-250" placeholder="Әкесінің аты" style="width: 100%" value="<?=$user_info['user_mname']?>">
              </div>
            </div>
  
          </div>
  
          <hr>
  
          <div class="row">
            
            <div class="col-md-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fa fa-mobile-alt tx-16 lh-0 op-6"></i>
                  </div>
                </div>
                <input name="user_phone" id="phoneMask" type="text" class="form-control" placeholder="+7 (999) 999-9999" value="<?=$user_info['user_phone']?>">
              </div>
            </div>
  
            <div class="col-md-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="icon fas fa-at tx-16 lh-0 op-6"></i></span>
                </div>
                <input name="user_email" type="email" class="form-control" placeholder="Username" value="<?=$user_info['user_email']?>">
              </div>
            </div>
  
          </div>
  
        </div>
        <div class="modal-footer">
          <button type="submit" name="update_profile" class="btn btn-primary" id="updateProfile">Сақтау</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Жабу</button>
        </div>

      </form>
    </div>
  </div>
</div>

<div id="change_password" class="modal fade">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content bd-0 tx-14">
      <div class="modal-header pd-y-20 pd-x-25">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Құпиясөз өзгерту</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body pd-25">

        <p id="updatePasswordResult"></p>
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group mg-b-15">
              <label>Ескі құписөз: <span class="tx-danger">*</span></label>
              <input type="password" name="password_old" class="form-control wd-250" placeholder="*******" required style="width: 100%">
            </div>
          </div>
  
          <div class="col-md-6">
            <div class="form-group mg-b-15">
              <label>Жаңа құпиясөз: <span class="tx-danger">*</span></label>
              <input type="password" name="password_new" class="form-control wd-250" placeholder="*******" required style="width: 100%">
            </div>
          </div>
        </div>
  
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="updatePassword">Сақтау</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Жабу</button>
      </div>

    </div>
  </div>
</div>