<?php
require_once("admin/models/database.php");

class M_order extends database {

	public function read_order_by_customer($customer_id) {
		$sql = "select * from orders where customer_id = ".$customer_id ." order by status desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_detail_by_order($order_id) {
		$sql = "select * from order_details where order_id = ".$order_id;
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_new_order(){
		$sql = "select * from orders where status = 1";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_status_by_id($id) {
		$sql = "select * from status where id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}


	public function read_order_by_id($id) {
		$sql = "select * from orders where id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}
	public function insert_order($customer_id,$delivery_place,$area,$delivery_cost,$payment) {
		$sql = "insert into orders (customer_id,delivery_place,area,delivery_cost,payment,status) value(?,?,?,?,?,1) ";
		$this->setQuery($sql);
		$this->execute(array($customer_id,$delivery_place,$area,$delivery_cost,$payment));
		return $this->getLastId();
	}

	public function insert_order_detail($order_id,$pro_id,$price,$size,$quantity) {
		$sql = "insert into order_details (order_id,pro_id,price,size,quantity) value(?,?,?,?,?)";
		$this->setQuery($sql);
		return $this->execute(array($order_id,$pro_id,$price,$size,$quantity));
	}

	public function update_status($status,$id){
		$sql = "update orders set status = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($status,$id));
	}

}