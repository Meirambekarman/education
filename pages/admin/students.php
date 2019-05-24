<div class="slim-mainpanel" style="margin-top: -21px;">
	<div class="container">
		<div class="slim-pageheader">
			<ol class="breadcrumb slim-breadcrumb"></ol>
			<h6 class="slim-pagetitle">Оқушылар тізімі</h6>
		</div>

		<div class="manager-wrapper">
			<div class="manager-right mg-l-0">
				<div class="row">

					<div class="col-md-12 mg-b-15">
						<button class="btn btn-primary" style="width: 100%" href="#add_new_tutor" data-toggle="modal">Жаңа оқушы қосу</button>

						<div id="add_new_tutor" class="modal fade">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content bd-0 tx-14">
									<div class="modal-header pd-y-20 pd-x-25">
										<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Жаңа оқушы қосу</h6>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>

									<form action="plugins/insert_user.php" method="post" enctype='multipart/form-data' required>
										<input type="hidden" name="user_type" value="3">
										
										<div class="modal-body pd-25">

											<div class="col-md-12 text-center mg-b-25">
												<div class='picture'>
													<img src="img/users/no_ava.jpg" class='picture-src' id='wizardPicturePreview'>
													<input name='img' type='file' id='wizard-picture'>
												</div>
											</div>

											<div class="row">

												<div class="col-md-4">
													<div class="form-group mg-b-15">
														<label>Тегі: <span class="tx-danger">*</span></label>
														<input type="text" name="user_sname" class="form-control wd-250" placeholder="Тегі" required style="width: 100%">
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group mg-b-15">
														<label>Аты: <span class="tx-danger">*</span></label>
														<input type="text" name="user_name" class="form-control wd-250" placeholder="Аты" required style="width: 100%">
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group mg-b-15">
														<label>Әкесінің аты:</label>
														<input type="text" name="user_mname" class="form-control wd-250" placeholder="Әкесінің аты" style="width: 100%">
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
														<input name="user_phone" id="phoneMask" type="text" class="form-control" placeholder="8 (999) 999-9999" required>
													</div>
												</div>

												<div class="col-md-6">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="icon fas fa-at tx-16 lh-0 op-6"></i></span>
														</div>
														<input name="user_email" type="email" class="form-control" placeholder="email" required>
													</div>
												</div>

											</div>

											<hr>

											<div class="row">
												<div class="col-md-2"></div>
												<div class="col-md-8">

													<div class="col-md-12 mg-10">
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="fas fa-user tx-16 lh-0 op-6"></i>
																</div>
															</div>
															<input name="login" type="text" class="form-control" placeholder="Логин" required>
														</div>
													</div>

													<div class="col-md-12 mg-10">
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="fas fa-lock tx-16 lh-0 op-6"></i>
																</div>
															</div>
															<input name="password" type="password" class="form-control" placeholder="********" required>
														</div>
													</div>
												</div>

											</div>
										</div>

										<div class="modal-footer">
											<button type="submit" name="add_new_user" class="btn btn-primary" id="updateProfile">Сақтау</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Жабу</button>
										</div>
	
									</form>
								</div>
							</div>
						</div>

					</div>
					<?php

					if(isset($_GET['del'])){

						$delete_stud = mysql_query("DELETE FROM db_users WHERE user_id = '$_GET[del]' ");
						if($delete_stud == true) header('Location:./?students');

					}

					$query_list_students  = mysql_query("SELECT * FROM db_users WHERE user_type='3' ");

					while($result_list_students = mysql_fetch_array($query_list_students)){

						echo"
						<div class='col-sm-6 col-md-6 col-lg-3 mg-b-15'>
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
          	    <a href='?students&del=$result_list_students[user_id]' class='btn btn-danger btn-icon pull-right mg-t-5'><div><i class='far fa-trash-alt'></i></div></a>
          	  </div>
          	</div>";
					}

					?>
				</div>
			</div>

		</div>
	</div>
</div>