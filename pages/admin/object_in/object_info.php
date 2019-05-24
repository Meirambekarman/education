<?php

if(isset($_GET['del_student_curs'])){
  $delete_stud = mysql_query("DELETE FROM db_student_curs WHERE student_curs_id = '$_GET[del_student_curs]' ");
  if($delete_stud == true) header("Location:./?objects=$_GET[objects]");
}
else if(isset($_GET['del_group'])){
  $delete_stud  = mysql_query("DELETE FROM db_student_curs WHERE id_group = '$_GET[del_group]' ");
  $delete_group = mysql_query("DELETE FROM db_groups WHERE id_group = '$_GET[del_group]' ");
  if($delete_stud == true && $delete_group == true) header("Location:./?objects=$_GET[objects]");
}
$query_curs_info  = mysql_query("SELECT * FROM db_curses WHERE id_curs = '$_GET[objects]' ");
$result_curs_info = mysql_fetch_array($query_curs_info);

$query_groups_list  = mysql_query("SELECT * FROM db_groups g, db_users u 
                                           WHERE g.id_curs = '$_GET[objects]'
                                             AND u.user_id = g.user_id ");
$result_groups_list_col = mysql_num_rows($query_groups_list);

$query_students_list  = mysql_query("SELECT * FROM db_student_curs t, db_users u 
                                             WHERE t.id_curs = '$_GET[objects]'
                                               AND u.user_id = t.user_id ");
$result_students_list = mysql_fetch_array($query_students_list);
$result_students_list_col = mysql_num_rows($query_students_list);

?>
<div class="manager-wrapper" style="margin-top: -21px;">
  <div class="row">

    <div class="col-md-12 mg-sm-t-30 mg-lg-t-0">
      <div class="card card-dash-headline">
        <div class="row">

          <div class="col-md-7 mg-t-0">
            <h4><?=$result_curs_info['name_curs']?></h4>
            <p align="left"><?=$result_curs_info['discription_curs']?></p>
            <div class="row row-sm pd-t-20">
              <div class="col-sm-6">
                <h3 class="tx-primary"><i class="fas fa-user-tie"></i> <?=$result_groups_list_col?> Мұғалім</h3>
              </div>
              <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                <h3 class="tx-purple"><i class="fas fa-user-graduate"></i> <?=$result_students_list_col?> Оқушы</h3>
              </div>
            </div>
          </div>

          <div class="col-md-5 mg-t-20 mg-sm-t-30 mg-lg-t-0">
            <img src='img/curses/<?=$result_curs_info['img_curs']?>' style='width: 100%;'>
          </div>

        </div>
      </div>
    </div>

    <div class="col-md-7 mg-t-20">
      <div class="card card-table">
        <div class="card-header">
          <h6 class="slim-card-title tx-primary">Курс группаларының тізімі</h6>
        </div>
        
        <div class="table-responsive">
          <table class="table mg-b-0 tx-13">
            <thead class="thead-colored thead-warning">
              <tr>
                <th style="vertical-align: middle" class="tx-center">#</th>
                <th style="vertical-align: middle">Группа атауы</th>
                <th style="vertical-align: middle" colspan="2" class="tx-center">Мүғалім</th>
                <th style="vertical-align: middle" class="tx-center">Сабақ беру күндері</th>
                <th style="vertical-align: middle" class="tx-center">Жою</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $n = 0;
              while($result_groups_list = mysql_fetch_array($query_groups_list)){
                $n++;
                $dates_teaching = '|';
                if($result_groups_list['mo'] == 1) $dates_teaching .= ' Дс |';
                if($result_groups_list['tu'] == 1) $dates_teaching .= ' Сс |';
                if($result_groups_list['we'] == 1) $dates_teaching .= ' Ср |';
                if($result_groups_list['th'] == 1) $dates_teaching .= ' Бс |';
                if($result_groups_list['fr'] == 1) $dates_teaching .= ' Жм |';
                if($result_groups_list['sa'] == 1) $dates_teaching .= ' Сн |';
                if($result_groups_list['su'] == 1) $dates_teaching .= ' Жс |';

                echo"
                <tr class='tx-14'>
                  <td style='vertical-align: middle' class='tx-center'>$n</td>
                  <td style='vertical-align: middle' class='tx-16'>$result_groups_list[name_group]</td>
                  <td style='vertical-align: middle'><img src='img/users/$result_groups_list[user_ava]' class='wd-40 rounded-circle'></td>
                  <td style='vertical-align: middle' class='tx-16'>$result_groups_list[user_sname] $result_groups_list[user_name]</td>
                  <td style='vertical-align: middle' class='tx-center'>
                    <i class='far fa-calendar-alt tx-warning'></i>&nbsp $dates_teaching <br> 
                    <i class='far fa-clock tx-purple'></i>&nbsp $result_groups_list[time]
                  </td>
                  <td style='vertical-align: middle' class='tx-center'><a href='?objects=$_GET[objects]&del_group=$result_groups_list[id_group]' class='btn btn-danger btn-icon'><div><i class='far fa-trash-alt'></i></div></a></td>
                </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

        <div class="card-footer tx-12 pd-y-15 bg-transparent">
          <button class="btn btn-primary btn-sm btn-block mg-b-10" href="#add_new_group" class="modal-effect" data-toggle="modal">Группа қосу</button>
        </div>

      </div>
    </div>

    <div class="col-lg-5 mg-t-20 mg-t-20 mg-b-20">
      <div class="card card-table">
        <div class="card-header">
          <h6 class="slim-card-title tx-purple">Курс оқушыларының тізімі</h6>
        </div>
        <div class="table-responsive">
          <table class="table mg-b-0 tx-13">
            <thead>
              <tr class="tx-10">
                <th class="wd-10p pd-y-5">&nbsp;</th>
                <th class="pd-y-5">Аты-жөні</th>
                <th class="pd-y-5">Группасы</th>
                <th class="pd-y-5 tx-center">Жою</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query_list_curs_student = mysql_query("SELECT * FROM db_users u, db_student_curs c, db_groups g
                                                              WHERE c.id_curs = '$_GET[objects]'
                                                                AND u.user_id = c.user_id
                                                                AND g.id_group = c.id_group
                                                              ORDER BY g.name_group, u.user_sname, u.user_name ");

              while($result_list_curs_student = mysql_fetch_array($query_list_curs_student)){

                echo"
                <tr>
                  <td style='vertical-align: middle'> <img src='img/users/$result_list_curs_student[user_ava]' class='wd-40 rounded-circle'> </td>
                  <td style='vertical-align: middle' class='tx-16'> $result_list_curs_student[user_sname] $result_list_curs_student[user_name] </td>
                  <td style='vertical-align: middle' class='tx-16'> $result_list_curs_student[name_group] </td>
                  <td style='vertical-align: middle' class='tx-center'> <a href='?objects=$_GET[objects]&del_student_curs=$result_list_curs_student[student_curs_id]' class='btn btn-danger btn-icon'><div><i class='far fa-trash-alt'></i></div></a> </td>
                </tr>";

              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer tx-12 pd-y-15 bg-transparent">
          <button class="btn btn-purple btn-sm btn-block mg-b-10" href="#add_student_to_curs" class="modal-effect" data-toggle="modal">Оқушы қосу</button>
        </div>
      </div>
    </div>

  </div>
</div>

<div id="add_student_to_curs" class="modal fade">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content bd-0 tx-14">
      <div class="modal-header pd-y-20 pd-x-25">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <?=$result_curs_info['name_curs']?> курсына оқушы қосу </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="plugins/add_tutor_stud_to_curs.php" method="post" required>

        <div class="modal-body pd-25">
          
          <div class="row">
            
            <input name="id_curs" type="hidden" value="<?=$_GET['objects']?>">
            <div class="col-md-12">
              <div class="form-group mg-b-15">
                <label>Группасы: <span class="tx-danger">*</span></label>
                <select name="id_group" class="form-control" required>
                  <option label="Тізімнен таңдаңыз"></option>
                  <?php
                  $query_list_groups = mysql_query("SELECT * FROM db_groups WHERE id_curs = '$_GET[objects]' ");
                  while($result_list_groups = mysql_fetch_array($query_list_groups))
                    echo "<option value='$result_list_groups[id_group]'> $result_list_groups[name_group] </option>";
                  ?>
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group mg-b-15">
                <label>Оқушы: <span class="tx-danger">*</span></label>
                <select name="user_id" class="form-control" required>
                  <option label="Тізімнен таңдаңыз"></option>
                  <?php
                  $query_list_students = mysql_query("SELECT * FROM db_users WHERE user_type = 3 AND user_id not in (SELECT user_id FROM db_student_curs WHERE id_curs = '$_GET[objects]' ) ");
                  while($result_list_students = mysql_fetch_array($query_list_students))
                    echo "<option value='$result_list_students[user_id]'> $result_list_students[user_sname] $result_list_students[user_name] </option>";
                  ?>
                </select>
              </div>
            </div>
  
          </div>
  
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_student_to_curs" class="btn btn-primary">Қосу</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Жабу</button>
        </div>

      </form>

    </div>
  </div>
</div>

<div id="add_new_group" class="modal fade">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content bd-0 tx-14">
      <div class="modal-header pd-y-20 pd-x-25">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <?=$result_curs_info['name_curs']?> курсына группа қосу </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="plugins/add_tutor_stud_to_curs.php" method="post" required>

        <div class="modal-body pd-25">
          
          <div class="row">
            <input name="id_curs" type="hidden" value="<?=$_GET['objects']?>">
            <div class="col-md-12">
              <div class="form-group mg-b-15">
                <label>Группа атауы: <span class="tx-danger">*</span></label>
                <input type="text" name="name_group" class="form-control wd-250" placeholder="Группа атауы" required style="width: 100%">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group mg-b-15">
                <label>Мұғалім: <span class="tx-danger">*</span></label>
                <select name="user_id" class="form-control" required>
                  <option label="Тізімнен таңдаңыз"></option>
                  <?php
                  $query_list_tutors = mysql_query("SELECT * FROM db_users WHERE user_type = 2");
                  while($result_list_tutors = mysql_fetch_array($query_list_tutors))
                    echo "<option value='$result_list_tutors[user_id]'> $result_list_tutors[user_sname] $result_list_tutors[user_name] </option>";
                  ?>
                </select>
              </div>
            </div>
  
          </div>

          <hr>

          <div class="row">
            
            <div class="col-md-4">
              <p class="tx-primary"><b>Оқыту күндері:</b> <span class="tx-danger">*</span></p>
              <label class="ckbox"> <input type="checkbox" name="mo" value="1"><span>Дүйсенбі</span></label>
              <label class="ckbox"> <input type="checkbox" name="tu" value="1"><span>Сейсенбі</span></label>
              <label class="ckbox"> <input type="checkbox" name="we" value="1"><span>Сәрсенбі</span></label>
              <label class="ckbox"> <input type="checkbox" name="th" value="1"><span>Бейсенбі</span></label>
              <label class="ckbox"> <input type="checkbox" name="fr" value="1"><span>Жұма</span></label>
              <label class="ckbox"> <input type="checkbox" name="sa" value="1"><span>Сенбі</span></label>
              <label class="ckbox"> <input type="checkbox" name="su" value="1"><span>Жексенбі</span></label>
            </div>
            <div class="col-md-4">
              <p class="tx-primary"><b>Басталу уақыты:</b> <span class="tx-danger">*</span></p>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="far fa-clock tx-16 lh-0 op-6"></i>
                  </div>
                </div>
                <input name="time1" id="TimeMask1" type="text" class="form-control" placeholder="00:00" required>
              </div>
            </div>
            <div class="col-md-4">
              <p class="tx-primary"><b>Аяқталу уақыты:</b> <span class="tx-danger">*</span></p>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="far fa-clock tx-16 lh-0 op-6"></i>
                  </div>
                </div>
                <input name="time2" id="TimeMask2" type="text" class="form-control" placeholder="00:00" required>
              </div>
            </div>

          </div>
  
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_new_group" class="btn btn-primary">Қосу</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Жабу</button>
        </div>

      </form>

    </div>
  </div>
</div>