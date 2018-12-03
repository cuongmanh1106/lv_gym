<?php
require_once("database.php");
class M_stock_receipt extends database {

	public function read_all_stock(){
		$sql = "select * from stock_receipt order by status asc, created_at desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	} 

	public function read_stock_by_id($id) {
		$sql = "select * from stock_receipt where id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function read_product_by_stock($stock_id) {
		$sql = "select * from detail_stock where status != 2 and stock_id = ".$stock_id;
		$this->setQuery($sql);
		$detail = $this->loadAllRows();
		$result = [];
		foreach($detail as $d) {
			$result[] = $this->read_product_by_id($d->pro_id);
		}
		return $result;

	}

	public function read_product_by_id($id) {
		$sql = "select * from products where id =".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function search_product_stock($stock_id,$name,$price_from,$price_to,$cate) {
		$sql = "select products.* from detail_stock,products  where detail_stock.pro_id = products.id and  detail_stock.status != 2 and detail_stock.stock_id = ".$stock_id. " and products.status != 1";
		if($name != '') {
			$sql .= " and products.name like '%".$name."%' ";
			$check = true;
		}
		if($price_from != '' && $price_to == '') {
			
			$sql .= " and detail_stock.price_in >= ".$price_from;
		} else if($price_from == '' && $price_to != '') {
			
			$sql .= " and detail_stock.price_in <= ".$price_to;
		} else if($price_from != '' && $price_to != '') {
			
			$sql .= " and detail_stock.price_in between ".$price_from." and ".$price_to;
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


		$this->setQuery($sql);
		$detail = $this->loadAllRows();
		
		return $detail;
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


	public function insert_stock($user_id,$description) {
		$sql = "insert into stock_receipt(user_id,description) values(?,?)";
		$this->setQuery($sql);
		return $this->execute(array($user_id,$description));
	}

	public function update_stock($user_id,$description,$id) {
		$sql = "update stock_receipt set user_id = ?, description = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($user_id,$description,$id));
	}

	public function cancel_stock($status,$id) {
		$sql = " update stock_receipt set status = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($status,$id));
	}

	//detail

	public function read_detail_by_stock($stock) {
		$sql = "select * from detail_stock where stock_id = ".$stock;
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_detail_by_id($id) {
		$sql = "select * from detail_stock where id =".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}
	public function read_detail_by_stock_product($stock,$pro) {
		$sql = "select * from detail_stock where stock_id = ? and pro_id = ?";
		$this->setQuery($sql);
		return $this->loadRow(array($stock,$pro));
	}
	public function insert_stock_detail($stock_id,$pro_id,$quantity,$price_in,$size,$status) {
		$sql = "insert into detail_stock (stock_id,pro_id,quantity,price_in,size,status) values(?,?,?,?,?,?)";
		$this->setQuery($sql);
		return $this->execute(array($stock_id,$pro_id,$quantity,$price_in,$size,$status));
	}

	public function update_stock_detail($quantiy,$price_in,$size,$status,$stock_id,$pro_id) {
		$sql ="update detail_stock set quantity = ?, price_in = ?, size = ?, status = ? where stock_id = ? and pro_id = ?";
		$this->setQuery($sql);
		return $this->execute(array($quantiy,$price_in,$size,$status,$stock_id,$pro_id));

	}

	public function update_status_detail($status,$id) {
		$sql = "update detail_stock set status = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($status,$id));
	}

	public function delete_group_stock_product($arrId = array()) {
		$str = implode(",",$arrId);
		$sql = "update detail_stock set status = 2 where id IN ($str)";
		$this->setQuery($sql);
		return $this->execute();
	}
 

}