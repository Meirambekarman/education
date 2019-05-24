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
  
          $query_list_groups_testing_info = mysql_query("SELECT * FROM db_groups_testing_info i, db_testing t
                                                                 WHERE i.id_group = '$_GET[objects]' 
                                                                   AND i.id_curses_sections = '$result_list_curses_sections[id_curses_sections]'
                                                                   AND t.id_groups_testing_info = i.id_groups_testing_info
                                                                   AND t.user_id = '$user_info[user_id]'
                                                              ORDER BY i.end_test ");
          $result_list_groups_testing_info = mysql_fetch_array($query_list_groups_testing_info);
  
          if($result_list_groups_testing_info['id_groups_testing_info'] != ''){
  
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
                  <div class='col-sm-2 mg-t-5 mg-sm-t-0 tx-left'><i class='far fa-calendar-alt'></i> $result_list_groups_testing_info[end_test] дейін</div>
                  <div class='col-sm-3 mg-t-5 mg-sm-t-0'> 
                     $result_list_groups_testing_info[mark]%
                  </div>
                </div>
              </div>";
  
            }while($result_list_groups_testing_info = mysql_fetch_array($query_list_groups_testing_info));

          }else echo "<p align='center'> <br>Мәліметтер табылмады </p>";
        echo"
          </div>
        </div>";     

      }while($result_list_curses_sections = mysql_fetch_array($query_list_curses_sections));

    }else echo "<p align='center'>Бөлімдер табылмады</p>";

  }else if(isset($_GET['testing'])){

    $query_testing_info = mysql_query("SELECT * FROM db_groups_testing_info t, db_curses_sections s
                                               WHERE t.id_groups_testing_info = '$_GET[testing]'
                                                 AND s.id_curses_sections = t.id_curses_sections ");
    $result_testing_info = mysql_fetch_array($query_testing_info);

    $query_user_testing_info = mysql_query("SELECT * FROM db_testing 
                                                    WHERE id_groups_testing_info = '$result_testing_info[id_groups_testing_info]'
                                                      AND user_id = '$user_info[user_id]' ");
    $result_user_testing_info = mysql_fetch_array($query_user_testing_info);

    echo "
    <div class='card card-dash-headline pd-0 mg-b-25'>
      
      <div class='card-header'>
        <h6 class='tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold tx-left'> $result_testing_info[name_curses_sections] &nbsp&nbsp<i class='fas fa-arrow-alt-circle-right'></i>&nbsp&nbsp $result_testing_info[name_test] </h6>
      </div>";

    if(isset($_SESSION['msg'])){

      echo $_SESSION['msg'];
      unset($_SESSION['msg']);

    }else if(isset($_POST['end_testing'])){

      $query_list_quertion = mysql_query("SELECT * FROM db_testing_questions 
                                                  WHERE id_groups_testing_info = '$result_testing_info[id_groups_testing_info]' 
                                                    AND id_curses_sections = '$result_testing_info[id_curses_sections]' 
                                               ORDER BY id_testing_questions ");

      $col_correct_answers = 0;
      $number_test = 0;

      while($result_list_quertion = mysql_fetch_array($query_list_quertion)){
        
        $number_test++;
        $answer = 'answer'.$number_test;

        if($result_list_quertion['correct_answer'] == $_POST[$answer]) $col_correct_answers++;

      }

      $mark = (100 / $number_test) * $col_correct_answers;
      $current_date = date("d.m.Y");

      $end_testing = mysql_query("INSERT INTO db_testing (id_groups_testing_info, user_id, start_date, mark) VALUES ('$result_testing_info[id_groups_testing_info]', '$user_info[user_id]', '$current_date', '$mark') ");

      if($end_testing == true){

        $_SESSION['msg'] = "
        <div class='alert alert-success'>
          <p align='center'> 
            <h5><b>Тестілеу аяқталды!</b></h5><br>
            Сіз <b>$number_test</b> сұрақтың <b>$col_correct_answers</b> дұрыс жауап бердіңіз!<br>
            Сіздің балыңыз <b>$mark%</b>
          </p>
          <a href='?objects=$_GET[objects]'><button class='btn btn-primary mg-t-25 mg-b-25' style='width: 20%'>Артқа</button></a>
        </div>";
        header("Location:./?objects=$_GET[objects]&testing=$_GET[testing]");
      }

    }else if($result_user_testing_info['id_testing'] != ''){

      echo"
      <div class='alert alert-success'>
        <p align='center'> 
          <h5><b>Тест тапсыру мүмкіндігі 1 рет қана беріледі!</b></h5><br>
          Сіздің балыңыз <b>$result_user_testing_info[mark]%</b><br>
          Тест тапсырған күніңіз <b>$result_user_testing_info[start_date]</b>
        </p>
        <a href='?objects=$_GET[objects]'><button class='btn btn-primary mg-t-25 mg-b-25' style='width: 20%'>Артқа</button></a>
      </div>";

    }else{

    echo"
      <div class='row pd-30 questions'>
        <div class='col-md-12 tx-left'>
          <form action='?objects=$_GET[objects]&testing=$_GET[testing]' method='post' style='width: 100%;' required'>";

            $query_list_quertion = mysql_query("SELECT * FROM db_testing_questions 
                                                        WHERE id_groups_testing_info = '$result_testing_info[id_groups_testing_info]' 
                                                          AND id_curses_sections = '$result_testing_info[id_curses_sections]' 
                                                     ORDER BY id_testing_questions ");
    
            $number_test = 0;
            while($result_list_quertion = mysql_fetch_array($query_list_quertion)){
              $number_test++;
        
              $answer = 'answer'.$number_test;
        
              echo"<p align='left'> <b>$number_test - Сұрақ</b> </p><br>";
              echo"
                $result_list_quertion[question_text] <br>
        
                <div class='row'>
                  <div class='col-md-1'>
                    <label class='rdiobox rdiobox-primary mg-t-15'>
                      <input type='radio' name='$answer' value='A'><span> A </span>
                    </label>
                  </div>
                  <div class='col-md-1'>
                    <label class='rdiobox rdiobox-primary mg-t-15'>
                      <input type='radio' name='$answer' value='B'><span> B </span>
                    </label>
                  </div>
                  <div class='col-md-1'>
                    <label class='rdiobox rdiobox-primary mg-t-15'>
                      <input type='radio' name='$answer' value='C'><span> C </span>
                    </label>
                  </div>
                  <div class='col-md-1'>
                    <label class='rdiobox rdiobox-primary mg-t-15'>
                      <input type='radio' name='$answer' value='D'><span> D </span>
                    </label>
                  </div>
                  <div class='col-md-1'>
                    <label class='rdiobox rdiobox-primary mg-t-15'>
                      <input type='radio' name='$answer' value='E'><span> E </span>
                    </label>
                  </div>
                </div>
        
              <hr>";
            }
            
    echo"   <button type='submit' name='end_testing' class='btn btn-primary mg-t-25 mg-b-25' style='width: 100%'>Тестілеуді аяқтау</button>
          </form>
        </div>
      </div>";
    }
    echo"
    </div>";

  }else{

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
                  <div class='col-sm-8 d-flex align-items-center'>
                    $file_type
                    <a href='downloads/$result_list_curses_docs[url_doc]' target='_blank'>$result_list_curses_docs[name_doc]</a>
                  </div>
                  <div class='col-sm-2 tx-right tx-sm-left'>$file_type_name</div>
                  <div class='col-sm-2 mg-t-5 mg-sm-t-0 tx-right'><i class='fas fa-file-upload'></i> $result_list_curses_docs[date_upload]</div>
                </div>
              </div>";
  
            }while($result_list_curses_docs = mysql_fetch_array($query_list_curses_docs));
  
          }

          $current_date = date("d.m.Y");
  
          $query_list_groups_testing_info = mysql_query("SELECT * FROM db_groups_testing_info i
                                                                 WHERE i.id_group = '$_GET[objects]' 
                                                                   AND i.id_curses_sections = '$result_list_curses_sections[id_curses_sections]' 
                                                                   AND i.start_test <= '$current_date'
                                                                   AND i.end_test >= '$current_date'
                                                              ORDER BY i.end_test ");
          $result_list_groups_testing_info = mysql_fetch_array($query_list_groups_testing_info);
  
          $col_list_groups_testing_info = 0;
  
          if($result_list_groups_testing_info['id_groups_testing_info'] != ''){
  
            do{
              $col_list_groups_testing_info++;
  
              $query_list_testing_questions = mysql_query("SELECT * FROM db_testing_questions 
                                                                   WHERE id_curses_sections = '$result_list_curses_sections[id_curses_sections]' 
                                                                     AND id_groups_testing_info = '$result_list_groups_testing_info[id_groups_testing_info]' ");
              $result_list_testing_questions = mysql_num_rows($query_list_testing_questions);
  
              echo"
              <div class='file-item' style='background-color: rgb(114, 174, 96, 0.4); color: #333'>
                <div class='row no-gutters wd-100p'>
                  <div class='col-sm-5 d-flex align-items-center'> $result_list_groups_testing_info[name_test] </div>
                  <div class='col-sm-2 tx-right tx-sm-left'> $result_list_testing_questions сұрақ </div>
                  <div class='col-sm-2 mg-t-5 mg-sm-t-0 tx-left'><i class='far fa-calendar-alt'></i> $result_list_groups_testing_info[end_test] дейін</div>
                  <div class='col-sm-3 mg-t-5 mg-sm-t-0 pd-t-12'> 
                    <a href='?objects=$_GET[objects]&testing=$result_list_groups_testing_info[id_groups_testing_info]'>
                      <button class='btn btn-primary btn-sm btn-block mg-b-10 wd-80p pull-right'> Тестілеуді бастау </button>
                    </a> 
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
  }
  ?>
  </div>

  <div class="manager-left">
    <nav class="nav">
      <?php
      if(isset($_GET['students']) || isset($_GET['results']) )
        echo "<a href='?objects=$_GET[objects]' class='nav-link'> <span> Басты бет </span> </a>";
      else echo "<a href='?objects=$_GET[objects]' class='nav-link active'> <span> Басты бет </span> </a>";

      if(isset($_GET['results'])) echo "<a href='?objects=$_GET[objects]&results' class='nav-link active'> <span> Нәтижелер </span> </a>";
      else echo "<a href='?objects=$_GET[objects]&results' class='nav-link'> <span> Тестілеу нәтижелері </span> </a>";
      ?>
    </nav>
  </div>

</div>