<?php
require_once("database.php");

class M_other extends database {

	public function read_new_order(){
		$sql = "select * from orders where status = 1";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_new_feedback() {
		$sql = "select * from feedback where status = 0";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_current_promotion($data) {
		$sql = "select * from feedback where status = 0 and date_from <= ? and date_to >= ?";
		$this->setQuery($sql);
		return $this->loadRow(array($data,$data));
	}

}
