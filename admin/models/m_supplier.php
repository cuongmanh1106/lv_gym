<?php
require_once("database.php");

class M_suppliers extends database {

	public function read_all_suppliers(){
		$sql = "select * from suppliers where status = 0 order by id desc" ;
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_supply_by_id($id) {
		$sql = "select * from suppliers where status = 0 and id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	} 

	public function insert_supplier($name,$address,$phone) {
		$sql = "insert into suppliers (name,address,phone,status) values(?,?,?,0)";
		$this->setQuery($sql);
		return $this->execute(array($name,$address,$phone));
	}

	public function update_supplier($name,$address,$phone,$id) {
		$sql = "update suppliers set name = ?, address = ?,phone = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($name,$address,$phone,$id));
	}

	public function delete_supplier($id) {
		$sql = "update suppliers set status = 1 where id = ".$id;
		$this->setQuery($sql);
		return $this->execute();
	}

	public function delete_group_supplier($arrId) {
		$str = implode(",", $arrId);
		$sql = "update suppliers set status = 1 where id IN ($str)";
		$this->setQuery($sql);
		return $this->execute();
	}
}