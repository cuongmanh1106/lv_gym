<?php
session_start();
include("../helper/help.php");
include("models/m_permission.php");
class C_Users 
{

	function __construct() {
		if(!isset($_SESSION["user"])) {
            echo "<script>window.location='.'</script>";
        } 
	}

	public function show_all_users() {

		$m_per = new M_permission();
		if($m_per->check_permission("list_user") == 0) {
			$_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
		}

		//models
		include("models/m_users.php");
		$m_user = new M_users();
		$users = $m_user->read_all_user();
		$permission = $m_user->read_permission();


		//views
		$view = "views/users/v_list.php";
		$title = "List of users";
		include("include/layout.php");
	}

	public function show_permission() {

	}



	public function insert() {

		$m_per = new M_permission();
		if($m_per->check_permission("insert_user") == 0) {
			$_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
		}

		//models
		include("models/m_users.php");
		$m_user = new M_users();
		$permission = $m_user->read_permission();

		$first_name = $last_name = $permission_id = $email = $password = $address = $phone_number = "";
		if(isset($_POST["insert_user"])) {
			$first_name = $_POST["first_name"];
			$last_name = $_POST["last_name"];
			$permission_id = $_POST["permission_id"];
			$email = $_POST["email"];
			$password = password_hash($_POST["password"],PASSWORD_DEFAULT);
			$address = $_POST["address"];
			$phone_number = $_POST["phone_number"];

				// public function insert_user($first_name,$last_name,$email,$password,$image,$permission_id,$phone_number,$address) {
			$file = $_FILES["image"];
			$image = '';
			if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
				$image = newImage($_FILES["image"]["name"]);
				move_uploaded_file($_FILES["image"]["tmp_name"],"public/images/".$image);
			}

			if($m_user->insert_user($first_name,$last_name,$email,$password,$image,$permission_id,$phone_number,$address)) {
				$_SESSION["alert-success"] = "Add Successfully";
				echo "<script> window.location='user_list.php'</script>";
			} else {
				$_SESSION["alert-danger"] = "Add Fail";
				echo " window.location='user_list.php'</script>";
			}
		}



		//views 
		$view = "views/users/v_add.php";
		$title = "Add a user";
		include("include/layout.php");
	}

	public function detail() {
		include("models/m_users.php");
		$m_user = new M_users();
		$user = "";
		if(isset($_SESSION["user"])) {
			$user = $_SESSION["user"];
		}

		//views
		$title = "Profile";
		$view = "views/users/v_detail.php";
		include("include/layout.php");
	}

	public function edit() {
		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$phone_number = $_POST["phone_number"];
		$id = $_POST["user_id"];
		$address = $_POST["address"];
		$image = $_SESSION["user"]->image;

		include("models/m_users.php");
		$m_user = new M_users();

		if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

			if($_SESSION["user"]->image != "" && file_exists("public/images/".$_SESSION["user"]->image)) {
				unlink("public/images/".$_SESSION["user"]->image);
			}
			$image = newImage($_FILES["image"]["name"]);
			if(move_uploaded_file($_FILES["image"]["tmp_name"],"public/images/$image")) {
				$_SESSION['alert-success'] = "Upload file Successfully.";
			} else {
				$_SESSION['alert-warning'] = "Upload file Fail";
			}
		}

		if($m_user->update_user($first_name,$last_name,$phone_number,$address,$image,$id)) {
			
			$_SESSION['user']->first_name  = $first_name;
			$_SESSION['user']->last_name  = $last_name;
			$_SESSION['user']->phone_number  = $phone_number;
			$_SESSION['user']->address  = $address;
			$_SESSION['user']->image  = $image;
			
			$_SESSION['alert-success'] = "Edit Profile Successfully.";
			echo "<script>window.location = 'user_detail.php'</script>";
		} else {
			$_SESSION['alert-danger'] = "Edit Profile Fail.";
			echo "<script>window.location = 'user_detail.php'</script>";
		}

	}

	public function logout(){
		unset($_SESSION['user']);
		echo "<script>window.location='.'</script>";
	}


	public function list_customer() {

		$m_per = new M_permission();
		if($m_per->check_permission("list_user") == 0) {
			$_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
		}
		
		include("models/m_users.php");
		$m_user = new M_users();
		$users = $m_user->read_customer();


		//views
		$view = "views/users/v_customer.php";
		$title = "List of Customer";
		include("include/layout.php");
	}
}