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
    include("models/m_supplier.php");
    $m_pro = new M_products();
    if($m_pro->delete_product($id)) {
        $m_sup = new M_suppliers();
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
    include("models/m_supplier.php");
    $m_pro = new M_products();
    $list_id = $_POST['list_id'];//trả về kiểu chuổi
    $str = str_replace('[','',$list_id);
    $str = str_replace(']', '', $str);
    $str = explode(',',$str);//chuyển thành mảng
    if($m_pro->delete_group($str)){
        $m_sup = new M_suppliers();
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
    $products = $m_pro->filter_detail_revenue($date);
    $type = "d";
    if(count($products) > 0) {
        include("views/products/v_load_revenue_by_date.php");
    }  else {
        echo "";
    }
}

if(isset($_POST["load_revenue_by_month_year"])) {
    $month = $_POST["month"];
    $year = $_POST["year"];
  
    include("models/m_products.php");
    $m_pro = new M_products();
    $products = $m_pro->filter_revenue_by_month_year($month,$year);
    $type = "my";
    if(count($products) > 0) {
        include("views/products/v_load_revenue_by_date.php");
    }  else {
        echo "";
    }

}

if(isset($_POST["view_detail_date"])) {
    $pro_id = $_POST["pro_id"];
    $date = $_POST["date"];
    $month = $_POST["month"];
    $year = $_POST["year"];
    $type = $_POST["type"];
    include("models/m_products.php");
    $m_pro = new M_products();
    if($type == "d") {
        $products = $m_pro->view_list_product_detail_revenue($pro_id,$date);
    } else if($type == "my") {
        $products = $m_pro->view_list_product_detail_revenue_month_year($pro_id,$month,$year);
    }
    include("views/products/v_view_list_products_detail_revenue.php");
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

    include("models/m_permission.php");
    $m_per = new M_permission;
    if($m_per->check_permission('insert_supplier') == 0) {
        echo "permission";
        exit;
    }

    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    include("models/m_supplier.php");
    $m_sup = new M_suppliers();
    
    
    if($m_sup->insert_supplier($name,$address,$phone)) {
        $_SESSION["alert-success"] = "Insert Supplier Successfully";
        echo "success";
    } else {
        // $_SESSION["alert-danger"] = "Insert Supplier Fail";
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

    include("models/m_permission.php");
    $m_per = new M_permission;
    if($m_per->check_permission('edit_supplier') == 0) {
        echo "permission";
        exit;
    }


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
        echo "fail";
    }
}
if(isset($_POST["delete_supplier"])) {

    include("models/m_permission.php");
    $m_per = new M_permission;
    if($m_per->check_permission('delete_supplier') == 0) {
        echo "permission";
        exit;
    }


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

    include("models/m_permission.php");
    $m_per = new M_permission;
    if($m_per->check_permission('delete_supplier') == 0) {
        echo "permission";
        exit;
    }


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
    
/* Stock receipt */
if(isset($_POST["search_update_product"])) {
    $pro_id = $_POST["pro_id"];
    $stock_id = $_POST["stock_id"];
    include("models/m_products.php");
    include("models/m_stock_receipt.php");

    $m_pro = new M_products();
    $m_stock = new m_stock_receipt();
    $product = $m_pro->read_product_by_id($pro_id);
    include("views/stock_receipt/v_search_update.php");

}

if(isset($_POST["delete_stock"])) { //delete detail_stock
    include("models/m_permission.php");
    $m_per = new M_permission;
    if($m_per->check_permission("delete_detail_stock") == 0) {
        $_SESSION['alert-warning'] = "You don't have permission to do this action";
        echo "permission";
        exit;
    }

    $id = $_POST["id"];

    require("models/m_stock_receipt.php");
    require("models/m_products.php");
    require("models/m_categories.php");
    require("models/m_supplier.php");

    $m_cate = new M_Categories();
    $m_sup = new M_suppliers();
    $m_stock = new M_stock_receipt();
    $m_pro = new M_products();
    $details = $m_stock->read_detail_by_id($id);
    if($m_stock->update_status_detail(2,$id)) {
        $products = $m_stock->read_product_by_stock($details->stock_id);
        $cates = $m_cate->read_all_categories();
        $stock_id = $details->stock_id;
        $_SESSION["alert-success"] = "Delete Detail Stock Successfully";
        include("views/stock_receipt/search_list_stock.php");
    }  else {
        $_SESSION["alert-danger"] = "Delete Detail Stock Faily";
        echo "fail";
    }
}

if(isset($_POST["delete_group_stock_product"])) { //delete detail stock
    include("models/m_permission.php");
    $m_per = new M_permission;
    if($m_per->check_permission("delete_detail_stock") == 0) {
        $_SESSION['alert-warning'] = "You don't have permission to do this action";
        echo "permission";
        exit;
    }
    require("models/m_stock_receipt.php");
    require("models/m_products.php");
    require("models/m_categories.php");
    require("models/m_supplier.php");

    $m_cate = new M_Categories();
    $m_sup = new M_suppliers();
    $m_stock = new M_stock_receipt();
    $m_pro = new M_products();
    $stock_id = $_POST["stock_id"];

    $list_id = $_POST['list_id'];//trả về kiểu chuổi
    $str = str_replace('[','',$list_id);
    $str = str_replace(']', '', $str);
    $str = explode(',',$str);//chuyển thành mảng
    if($m_stock->delete_group_stock_product($str)){
        $products = $m_stock->read_product_by_stock($stock_id);
        $cates = $m_cate->read_all_categories();
        $_SESSION["alert-success"] = "Delete Detail Stock Successfully";
        include("views/stock_receipt/search_list_stock.php");
    }  else {
        $_SESSION["alert-danger"] = "Delete Detail Stock Faily";
        echo "fail";
    }
}


if(isset($_POST["search_list_stock"])) {
    $name = $_POST["name"];
    $price_from = $_POST["price_from"];
    $price_to = $_POST["price_to"];
    $cate = $_POST["cate"];
    $stock_id = $_POST["stock_id"];

    require("models/m_stock_receipt.php");
    require("models/m_products.php");
    require("models/m_categories.php");
    require("models/m_supplier.php");

    $m_cate = new M_Categories();
    $m_sup = new M_suppliers();
    $m_stock = new M_stock_receipt();
    $m_pro = new M_products();
    $stock_id = $_POST["stock_id"];

    $products = $m_stock->search_product_stock($stock_id,$name,$price_from,$price_to,$cate);
    $cates = $m_cate->read_all_categories();
    include("views/stock_receipt/search_list_stock.php");


}

if(isset($_POST["update_stock_receipt"])) { //update status stock
    include("models/m_permission.php");
    $m_per = new M_permission;
    if($m_per->check_permission("edit_stock") == 0) {
        $_SESSION['alert-warning'] = "You don't have permission to do this action";
        echo "permission";
        exit;
    }

    $id = $_POST["stock_id"];
    $status = $_POST["status"];

    require("models/m_stock_receipt.php");
    require("models/m_products.php");
    $m_stock = new M_stock_receipt();
    $m_pro = new M_products();
    $detail = $m_stock->read_detail_by_stock($id);
    if($status == "2") {
        $m_stock->cancel_stock($status,$id);
        foreach($detail as $d) {
            if($d->status == 0) {
                $m_pro->delete_product($d->pro_id);
            }
        }
    } else if ($status == "1") {
        $m_stock->cancel_stock($status,$id);
        foreach($detail as $d) {
            if($d->status == 0) {
                $m_pro->update_status(0,$d->pro_id);
            } else if($d->status == 1) { 
                $pro = $m_pro->read_product_by_id($d->pro_id);
                $del_pro = $m_stock->read_detail_by_stock_product($id,$d->pro_id);
                $size = json_decode($pro->size);
                $quantity = $pro->quantity;
                $old_size = json_decode($del_pro->size);
                if(count($size) > 0 ) { //update qty & size vao sp chinh
                    foreach($old_size as $key=>$value) {
                        if(isset($size->$key)) {
                            $size->$key += $value;
                        } else {
                            $size->$key = $value;
                        }
                        $quantity += $value;
                    }
                } else {
                    $quantity += $del_pro->quantity;
                }

                $m_pro->update_product_order($quantity,json_encode($size),$d->pro_id);
                $_SESSION["alert-success"] = "Update Status Stock Successfully";
            }
        }
    }
}
/* end stock receipt */



/* Promotion */
if(isset($_POST["delete_promotion"])) {
    include("models/m_permission.php");
    $m_per = new M_permission;
    if($m_per->check_permission("delete_promotion") == 0) {
        $_SESSION['alert-warning'] = "You don't have permission to do this action";
        echo "permission";
        exit;
    }

    $id = $_POST["id"];
    include("models/m_promotion.php");
    $m_promotion = new M_promotion();
    if($m_promotion->update_status_promotion($id)) {
        $promotions = $m_promotion->read_all_promotion();
        include("views/promotion/v_search_promotion.php");
    } else {
        echo "error";
    }
}

if(isset($_POST["delete_group_promotion"])) {

    include("models/m_permission.php");
    $m_per = new M_permission;
    if($m_per->check_permission("delete_promotion") == 0) {
        $_SESSION['alert-warning'] = "You don't have permission to do this action";
        echo "permission";
        exit;
    }


    $list_id = $_POST['list_id'];//trả về kiểu chuổi
    $str = str_replace('[','',$list_id);
    $str = str_replace(']', '', $str);
    $str = explode(',',$str);//chuyển thành mảng

    include("models/m_promotion.php");
    $m_promotion = new M_promotion();
    if($m_promotion->delete_group_promotion($str)) {
        $promotions = $m_promotion->read_all_promotion();
        include("views/promotion/v_search_promotion.php");
    } else {
        echo "error";
    }
}

if(isset($_POST["search_promotion"])) {

    $name = $_POST["name"];
    $date_from = $_POST["date_from"];
    $date_to = $_POST["date_to"];


    include("models/m_promotion.php");
    $m_promotion = new M_promotion();
    $promotions = $m_promotion->search_promotion($name,$date_from,$date_to);
    include("views/promotion/v_search_promotion.php");
}

if(isset($_POST["search_pro_promotion"])) {
    $name = $_POST['name'];
    $price_from = $_POST['price_from'];
    $price_to = $_POST['price_to'];
    $cate = $_POST['cate'];
    $id = $_POST['id'];
    include("models/m_products.php");
    include("models/m_categories.php");
    include("models/m_supplier.php");
    include("models/m_permission.php");
    include("models/m_promotion.php");
    $m_promotion = new M_promotion();
    $m_sup = new M_suppliers();
    $m_per = new M_permission();
    $m_pro = new M_products();
    $m_cate = new M_Categories();
    
    $products = $m_promotion->search_choose_product($id,$name,$price_from,$price_to,$cate);
    $cates = $m_cate->read_all_categories();
    include("views/promotion/v_search_products_promotion.php");
}

if(isset($_POST["search_chose_promotion"])) {
    $name = $_POST['name'];
    $price_from = $_POST['price_from'];
    $price_to = $_POST['price_to'];
    $cate = $_POST['cate'];
    include("models/m_products.php");
    include("models/m_categories.php");
    
    $m_pro = new M_products();
    $m_cate = new M_Categories();
    
    $products = $m_pro->search_product($name,$price_from,$price_to,$cate);
    $cates = $m_cate->read_all_categories();
    include("views/promotion/v_search_products_promotion.php");
}

if(isset($_POST["get_detail_product_promotion"])) {
    $id = $_POST["id"];
    include("models/m_promotion.php");
    $m_promotion = new M_promotion();
    $product = $m_promotion->get_detail_product_promotion($id);
    echo json_encode($product);
}
if(isset($_POST["update_detail_product_promotion"])) {

    include("models/m_permission.php");
    $m_per = new M_permission;
    if($m_per->check_permission("edit_promotion_detail") == 0) {
        $_SESSION['alert-warning'] = "You don't have permission to do this action";
        echo "permission";
        exit;
    }

    $id = $_POST["id"];
    $price = $_POST["price"];
    include("models/m_promotion.php");
    $m_promotion = new M_promotion();
    if($m_promotion->update_promotion_detail($price,0,$id)) {
        $detail = $m_promotion->get_detail_product_promotion($id);
        $_SESSION['alert-success'] = "Update promotion price successfully";
        echo json_encode($detail);
    } else {
        echo json_encode(['error'=>'Error update']);
    }

}

if(isset($_POST["delete_promotion_detail"])) {

    include("models/m_permission.php");
    $m_per = new M_permission;
    if($m_per->check_permission("delete_promotion_detail") == 0) {
        $_SESSION['alert-warning'] = "You don't have permission to do this action";
        echo "permission";
        exit;
    }


    $id = $_POST["id"];
    include("models/m_promotion.php");
    $m_promotion = new M_promotion();
    if($m_promotion->delete_promotion_detail($id)) {
        echo "success";
    } else {
        echo "fail";
    }
}
/* end Promotion*/
?>