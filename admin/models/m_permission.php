<?php
require_once("database.php");

class M_permission extends database {

	public function read_all_permission() {
		$sql = "select * from permission ";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_permission_by_id($id) {
		$sql = "select * from permission where id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function read_group_permission_by_id($id) {
		$sql = "select * from group_permission where per_id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function insert_permission($name) {
		$sql = "insert into permission (name) values(?)";
		$this->setQuery($sql);
		return $this->execute(array($name));
	}


	public function insert_group_permission($per_id,$list_product,$insert_product,$edit_product,$delete_product,$list_category,$insert_category,$edit_category,$delete_category,$list_user,$insert_user,$edit_user,$delete_user,$list_permission,$insert_permission,$edit_permission,$delete_permission,$list_order,$edit_order,$list_ship,$edit_ship){
		$sql = "insert into group_permission (per_id,list_product,insert_product,edit_product,delete_product,list_category,insert_category,edit_category,delete_category,list_user,insert_user,edit_user,delete_user,list_permission,insert_permission,edit_permission,delete_permission,list_order,edit_order,list_ship,edit_ship) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$this->setQuery($sql);
		return $this->execute(array($per_id,$list_product,$insert_product,$edit_product,$delete_product,$list_category,$insert_category,$edit_category,$delete_category,$list_user,$insert_user,$edit_user,$delete_user,$list_permission,$insert_permission,$edit_permission,$delete_permission,$list_order,$edit_order,$list_ship,$edit_ship));
	}

	public function update_group_permission($list_product,$insert_product,$edit_product,$delete_product,$list_category,$insert_category,$edit_category,$delete_category,$list_user,$insert_user,$edit_user,$delete_user,$list_permission,$insert_permission,$edit_permission,$delete_permission,$list_order,$edit_order,$list_ship,$edit_ship,$per_id) {
		$sql = "update group_permission set list_product = ?,insert_product =?,edit_product =?,delete_product=?,list_category=?,insert_category=?,edit_category=?,delete_category=?,list_user=?,insert_user=?,edit_user=?,delete_user=?,list_permission=?,insert_permission=?,edit_permission=?,delete_permission=?,list_order=?,edit_order=?,list_ship=?,edit_ship=? where per_id = ?";
		$this->setQuery($sql);
		return $this->execute(array($list_product,$insert_product,$edit_product,$delete_product,$list_category,$insert_category,$edit_category,$delete_category,$list_user,$insert_user,$edit_user,$delete_user,$list_permission,$insert_permission,$edit_permission,$delete_permission,$list_order,$edit_order,$list_ship,$edit_ship,$per_id));
	}

	function check_permission($controller){
		$sql = "select * from group_permission where per_id =".$_SESSION["user"]->permission_id;
		$this->setQuery($sql);
		$result = $this->loadRow();
		if($result == null) return 0;
		return $result->$controller;
	}


}