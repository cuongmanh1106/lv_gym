<?php
require_once("database.php");

class M_Categories extends database {

	public function read_all_categories(){
		$sql = "select * from categories where status = 0 order by id asc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}



	public function  read_cate_by_id($id) {
		$sql = "select* from categories where id = ?";
		$this->setQuery($sql);
		return $this->loadRow(array($id));
	}
	public function read_cate_by_parent($id){
		$sql = "select* from categories where parent_id = ? and status = 0";
		$this->setQuery($sql);
		return $this->loadAllRows(array($id));
	}

	public function search_cate($name,$parent){
		$sql = "";
		$sql .= "select * from categories where status = 0 and name like '%".$name."%' ";
		if($parent != "all") {
			$sql .= " and parent_id = ".$parent." ";
		}
		$sql .= "  order by id desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_rand_categories() {
        $sql = "select * from categories where status = 0  order by RAND() limit 4";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

	public function insert_cate($name,$parent_id,$description) {
		$sql = "insert into categories (name, alias, parent_id,description) values(?, ?, ?, ?)";
		$this->setQuery($sql);
		// var_dump($sql);
		return $this->execute(array($name,changeTitle($name),$parent_id,$description));

	}

	public function update_cate($id,$name,$parent_id,$description) {
		$sql = "update categories set name=?,alias=?,parent_id=?, description = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($name,changeTitle($name),$parent_id,$description,$id));
	}

	public function delete_cate($id) {
		$sql = "update categories set status = 1 where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($id));
	}

	public function delete_group($arrId = array()) {
		$str = implode(",",$arrId);
		$sql = "update categories set status = 1 where id IN ($str)";
		$this->setQuery($sql);
		return $this->execute();
	}

}
?>