<div class="slim-mainpanel" style="margin-top: -21px;">
  <div class="container">
    
      <div class="slim-pageheader">
        <div class="breadcrumb slim-breadcrumb">
        </div>
        <h6 class="slim-pagetitle"> Курстар тізімі </h6>
      </div>
    
    <?php
    if($_GET['objects'] != '') require "object_in/object_info.php";
    else{ 
    ?>

    <div class="manager-wrapper">
      <div class="manager-right mg-l-0">
        <div class="row">

          <div class="col-md-12 mg-b-15">
            <button class="btn btn-primary" style="width: 100%" href="#add_new_curs" data-toggle="modal">Жаңа курс қосу</button>
            
            <div id="add_new_curs" class="modal fade">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content bd-0 tx-14">
                  <div class="modal-header pd-y-20 pd-x-25">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Жаңа курс қосу</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            
                  <form action="plugins/insert_new_curs.php" method="post" enctype='multipart/form-data' required>
            
                    <div class="modal-body pd-25">
                                  
                      <div class="row">

                        <div class="col-md-12 text-center mg-b-25">
                          <div class='picture-curs'>
                            <img src="img/curses/no_image.jpg" class='picture-src' id='wizardPicturePreview'>
                            <input name='img' type='file' id='wizard-picture'>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group mg-b-15">
                            <label>Курс атауы: <span class="tx-danger">*</span></label>
                            <input type="text" name="name_curs" class="form-control wd-250" placeholder="Мысалы: Математика 8-сынып" required style="width: 100%">
                          </div>
                        </div>
                    
                        <div class="col-md-12">
                          <div class="form-group mg-b-15">
                            <label>Курс туралы қысқаша мәлімет:</label>
                            <textarea name="discription_curs" class="editable tx-14 bd pd-10 tx-inverse" style="min-height: 150px">  </textarea>
                          </div>
                        </div>
              
                      </div>
              
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="insert_new_curs" class="btn btn-primary" id="updateProfile">Қосу</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Жабу</button>
                    </div>
            
                  </form>
                </div>
              </div>
            </div>
          </div>

        <?php
        if(isset($_GET['del'])){

          $delete_object = mysql_query("DELETE FROM db_curses WHERE id_curs = '$_GET[del]' ");
          if($delete_object == true) header('Location:./?objects');

        }

        $query_list_curses = mysql_query("SELECT * FROM db_curses ");
        
        while($result_list_curses = mysql_fetch_array($query_list_curses)){

          $query_groups_list  = mysql_query("SELECT * FROM db_groups g, db_users u 
                                           WHERE g.id_curs = '$result_list_curses[id_curs]'
                                             AND u.user_id = g.user_id ");
          $result_groups_list_col = mysql_num_rows($query_groups_list);

          $query_students_list  = mysql_query("SELECT * FROM db_student_curs t, db_users u 
                                             WHERE t.id_curs = '$result_list_curses[id_curs]'
                                               AND u.user_id = t.user_id ");
          $result_students_list_col = mysql_num_rows($query_students_list);

          echo"
          <div class='col-md-6 mg-b-15'>
            <div class='card-contact'>
              <div class='row'>
                <div class='col-md-5'>
                  <div class='tx-center'>
                    <a href='?objects=$result_list_curses[id_curs]'><img src='img/curses/$result_list_curses[img_curs]' style='width: 100%;'></a>
                  </div>
                </div>
                <div class='col-md-7'>
                  <div class='tx-center'>
                    <h5 class='mg-t-10 mg-b-5 pd-t-10 pd-b-15'><a href='?objects=$result_list_curses[id_curs]' class='contact-name'> $result_list_curses[name_curs] </a></h5>
                  </div>
                  <p class='contact-item'>
                    <span>Мұғалімдер:</span>
                    <span>$result_groups_list_col</span>
                  </p>
    
                  <p class='contact-item'>
                    <span>Оқушылар:</span>
                    <span>$result_students_list_col</span>
                  </p>
                </div>
              </div>
              <a href='?objects&del=$result_list_curses[id_curs]' class='btn btn-danger btn-icon pull-right mg-t-10'><div><i class='far fa-trash-alt'></i></div></a>
            </div>
          </div>";
        }
        ?>
        </div>
      </div>
    </div>
    <?php
    }
    ?>

  </div>
</div>
