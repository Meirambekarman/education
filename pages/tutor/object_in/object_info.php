<?php

$query_curs_info  = mysql_query("SELECT * FROM db_groups g, db_curses c 
                                         WHERE g.id_group = '$_GET[objects]'
                                           AND c.id_curs = g.id_curs ");
$result_curs_info = mysql_fetch_array($query_curs_info);

?>
<div class="row pd-l-15 pd-r-15 mg-b-25" style="margin-top: -21px;">
  <div class="col-md-12 pd-0">
    <div class="card card-dash-headline pd-0" 
      style="
      height: 120px; 
      background-image: url('img/curses/<?=$result_curs_info['img_curs']?>');
      background-position: center;
      -webkit-background-size: cover;
      background-size: cover;
    ">
      <div class="row mg-0" 
        style="
        background-color: rgb(0, 0, 0, 0.5);
        height: 120px;
      ">

        <div class="col-md-12 pd-t-35">
          <h4 style="color: #fff">
            <?=$result_curs_info['name_curs']?><br>
            <span style="color: #f6f6f6; font-size: 18px">( <?=$result_curs_info['name_group']?> )</span>
          </h4>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="manager-wrapper">
  <div class="manager-right">
  <?php
  if(isset($_GET['results'])){

    $query_list_curses_sections = mysql_query("SELECT * FROM db_curses_sections WHERE id_group = '$_GET[objects]' ");
    $result_list_curses_sections = mysql_fetch_array($query_list_curses_sections);
    $col_list_curses_sections    = mysql_num_rows($query_list_curses_sections);

    if($result_list_curses_sections['id_curses_sections'] != '' ){

      $i = 0;

      do{
        $i++;
        
        echo "
        <div class='card card-dash-headline pd-0 mg-b-25'>
          <div class='card-header'>
            <div class='row tx-left'>
              
              <div class='col-md-12'>
                <div class='dropdown dropdown-demo show'>
                  <a href='#' class='dd-link' data-toggle='dropdown'>
                    <div>
                      <span>$result_list_curses_sections[name_curses_sections]</span>
                    </div>
                  </a>
                </div>
              </div>            

            </div>
          </div>";

          $query_list_curses_docs = mysql_query("SELECT * FROM db_groups_docs WHERE id_group = '$_GET[objects]' AND id_curses_sections = '$result_list_curses_sections[id_curses_sections]' ");
          $result_list_curses_docs = mysql_fetch_array($query_list_curses_docs);
  
          echo"
            <div class='file-group'>";
  
          $query_list_groups_testing_info = mysql_query("SELECT * FROM db_groups_testing_info i
                                                                 WHERE i.id_group = '$_GET[objects]' 
                                                                   AND i.id_curses_sections = '$result_list_curses_sections[id_curses_sections]'
                                                              ORDER BY i.end_test ");
          $result_list_groups_testing_info = mysql_fetch_array($query_list_groups_testing_info);
  
          if($result_list_groups_testing_info['id_groups_testing_info'] != ''){

            $col_users = 0;
            $summ_mark_users = 0;
  
            do{
  
              $query_list_testing_questions = mysql_query("SELECT * FROM db_testing_questions 
                                                                   WHERE id_curses_sections = '$result_list_curses_sections[id_curses_sections]' 
                                                                     AND id_groups_testing_info = '$result_list_groups_testing_info[id_groups_testing_info]' ");
              $result_list_testing_questions = mysql_num_rows($query_list_testing_questions);

              echo"
              <div class='file-item' style='background-color: rgb(114, 174, 96, 0.4); color: #333'>
                <div class='row no-gutters wd-100p'>
                  <div class='col-sm-5 d-flex align-items-center'> $result_list_groups_testing_info[name_test] </div>
                  <div class='col-sm-2 tx-right tx-sm-left'> $result_list_testing_questions сұрақ </div>
                  <div class='col-sm-5 mg-t-5 mg-sm-t-0 tx-right'><i class='far fa-calendar-alt'></i> $result_list_groups_testing_info[start_test] - $result_list_groups_testing_info[end_test] </div>
                </div>
              </div>";

              $query_list_students_mark = mysql_query("SELECT * FROM db_testing t, db_users u
                                                               WHERE t.id_groups_testing_info = '$result_list_groups_testing_info[id_groups_testing_info]'
                                                                 AND u.user_id = t.user_id 
                                                               ORDER BY t.mark DESC ");
              while($result_list_students_mark = mysql_fetch_array($query_list_students_mark)){
                
                $col_users++;
                $summ_mark_users += $result_list_students_mark['mark'];

                echo"
                <div class='file-item' style='color: #333'>
                  <div class='row no-gutters wd-100p'>
                    <div class='col-sm-4 d-flex align-items-center'>  </div>
                    <div class='col-sm-4 mg-t-5 mg-sm-t-0 tx-right'> $result_list_students_mark[user_sname] $result_list_students_mark[user_name] </div>
                    <div class='col-sm-2 mg-t-5 mg-sm-t-0'> $result_list_students_mark[mark]% </div>
                    <div class='col-sm-2 tx-right tx-sm-left'> $result_list_students_mark[start_date] </div>
                  </div>
                </div>";

              }

              if($summ_mark_users != 0 && $col_users != 0){ 

                $sred_summ_mark_users = $summ_mark_users / $col_users;

                echo"
                <div class='file-item' style='background-color: rgb(0, 0, 0, 0.12); color: #333'>
                  <div class='row no-gutters wd-100p'>
                    <div class='col-sm-4 d-flex align-items-center'>  </div>
                    <div class='col-sm-4 mg-t-5 mg-sm-t-0 tx-right'> <b>Орташа балы</b> </div>
                    <div class='col-sm-2 mg-t-5 mg-sm-t-0'> <b>$sred_summ_mark_users%</b> </div>
                    <div class='col-sm-2 tx-right tx-sm-left'>  </div>
                  </div>
                </div>";
              }
  
            }while($result_list_groups_testing_info = mysql_fetch_array($query_list_groups_testing_info));

          }else echo "<p align='center'> <br>Мәліметтер табылмады </p>";
        echo"
          </div>
        </div>";     

      }while($result_list_curses_sections = mysql_fetch_array($query_list_curses_sections));

    }else echo "<p align='center'>Бөлімдер табылмады</p>";

  }else if(isset($_GET['students'])){
    echo"
    <label class='section-label'> Группа оқушыларының тізімі </label>
    <div class='row row-sm'>";

    $query_list_students = mysql_query("SELECT * FROM db_users u, db_student_curs c
                                                WHERE c.id_group = '$_GET[objects]'
                                                  AND u.user_id = c.user_id
                                             ORDER BY u.user_sname, u.user_name ");
    
    while($result_list_students = mysql_fetch_array($query_list_students)){
      echo"
      <div class='col-sm-6 col-md-6 col-lg-4 mg-b-15'>
        <div class='card-contact'>
          <div class='tx-center'>
            <img src='img/users/$result_list_students[user_ava]' class='card-img'>
            <h5 class='mg-t-10 mg-b-5'>$result_list_students[user_sname] $result_list_students[user_name]</h5>
            <p>Оқушы</p>
          </div>
  
          <p class='contact-item'>
            <span>Ұялы нөмірі:</span>
            <span>$result_list_students[user_phone]</span>
          </p>
          <p class='contact-item'>
            <span>Email:</span>
            $result_list_students[user_email]
          </p>
        </div>
      </div>";
    }

    echo"
    </div>";

  }else if(isset($_GET['testing'])){

    $query_testing_info = mysql_query("SELECT * FROM db_groups_testing_info t, db_curses_sections s
                                               WHERE t.id_groups_testing_info = '$_GET[testing]'
                                                 AND s.id_curses_sections = t.id_curses_sections ");
    $result_testing_info = mysql_fetch_array($query_testing_info);

    if(isset($_POST['add_testing_question'])){

      $add_testing_question = mysql_query("INSERT INTO db_testing_questions (id_groups_testing_info, id_curses_sections, question_text, correct_answer) VALUES ('$result_testing_info[id_groups_testing_info]', '$result_testing_info[id_curses_sections]', '$_POST[question_text]', '$_POST[correct_answer]') ");
      if($add_testing_question == true) header("Location:./?objects=$_GET[objects]&testing=$_GET[testing]");

    }else if(isset($_GET['del_testing_questions'])){

      $del_testing_questions = mysql_query("DELETE FROM db_testing_questions WHERE id_testing_questions = '$_GET[del_testing_questions]' ");
      if($del_testing_questions == true) header("Location:./?objects=$_GET[objects]&testing=$_GET[testing]");

    }

    echo"
    <div class='card card-dash-headline pd-0 mg-b-25'>
      <div class='card-header'>
        <h6 class='tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold tx-left'> $result_testing_info[name_curses_sections] &nbsp&nbsp<i class='fas fa-arrow-alt-circle-right'></i>&nbsp&nbsp $result_testing_info[name_test] </h6>
      </div>
      
      <div class='row pd-20'>
        <form action='?objects=$_GET[objects]&testing=$_GET[testing]' method='post' style='width: 100%;' required>

          <div class='col-md-12'>
            <div class='form-group mg-b-25 tx-left'>
              <label>Тест сұрағының үлгісі:</label>
              
              <div class='alert alert-warning'>
                <b>Әріпке берілетін дәстүрлі анықтама</b>
                <br>
                <br>
                <b>A)</b> Дыбысты жазудағы шартты таңба <br> 
                <b>B)</b> Сөздің дұрыс жазылуы<br>
                <b>C)</b> Сөздің дұрыс айтылуы<br>
                <b>D)</b> Дыбыстардың белгілі бір жинағы<br>
                <b>E)</b> Дыбыстың шарттылық белгісі<br>
              </div>

              <textarea name='question_text' class='editable tx-14 bd pd-10 tx-inverse tx-left' style='min-height: 150px; width: 100%;' required>  </textarea>
            </div>
          </div>

          <div class='col-md-6'>
            <div class='form-group mg-b-25 tx-left'>
              <label>Дұрыс жауапты көрсетіңіз:</label>
              <select name='correct_answer' class='form-control' required>
                <option value=''> Тізімнен таңдаңыз </option>
                <option value='A'> A </option>
                <option value='B'> B </option>
                <option value='C'> C </option>
                <option value='D'> D </option>
                <option value='E'> E </option>
              </select>
            </div>
          </div>

          <button type='submit' name='add_testing_question' class='btn btn-primary mg-t-25 mg-b-25' style='width: 50%'>Сұрақты қосу</button>

        </form>
      </div>

      <div class='card-header'>
        <h6 class='tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold tx-left'> Енгізілген сұрақтар </h6>
      </div>

      <div class='table-responsive questions'>
        <table class='table mg-b-0 tx-13'>
          <thead>
            <tr class='tx-10'>
              <th class='wd-10p pd-y-5 tx-center'> № </th>
              <th class='wd-60p pd-y-5'> Сұрақ </th>
              <th class='wd-20p pd-y-5 tx-center'> Дұрыс жауабы </th>
              <th class='wd-10p pd-y-5 tx-center'>Жою</th>
            </tr>
          </thead>
          <tbody>";

          $query_list_question = mysql_query("SELECT * FROM db_testing_questions WHERE id_groups_testing_info = '$result_testing_info[id_groups_testing_info]' AND id_curses_sections = '$result_testing_info[id_curses_sections]' ");

          $number_test = 0;

          while($result_list_question = mysql_fetch_array($query_list_question)){
            $number_test++;
            echo"
            <tr>
              <td style='vertical-align: middle' class='tx-center'> <b>$number_test</b> </td>
              <td style='vertical-align: middle' class='tx-left'>$result_list_question[question_text]</td>
              <td style='vertical-align: middle' class='tx-center'>$result_list_question[correct_answer]</td>
              <td style='vertical-align: middle' class='tx-center'><a href='?objects=$_GET[objects]&testing=$_GET[testing]&del_testing_questions=$result_list_question[id_testing_questions]' class='btn btn-danger btn-icon'><div><i class='far fa-trash-alt'></i></div></a></td>
            </tr>";
          }

    echo"
          </tbody>
        </table>
      </div>

    </div>";

  }else{

    if(isset($_GET['del_group_doc'])){

      $del_group_doc = mysql_query("DELETE FROM db_groups_docs WHERE id_group_doc = '$_GET[del_group_doc]' ");
      if($del_group_doc == true) header("Location:./?objects=$_GET[objects]");

    }else if(isset($_POST['update_name_section'])){

      $update_name_section = mysql_query("UPDATE db_curses_sections SET name_curses_sections = '$_POST[name_curses_sections]' WHERE id_curses_sections = '$_POST[id_curses_sections]' ");
      if($update_name_section == true) header("Location:./?objects=$_GET[objects]");

    }else if(isset($_POST['add_groups_docs'])){

      $current_time = date("His");
      $current_date = date("d.m.Y");

      move_uploaded_file($_FILES['url_doc']['tmp_name'], "downloads/$current_time".'_'.$_FILES['url_doc']['name']);
      $url_doc = $current_time."_".$_FILES['url_doc']['name'];
      $type_doc = $_FILES['url_doc']['type'];
      
      $add_groups_docs = mysql_query("INSERT INTO db_groups_docs (id_group, id_curses_sections, name_doc, url_doc, type_doc, date_upload) 
                                                          VALUES ('$_GET[objects]', '$_POST[id_curses_sections]', '$_POST[name_doc]', '$url_doc', '$type_doc', '$current_date') ");
      if($add_groups_docs == true) header("Location:./?objects=$_GET[objects]");

    }else if(isset($_POST['add_groups_testing_info'])){

      $add_groups_testing_info = mysql_query("INSERT INTO db_groups_testing_info (id_group, id_curses_sections, name_test, start_test, end_test) 
                                                                          VALUES ('$_GET[objects]', '$_POST[id_curses_sections]', '$_POST[name_test]', '$_POST[start_test]', '$_POST[end_test]') ");
      if($add_groups_testing_info == true) header("Location:./?objects=$_GET[objects]");

    }else if(isset($_GET['del_groups_testing_info'])){

      $del_groups_testing_info = mysql_query("DELETE FROM db_groups_testing_info WHERE id_groups_testing_info = '$_GET[del_groups_testing_info]' ");
      if($del_groups_testing_info == true) header("Location:./?objects=$_GET[objects]");

    }else if(isset($_GET['del_curses_sections'])){

      $del_curses_sections = mysql_query("DELETE FROM db_curses_sections WHERE id_curses_sections = '$_GET[del_curses_sections]' ");
      if($del_curses_sections == true) header("Location:./?objects=$_GET[objects]");

    }

    $query_list_curses_sections = mysql_query("SELECT * FROM db_curses_sections WHERE id_group = '$_GET[objects]' ");
    $result_list_curses_sections = mysql_fetch_array($query_list_curses_sections);
    $col_list_curses_sections    = mysql_num_rows($query_list_curses_sections);

    if($result_list_curses_sections['id_curses_sections'] != '' ){

      $i = 0;

      do{
        $i++;
        
        echo "
        <div class='card card-dash-headline pd-0 mg-b-25'>
          <div class='card-header'>
            <div class='row tx-left'>
              <div class='col-md-12'>
                <div class='dropdown dropdown-demo show'>
                  <a href='#' class='dd-link' data-toggle='dropdown'>
                    <div>
                      <span>$result_list_curses_sections[name_curses_sections]</span>
                      <i class='fa fa-angle-down mg-l-10'></i>
                    </div>
                  </a>
                  <div class='dropdown-menu wd-200 pd-5'>
                    <nav class='nav dropdown-nav'>
                      <a href='#update_name_section$i' data-toggle='modal' class='nav-link'> <i class='icon ion-edit' style='color: #CE7D0A; font-size: 18px'></i> Атауын өзгерту </a>
                      <a href='#add_groups_docs$i' data-toggle='modal' class='nav-link'> <i class='icon ion-plus-circled' style='color: #3579C6; font-size: 18px'></i> Файл жүктеу </a>
                      <a href='#add_groups_testing_info$i' data-toggle='modal' class='nav-link'> <i class='icon ion-clipboard' style='color: #1A8E06; font-size: 18px'></i> Тестілеу қосу </a>
                      <a href='?objects=$_GET[objects]&del_curses_sections=$result_list_curses_sections[id_curses_sections]' class='nav-link'><i class='icon ion-trash-a' style='color: #BD2130; font-size: 18px'></i> Жою </a>
                    </nav>
                  </div>
                </div>
              </div>

              <div id='update_name_section$i' class='modal fade'>
                <div class='modal-dialog' role='document'>
                  <div class='modal-content bd-0 tx-14'>
                    <div class='modal-header pd-y-20 pd-x-25'>
                      <h6 class='tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold'>Бөлімнің атауын өзгерту</h6>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>
          
                    <form action='?objects=$_GET[objects]' method='post' enctype='multipart/form-data' required>
                      <input type='hidden' name='id_curses_sections' value='$result_list_curses_sections[id_curses_sections]'>
          
                      <div class='modal-body pd-25'>
                        <div class='row'>
          
                          <div class='col-md-12'>
                            <div class='form-group mg-b-15'>
                              <label>Бөлім атауын енгізіңіз: <span class='tx-danger'>*</span></label>
                              <input type='text' name='name_curses_sections' class='form-control' required style='width: 100%' value='$result_list_curses_sections[name_curses_sections]'>
                            </div>
                          </div>
          
                        </div>
                      </div>
          
                      <div class='modal-footer'>
                        <button type='submit' name='update_name_section' class='btn btn-primary' id='updateProfile'>Өзгерту</button>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Жабу</button>
                      </div>
          
                    </form>
                  </div>
                </div>
              </div>
              
              <div id='add_groups_docs$i' class='modal fade'>
                <div class='modal-dialog' role='document'>
                  <div class='modal-content bd-0 tx-14'>
                    <div class='modal-header pd-y-20 pd-x-25'>
                      <h6 class='tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold'>Файл жүктеу</h6>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>
          
                    <form action='?objects=$_GET[objects]' method='post' enctype='multipart/form-data' required>
                      <input type='hidden' name='id_curses_sections' value='$result_list_curses_sections[id_curses_sections]'>
          
                      <div class='modal-body pd-25'>
                        <div class='row'>
          
                          <div class='col-md-12'>
                            <div class='form-group mg-b-15'>
                              <label>Файлдың атауын енгізіңіз: <span class='tx-danger'>*</span></label>
                              <input type='text' name='name_doc' class='form-control' required style='width: 100%' placeholder='Лекция'>
                            </div>
                            <input name='url_doc' type='file' required>
                          </div>
          
                        </div>
                      </div>
          
                      <div class='modal-footer'>
                        <button type='submit' name='add_groups_docs' class='btn btn-primary' id='updateProfile'>Жүктеу</button>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Жабу</button>
                      </div>
          
                    </form>
                  </div>
                </div>
              </div>

              <div id='add_groups_testing_info$i' class='modal fade'>
                <div class='modal-dialog' role='document'>
                  <div class='modal-content bd-0 tx-14'>
                    <div class='modal-header pd-y-20 pd-x-25'>
                      <h6 class='tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold'>Тестілеу қосу</h6>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>
          
                    <form action='?objects=$_GET[objects]' method='post' enctype='multipart/form-data' required>
                      <input type='hidden' name='id_curses_sections' value='$result_list_curses_sections[id_curses_sections]'>
          
                      <div class='modal-body pd-25'>
                        <div class='row'>
          
                          <div class='col-md-12'>
                            <div class='form-group mg-b-15'>
                              <label>Тестілеу түрі: <span class='tx-danger'>*</span></label>
                              <input type='text' name='name_test' class='form-control' required style='width: 100%' placeholder='Қорытынды тестілеу'>
                            </div>
                          </div>

                          <div class='col-md-6'>
                            <div class='form-group mg-b-15'>
                              <label>Басталу күні: <span class='tx-danger'>*</span></label>
                              <input name='start_test' type='text' class='form-control DateMask' placeholder='кк.аа.жжжж' required>
                            </div>
                          </div>

                          <div class='col-md-6'>
                            <div class='form-group mg-b-15'>
                              <label>Аяқталу күні: <span class='tx-danger'>*</span></label>
                              <input name='end_test' type='text' class='form-control DateMask' placeholder='кк.аа.жжжж' required>
                            </div>
                          </div>
          
                        </div>
                      </div>
          
                      <div class='modal-footer'>
                        <button type='submit' name='add_groups_testing_info' class='btn btn-primary' id='updateProfile'>Қосу</button>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Жабу</button>
                      </div>
          
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>";

          $query_list_curses_docs = mysql_query("SELECT * FROM db_groups_docs WHERE id_group = '$_GET[objects]' AND id_curses_sections = '$result_list_curses_sections[id_curses_sections]' ");
          $result_list_curses_docs = mysql_fetch_array($query_list_curses_docs);
  
          echo"
            <div class='file-group'>";
  
          $col_list_curses_docs = 0;
  
          if($result_list_curses_docs['id_group_doc'] != ''){
  
            do{
              $col_list_curses_docs++;
  
              $file_type='';
              if($result_list_curses_docs['type_doc'] == 'application/pdf'){
                $file_type='<i class="fa fa-file-pdf tx-danger"></i>';
                $file_type_name = 'pdf';
              }
              else if($result_list_curses_docs['type_doc'] == 'application/vnd.openxmlformats-officedocument.word' || $result_list_curses_docs['type_doc'] == 'application/msword'){
               $file_type='<i class="fa fa-file-word tx-primary"></i>';
               $file_type_name = 'doc';
              }
  
              echo"
              <div class='file-item'>
                <div class='row no-gutters wd-100p'>
                  <div class='col-sm-5 d-flex align-items-center'>
                    $file_type
                    <a href='downloads/$result_list_curses_docs[url_doc]' target='_blank'>$result_list_curses_docs[name_doc]</a>
                  </div>
                  <div class='col-sm-2 tx-right tx-sm-left'>$file_type_name</div>
                  <div class='col-sm-2 mg-t-5 mg-sm-t-0'><i class='fas fa-file-upload'></i> $result_list_curses_docs[date_upload]</div>
                  <div class='col-sm-2 mg-t-5 mg-sm-t-0'><i class='far fa-eye'></i> $result_list_curses_docs[points]</div>
                  <div class='col-sm-1 tx-right mg-t-5 mg-sm-t-0'>
                    <a href='?objects=$_GET[objects]&del_group_doc=$result_list_curses_docs[id_group_doc]'><i class='far fa-trash-alt tx-danger'></i></a>
                  </div>
                </div>
              </div>";
  
            }while($result_list_curses_docs = mysql_fetch_array($query_list_curses_docs));
  
          }
  
          $query_list_groups_testing_info = mysql_query("SELECT * FROM db_groups_testing_info WHERE id_group = '$_GET[objects]' AND id_curses_sections = '$result_list_curses_sections[id_curses_sections]' ORDER BY end_test ");
          $result_list_groups_testing_info = mysql_fetch_array($query_list_groups_testing_info);
  
          $col_list_groups_testing_info = 0;
  
          if($result_list_groups_testing_info['id_groups_testing_info'] != ''){
  
            do{
              $col_list_groups_testing_info++;
  
              $query_list_testing_questions = mysql_query("SELECT * FROM db_testing_questions WHERE id_curses_sections = '$result_list_curses_sections[id_curses_sections]' AND id_groups_testing_info = '$result_list_groups_testing_info[id_groups_testing_info]' ");
              $result_list_testing_questions = mysql_num_rows($query_list_testing_questions);
  
              echo"
              <div class='file-item' style='background-color: rgb(114, 174, 96, 0.4)'>
                <div class='row no-gutters wd-100p'>
                  <div class='col-sm-5 d-flex align-items-center'>
                    <a href='?objects=$_GET[objects]&testing=$result_list_groups_testing_info[id_groups_testing_info]'>$result_list_groups_testing_info[name_test]</a>
                  </div>
                  <div class='col-sm-2 tx-right tx-sm-left'> $result_list_testing_questions сұрақ </div>
                  <div class='col-sm-4 mg-t-5 mg-sm-t-0'><i class='far fa-calendar-alt'></i> $result_list_groups_testing_info[start_test] - $result_list_groups_testing_info[end_test]</div>
                  <div class='col-sm-1 tx-right mg-t-5 mg-sm-t-0'>
                    <a href='?objects=$_GET[objects]&del_groups_testing_info=$result_list_groups_testing_info[id_groups_testing_info]'><i class='far fa-trash-alt tx-danger'></i></a>
                  </div>
                </div>
              </div>";
  
            }while($result_list_groups_testing_info = mysql_fetch_array($query_list_groups_testing_info));
  
          }
  
          if($col_list_curses_docs == 0 && $col_list_groups_testing_info == 0) echo "<p align='center'> <br>Мәліметтер табылмады </p>";

        echo"
          </div>
        </div>";     

      }while($result_list_curses_sections = mysql_fetch_array($query_list_curses_sections));

    }else echo "<p align='center'>Бөлімдер табылмады</p>";

  ?>
    <button class="btn btn-primary mg-t-25 mg-b-25" style="width: 100%" href="#add_new_section" data-toggle="modal">Бөлімдер қосу</button>

    <div id="add_new_section" class="modal fade">
      <div class="modal-dialog" role="document">
        <div class="modal-content bd-0 tx-14">
          <div class="modal-header pd-y-20 pd-x-25">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Бөлімдер қосу</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="plugins/insert_in_curs.php" method="post" enctype='multipart/form-data' required>
            <input type="hidden" name="col_list_curses_sections" value="<?=$col_list_curses_sections?>">
            <input type="hidden" name="id_group" value="<?=$_GET['objects']?>">

            <div class="modal-body pd-25">
              <div class="row">

                <div class="col-md-12">
                  <div class="form-group mg-b-15">
                    <label>Бөлімдердің санын көрсетіңіз: <span class="tx-danger">*</span></label>
                    <input type="number" name="col_section" class="form-control wd-250" required style="width: 30%" value="1">
                  </div>
                </div>

              </div>
            </div>

            <div class="modal-footer">
              <button type="submit" name="add_new_section" class="btn btn-primary" id="updateProfile">Қосу</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Жабу</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
  </div>
  
  <div class="manager-left">
    <nav class="nav">
      <?php
      if(isset($_GET['students']) || isset($_GET['results']) )
        echo "<a href='?objects=$_GET[objects]' class='nav-link'> <span> Басты бет </span> </a>";
      else echo "<a href='?objects=$_GET[objects]' class='nav-link active'> <span> Басты бет </span> </a>";

      if(isset($_GET['students'])) echo "<a href='?objects=$_GET[objects]&students' class='nav-link active'> <span> Оқушылар </span> </a>";
      else echo "<a href='?objects=$_GET[objects]&students' class='nav-link'> <span> Оқушылар </span> </a>";

      if(isset($_GET['results'])) echo "<a href='?objects=$_GET[objects]&results' class='nav-link active'> <span> Нәтижелер </span> </a>";
      else echo "<a href='?objects=$_GET[objects]&results' class='nav-link'> <span> Нәтижелер </span> </a>";
      ?>
    </nav>
  </div>

</div>