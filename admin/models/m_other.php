<?php
require_once("database.php");

class M_other extends database {

	public function read_new_order(){
		$sql = "select * from orders where status = 1";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_new_feedback() {
		$sql = "select * from feedback where status = 0";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_current_promotion($data) {
		$sql = "select * from feedback where status = 0 and date_from <= ? and date_to >= ?";
		$this->setQuery($sql);
		return $this->loadRow(array($data,$data));
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
