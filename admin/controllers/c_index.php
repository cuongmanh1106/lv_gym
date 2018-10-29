<?php
session_start();
class C_Index
{
	public function enterAdmin() {
		$email = $password = '';
		if(isset($_SESSION["user"])) {
			echo "<script>window.location = 'products_list.php'</script>";

		} else {
			include("models/m_users.php");
			$m_user = new M_users();
			if(isset($_POST["login"])) {
				$email = $_POST["email"];
				$password = $_POST["password"];
				if($m_user->check_login($email, $password) != "wrong") {
					$_SESSION["user"] = $m_user->check_login($email,$password);
					$_SESSION["alert-success"] = "Login Successfully";
					echo "<script>window.location = 'products_list.php'</script>";
				} else {
					$_SESSION["alert-danger"] = "Wrong Email or Password";
					// echo "<script>window.location = '';</script>";
				}

			}
			include("views/login/v_login.php");
		}
	}
}