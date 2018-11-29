<?php
require_once("database.php");
class M_stock_receipt extends database {

	public function read_all_stock(){
		$sql = "select * from stock_receipt where status = 0 order by created_at desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	} 

	public function read_stock_by_id($id) {
		$sql = "select * from stock_receipt where id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
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

	//detail
	public function insert_stock_detail($stock_id,$quantity,$price_in,$size) {
		$sql = "insert into detail_stock (stock_id,quantity,price_in,size) values(?,?,?,?)";
		$this->setQuery($sql);
		return $this->execute(array($stock_id,$quantity,$price_in,$size));
	}
 

}