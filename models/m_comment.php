<?php
require_once("admin/models/database.php");

class M_comment extends database { 

	public function read_comment($id,$vt = -1 ,$limit = 0) {
		$sql = "select * from comments where parent = 0 and pro_id =  ".$id." order by created_at desc ";
		if($vt != -1 && $limit != 0) {
			$sql .= " limit ".$vt.", ".$limit;
		}
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_comment_by_id($id) {
		$sql = "select * from comments where id = ".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function read_all_comment($pro_id) {
		$sql = "select * from comments where parent = 0 and pro_id = ".$pro_id;
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function  read_like($id) {
		$sql = "select * from `like` where comment_id = ".$id;
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_like_by_user($user_id,$cmt_id) {
		$sql = "select * from `like` where user_id = ? and comment_id = ?";
		$this->setQuery($sql);
		return $this->loadAllRows(array($user_id,$cmt_id));
	}

	public function read_sub_comment($parent,$pro_id) {
		$sql = "select * from comments where parent = ? and pro_id = ? order by created_at desc";
		$this->setQuery($sql);
		return $this->loadAllRows(array($parent,$pro_id));
	}

	public function insert_comment($pro_id,$user_id,$comment,$parent){
		$sql = "insert into comments  values(?,?,?,?,?,?,now())";
		$this->setQuery($sql);
		$this->execute(array(null,$pro_id,$user_id,$comment,$parent,0));
		return $this->getLastId();
	}

	public function insert_like($comment_id,$user_id) {
		$sql = "insert into `like` (comment_id,user_id) values(?,?)";
		$this->setQuery($sql);
		return $this->execute(array($comment_id,$user_id));
	}

	public function update_comment($comment_id,$like) {
		$sql = "update comments set like = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($like,$comment_id));
	}

	public function delete_like($comment_id,$user_id) {
		$sql = "delete from `like` where comment_id = ? and user_id = ?";
		$this->setQuery($sql);
		return $this->execute(array($comment_id,$user_id));
	}
}