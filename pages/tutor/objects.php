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
        <?php
        $query_list_curses = mysql_query("SELECT * FROM db_groups g, db_curses c
                                                  WHERE g.user_id = '$user_info[user_id]'
                                                    AND c.id_curs = g.id_curs 
                                               ORDER BY g.name_group ");
        while($result_list_curses = mysql_fetch_array($query_list_curses)){

          $query_students_list = mysql_query("SELECT * FROM db_student_curs WHERE id_group = '$result_list_curses[id_group]' ");
          $result_students_list_col = mysql_num_rows($query_students_list);

          echo"
          <div class='col-md-6 mg-b-15'>
            <div class='card-contact'>
              <div class='row'>
                <div class='col-md-5'>
                  <div class='tx-center'>
                    <a href='?objects=$result_list_curses[id_group]'><img src='img/curses/$result_list_curses[img_curs]' style='width: 100%;'></a>
                  </div>
                </div>
                <div class='col-md-7'>
                  <div class='tx-center'>
                    <h5 class='mg-t-10 mg-b-5 pd-t-10 pd-b-15'><a href='?objects=$result_list_curses[id_group]' class='contact-name'> $result_list_curses[name_curs] </a></h5>
                  </div>
                  <p class='contact-item'>
                    <span>Группа:</span>
                    <span>$result_list_curses[name_group]</span>
                  </p>
    
                  <p class='contact-item'>
                    <span>Оқушылар:</span>
                    <span>$result_students_list_col</span>
                  </p>
                </div>
              </div>
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
