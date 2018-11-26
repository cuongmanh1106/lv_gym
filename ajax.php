<?php
session_start();
ini_set('display_errors', 0);

if(isset($_POST['frontend_search_product'])) {
	$price = $name = $soft = $cate_id = "";
	if(isset($_POST["price"])) {
		$price = $_POST["price"];
	}
	if(isset($_POST["name"])) {
		$name = $_POST["name"];
	}
	if(isset($_POST["soft"])) {
		$soft = $_POST["soft"];
	}
	if(isset($_POST["cate_id"])) {
		$cate_id = $_POST["cate_id"];
	}

	include("models/m_products.php");
	$m_pro = new M_products();
	$products = $m_pro->search_product($price,$name,$soft,$cate_id);
	include("views/products/v_search.php");
}

if(isset($_POST["check_email"])){
	$email = $_POST['email'];

	include("admin/models/m_users.php");
	$m_user = new M_users();

	$check = $m_user->check_email($email);
	if($check == null ){
		echo "ok";
	}  else {
		echo "exist";
	}
}

/*#############Comment process##############*/

if(isset($_POST["add_comment"])) {
	$comment = $_POST['comment'];
	$pro_id = $_POST['pro_id'];
	$user_id = $_POST['user_id'];


	include("models/m_comment.php");
	$m_comment = new M_comment();
	$id = $m_comment->insert_comment($pro_id,$user_id,$comment,0);
	$comment = $m_comment->read_comment_by_id($id);
	echo json_encode($comment);
} 

if(isset($_POST["add_sub_comment"])) {
	$comment = $_POST['comment'];
	$pro_id = $_POST['pro_id'];
	$user_id = $_POST['user_id'];
	$id = $_POST['id'];

	include("models/m_comment.php");
	include("models/m_account.php");
	$m_account = new M_account();
	$m_comment = new M_comment();
	$user_name = $m_account->read_user_by_id($user_id);
	$id_cmt = $m_comment->insert_comment($pro_id,$user_id,$comment,$id);
	$comment = $m_comment->read_comment_by_id($id_cmt);
	$data = [
		'comment' => $comment,
		'user_name' => $user_name
	];
	echo json_encode($data);

}

if(isset($_POST["like"])) {
	$comment_id = $_POST['cmt_id'];
	$user_id = $_POST['user_id'];

	include("models/m_comment.php");
	$m_comment = new M_comment();
	$cmt = $m_comment->read_comment_by_id($comment_id);
	if($m_comment->insert_like($comment_id,$user_id)) {
		$like = $cmt->like + 1;
		$m_comment->update_comment($comment_id,$cmt->like + 1 );
		echo "success";
	} else {
		echo "fail";
	}
}

if(isset($_POST["dislike"])) {
	$comment_id = $_POST['comment_id'];
	$user_id = $_POST['user_id'];

	include("models/m_comment.php");
	$m_comment = new M_comment();
	$cmt = $m_comment->read_comment_by_id($comment_id);


	if($m_comment->delete_like($comment_id,$user_id)) {

		$m_comment->update_comment($comment_id,$cmt->like - 1 );

		echo "success";
	} else {
		echo "fail";
	}

}
if(isset($_POST["show_more"])) {
	session_start();
	$pro_id = $_POST['pro_id'];
	$count = $_POST['count'];
	include("models/m_comment.php");
	include("models/m_account.php");
	include("models/m_products.php");
	$m_pro = new M_products();
	$m_account = new M_account();
	$m_comment = new M_comment();
	$comments = $m_comment->read_comment($pro_id, $count, 10);
	$product = $m_pro->read_product_by_id($pro_id);
	include("views/products/v_show_more.php");
}
/*#############End Comment process##############*/

/*#############Profile process##############*/

if(isset($_POST["change_password"])) {
	$password = $_POST["password"];
	$new_password = password_hash($_POST["new_password"],PASSWORD_DEFAULT);
	$email = '';
	if(isset($_SESSION["customer"])) {
		$email = $_SESSION["customer"]->email;
	}
	include("models/m_account.php");
	$m_account = new M_account();
	if(password_verify($password,$_SESSION["customer"]->password)){
		if($m_account->update_password($new_password,$_SESSION["customer"]->id)) {
			$_SESSION["alert-success"] = "Successfully";
			$_SESSION["customer"]->password = $new_password;
			echo "success";
		}
	} else {
		echo "error_password";
	}
}

if(isset($_POST['profile_logout'])) {
	unset($_SESSION["customer"]);
	echo "success";
}
/*#############End Profile process##############*/

/*#############Cart process##############*/
if(isset($_POST['add-to-cart'])) {
	$pro_id = $_POST['pro_id'];
	$size = '';
	$count = $_POST['count'];
	$qty = 1;
	include("models/m_products.php");
	$m_pro = new M_products();
	$product = $m_pro->read_product_by_id($pro_id);

	if(isset($_POST["qty"])) {
		$qty = $_POST["qty"];
		if($_POST["qty"] == "") {
			$qty = 1;
		}
	}
	if(isset($_POST["size"])) {
		$size  = $_POST["size"];
		$sizes = json_decode($product->size);
		if($size == "" && count($sizes) > 0) { //chọn khi xem sản phẩm mà k order bên chi tiết
			foreach($sizes as $key=>$v){
				if($v != 0) {
					$size = $key;
					break;
				}
			}
		}
	}

	if(count($sizes) == 0) {
		$size = "none";
	}

	if($product->quantity == 0) {
		echo "overlimit";
		exit();
	}
	$time = time();
	$check = false;
	$total = 0;

	

	if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) {
		//add existed product
		foreach($_SESSION["cart"] as $key=>$cart) {
			$total = $total + $cart["qty"]*$cart["price"];
			if($cart["id"] == $pro_id && $cart["size"] == $size) {
				$qty_add = $cart["qty"] + $qty;
				if(count($sizes) > 0 ) { // If there are sizes in this product
					if($qty_add > $sizes->$size) { //If the quantity of customer higher the quantity of size, I will display a error
						echo "overlimit";
						exit();
					} else {
						$check = true;
					}
				} else { // If without sizes in this product
					if($qty_add > $product->quantity) { //I compare with quantity if lower I will display error
						echo "overlimit";
						exit();
					} else {
						$check = true;
					}
				}
				$check = true;
				$cart["price"] = (int)$cart["price"];
				if($check) { //check == true => it means update cart successfully
					$_SESSION["cart"][$key]["qty"] = $qty_add;
					$total += $qty*$cart["price"];
					$time = $key;
				}
			}
		}
	}
	
	//if this product doesn't exist in session
	if(!$check) {
		$_SESSION["cart"][$time]["id"] = $pro_id;
		$_SESSION["cart"][$time]["size"] = $size;
		$_SESSION["cart"][$time]["price"] = $product->price;
		$_SESSION["cart"][$time]["qty"] = $qty; 
		$total += $qty*$product->price;
	} 

	$count = count($_SESSION["cart"]);
	$cart = $_SESSION["cart"][$time];

	include("views/cart/v_add_cart.php");

	

}

if(isset($_POST["update_cart"])) {
	$rowId = $_POST["rowId"];
	$pro_id = $_POST["pro_id"];
	$size = $_POST["size"];
	$qty = $_POST["qty"];
	$cart_detail = $_SESSION["cart"][$rowId];

	include("models/m_products.php");
	$m_pro = new M_products();
	$product = $m_pro->read_product_by_id($pro_id);
	$sizes = json_decode($product->size);
	$check = false;
	$cart_detail = $_SESSION["cart"][$rowId];
	$total = 0;
	$content = "";
	foreach($_SESSION["cart"] as $key=>$cart) {
		$total += $cart["qty"]*$cart["price"];

		if($key != $rowId && $pro_id == $cart["id"] && $size == $cart["size"]) { //if the product just update and it already have in your cart 																			(that mean giống nhau)
			echo json_encode(['cart'=>"exists",'size'=>$cart_detail["size"] ]); //send back begin size
			exit();
		} 
		if(count($sizes) > 0) { //có size
			if($rowId == $key && $qty > $sizes->$size) { //change size of product but it already have on cart (chọn số lượng nhiều hơn tồn)
				echo json_encode(['cart'=>"overlimit",'qty'=>$cart_detail["qty"] , 'size'=>$cart_detail["size"] ]); //send back begin quantity
				exit();															 //using size when change size and it doesn't exist in cart													
			} else {
				$check = true;
			}

		} else {
			if($rowId == $key && $qty > $product->quantity) { // không có size thì so sánh vs tồn chính
				echo json_encode(['cart'=>"overlimit",'qty'=>$cart_detail["qty"]]);
				exit();
			} else {
				$size = "none";
				$check = true;
			}
		}
		
	}

	if($check) { 
		$total += ($qty - $_SESSION["cart"][$rowId]["qty"])*$_SESSION["cart"][$rowId]["price"];
		$_SESSION["cart"][$rowId]["qty"] = $qty;
		$_SESSION["cart"][$rowId]["size"] = $size;

	}
	$data = ['cart'=>$_SESSION["cart"][$rowId],'total'=>$total];
	echo json_encode($data);
}

if(isset($_POST["delete_cart"])){
	$rowId = $_POST["rowId"];

	unset($_SESSION["cart"][$rowId]);
	$total = 0;
	foreach($_SESSION["cart"] as $key=>$cart){
		$total += $cart["qty"]*$cart["price"];
	}

	$count = count($_SESSION["cart"]);
	$data = ["total"=>$total, "count"=>$count];
	echo json_encode($data);

}
/*#############End Cart process##############*/
?>