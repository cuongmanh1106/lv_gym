<?php
require_once("database.php");
class M_promotion extends database {

	public function read_all_promotion() {
		$sql = "select * from promotion where status = 0 order by created_at desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_promotion_by_id($id) {
		$sql = "select * from promotion where id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function search_promotion($name,$date_from,$date_to) {
		$sql = "select * from promotion where status = 0 ";
		if($name != '') {
			$sql .= "and name like '%".$name."%' ";
		} 
		if($date_from != '' && $date_to == '') {
			$sql .= " and date_from >= '". $date_from."'";
		} else if ($date_from == '' && $date_to != '') {
			$sql .= " and date_to <= '".$date_to."'";
		} else if($date_from != '' && $date_from != '') {
			$sql .= " and date_from >= '".$date_from ."' and date_to <= '".$date_to."'";
		}
		$this->setQuery($sql);
		return $this->loadAllRows();

	}

	public function check_date($date_from,$date_to,$id = null) {
		$date = date("Y-m-d");
		$sql ="select * from promotion where status = 0 and date_from >= ".$date;
		if($id != null) {
			$sql .= " and id != ".$id;
		}
		$this->setQuery($sql);
		$result = $this->loadAllRows();
		$check = true;
		foreach($result as $r) {
			if( !(($date_to < $r->date_from) || ($date_from > $r->date_to)) ) {
				$check = false;
				break;
			} 
		}

		return $check;

	}



	public function insert_promotion($name,$description,$image,$date_from,$date_to,$status) {
		$sql = "insert into promotion (name,description,image,date_from,date_to,status) values(?,?,?,?,?,?)";
		$this->setQuery($sql);
		return $this->execute(array($name,$description,$image,$date_from,$date_to,$status));
	}

	public function update_promotion($name,$description,$image,$date_from,$date_to,$status,$id) {
		$sql = "update promotion set name = ?, description=?, image = ?, date_from = ?, date_to = ?, status = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($name,$description,$image,$date_from,$date_to,$status,$id));
	}

	public function update_status_promotion($id) {
		$sql = "update promotion set status = 1 where id =  ".$id;
		$this->setQuery($sql);
		return $this->execute();
	}

	public function delete_group_promotion($arrId = array()) {
		$str = implode(",",$arrId);
		$sql = "update promotion set status = 1 where id IN ($str)";
		$this->setQuery($sql);
		return $this->execute();
	}

	//promotion_detail 

	public function get_choose_product($promotion_id) {
		$arrPromotion = [];
		$sql = "select * from promotion_detail  where promotion_id = $promotion_id and status = 0 ";
		$this->setQuery($sql);
		$result = $this->loadAllRows();
		foreach($result as $r) {
			$arrPromotion[] = $r->pro_id;
		}
		$str = implode(",",$arrPromotion);
		$extra = '';
		if(count($arrPromotion)>0) {
			$extra = " and id NOT IN ($str)";
		}
		$sql = "select * from products where status = 0 ".$extra;
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function search_choose_product($promotion_id,$name,$price_from,$price_to,$cate) {
		$arrPromotion = [];
		$sql = "select * from promotion_detail  where promotion_id = $promotion_id and status = 0 ";
		$this->setQuery($sql);
		$result = $this->loadAllRows();
		foreach($result as $r) {
			$arrPromotion[] = $r->pro_id;
		}


		$str = implode(",",$arrPromotion);
		$sql = "select * from products where status = 0 and id NOT IN ($str)";
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
	public function get_detail_promotion($promotion_id) {
		$sql = "select p.name as name, p.price as price_out, p.image as image, p.status as pro_status,d.* from products p,promotion_detail d 
				WHERE p.id = d.pro_id and d.promotion_id = ?  and d.status = 0";
		$this->setQuery($sql);
		return $this->loadAllRows(array($promotion_id));
	}

	public function get_detail_product_promotion($id) {
		$sql = "select p.name as name, p.price_in as price_in , p.price as price_out, p.image as image, p.status as pro_status,d.* 
				FROM products p,(select * from promotion_detail where id = ".$id.") d 
				WHERE p.id = d.pro_id  and d.status = 0";
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function get_chose_products($arrId = array()) {
		$str = implode(",",$arrId);
		$sql = "select * from products where id IN ($str) and status = 0";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function insert_promotion_detail($promotion_id,$arr) {

		foreach($arr as $key=>$value) {
			$sql = "insert into promotion_detail set promotion_id = ?, pro_id = ?, price = ?, status = 0 ";
			$this->setQuery($sql);
			$this->execute(array($promotion_id,$key,$value));
		}
		return true;
	}

	public function update_promotion_detail($price,$status,$id) {
		$sql = "update promotion_detail set price = ?, status = ? where id = ".$id;
		$this->setQuery($sql);
		return $this->execute(array($price,$status));
	}

	public function delete_promotion_detail($id) {
		$sql = "delete from promotion_detail where id = ".$id;
		$this->setQuery($sql);
		return $this->execute();
	}


	public function get_promotion_price($pro_id) {
		$date = date('Y-m-d');
		$sql = "select d.* 
		from (select * from promotion where date_from <= '$date' and date_to >= '$date' and status = 0) p, promotion_detail d 
		where p.id = d.promotion_id and d.status = 0 and d.pro_id =".$pro_id;
		$this->setQuery($sql);
		$result = $this->loadRow();
		if(empty($result)) {
			return 0;
		} else {
			
			return $result;
		}
	}


	public function get_promotion_detail_product() {
		$date = date('Y-m-d');
		$sql = "select  pro.id as id, pro.name as name, pro.price as price_out, pro.image as image, d.price as price_sale  
		from (select * from promotion where date_from <= '$date' and date_to >= '$date' and status = 0) p, promotion_detail d, (select * from products where status = 0) pro 
		where p.id = d.promotion_id and d.pro_id = pro.id and d.status = 0";
		$this->setQuery($sql);
		$result = $this->loadAllRows();
		return $result;
	}
}