<?php 
session_start();
ini_set('display_errors', 0);

if(isset($_POST["delete_group"])){
	include("models/m_permission.php");
	$m_per = new M_permission;
	if($m_per->check_permission('delete_category') == 0) {
		echo "permission";
		exit;
	}
	include("models/m_categories.php");
	$m_cate = new M_Categories();
	$list_id = $_POST['list_id'];//trả về kiểu chuổi
	$str = str_replace('[','',$list_id);
	$str = str_replace(']', '', $str);
	$str = explode(',',$str);//chuyển thành mảng
	$check = '';
	foreach($str as $s) {
		$parent = $m_cate->read_cate_by_parent($s);
		if(count($parent) > 0 ) { 
			$check =  "success";
			break;
		}
	}
	if($check == '') {
		if($m_cate->delete_group($str)){
			$cates = $m_cate->read_all_categories();
			include("views/categories/v_search.php");
		}
	} else {
		echo 'parent_error';
	}
}


//Search cate 
if(isset($_POST['search_cate'])){
	$name = $_POST['name'];
	$parent = $_POST['parent'];
	include("models/m_categories.php");
	include("models/m_permission.php");
	$m_per = new M_permission();
	$m_cate = new M_Categories();
	$cates = $m_cate->search_cate($name,$parent);

		//views
	include("views/categories/v_search.php");
}

if(isset($_POST['delete_cate'])){
	include("models/m_permission.php");
	$m_per = new M_permission;
	if($m_per->check_permission('delete_category') == 0) {
		echo "permission";
		exit;
	}

	$id = $_POST['id'];
	include("models/m_categories.php");
	$m_cate = new M_Categories();
	$parent = $m_cate->read_cate_by_parent($id);
	if(count($parent) == 0) {
		if($m_cate->delete_cate($id)) {
			$cates = $m_cate->read_all_categories();
			include("views/categories/v_search.php");
		} else {
			echo "error_delete";
		}
	} else {
		echo "error_parent";
	}
	
}
/*Categories */


/*Products */
//Edit sub image 
if(isset($_POST["edit_sub_image"])) {
	include("models/m_products.php");
	$m_pro = new M_products();
	$pro = $m_pro->read_product_by_id($_POST["id"]);
	$sub_image = $pro->sub_image;
	echo $sub_image;
}
//Edit size
if(isset($_POST["edit_size"])) {
	include("models/m_products.php");
	$m_pro = new M_products();
	$pro = $m_pro->read_product_by_id($_POST["id"]);
	$size = $pro->size;
	echo $size;
}

//delete_product
if(isset($_POST['delete_pro'])){
	include("models/m_permission.php");
	$m_per = new M_permission;
	if($m_per->check_permission('delete_product') == 0) {
		echo "permission";
		exit;
	}

	$id = $_POST['id'];
	include("models/m_products.php");
	include("models/m_categories.php");
	$m_pro = new M_products();
	if($m_pro->delete_product($id)) {
		$m_pro = new M_products();
		$m_cate = new M_Categories();
		$products = $m_pro->read_all_products();
		$cates = $m_cate->read_all_categories();
		include("views/products/v_search.php");

	} else {
		echo "";
	}
}

//delete_group_product
if(isset($_POST['delete_group_product'])){
	include("models/m_permission.php");
	$m_per = new M_permission;
	if($m_per->check_permission('delete_product') == 0) {
		echo "permission";
		exit;
	}

	include("models/m_products.php");
	include("models/m_categories.php");
	$m_pro = new M_products();

	$list_id = $_POST['list_id'];//trả về kiểu chuổi
	$str = str_replace('[','',$list_id);
	$str = str_replace(']', '', $str);
	$str = explode(',',$str);//chuyển thành mảng
	if($m_pro->delete_group($str)){
		$m_pro = new M_products();
		$m_cate = new M_Categories();
		$products = $m_pro->read_all_products();
		$cates = $m_cate->read_all_categories();
		include("views/products/v_search.php");
	} else {
		echo '';
	} 
}

if(isset($_POST["search_pro"])){
	//'name':name, 'price_from':price_from, 'price_to':price_to, 'cate':cate,'search_pro':'OK'
	$name = $_POST['name'];
	$price_from = $_POST['price_from'];
	$price_to = $_POST['price_to'];
	$cate = $_POST['cate'];


	include("models/m_products.php");
	include("models/m_categories.php");
	include("models/m_supplier.php");
	include("models/m_permission.php");
	$m_sup = new M_suppliers();
	$m_per = new M_permission();
	$m_pro = new M_products();
	$m_cate = new M_Categories();

	
	$products = $m_pro->search_product($name,$price_from,$price_to,$cate);

	$cates = $m_cate->read_all_categories();
	include("views/products/v_search.php");
}
/*Products */

/*Chart*/
if(isset($_POST["chart"])) {
	include("models/m_products.php");
	$m_pro = new M_products();
	$year = date("Y");
	if(isset($_POST["year"])) {
		$year = $_POST["year"];
	}
	$chart = $m_pro->chart($year);

	echo json_encode($chart);
}

if(isset($_POST["filter_revenue"])) {
	$date = $_POST["date"];
	include("models/m_products.php");
	$m_pro = new M_products();
	$data = $m_pro->filter_revenue($date);
	echo $data->total;
}
/*End Chart*/

/*Users*/

if(isset($_POST["check_email"])){
	$email = $_POST['email'];

	include("models/m_users.php");
	$m_user = new M_users();

	$check = $m_user->check_email($email);
	if($check == null ){
		echo "ok";
	}  else {
		echo "exist";
	}
} 

if(isset($_POST["check_password"])) {
	$password = $_POST["password"];
	$new_password = password_hash($_POST["new_password"],PASSWORD_DEFAULT);
	$email = '';
	if(isset($_SESSION["user"])) {
		$email = $_SESSION["user"]->email;
	}
	include("models/m_users.php");
	$m_user = new M_users();
	if(password_verify($password,$_SESSION["user"]->password)){
		if($m_user->update_password($new_password,$_SESSION["user"]->id)) {
			$_SESSION["alert-success"] = "Successfully";
			$_SESSION["user"]->password = $new_password;
			echo "success";
		}
	} else {
		echo "error_password";
	}

}

if(isset($_POST["delete_user"])) {

	include("models/m_permission.php");
	$m_per = new M_permission;
	if($m_per->check_permission('delete_user') == 0) {
		echo "permission";
		exit;
	}

	include("models/m_users.php");
	$m_user = new M_users();
	$id = $_POST["id"];

	if($m_user->delete_user($id)) {
		$users = $m_user->read_all_user();
		include("views/users/v_search.php");
	} else {
		echo "error";
	}
}

if(isset($_POST["delete_group_user"])) {

	include("models/m_permission.php");
	$m_per = new M_permission;
	if($m_per->check_permission('delete_user') == 0) {
		echo "permission";
		exit;
	}


	$list_id = $_POST['list_id'];//trả về kiểu chuổi
	$str = str_replace('[','',$list_id);
	$str = str_replace(']', '', $str);
	$str = explode(',',$str);//chuyển thành mảng

	include("models/m_users.php");
	$m_user = new M_users();
	if($m_user->delete_group_user($str)) {
		$users = $m_user->read_all_user();
		include("views/users/v_search.php");
	} else {
		echo "error";
	}
}

if(isset($_POST["search_user"])) {
	$name = $_POST["name"];
	$permission = $_POST["permission"];	
	var_dump($name);
	include("models/m_users.php");
	include("models/m_permission.php");
	$m_per = new M_permission();
	$m_user = new M_users();
	$users = $m_user->search_user($name,$permission);

	include("views/users/v_search.php");
}

if(isset($_POST["logout"])) {
	unset($_SESSION['user']);
	echo "success";
}

if(isset($_POST["delete_customer"])) {

	include("models/m_permission.php");
	$m_per = new M_permission;
	if($m_per->check_permission('delete_user') == 0) {
		echo "permission";
		exit;
	}

	include("models/m_users.php");
	$m_user = new M_users();
	$id = $_POST["id"];

	if($m_user->delete_user($id)) {
		$users = $m_user->read_customer();
		include("views/users/v_search_customer.php");
	} else {
		echo "error";
	}
}

if(isset($_POST["delete_group_customer"])) {

	include("models/m_permission.php");
	$m_per = new M_permission;
	if($m_per->check_permission('delete_user') == 0) {
		echo "permission";
		exit;
	}

	$list_id = $_POST['list_id'];//trả về kiểu chuổi
	$str = str_replace('[','',$list_id);
	$str = str_replace(']', '', $str);
	$str = explode(',',$str);//chuyển thành mảng

	include("models/m_users.php");
	$m_user = new M_users();
	if($m_user->delete_group_user($str)) {
		$users = $m_user->read_customer();
		include("views/users/v_search.php");
	} else {
		echo "error";
	}
}


if(isset($_POST["search_customer"])) {
	$name = $_POST["name"];
	include("models/m_users.php");
	include("models/m_permission.php");
	$m_per = new M_permission();
	$m_user = new M_users();
	$users = $m_user->search_customer($name);
	include("views/users/v_search_customer.php");
}
/*End Users*/


/*FeedBack*/
if(isset($_POST["delete_feedback"])) {
	$id = $_POST["id"];

	include("models/m_feedback.php");
	include("models/m_users.php");
	$m_user = new M_users();
	$m_feedback = new M_feedback();
	if($m_feedback->delete_feedback($id)) {
		$contacts = $m_feedback->read_all_feedback();
		include("views/feedback/v_search.php");
	} else {
		echo "error";
	}
}

if(isset($_POST["delete_group_feedback"])){
	$list_id = $_POST['list_id'];//trả về kiểu chuổi
	$str = str_replace('[','',$list_id);
	$str = str_replace(']', '', $str);
	$str = explode(',',$str);//chuyển thành mảng

	include("models/m_feedback.php");
	include("models/m_users.php");
	$m_user = new M_users();
	$m_fb = new M_feedback();
	if($m_fb->delete_group_feedback($str)) {
		$contacts = $m_fb->read_all_feedback();
		include("views/feedback/v_search.php");
	} else {
		echo "error";
	}
}

if(isset($_POST["view_feedback"])) {
	$id = $_POST["id"];

	include("models/m_feedback.php");
	$m_fb = new M_feedback();

	$contact = $m_fb->read_feedback_by_id($id);
	echo $contact->content;
}

if(isset($_POST["seen_contact"])) {
	$id = $_POST["id"];

	include("models/m_feedback.php");
	$m_fb = new M_feedback();

	if($m_fb->seen_feedback($id)) {
		echo "success";
	}
}
/*End FeedBack*/


/*Orders*/
if(isset($_POST["search_order"])) {
	$cus  = $_POST["cus_search"];
	$status_search = $_POST["status_search"];
	$date_from = $_POST["date_from"];
	$date_to = $_POST["date_to"];
	$order = $_POST["order"];

	include("models/m_orders.php");
	include("models/m_users.php");
	include("models/m_permission.php");
	$m_per = new M_permission();
	$m_order = new M_orders();
	$m_user = new M_users();

	$status = $m_order->read_status();
	$customer = $m_user->read_customer();
	$orders = $m_order->search_orders($order,$cus,$status_search,$date_from,$date_to);

	include("views/orders/v_search.php");

}

if(isset($_POST["check_delivery"])) {
	$id = $_POST["id"];
	include("models/m_orders.php");
	$m_order = new M_orders();
	


}

if(isset($_POST["update_status_ship"])) {
	$id = $_POST["id"];
	$status = $_POST["status"];
	$order_id = $_POST["order_id"];

	include("models/m_users.php");
	include("models/m_orders.php");
	include("models/m_products.php");
	$m_pro = new M_products();
	$m_user = new M_users();
	$m_order = new M_orders();
	if($status == 1) {
		if($m_order->update_ship($status,$order_id) && $m_order->update_status(4,$order_id)){
			echo "success";
		} else {
			echo "fail";
		}
	} else if($status == 2) {
		$order = $m_order->read_order_by_id($order_id);
		$order_detail = $m_order->read_detail_by_id($order_id);
		if($m_order->update_ship($status,$order_id) && $m_order->update_status(5,$order_id)){
			foreach($order_detail as $d) {
				$product = $m_pro->read_product_by_id($d->pro_id);
				$sizes = json_decode($product->size);
				$total = 0;
				if(count($sizes)> 0 ) {
					foreach($sizes as $key=>$value) {
						if($key == $d->size) {
							$sizes->$key = $value + $d->quantity;
							$total += $value + $d->quantity;
						} else {
							$total += $value;
						}
					}
				} else {
					$total = $product->quantity + $d->quantity;
				}
				$m_pro->update_product_order($total,json_encode($sizes),$product->id);	
			}
			echo "success";
		} else {
			echo "fail";
		}
	}
}

if(isset($_POST["search_ship"])) {
	$order_id = $_POST["order_id"];
	$user_id = $_POST["user_id"];
	$status = $_POST["status"];


	include("models/m_orders.php");
	include("models/m_users.php");
	include("models/m_permission.php");
	$m_per = new M_permission();
	$m_user = new M_users();
	$m_order = new M_orders();

	$ship = $m_order->search_ship($order_id,$user_id,$status);
	include("views/orders/v_search_ship.php");

}
/*End orders*/

/*Supplier*/ 
if(isset($_POST["insert_supplier"])) {
	$name = $_POST["name"];
	$phone = $_POST["phone"];
	$address = $_POST["address"];
	include("models/m_supplier.php");
	$m_sup = new M_suppliers();
	
	if($m_sup->insert_supplier($name,$address,$phone)) {
		$_SESSION["alert-success"] = "Insert Supplier Successfully";
		echo "success";
	} else {
		$_SESSION["alert-danger"] = "Insert Supplier Fail";
		echo "fail";
	}
}

if(isset($_POST["get_supplier_by_id"])) {
	$id = $_POST["id"];
	include("models/m_supplier.php");
	$m_sup = new M_suppliers();
	$sup = $m_sup->read_supply_by_id($id);
	echo json_encode(['sup'=>$sup]);
}
if(isset($_POST["edit_supplier"])) {
	$id = $_POST["id"];
	$name = $_POST["name"];
	$phone = $_POST["phone"];
	$address = $_POST["address"];
	include("models/m_supplier.php");
	$m_sup = new M_suppliers();
	if($m_sup->update_supplier($name,$address,$phone,$id)) {
		$_SESSION["alert-success"] = "Edit Supplier Successfully";
		echo "success";
	} else {
		$_SESSION["alert-danger"] = "Edit Supplier Fail";
		echo "fail";
	}
}

if(isset($_POST["delete_supplier"])) {
	$id = $_POST["id"];
	include("models/m_supplier.php");
	$m_sup = new M_suppliers();
	if($m_sup->delete_supplier($id)) {
		$_SESSION["alert-success"] = "Delete Supplier Successfully";
		echo "success";
	} else {
		$_SESSION["alert-danger"] = "Delete Supplier Fail";
		echo "fail";
	}
}


if(isset($_POST["delete_group_supplier"])) {
	$list_id = $_POST['list_id'];//trả về kiểu chuổi
	$str = str_replace('[','',$list_id);
	$str = str_replace(']', '', $str);
	$str = explode(',',$str);//chuyển thành mảng
	include("models/m_supplier.php");
	$m_sup = new M_suppliers();
	if($m_sup->delete_group_supplier($str)) {
		$_SESSION["alert-success"] = "Delete Suppliers Successfully";
		echo "success";
	} else {
		$_SESSION["alert-danger"] = "Delete Suppliers Fail";
		echo "fail";
	}
}


/*end Supplier*/

?>