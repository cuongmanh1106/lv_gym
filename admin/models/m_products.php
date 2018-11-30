<?php
require_once("database.php");
class M_products extends database {

	public function read_all_products($vt = -1, $limit = 0) {
		$sql = "select p.*,ca.name as cate_name from products p, (select * from categories where status = 0) ca  where p.cate_id = ca.id and p.status = 0 order by id desc ";
		if($vt != -1 && $limit != 0) {
			$sql .= "limit ".$vt.",".$limit;
		}
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_all_pro() {
		$sql = "select * from products where status != 1 order by id desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_product_by_id($id) {
		$sql = "select * from products where id =".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function read_product_by_cate($cate_id,$vt = -1 , $limit = 0) {
		$sql = "select * from products where cate_id = ? where status = 0 order by id desc ";
		if($vt != -1 && $limit != 0) {
			$sql .= " limit ".$vt.",".$limit;
		}
		$this->setQuery($sql);
		return $this->loadAllRows();
	}


	public function read_product_by_arrcate($arrId) {
		$str = implode(",",$arrId);
		$sql = "select * from products where status = 0 and cate_id IN ($str)";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function chart($year) {
		$sql = "select SUM(price*quantity) as total, Month(created_at) as month from order_details where Year(created_at) = ".$year." group by Month(created_at)";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function filter_revenue($date) {
		$sql = "select SUM(price*quantity) as total from order_details where date(created_at) = '".$date."' group by date(created_at)";
		$this->setQuery($sql);
		// var_dump($sql);
		return $this->loadRow();
	}

	public function read_top_product($top) {
		$sql ="select products.id, products.name, products.image, products.price,SUM(order_details.quantity) as quantity ,SUM(order_details.price*order_details.quantity) as total from products, order_details where products.id = order_details.pro_id group by products.id order by total desc limit 0,".$top;
		$this->setQuery($sql);
		// var_dump($sql);
		return $this->loadAllRows();
	}

	public function insert_product($name,$cate_id,$sup_id,$price,$quantity,$size,$image,$sub_image,$intro,$description) {
		$sql = "insert into products(name,alias,cate_id,sup_id,price,quantity,size,image,sub_image,intro,description) values(?,?,?,?,?,?,?,?,?,?,?)";
		$this->setQuery($sql);
		return $this->execute(array($name,changeTitle($name),$cate_id,$sup_id,$price,$quantity,$size,$image,$sub_image,$intro,$description));
	}

	public function insert_product_get_id($name,$cate_id,$sup_id,$price,$price_in,$quantity,$size,$image,$sub_image,$intro,$description,$status) {
		$sql = "insert into products(name,alias,cate_id,sup_id,price,price_in,quantity,size,image,sub_image,intro,description,status) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$this->setQuery($sql);

		$this->execute(array($name,changeTitle($name),$cate_id,$sup_id,$price,$price_in,$quantity,$size,$image,$sub_image,$intro,$description,$status));
		return $this->getLastId();
	}



	public function update_product($name,$cate_id,$sup_id,$price,$quantity,$size,$image,$sub_image,$intro,$description,$id){
		$sql = "update products set name = ?,alias = ?,cate_id =?,sup_id=?, price = ?, quantity = ?, size = ?,image = ?,sub_image = ?,intro = ?,description = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($name,changeTitle($name),$cate_id,$sup_id,$price,$quantity,$size,$image,$sub_image,$intro,$description,$id));
	}
	public function update_sub_image($sub_image,$id) {
		$sql = "update products set sub_image = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($sub_image,$id));
	}

	public function update_size($id,$quantity , $size ) {
		$sql = "update products set size = ?, quantity = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($size,$quantity,$id));
	}

	public function update_quantity($id,$quantity) {
		$sql = "update products set quantity = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($quantity,$id));
	}

	public function delete_product($id) {
		$sql = "update products set status = 1 where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($id));
	}

	public function delete_group($arrId = array()) {
		$str = implode(",",$arrId);
		$sql = "update products set status = 1 where id IN ($str)";
		$this->setQuery($sql);
		return $this->execute();
	}

	


	public function search_product($name,$price_from,$price_to,$cate) {
		$sql = "select * from products where status = 0  ";
		$check = false;
		if($name != '') {
			$sql .= " and name like '%".$name."%' ";
			$check = true;
		}
		if($price_from != '' && $price_to == '') {
			
			$sql .= " and price >= ".$price_from;
		} else if($price_from == '' && $price_to != '') {
			
			$sql .= " and price <= ".$price_to;
		} else if($price_from != '' && $price_to != '') {
			
			$sql .= " and price between ".$price_from." and ".$price_to;
		}
		if($cate != 'all') {
			$this->setQuery("select * from categories where id =".$cate."");
			$category = $this->loadRow();
			if($category->parent_id == 0) { //neu cate la thang  cao nhat thi xuat du lieu cua tat ca cac con cua no
				$this->setQuery("select id from categories where parent_id =".$cate);
				$cates = $this->loadAllRows();
				if(count($cates) != 0) { //neu co con
					$arrId = [];
					foreach($cates as $c) {
						$arrId[] = $c->id;
					}
					$str = implode(",",$arrId);
					$sql .= " and cate_id IN ($str)";
				} else {
					$sql .= " and cate_id = ".$cate;
				}
			} else {
				$sql .= " and cate_id = ".$cate;
			}			
			
		}

		$sql .= " order by id desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function update_product_order($quantity,$size,$id) {
		$sql = "update products set quantity = ?, size = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($quantity,$size,$id));
	}

	public function update_product_stock($quantity,$size,$price,$price_in,$id) {
		$sql = "update products set quantity = ?, size = ?, price = ?, price_in = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($quantity,$size,$price,$price_in,$id));
	}
}