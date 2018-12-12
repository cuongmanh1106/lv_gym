<?php
require_once("database.php");

class M_orders extends database {

	public function read_all_orders(){
		$sql = "select * from orders order by status asc, created_at desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_new_order() {
		$sql = "select * from orders where status = 1";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_order_by_id($id) {
		$sql = "select * from orders where id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function read_status() {
		$sql = "select * from status";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_status_by_id($id){
		$sql = "select * from status where id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function read_detail_by_id($id) {
		$sql = "select * from order_details where order_id = ".$id;
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function search_orders($order_number,$cus,$status,$date_from,$date_to) {
		$sql = "select * from orders where created_at != '' ";
		if($order_number != '') {
			$sql .= " and id like '%".$order_number."%'";
		} 
		if($cus != "all"){
			$sql .=" and customer_id = ".$cus ;
		}
		if($status != 'all') {
			$sql .= " and status = ".$status;
		}
		if($date_from != '' && $date_to == '') {
			$sql .= " and created_at >= '".$date_from."'";
		} else if($date_from == '' && $date_to != '') {
			$sql .= " and created_at >= '".$date_to."'";
		} else if($date_from != '' && $date_to != '') {
			$sql .= "and created_at >= '".$date_from."' and created_at <= '".$date_to."'";
		}

		$sql .= " order by status asc, created_at desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function update_order($delivery_place,$delivery_cost,$status,$id) {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$now = new DateTime();
		$now =  $now->format('Y-m-d H:i:s');    // MySQL datetime format
		var_dump($now);
		$sql = "update orders set delivery_place = ?, delivery_cost = ?, status =?, updated_at = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($delivery_place,$delivery_cost,$status,$now,$id));
	}
	public function update_status($status,$id) {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$now = new DateTime();
		$now =  $now->format('Y-m-d H:i:s');    // MySQL datetime format
		$sql = "update orders set status =?, updated_at = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($status,$now,$id));
	}

	//ship

	public function read_shipper() {
		$sql = "select * from ship order by status asc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_ship(){
		$sql = "select * from ship where user_id = ? order by status asc";
		$this->setQuery($sql);
		return $this->loadAllRows(array($_SESSION["user"]->id));
	}
	public function read_shipper_by_order_id($id) {
		$sql = "select * from ship where order_id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function search_ship($order_id,$user_id,$status) {
		$sql = "select * from ship where status != 5 ";
		if($order_id != '') {
			$sql .= " and order_id like '%".$order_id."%'";
		}
		if($user_id != 'all') {
			$sql .= "and user_id = ".$user_id;
		}
		if($status != 'all') {
			$sql .= "and status = ".$status;
		}
		$sql .= " order by status asc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}
	public function update_ship($status,$id){
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$now = new DateTime();
		$now =  $now->format('Y-m-d H:i:s');    // MySQL datetime format
		$sql = "update ship set status = ?, updated_at = ? where order_id = ?";
		$this->setQuery($sql);
		return $this->execute(array($status,$now,$id));
	}

	public function update_shipper($user_id,$id) {
		$sql = "update ship set user_id = ? where order_id = ?";
		$this->setQuery($sql);
		return $this->execute(array($user_id,$id));
	}

	public function insert_ship($user_id,$order_id) {
		$sql = "insert into ship (user_id,order_id) values(?,?)";
		$this->setQuery($sql);
		return $this->execute(array($user_id,$order_id));
	}
	/*end ship*/



}