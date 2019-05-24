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
        $query_list_curses = mysql_query("SELECT * FROM db_student_curs s, db_groups g, db_curses c
                                                  WHERE s.user_id = '$user_info[user_id]'
                                                    AND c.id_curs = s.id_curs
                                                    AND g.id_group = s.id_group 
                                               ORDER BY c.name_curs ");
        while($result_list_curses = mysql_fetch_array($query_list_curses)){

          $query_curs_info = mysql_query("SELECT * FROM db_groups g, db_users u 
                                                  WHERE g.id_group = '$result_list_curses[id_group]'
                                                    AND u.user_id = g.user_id ");
          $result_curs_info = mysql_fetch_array($query_curs_info);

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
                    <span>Мұғалім:</span>
                    <span>$result_curs_info[user_sname] $result_curs_info[user_name]</span>
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
