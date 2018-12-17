<?php
session_start();
require 'vendor/autoload.php';
include("models/m_products.php");
use Carbon\Carbon;

class C_account{

	public function login() {
		//models
		include("models/m_account.php");
		$m_account = new M_account();

		$email = $password = "";

		if(isset($_POST["login"])) {
			$email = $_POST["email"];
			$password = $_POST["password"];
			if($m_account->check_login($email, $password) != "wrong") {
				$_SESSION["customer"] = $m_account->check_login($email,$password);
				$_SESSION["alert-success"] = "Login Successfully";
				echo "<script> alert('Successfully'); window.location = '.'</script>";
			} else {
				$_SESSION["alert-danger"] = "Wrong Email or Password";
				// echo "<script>window.location = '';</script>";
			}

		}


		//views
		$view = "views/account/v_login.php";
		$title = "Login";
		include("include/layout.php");
	}


	public function register() {

		//models
		include("models/M_account.php");
		include("helper/help.php");
		$m_account = new M_account();
		$first_name = $last_name = $email = $password = $address = $phone_number = "";
		if(isset($_POST["register_customer"])) {
			$first_name = $_POST["first_name"];
			$last_name = $_POST["last_name"];
			$email = $_POST["email"];
			$password = $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
			$address = $_POST["address"];
			$phone_number = $_POST["phone_number"];
			// $file = $_FILES["image"];
			$image = '';
			if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
				$image = newImage($_FILES["image"]["name"]);
				move_uploaded_file($_FILES["image"]["tmp_name"],"admin/public/images/".$image);
			}

			if($m_account->insert_user($first_name,$last_name,$email,$password,$image,4,$phone_number,$address)) {
				$_SESSION["alert-success"] = "Register Successfully";
				echo "<script> window.location='login.php'</script>";
			} else {
				$_SESSION["alert-danger"] = "Register Fail";
				echo " window.location='.'</script>";
			}
		}


		//views
		$view = "views/account/v_register.php";
		$title = "Register";
		include("include/layout.php");
	}

	public function profile() {

		//models
		include("models/m_account.php");
		include("helper/help.php");
		$m_account = new M_account();


		if(isset($_POST["update_prof"])) {
			$id = $_POST["user_id"];
			$first_name = $last_name = $phone_number = $address = $image = '';
			$first_name = $_POST["first_name"];
			$last_name = $_POST["last_name"];
			$phone_number = $_POST["phone_number"];
			$address = $_POST["address"];
			$image = $_SESSION["customer"]->image;
			$msg = "";

			if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
				if($_SESSION["customer"]->image != "" && file_exists("admin/public/images/".$_SESSION["customer"]->image)) {
					unlink("admin/public/images/".$_SESSION["customer"]->image);
				}
				
				$image = newImage($_FILES["image"]["name"]);
				move_uploaded_file($_FILES["image"]["tmp_name"],"admin/public/images/".$image);

				
				$msg = "Upload successfully";
			} 

			
			if($m_account->update_user($first_name,$last_name,$phone_number,$address,$image,$id)) {
				$_SESSION["customer"]->first_name = $first_name;
				$_SESSION["customer"]->last_name = $last_name;
				$_SESSION["customer"]->phone_number = $phone_number;
				$_SESSION["customer"]->address = $address;
				$_SESSION["customer"]->image = $image;
				$_SESSION["alert-success"] = "Edit Profile Successfully ".$msg;

			} else {
				$_SESSION["alert-danger"] = "Edit Profile Fail";
			}
		}


		//views
		$title = "Profile";
		$view = "views/account/v_profile.php";
		include("include/layout.php");
	}


	public function order() {
		//models
		date_default_timezone_set('Asia/Ho_Chi_Minh');

		include("models/m_order.php");
		$m_order = new M_order();
		$customer_id = 0;
		if(isset($_SESSION["customer"])) {
			$customer_id = $_SESSION["customer"]->id;
		}

		$orders = $m_order->read_order_by_customer($customer_id);
		//views	
		$title = "Order history";
		$view = "views/account/v_history_order.php";
		include("include/layout.php");
	}

	public function detail_order() {
		$id = $_GET["id"];

		include("models/m_order.php");
		$m_order = new M_order();
		$m_pro = new M_products();
		$details = $m_order->read_detail_by_order($id);
		$total = 0;
		foreach($details as $d) {
			$total += $d->quantity*$d->price;
		}
		$_SESSION["total"] = $total;
		


		//views
		$view = "views/account/v_history_detail.php";
		$title =  "Detail order";
		include("include/layout.php");
	}

	public function logout() {
		unset($_SESSION['customer']);
		echo "<script>window.location='.'</script>";
	}

	public function reset_password() {
		//models
		$email = $_GET["email"];

		if(isset($_POST["reset_password"])) {
			$password =  password_hash($_POST["password"],PASSWORD_DEFAULT);
			$email = $_POST["email"];
			include("models/m_account.php");
			$m_account = new M_account();
			$account = $m_account->check_email($email);
			if(empty($account)) {
				echo "<script>alert('Email does not exitst !!!'); window.location='login.php'</script>";
			}
			if($m_account->reset_password($email,$password)) {
				$_SESSION["alert-success"] = "Reset password successfully";
				echo "<script>alert('successfully'); window.location='login.php'</script>";
			} else {
				$_SESSION["alert-danger"] = "Reset password Faily";
			}
		}
		//views
		$title = "Reset password";
		$view = "views/account/v_reset_password.php";
		include("include/layout.php");
	}
}
?>