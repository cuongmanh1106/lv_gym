<?php
session_start();
require("../helper/help.php");
require("models/m_permission.php");


class C_products
{
    function __construct() {

        if(!isset($_SESSION["user"])) {
            echo "<script>window.location='.'</script>";
        } 
    }

    public function get_all_products(){
        $m_per = new M_permission;
        if($m_per->check_permission("list_product") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        //models
        require("models/m_categories.php");
        require("models/m_products.php");
        
        $m_cate = new M_Categories();
        $m_pro = new M_products();

        $cates = $m_cate->read_all_categories();
        $products = $m_pro->read_all_products();


        //views
        $view = "views/products/v_list.php";
        $title = "List Of Products";
        include("include/layout.php");
    }

    public function create(){
        $m_per = new M_permission;
        if($m_per->check_permission("insert_product") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        // require("../helper/help.php");
        require("models/m_categories.php");
        $m_cate = new M_Categories();

        $cates = $m_cate->read_all_categories();


        //views
        $view = "views/products/v_add.php";
        $title = "Add a category";
        include("include/layout.php");
    }

    public function store() {
        $m_per = new M_permission;
        if($m_per->check_permission("insert_product") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        // include("../helper/help.php");
        include("models/m_products.php");
        $m_pro = new M_products();
        if(isset($_POST["insert_pro"])) {

            $img = '';
            if($_FILES["image"]["error"] != 0){
                $_SESSION['alert-danger'] = "Error File";
                echo "<script>window.location = 'products_list.php'</script>";
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
            $price = str_replace(',', '', $_POST['price']);
            $reduce = str_replace(',', '', $_POST['price']);
            if($_POST['reduce'] != ""){
                $reduce = str_replace(',', '', $_POST['reduce']);
            }
            $cate_id = $_POST["cate_id"];
            $intro = $_POST["intro"];
            $description = $_POST["description"];
            $quanity = $total_quantity;
            $image = newImage($_FILES["image"]["name"]);


            //Xu ly hinh anh
            $sub_image_array = array();
            $sub_image = $_FILES["sub_image"]["name"];
            if(move_uploaded_file($_FILES["image"]["tmp_name"],"public/images/$image")) {
                foreach($sub_image as $key => $value) {
                   if($value == "") {
                    continue;
                }
                $sub_name_tmp = newImage($value);
                if($_FILES["sub_image"]["error"][$key] == 0 && move_uploaded_file($_FILES["sub_image"]["tmp_name"][$key],"public/images/$sub_name_tmp")){
                    $sub_image_array[] = $sub_name_tmp;
                } else {
                    $_SESSION['alert-danger'] = "Error Upload File";
                    echo "<script>window.location = 'products_list.php'</script>";
                }

            }
                //insert_product($name,$cate_id,$price,$quantity,$reduce,$size,$image,$sub_image,$intro,$description)
            if($m_pro->insert_product($name,$cate_id,$price,$quanity,$reduce,$size,$image,json_encode($sub_image_array),$intro,$description)){
                $_SESSION['alert-success'] = "Insert Product Successfully";
                echo "<script>window.location = 'products_list.php'</script>";
            } else {
                $_SESSION['alert-danger'] = "Insert Product Fail";
                echo "<script>window.location = 'products_list.php'</script>";
            }
        } else {
            $_SESSION['alert-danger'] = "Error Upload File";
                // echo "<script>window.location = 'products_list.php'</script>";
        }

        var_dump($sub_image_array);


    }
}

public function edit() {
    $m_per = new M_permission;
    if($m_per->check_permission("edit_product") == 0) {
        $_SESSION['alert-warning'] = "You don't have permission to do this action";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $id = $_GET['id'];

        //model
    include("models/M_products.php");
    include("models/M_categories.php");
    // include("../helper/help.php");

    $m_product = new M_products();
    $m_cate = new M_Categories();
    $cates = $m_cate->read_all_categories();
    $product = $m_product->read_product_by_id($id);


        //views
    $view = "views/products/v_edit.php";
    $title = "Edit a product";
    include("include/layout.php");

}

public function update() {

    $m_per = new M_permission;
    if($m_per->check_permission("edit_product") == 0) {
        $_SESSION['alert-warning'] = "You don't have permission to do this action";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    include("models/M_products.php");
    // include("../helper/help.php");
    $m_product = new M_products();


    if(isset($_POST["update_pro"])){
        $id = $_POST["id"];
        $product = $m_product->read_product_by_id($id);

        /*------Xử lý hình phụ-------*/
        $new_sub_image = array();
        if(isset($_POST["old_sub_image"])) {
                $new_sub_image = $_POST['old_sub_image']; //Hình còn lại mà người dùng vừa thao tác
            }
            $old_sub_image = array();
            $delete_sub_image = [];

            if(!empty($product->sub_image)) {
                $old_sub_image = (array) json_decode($product->sub_image); //Hình phụ có sẵn trong db
            }
            //Nếu hình bị xóa (số lượng hình có sự chênh lệch)
            if(count($new_sub_image) != count($old_sub_image) && $new_sub_image != null && $old_sub_image != null){
                $delete_sub_image = array_diff($old_sub_image, $new_sub_image); //Trừ 2 mảng lấy phần tử thuộc array1 mà không thuộc array 2 (hình đã xóa)
                $new_sub_image = array_intersect($old_sub_image, $new_sub_image); //giao 2 mảng => lấy phần tử thuộc cả 2 mảng (hình còn lại) 
            }  
            
            /*------Xử lý hình phụ-------*/

            $old_img = $product->image;
            $new_img = $old_img;
            
            //thu thập dữ liệu
            $size = '';
            $total_quantity = $_POST["total_quantity"];
            
            if(isset($_POST['size'])) {
                $arr_size = $_POST['size'];
                $arr_quantity = $_POST['quantity'];
                $merge=array_combine($arr_size,$arr_quantity);
                $total_quantity = array_sum($arr_quantity);
                $size = json_encode($merge);
            }
            if($size == '') {
                $total_quantity = $_POST["total_quantity"];
            }
            $reduce = str_replace(',', '', $_POST["price"]);
            if(isset($_POST["reduce"])){
                $reduce = str_replace(',', '', $_POST["reduce"]);
            }
            $name = $_POST['name'];
            $price = str_replace(',', '', $_POST["price"]);
            $cate_id = $_POST["cate_id"];
            $description = $_POST["description"];
            $intro = $_POST['intro'];
            $quantity = $total_quantity;
            /*----thu thập dữ liệu-----*/

            //Xử lý hình và update
            $check = true;
            if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                $new_img = newImage($_FILES["image"]["name"]);
                //cập nhậ hình chính
                if(move_uploaded_file($_FILES["image"]["tmp_name"],"public/images/$new_img")) {

                } else {
                    $check = false;
                    $_SESSION['alert-danger'] = "Error Upload File";
                    echo "<script>window.location = 'products_list.php'</script>";
                }
            }

            //Xóa hình phụ
            if(count($delete_sub_image) > 0) {
                foreach ($delete_sub_image as $key => $value) {
                    if(file_exists("public/images/$value")) {
                        unlink("public/images/$value");
                    }
                }
            }

            //Hình khách hàng vừa thêm
            if(isset($_FILES["sub_image"])) {
                $sub_image = $_FILES["sub_image"]["name"];
                foreach($sub_image as $key => $value) {
                    if($value == "") {
                        continue;
                    }
                    $sub_name_tmp = newImage($value);
                    if($_FILES["sub_image"]["error"][$key] == 0 && move_uploaded_file($_FILES["sub_image"]["tmp_name"][$key],"public/images/$sub_name_tmp")){
                        $new_sub_image[] = $sub_name_tmp;
                    } else {
                        $_SESSION['alert-danger'] = "Error Upload File";
                        echo "<script>window.location = 'products_list.php'</script>";
                    }

                }
            }

            //Tiến hành update
            if($m_product->update_product($name,$cate_id,$price,$quantity,$reduce,$size,$new_img,json_encode($new_sub_image),$intro,$description,$id)){
                $_SESSION['alert-success'] = "Edit Successfully";
                echo "<script>window.location = 'products_edit.php?id=$id'</script>";
            } else {
                $_SESSION['alert-danger'] = "Edit Fail";
                echo "<script>window.location.reload();</script>";
            }
        }
    }
    public function update_sub() {

        $m_per = new M_permission;
        if($m_per->check_permission("edit_product") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $id = $_POST['id_pro'];

        include("models/M_products.php");
        // include("../helper/help.php");
        $m_product = new M_products();
        $product = $m_product->read_product_by_id($id);



        $new_sub_image = array();
        if(isset($_POST["old_sub_image"])) {
            $new_sub_image = $_POST['old_sub_image']; //Hình còn lại mà người dùng vừa thao tác
        }
        $old_sub_image = array();
        $delete_sub_image = [];

        if(!empty($product->sub_image)) {
            $old_sub_image = (array) json_decode($product->sub_image); //Hình phụ có sẵn trong db
        }
            //Nếu hình bị xóa (số lượng hình có sự chênh lệch)
        if(count($new_sub_image) != count($old_sub_image) && $new_sub_image != null && $old_sub_image != null){
            $delete_sub_image = array_diff($old_sub_image, $new_sub_image); //Trừ 2 mảng lấy phần tử thuộc array1 mà không thuộc array 2 (hình đã xóa)
            $new_sub_image = array_intersect($old_sub_image, $new_sub_image); //giao 2 mảng => lấy phần tử thuộc cả 2 mảng (hình còn lại) 
        }  

        if(count($delete_sub_image) > 0) {
            foreach ($delete_sub_image as $key => $value) {
                if(file_exists("public/images/$value")) {
                    unlink("public/images/$value");
                }
            }
        }

        if(isset($_FILES["sub_image"])) {
            $sub_image = $_FILES["sub_image"]["name"];
            foreach($sub_image as $key => $value) {
                if($value == "") {
                    continue;
                }
                $sub_name_tmp = newImage($value);
                if($_FILES["sub_image"]["error"][$key] == 0 && move_uploaded_file($_FILES["sub_image"]["tmp_name"][$key],"public/images/$sub_name_tmp")){
                    $new_sub_image[] = $sub_name_tmp;
                } else {
                    $_SESSION['alert-danger'] = "Error Upload File";
                }
            }
        }
        
        if($m_product->update_sub_image(json_encode($new_sub_image),$id)){
            $_SESSION['alert-success'] = "Edit Successfully";
            echo "<script>window.location = 'products_list.php'</script>";
        } else {
            $_SESSION['alert-danger'] = "Edit Fail";
            echo "<script>window.location.reload();</script>";
        }

    }

    public function update_size()
    {
        $m_per = new M_permission;
        if($m_per->check_permission("edit_product") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $id = $_POST['id_pro'];

        $total_quantity = 0;
        $size = '';
        if(isset($_POST['size'])) {
            $arr_size = $_POST['size'];
            $arr_quantity = $_POST['quantity'];
            $merge=array_combine($arr_size,$arr_quantity); // merge 2 trường lại 
            $total_quantity = array_sum($arr_quantity);
            $size = json_encode($merge);
        } 

        include("models/m_products.php");
        $m_pro = new M_products();
        if($m_pro->update_size($id,$total_quantity,$size)){
            $_SESSION['alert-success'] = "Edit Successfully";
            echo "<script>window.location = 'products_list.php'</script>";
        } else {
            $_SESSION['alert-danger'] = "Edit Fail";
            echo "<script>window.location.reload();</script>";
        }
    }

    public function update_quantity() {

        $m_per = new M_permission;
        if($m_per->check_permission("edit_product") == 0) {
            $_SESSION['alert-warning'] = "You don't have permission to do this action";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $id = $_POST['pro_id'];
        $quantity = $_POST['quantity'];
        //models
        include("models/m_products.php");
        $m_pro = new M_products();
        $product = $m_pro->read_product_by_id($id);
        if(count(json_decode($product->size))==0) {
            if($m_pro->update_quantity($id,$quantity)) {
                $_SESSION['alert-success'] = "Edit Successfully";
                echo "<script>window.location = 'products_list.php'</script>";
            } else {
                $_SESSION['alert-danger'] = "Edit Fail";
                echo "<script>window.location.reload();</script>";
            }
        } else {
            echo "<script>alert('You must change quantity in product size');window.location = 'products_list.php'</script>";
        }
    }

    public function refreshDataTable(){
        include("models/m_categories.php");
        $m_pro = new M_products();
        $m_cate = new M_Categories();
        $products = $m_pro->read_all_products();
        $cates = $m_cate->read_all_categories();
        include("views/products/v_search.php");
    }
}

