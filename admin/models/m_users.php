<?php
require_once("database.php");

class M_users extends database {

	public function read_all_user() {
		$sql = "select * from users where status  = 0 and permission_id != 4 order by  id desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_customer() {
		$sql = "select * from users where status = 0 and permission_id = 4 ";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_user_by_permission($permission) {
		$sql = "select * from users where status = 0 and permission_id = ".$permission;
		$this->setQuery($sql);
		return $this->loadAllRows();
	}


	public function read_user_by_id($id) {
		$sql = "select * from users where id = ?";
		$this->setQuery($sql);
		return $this->loadRow(array($id));
	}

	public function read_permission() {
		$sql = "select * from permission where id != 4 order by id desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_permission_by_id($id) {
		$sql ="select * from permission where id = ? ";
		$this->setQuery($sql);
		return $this->loadRow(array($id));
	}

	public function check_email ($email) {
		$sql = "select * from users where email = ?";
		$this->setQuery($sql);
		return $this->loadRow(array($email));
	}

	public function insert_user($first_name,$last_name,$email,$password,$image,$permission_id,$phone_number,$address) {
		$sql = "insert into users (first_name,last_name,email,password,image,permission_id,phone_number,address) value(?,?,?,?,?,?,?,?)";
		$this->setQuery($sql);
		return $this->execute(array($first_name,$last_name,$email,$password,$image,$permission_id,$phone_number,$address));
	}

	public function check_login($email,$password){
		$sql = "select * from users where email = ? and permission_id != 4 and status = 0  ";
		$this->setQuery($sql);
		$us = $this->loadRow(array($email)); 
		if(!empty($us) && password_verify($password,$us->password)) {
			return $us;
		}
		return 'wrong';
	}

	public function update_user($first_name,$last_name,$phone_number,$address,$image, $id) {
		$sql = "update users set first_name = ?, last_name = ?, phone_number = ?, address = ?, image = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($first_name,$last_name,$phone_number,$address,$image, $id));
	}

	public function update_password($password,$id) {
		$sql = "update users set password = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($password,$id));
	}

	public function delete_user($id){
		$sql = "update users set status = 1 where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($id));
	}

	public function delete_group_user($arrId) {
		$str = implode(",", $arrId);
		$sql = "update users set status = 1 where id IN ($str)";
		$this->setQuery($sql);
		return $this->execute();
	}

	public function search_user($name,$permission) {
		$sql = "select * from users where status = 0 and permission_id != 4 ";
		if($name != ''){
			$sql .= " and (last_name like '%".$name."%' or first_name like '%".$name."%') ";
		} 
		if ($permission != "all") {
			$sql .= " and permission_id = ".$permission;
		}
		$sql .= " order by id desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function search_customer($name) {
		$sql = "select * from users where status = 0 and permission_id = 4 ";
		if($name != ''){
			$sql .= " and (last_name like '%".$name."%' or first_name like '%".$name."%') ";
		} 
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function edit_perrmision($id,$permission_id) {
		$sql = "update users set permission_id =? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($permission_id,$id));
	}


}