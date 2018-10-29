<?php
require_once("database.php");

class M_feedback extends database {

	public function read_all_feedback() {
		$sql = "select * from feedback where status != 2 order by status  asc, id desc ";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_feedback_by_id($id) {
		$sql = "select * from feedback where id = ".$id;
		$this->setQuery($sql);
		$view = $this->loadRow();
		if($view->status == 0) {
			$sql = "update feedback set status = 1 where id =".$id;
			$this->setQuery($sql);
			$this->execute();
		}
		return $view;
	}

	public function delete_feedback($id) {
		$sql = "update feedback set status = 2 where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($id));
	}

	public function delete_group_feedback($id) {
		$str = implode(",", $id);
		$sql = "update feedback set status = 2 where id IN ($str)";
		$this->setQuery($sql);
		return $this->execute();
	}

	public function seen_feedback($id) {
		$sql = "update feedback set status = 1 where id = ".$id;
		$this->setQuery($sql);
		return $this->execute();
	}


}