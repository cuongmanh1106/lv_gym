<?php
require_once("admin/models/database.php");

class M_account extends database { 

	public function insert_user($first_name,$last_name,$email,$password,$image,$permission_id,$phone_number,$address) {
		$sql = "insert into users (first_name,last_name,email,password,image,permission_id,phone_number,address) value(?,?,?,?,?,?,?,?)";
		$this->setQuery($sql);
		return $this->execute(array($first_name,$last_name,$email,$password,$image,$permission_id,$phone_number,$address));
	}

	public function check_login($email,$password){
		$sql = "select * from users where email = ? and permission_id = 4  ";
		$this->setQuery($sql);
		$us = $this->loadRow(array($email)); 
		if(!empty($us) && password_verify($password,$us->password)) {
			return $us;
		}
		return 'wrong';
	}

	public function read_user_by_id($id) {
		$sql = "select * from users where id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function update_user($first_name,$last_name,$phone_number,$address,$image, $id) {
		$sql = "update users set first_name = ?, last_name = ?, phone_number = ?, address = ?, image = ? where id = ?";
		// var_dump($first_name." ".$last_name." ".$phone_number." ".$address." ".$image." ".$id);
		$this->setQuery($sql);
		return $this->execute(array($first_name,$last_name,$phone_number,$address,$image, $id));
	}

	public function update_password($password,$id) {
		$sql = "update users set password = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($password,$id));
	}
}