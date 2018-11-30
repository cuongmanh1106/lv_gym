<?php
session_start();
include("../helper/help.php");
include("models/m_permission.php");
class C_stock_receipt
{

	public function get_all_stock_receipt() {

		//models
		include("models/m_stock_receipt.php");
		include("models/m_users.php");
		$m_stock = new M_stock_receipt();
		$m_user = new M_users();
		$stocks = $m_stock->read_all_stock();




		//views
		$view = "views/stock_receipt/v_list.php";
		$title = "List of Stock Receipt";
		include("include/layout.php");
	}

	public function insert_stock() {
		$description = $_POST["description_stock"];
		$user_id = $_SESSION["user"]->id;
		include("models/m_stock_receipt.php");
		$m_stock = new M_stock_receipt();
		if($m_stock->insert_stock($user_id,$description)) {
			$_SESSION['alert-success'] = "Insert stock receipt successfully";
		} else {
			$_SESSION['alert-danger'] = "Insert stock receipt failed";
		}

		echo "<script>window.location = 'stock_receipt_list.php'</script>";
	}

	public function create_stock_product() {
		//models
		$stock_id = $_GET["id"];
		require("models/m_categories.php");
        require("models/m_supplier.php");
        $m_sup = new M_suppliers();
        $m_cate = new M_Categories();

        $cates = $m_cate->read_all_categories();
        $supliers = $m_sup->read_all_suppliers();

        //views
        $view = "views/stock_receipt/v_add_product.php";
        $title = "Add a product to stock";
        include("include/layout.php");
	}

	public function store_stock_product() {
		$stock_id = $_POST["stock_id"];
		include("models/m_products.php");
		include("models/m_stock_receipt.php");
		$m_stock = new M_stock_receipt();
        $m_pro = new M_products();
        if(isset($_POST["insert_stock"])) {

            $img = '';
            if($_FILES["image"]["error"] != 0){
                $_SESSION['alert-danger'] = "Error File";
                echo "<script>window.location = 'stock_receipt_add_products.php?id=".$stock_id."'</script>";
            }


            //Xu Ly size
            $size  = '';
            $total_quantity = 0;
            if(isset($_POST['size'])) {
                $arr_size = $_POST['size'];
                $arr_quantity = $_POST['quantity'];
                $merge=array_combine($arr_size,$arr_quantity);
                $total_quantity = array_sum($arr_quantity);
                $size = json_encode($merge);
            } 
            if($size == ''){
                $total_quantity = $_POST["total_quantity"];
            }

            //Tong hop du lieu
            $name = $_POST["name"];
            $price_in = str_replace(',', '', $_POST["price_in"]);
            $price_out = str_replace(',', '', $_POST["price"]);
            
            $cate_id = $_POST["cate_id"];
            $sup_id = $_POST["sup_id"];
            $intro = $_POST["intro"];
            $description = $_POST["description"];
            $quanity = $total_quantity;
            $image = newImage($_FILES["image"]["name"]);

            //Xu ly hinh anh
            $sub_image_array = array();
            
            if(move_uploaded_file($_FILES["image"]["tmp_name"],"public/images/$image") ) {

                $sub_image = $_FILES["sub_image"]["name"];
                foreach($sub_image as $key => $value) {
                   if($value == "") {
                        continue;
                    }
                    $sub_name_tmp = newImage($value);
                    if($_FILES["sub_image"]["error"][$key] == 0 && move_uploaded_file($_FILES["sub_image"]["tmp_name"][$key],"public/images/$sub_name_tmp")){
                        $sub_image_array[] = $sub_name_tmp;
                    } else {
                        $_SESSION['alert-danger'] = "Error Upload File";
                        echo "<script>window.location = 'stock_receipt_add_products.php?id=".$stock_id."'</script>";
                    }

                }
                $status = 2;
                // $name,$cate_id,$sup_id,$price,$quantity,$size,$image,$sub_image,$intro,$description
                $pro_id = $m_pro->insert_product_get_id($name,$cate_id,$sup_id,$price_out,$price_in,$quanity,$size,$image,json_encode($sub_image_array),$intro,$description,$status);
                if($pro_id != 0){
                	$m_stock->insert_stock_detail($stock_id,$pro_id,$quanity,$price_in,$size,0);
                    $_SESSION['alert-success'] = "Insert Product Successfully";
                   	echo "<script>window.location = 'stock_receipt_add_products.php?id=".$stock_id."'</script>";
                } else {
                    $_SESSION['alert-danger'] = "Insert Product Fail";
                    echo "<script>window.location = 'stock_receipt_add_products.php?id=".$stock_id."'</script>";	
                }
            } else {
                $_SESSION['alert-danger'] = "Error Upload File";
                    echo "<script>window.location = 'stock_receipt_add_products.php?id=".$stock_id."'</script>";
            }

        }
	}


    public function edit_stock_product() {

        //models
        $stock_id = $_GET["id"];
        require("models/m_categories.php");
        require("models/m_products.php");
        $m_pro = new M_products();
        $m_cate = new M_Categories();
        $products = $m_pro->read_all_pro();
        $cates = $m_cate->read_all_categories();
        

       
        //views
        $view = "views/stock_receipt/v_update.php";
        $title = "Update product in stock";
        require("include/layout.php");

    }

    public function update_stock_product(){

    	//models
    	require("models/m_stock_receipt.php");
    	require("models/m_products.php");
    	$m_pro = new M_products();
    	$m_stock = new M_stock_receipt();

    	if(isset($_POST["update_stock"])) {
    		$stock_id = $_POST["stock_id"];
    		$pro_id = $_POST["pro_id"];

    		$detail = $m_stock->read_detail_by_stock_product($stock_id,$pro_id);
    		$detail_size = '';
    		$detail_quantity = 0;

    		$product = $m_pro->read_product_by_id($pro_id);
    		$price = $product->price;
    		$price_in = $product->price_in;
    		$old_size = json_decode($product->size);

    		$extra_size  = '';
            $total_quantity = 0;

            if(isset($_POST['size'])) {
                $arr_size = $_POST['size'];
                $arr_quantity = $_POST['quantity'];
                $merge=array_combine($arr_size,$arr_quantity);
                $total_quantity = array_sum($arr_quantity);
                $extra_size = $merge;
            } 
            if($extra_size == ''){
                $total_quantity = $_POST["total_quantity"];
            }

            
            if($product->status == 2) { //sản phẩm mới dc thêm trong đơn hàng này
            	
            	$detail_size = json_decode($detail->size);
            	$quantity = $product->quantity;
            	$price = $_POST["price"];
            	$price_in = $_POST["price_in"];
            	if($extra_size == '') { 
            		$quantity += $total_quantity;
            	} else {

            		foreach($extra_size as $key=>$value) {
	                	if(isset($old_size->$key)) {
	                		$old_size->$key += $value;
	                	} else {
	                		$old_size->$key = $value;
	                	}

	                	$quantity += $value;
		            }
            	}
            	
            	//$quantity,$size,$price,$price_in,$id
            	if($m_pro->update_product_stock($quantity,json_encode($old_size),$price,$price_in,$pro_id)) {
            		//$quantiy,$price_in,$size,$status,$stock_id,$pro_id
            		$m_stock->update_stock_detail($quantity,$price_in,json_encode($old_size),0,$stock_id,$pro_id);
            		$_SESSION['alert-success'] = "Update Stock Product Successfully";
                   	
            	} else {
            		$_SESSION['alert-danger'] = "Update Stock Product Faily";
            	}

            } else { //sản phẩm có sản trong danh sách
            	if(empty($detail)) { //chưa dc update lần nào
            		//$stock_id,$pro_id,$quantity,$price_in,$size,$status
            		if($extra_size == '') $extra_size = null;
            		if($m_stock->insert_stock_detail($stock_id,$pro_id,$total_quantity,$price_in,json_encode($extra_size),1)) {
            			$_SESSION['alert-success'] = "Update Stock Product Successfully";
            		} else {
            			$_SESSION['alert-danger'] = "Update Stock Product Faily";
            		}
            	} else { //Update lần 2 trở lên
            		$detail_size = json_decode($detail->size);
            		$detail_quantity = $detail->quantity;
            		if($extra_size == '') { 
	            		$detail_quantity += $total_quantity;
	            	} else {
	            		foreach($extra_size as $key=>$value) {
		                	if(isset($detail_size->$key)) {
		                		$detail_size->$key += $value;
		                	} else {
		                		$detail_size->$key = $value;
		                	}
		                	$detail_quantity += $value;
			            }
	            	}
            		if($m_stock->update_stock_detail($detail_quantity,$price_in,json_encode($detail_size),1,$stock_id,$pro_id)){
            		$_SESSION['alert-success'] = "Update Stock Product Successfully";
	            	} else {
	            		$_SESSION['alert-danger'] = "Update Stock Product Faily";
	            	}
            	}

            	
            } 
            echo "<script>window.location = 'stock_receipt_update_products.php?id=".$stock_id."'</script>";
    	}

    }


    public function list_stock_product() {
        $stock_id = $_GET["id"];

        //models
        require("models/m_stock_receipt.php");
        require("models/m_categories.php");
        require("models/m_products.php");
        require("models/m_supplier.php");

        $m_sup = new M_suppliers();
        $m_cate = new M_Categories();
        $m_pro = new M_products();
        $m_stock = new M_stock_receipt();
        $products = $m_stock->read_product_by_stock($stock_id);
        $cates = $m_cate->read_all_categories();
        


        //views
        $title = "List products of stock";
        $view = "views/stock_receipt/v_list_product.php";
        include("include/layout.php");
    }

    public function edit_stock_size_qty() {
        //models
        $pro_id = $_GET["pro_id"];
        $stock_id = $_GET["stock_id"];
        include("models/m_products.php");
        include("models/m_stock_receipt.php");

        $m_pro = new M_products();
        $m_stock = new m_stock_receipt();
        $product = $m_pro->read_product_by_id($pro_id);

        if(isset($_POST["update_stock_qty_size"])) {
            $detail = $m_stock->read_detail_by_stock_product($stock_id,$pro_id);
            $detail_size = '';
            $detail_quantity = 0;

            $price = $product->price;
            $price_in = $product->price_in;
            $old_size = json_decode($product->size);

            $new_size  = '';
            $total_quantity = 0;

            if(isset($_POST['size'])) {
                $arr_size = $_POST['size'];
                $arr_quantity = $_POST['quantity'];
                $merge=array_combine($arr_size,$arr_quantity);
                $total_quantity = array_sum($arr_quantity);
                $new_size = $merge;
            } 
            if($new_size == ''){
                $total_quantity = $_POST["total_quantity"];
                $new_size = null;
            }

            
            if($product->status == 2) { //sản phẩm mới dc thêm trong đơn hàng này
                $price = $_POST["price"];
                $price_in = $_POST["price_in"];
                
                //$quantity,$size,$price,$price_in,$id
                if($m_pro->update_product_stock($total_quantity,json_encode($new_size),$price,$price_in,$pro_id)) {
                    //$quantiy,$price_in,$size,$status,$stock_id,$pro_id
                    $m_stock->update_stock_detail($total_quantity,$price_in,json_encode($new_size),0,$stock_id,$pro_id);
                    $_SESSION['alert-success'] = "Update Stock Product Successfully";
                    
                } else {
                    $_SESSION['alert-danger'] = "Update Stock Product Faily";
                }

            } else { //sản phẩm có sản trong danh sách

                if($m_stock->update_stock_detail($total_quantity,$price_in,json_encode($new_size),1,$stock_id,$pro_id)){
                $_SESSION['alert-success'] = "Update Stock Product Successfully";
                } else {
                    $_SESSION['alert-danger'] = "Update Stock Product Faily";
                }
            }
        }

        //views
        $title = "Update Size & Qty Of Stock";
        $view = "views/stock_receipt/v_update_size_qty.php";
        include("include/layout.php");
    }
}