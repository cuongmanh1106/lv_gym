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
		$sql = "select * from detail_stock where stock_id = ".$stock_id;
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

	public function read_detail_by_stock($stock) {
		$sql = "select * from detail_stock where stock_id = ".$stock;
		$this->setQuery($sql);
		return $this->loadAllRows();
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
 

}