<?php
require_once("database.php");

class M_suppliers extends database {

	public function read_all_suppliers(){
		$sql = "select * from suppliers where status = 0 order by id desc" ;
		$this->setQuery($sql);

		return $this->loadAllRows();
	}

	public function read_supply_by_id($id) {
		$sql = "select * from suppliers where id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	} 

	public function check_uni_name($name,$id = null) {
		$extra_sql = "";
		if($id != null) {
			$extra_sql = " and id != ".$id;
		}
		$sql = "select * from suppliers where name = ? and status = 0 ".$extra_sql;
		$this->setQuery($sql);
		$result = $this->loadRow(array($name));
		if(!empty($result)) {
			return true;
		} 
		return false;
	}
	public function insert_supplier($name,$address,$phone) {
		
		if($this->check_uni_name($name)) {
			return false;
		}
		$sql = "insert into suppliers (name,address,phone,status) values(?,?,?,0)";
		$this->setQuery($sql);
		return $this->execute(array($name,$address,$phone));
	}

	public function update_supplier($name,$address,$phone,$id) {
		if($this->check_uni_name($name,$id)) {
			return false;
		}
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