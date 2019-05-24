<?php
	if($_SESSION['user_type'] == '1'){

		if(isset($_GET['profile'])) require "pages/admin/profile.php";
		else if(isset($_GET['objects'])) require "pages/admin/objects.php";
		else if(isset($_GET['tutors'])) require "pages/admin/tutors.php";
		else if(isset($_GET['students'])) require "pages/admin/students.php";
		else header('Location:./?profile');

	}else if($_SESSION['user_type'] == '2'){

		if(isset($_GET['profile'])) require "pages/tutor/profile.php";
		else if(isset($_GET['objects'])) require "pages/tutor/objects.php";
		else header('Location:./?profile');

	}else if($_SESSION['user_type'] == '3'){

		if(isset($_GET['profile'])) require "pages/student/profile.php";
		else if(isset($_GET['objects'])) require "pages/student/objects.php";
		else header('Location:./?profile');

	}
?>