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
        if(isset($_POST["insert_pro"])) {

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
            $price = str_replace(',', '', $_POST["price"]);
            $reduce = str_replace(',', '', $_POST["reduce"]);
            
            $cate_id = $_POST["cate_id"];
            $sup_id = $_POST["sup_id"];
            $intro = $_POST["intro"];
            $description = $_POST["description"];
            $quanity = $total_quantity;
            $image = newImage($_FILES["image"]["name"]);


            //Xu ly hinh anh
            $sub_image_array = array();
            $sub_image = $_FILES["sub_image"]["name"];
            if(move_uploaded_file($_FILES["image"]["tmp_name"],"public/images/$image") ) {
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
                //insert_product($name,$cate_id,$price,$quantity,$reduce,$size,$image,$sub_image,$intro,$description)
            if($m_pro->insert_product($name,$cate_id,$sup_id,$price,$quanity,$reduce,$size,$image,json_encode($sub_image_array),$intro,$description)){
            	var_dump($stock_id." ".$quantity." ".$reduce." ".$size);
            	$m_stock->insert_stock_detail($stock_id,$quanity,$reduce,$size);
                $_SESSION['alert-success'] = "Insert Product Successfully";
               	// echo "<script>window.location = 'stock_receipt_add_products.php?id=".$stock_id."'</script>";
            } else {
                $_SESSION['alert-danger'] = "Insert Product Fail";
                echo "<script>window.location = 'stock_receipt_add_products.php?id=".$stock_id."'</script>";	
            }
        } else {
            $_SESSION['alert-danger'] = "Error Upload File";
                // echo "<script>window.location = 'products_list.php'</script>";
        }



    }
	}
}