<?php
require_once("admin/models/database.php");

class M_products extends database { 

	public function read_top_product() {
		$sql = "select * from products order by view desc limit 0,3";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_all_product($vt = -1,$limit = 0) {
		$sql = "select * from products where status = 0 order by id desc ";
		if($vt != -1 && $limit != 0 ) {
			$sql .= "limit ".$vt.",".$limit;
		}
		$this->setQuery($sql);
		return $this->loadAllRows();
	}
	public function read_product_by_id($id) {
		$sql = "select * from products where id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}
	public function read_product_paging($vt,$limit) {
		$sql = "select * from products where status = 0 limit ?,?";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_product_by_cate_id($cate_id,$vt = -1,$limit = 0) {
		$sql = "select * from products where status = 0 and cate_id = ".$cate_id;
		if($vt != -1 && $limit != 0 ) {
			$sql .= " limit ".$vt.",".$limit;
		}
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_product_by_arrcate($cate,$vt = -1,$limit = 0) {
		$str = implode(",",$cate);
		$sql = "select * from products where status = 0 and cate_id IN ($str)";
		if($vt != -1 && $limit != 0 ) {
			$sql .= "limit ".$vt.",".$limit;
		}
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

    public function read_relative_product($cate_id) {
        $sql = "select * from products where status = 0 and cate_id = ".$cate_id." order by RAND() limit 4";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }


	public function search_product($price,$name,$soft,$cate_id) {
		$sql = "select * from products where status  = 0 ";
		if($price != 'all') {
			$cost = explode('-',$price);
            if(count($cost)>1){ // price nằm trong khoảng 
            	$sql .= " and price between ".$cost[0]."  and ".$cost[1]; 
            } else { // Có 1 giá trị price
            	$fil_price = explode(',',$price);
            	if($fil_price[0] == "small") {
            		$sql .= " and price <= ".$fil_price[1];
            	} elseif($fil_price[0] == "big") {
            		$sql .= " and price >= ".$fil_price[1];
            	}
            }
        }
        if($name != '') {
        	$sql .= " and name like '%".$name."%'";
        }
        if($cate_id != '') {
        	include("models/m_categories.php");
        	$m_category = new M_Category();
        	$cate = $m_category->read_cate_by_id($cate_id);
            if($cate->parent_id == 0 ) { //nếu có con 
                $cate_parent = $m_category->read_cate_by_parent($cate->id);//tìm con để show sản phẩm của con nữa
                if(count($cate_parent) !=0) {
                	$arr_cate = [];
                	foreach($cate_parent as $cp) {
                		$arr_cate[] = $cp->id;
                	}
                	$str = implode(",",$arr_cate);
                	$sql .= " and cate_id In ($str) ";
                } else {
                	$sql .=" and cate_id = ".$cate_id;
                }
            } else {
            	$sql .= " and cate_id = ".$cate_id;
            }

        } 
        if($soft != 'all') {
        	switch($soft){
        		case 'price_high':
        		$sql .= " order by price desc" ;break;
        		case 'price_low':
        		$sql .= " order by price asc "; break;
        		case 'popular':
        		$sql .= " order by view desc "; break;
        		case 'newest':
        		$sql .= " order by created_at desc"; break;
        	}
        }
        $this->setQuery($sql);
        return $this->loadAllRows();
        
    }

    public function update_product($id,$quantity,$size) {
        $sql = "update products set quantity = ?, size = ? where id = ?";
        $this->setQuery($sql);
        return $this->execute(array($quantity,$size,$id));
    }

    public function insert_feedback($customer_id,$content) {
        $sql ="insert into feedback (customer_id,content,status) values(?,?,0)";
        $this->setQuery($sql);
        return $this->execute(array($customer_id,$content));
    }





}