<?php
session_start();
include("models/m_permission.php");

class C_orders
{

  function __construct() {
    if(!isset($_SESSION["user"])) {
        echo "<script>window.location='.'</script>";
    } 
}

public function show_all_orders() {

    $m_per = new M_permission();
    if($m_per->check_permission("list_order") == 0) {
        $_SESSION['alert-warning'] = "You don't have permission to do this action";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

        //models
    include("models/m_orders.php");
    include("models/m_users.php");

    $m_order = new M_orders();
    $m_user = new M_users();
    $orders = $m_order->read_all_orders();
    $status = $m_order->read_status();
    $customer = $m_user->read_customer();


        //views
    $title = "Lists of orders";
    $view = "views/orders/v_list.php";
    include("include/layout.php");
}

public function show_order_detail(){
    $m_per = new M_permission();

    if($m_per->check_permission("edit_order") == 0) {
        $_SESSION['alert-warning'] = "You don't have permission to do this action";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $id = $_GET["id"];


        //models 
    include("models/m_orders.php");
    include("models/m_users.php");
    include("models/m_products.php");
    $m_product = new M_products();
    $m_user = new M_users();
    $m_order = new M_orders();
    $details = $m_order->read_detail_by_id($id);
    $order = $m_order->read_order_by_id($id);
    $status = $m_order->read_status();

    if(isset($_POST["confirm"]) || isset($_POST["confirm_delivery"])) {
            // nếu status cũ là 1 và status vừa chọn khác 5 và 3 thì update lại thông tin đơn hàng
        if($order->status == 1 && $_POST["status"] != 5 && $_POST["status"] != 3) {
            if($m_order->update_order($_POST["delivery_place"],$_POST["delivery_cost"],$_POST["status"],$id)) {
                $_SESSION["alert-info"] = "Successfully";
                echo "<script>window.location = 'orders_list.php'</script>";
                // header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                $_SESSION["alert-danger"] = "Fail";
            }
        } else if($_POST["status"] == 5) { //Nếu chọn status = 5(cancel) thì phải update quantity bên product
            if($m_order->update_status($_POST["status"],$id) && $m_order->update_ship(2,$id)) {
                foreach($details as $d) {
                    $product = $m_product->read_product_by_id($d->pro_id);
                    $sizes = json_decode($product->size);
                    $total = 0;
                    if(count($sizes) > 0) { //Có size
                        foreach($sizes as $key=>$value) {
                            if($key == $d->size) { // cộng vào size trùng vs size của đơn hàng
                                $sizes->$key = $value + $d->quantity;
                                $total += $value + $d->quantity;
                            } else {
                                $total += $value;
                            }
                        }
                    } else { // không có size cộng trực tiếp vào quantity
                        $total = $product->quantity + $d->quantity;
                    }
                    $m_product->update_product_order($total,json_encode($sizes),$product->id);
                }
                $_SESSION["alert-success"] = "Successfully";
                echo "<script>window.location = 'orders_list.php'</script>";
            } else {
                $_SESSION["alert-danger"] = "Fail";
            }
        } else if($_POST["status"] == 3 && $order->status == 3){ //Khi cập nhật lại người giao hàng
            $shipper = $_POST["shipper"];
            if($m_order->update_shipper($shipper,$id)) {
                $_SESSION["alert-success"] = "Successfully";
                echo "<script>window.location = 'orders_list.php'</script>";
            } else {
                $_SESSION["alert-danger"] = "Fail";
            }
        } else { // Nếu chọn 3 thì phải chọn shipper
            if($_POST["delivery_place"] != '' && $_POST["delivery_cost"] != '') {
                $m_order->update_order($_POST["delivery_place"],$_POST["delivery_cost"],$_POST["status"],$id);
            } else {
                $m_order->update_status($_POST["status"],$id);
            }
            /*Giao cho shipper giao hang neu status la delivery*/
            $shipper = '';
            if($_POST["status"] == 3) {
                $shipper = $_POST["shipper"];
                $m_order->insert_ship($shipper,$id);
            } else if ($_POST["status"] == 4) {
                if(!empty($m_order->read_shipper_by_order_id($id))) { //đơn hàng đã có shipper
                    $m_order->update_ship(1,$id);
                }
            }
            $_SESSION["alert-success"] = "Successfully";
            echo "<script>window.location = 'orders_list.php'</script>";

        }
    }

        //views 
    $title = "Detail order";
    $view = "views/orders/v_detail.php";
    include("include/layout.php");
}



/*ship*/
public function ship() {
    $m_per = new M_permission();

    if($m_per->check_permission("list_ship") == 0) {
        $_SESSION['alert-warning'] = "You don't have permission to do this action";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    //models
    include("models/m_orders.php");
    include("models/m_users.php");
    $m_order = new M_orders();
    $m_user = new M_users();


    $ship = $m_order->read_shipper();
     if($_SESSION["user"]->permission_id == 6) {
        $ship = $m_order->read_ship();
    }


    //views
    $title = "List of Shipper";
    $view = "views/orders/v_ship.php";
    include("include/layout.php");
}
/*end ship*/









}