<?php
require_once("admin/models/database.php");

class M_Category extends database {
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
		$sql = "select* from categories where parent_id = ?";
		$this->setQuery($sql);
		return $this->loadAllRows(array($id));
	}

	public function read_top_view_cate() {

		$sql = "SELECT c.id,c.name as cate_name,c.parent_id, p.name as product_name, p.image,p.view FROM `categories` c INNER JOIN products p ON c.id = p.cate_id
GROUP by c.id, c.name,c.parent_id , p.name, p.image, p.view
having p.view >= ALL (SELECT max(view) FROM products p1 where p1.cate_id = c.id)";
 		$this->setQuery($sql);
 		return $this->loadAllRows();


	}
}