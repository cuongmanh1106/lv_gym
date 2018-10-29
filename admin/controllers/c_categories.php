<?php
session_start();
include("models/m_permission.php");
class C_categories 
{
	function __construct() {
		if(!isset($_SESSION["user"])) {
			echo "<script>window.location='.'</script>";
		} 
	}
	public function get_all_categories() {
		$m_per = new M_permission();
		if($m_per->check_permission("list_category") == 0) {
			$_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
		}
		//models
		include("models/m_categories.php");
		$m_cate = new M_Categories();
		$cates = $m_cate->read_all_categories();



		//view 
		$view = "views/categories/v_list.php";
		$title = "List of categories";
		include("include/layout.php");
	}

	public function get_all_categories_ajax() {
		include("models/m_categories.php");
		$m_cate = new M_Categories();
		$cates = $m_cate->read_all_categories();
		echo json_encode($cates);
	}

	public function add_cate() {
		$m_per = new M_permission();
		if($m_per->check_permission("insert_category") == 0) {
			$_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
		}

		$name = $parent = $description = "";

		//models
		require_once("../helper/help.php");
		include("models/m_categories.php");
		$m_cate = new M_Categories();

		if(isset($_POST["add_cate"])) {
			$name = $_POST["name"];
			$parent = $_POST["parent"];
			$description = $_POST["description"];

			if($parent != 0) { //Nếu không phải none value = 0
				$cate = $m_cate->read_cate_by_id($parent); //Tìm Cha  
				if($cate->parent_id == 0) {//Neu cha no khong co con (Cấp cao nhất)
					$parent = $_POST["parent"];
				} else { // Nếu cha của nó là con của thằng khác (không phải cấp cao nhất) -> ta lấy parent là thằng cha có cấp cao nhất
					$parent = $cate->parent_id;
				}
			} else {
				$parent = $_POST["parent"];
			}
			// var_dump($name .' '.$parent.' '.$description);
			if($m_cate->insert_cate($name,$parent,$description)) {
				$_SESSION['alert-success'] = "Successfully";
				echo "<script>window.location = 'cate_list.php'</script>";

			} else {
				$_SESSION['alert-danger'] = "Fail";
				echo "<script>window.location = 'cate_list.php'</script>";
			}	
		}

	}

	public function edit_cate() {
		$m_per = new M_permission();
		if($m_per->check_permission("edit_category") == 0) {
			$_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
		}

		$id = $_GET["id"];
		//models
		require_once("../helper/help.php");
		include("models/m_categories.php");
		$m_cate = new M_Categories();
		$cate = $m_cate->read_cate_by_id($id);
		$cates = $m_cate->read_all_categories();

		$name = $parent = $description = "";
		if(isset($_POST["edit_cate"])){
			$name = $_POST["name"];
			$parent = $_POST["parent"];
			$description = $_POST["description"];

			if($parent != 0) {
				$cate_parent = $m_cate->read_cate_by_id($parent);
				if($cate_parent->parent_id != $parent && $cate_parent->parent_id != 0) {
					$parent = $cate_parent->parent_id;
				} else if($cate_parent->parent_id == 0) {
					$parent = $cate->parent_id;
				}
			}
			

			if($m_cate->update_cate($id,$name,$parent,$description)){
				$_SESSION['alert-success'] = "Successfully";
				// echo "<script>alert('Successfully'); window.location = 'cate_list.php'</script>";

			} else {
				$_SESSION['alert-danger'] = "Fail";
			}

			$cate = $m_cate->read_cate_by_id($id);
			$cates = $m_cate->read_all_categories();	

		}

		//views
		$view = "views/categories/v_edit.php";
		$title = "Edit Categories";
		include("include/layout.php");

	}	

	public function delete_cate(){
		$m_per = new M_permission();
		if($m_per->check_permission("delete_category") == 0) {
			$_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
		}

		$id = $_GET["id"];

		//models
		include("models/m_categories.php");
		$m_cate = new M_Categories();
		$parent = $m_cate->read_cate_by_parent($id);
		if(count($parent) == 0 && $m_cate->delete_cate($id)){
			$_SESSION['alert-success'] = "Successfully";
			echo "window.location = 'cate_list.php'</script>";
		} else {
			$_SESSION['alert-danger'] = "Fail";
			echo "<script>window.location = 'cate_list.php'</script>";
		}
	}

	public function search_cate(){
		$name = $_POST['name'];
		$parent = $_POST['parent'];

		//model
		include("models/m_categories.php");
		include("models/m_permission.php");
		$m_per = new M_permission();
		$m_cate = new M_Categories();
		$cates = $m_cate->search_cate($name,$parent);

		//views
		include("views/categories/v_search.php");



	}
	
	

}
?>