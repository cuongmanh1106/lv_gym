<?php
require_once("database.php");
class M_products extends database {

	public function read_all_products($vt = -1, $limit = 0) {
		$sql = "select p.*,ca.name as cate_name from products p, (select * from categories where status = 0) ca  where p.cate_id = ca.id and p.status = 0 order by id desc ";
		if($vt != -1 && $limit != 0) {
			$sql .= "limit ".$vt.",".$limit;
		}
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_all_pro() {
		$sql = "select * from products where status != 1 order by id desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_pro_by_sup_id($sup_id) {
		$sql = "select * from products where status != 1 and sup_id = ? order by id desc";
		$this->setQuery($sql);
		return $this->loadAllRows(array($sup_id));
	}

	public function read_product_by_id($id) {
		$sql = "select * from products where id =".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function read_product_by_cate($cate_id,$vt = -1 , $limit = 0) {
		$sql = "select * from products where cate_id = ? where status = 0 order by id desc ";
		if($vt != -1 && $limit != 0) {
			$sql .= " limit ".$vt.",".$limit;
		}
		$this->setQuery($sql);
		return $this->loadAllRows();
	}


	public function read_product_by_arrcate($arrId) {
		$str = implode(",",$arrId);
		$sql = "select * from products where status = 0 and cate_id IN ($str)";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_destroy_products() {
		$sql = "select * from destroy_product order by id desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function chart($year) {
		$sql = "select SUM((o.price - p.price_in)*o.quantity) as total,SUM(o.quantity) as total_quantity, Month(od.updated_at) as month 
			from order_details o,products p, (select * from orders where status = 4  and  Year(updated_at) = ".$year.") od 
			where o.pro_id = p.id and od.id = o.order_id group by Month(od.updated_at)";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function filter_revenue($date) {
		$sql = "select SUM((o.price - p.price_in )*o.quantity) as total , SUM(o.quantity) as total_quantity from order_details o, products p where o.pro_id = p.id and date(o.created_at) = '".$date."' group by date(o.created_at)";
		$this->setQuery($sql);
		// var_dump($sql);
		return $this->loadRow();
	}

	public function filter_detail_revenue($date) {
		$sql = "select p.id as id, p.image as image, p.name as name, p.price as price_out, p.price_in as price_in,o.price as price_sale, SUM(o.quantity) as quantity ,SUM((o.price - p.price_in)*o.quantity) as total 
		FROM order_details o, products p, (select * from orders where status = 4 and date(updated_at) = '".$date."' ) od 
		WHERE o.pro_id = p.id and od.id = o.order_id
		GROUP BY p.id";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function view_list_product_detail_revenue($pro_id,$date) {
		$sql = "select p.image as image, p.name as name, p.price as price_out, p.price_in as price_in,o.price as price_sale, o.quantity as quantity, od.updated_at as created_at
		FROM order_details o, (select * from products where id = ".$pro_id.") p, (select * from orders where status = 4 and date(updated_at) = '".$date."') od 
		WHERE o.pro_id = p.id and od.id = o.order_id";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}


	public function filter_revenue_by_month_year($month,$year) {
		$sql_month = ""; 
		if($month != 0) {
			$sql_month = "and Month(updated_at) = '".$month."' ";
		}
		$sql = "select p.id as id, p.image as image, p.name as name, p.price as price_out, p.price_in as price_in,o.price as price_sale, SUM(o.quantity) as quantity ,SUM((o.price - p.price_in)*o.quantity) as total 
		FROM order_details o, products p, (select * from orders where status = 4 and Year(updated_at) = '".$year."' ".$sql_month .") od 
		WHERE o.pro_id = p.id and od.id = o.order_id  GROUP BY p.id";
		$this->setQuery($sql);
		// var_dump($sql);
		return $this->loadAllRows();
	}

	public function view_list_product_detail_revenue_month_year($pro_id,$month,$year) {
		$sql_month = ""; 
		if($month != 0) {
			$sql_month = "and Month(updated_at) = '".$month."' ";
		}
		$sql = "select p.id as id, p.image as image, p.name as name, p.price as price_out, p.price_in as price_in,o.price as price_sale, o.quantity as quantity, od.updated_at as created_at
		FROM order_details o, (select * from products where id =".$pro_id.") p, (select * from orders where status = 4  and Year(updated_at) = '".$year."' ".$sql_month.") od 
		WHERE o.pro_id = p.id and od.id = o.order_id";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_top_product() {
		$sql ="select products.id, products.name, products.image, order_details.price as price_sale,products.price_in as price_in,SUM(order_details.quantity) as quantity ,SUM((order_details.price - products.price_in)*order_details.quantity) as total 
			FROM products, order_details,orders 
			WHERE products.id = order_details.pro_id and orders.id = order_details.order_id and orders.status = 4
			GROUP BY products.id order by total desc";
		$this->setQuery($sql);
		// var_dump($sql);
		return $this->loadAllRows();
	}
	public function read_inventory() {
		$sql ="select p.id as id, p.name as name, p.image as image, p.quantity as inventory, SUM(dstock.quantity)  as input
				from (select * from products where status = 0) p, (select * from stock_receipt where status = 1) stock, (select * from detail_stock where status != 2) dstock
				where dstock.stock_id = stock.id and dstock.pro_id = p.id group by p.id";
		$this->setQuery($sql);
		// var_dump($sql);
		return $this->loadAllRows();
	}

	public function get_output_quantity($pro_id){
		$sql = "select SUM(detail.quantity) as output
				from (select * from orders where status != 5) o, order_details detail 
				where o.id = detail.order_id and detail.pro_id = ? group by detail.pro_id";
		$this->setQuery($sql);
		$result =  $this->loadRow(array($pro_id));
		if(empty($result)) {
			return 0;
		}
		return $result->output;
	}

	public function get_destroy_quantity($pro_id) {
		$sql = "select SUM(quantity) as destroy
				from destroy_product 
				where pro_id =".$pro_id." group by pro_id";
		$this->setQuery($sql);
		$result = $this->loadRow();
		if(empty($result)) {
			return 0;
		}
		return $result->destroy;
	}

	public function read_detail_inventory($pro_id) {
		$sql = "select SUM(d.quantity) as quantity, o.status as status
				from orders o , (select * from order_details where pro_id = ".$pro_id.") d 
				where o.id = d.order_id  and o.status != 5 group by o.status";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function read_status_by_id($id) {
		$sql = "select * from status where id =".$id;
		$this->setQuery($sql);
		return $this->loadRow();
	}

	public function insert_product($name,$cate_id,$sup_id,$price,$quantity,$size,$image,$sub_image,$intro,$description) {
		$sql = "insert into products(name,alias,cate_id,sup_id,price,quantity,size,image,sub_image,intro,description) values(?,?,?,?,?,?,?,?,?,?,?)";
		$this->setQuery($sql);
		return $this->execute(array($name,changeTitle($name),$cate_id,$sup_id,$price,$quantity,$size,$image,$sub_image,$intro,$description));
	}

	public function insert_product_get_id($name,$cate_id,$sup_id,$price,$price_in,$quantity,$size,$image,$sub_image,$intro,$description,$status) {
		$sql = "insert into products(name,alias,cate_id,sup_id,price,price_in,quantity,size,image,sub_image,intro,description,status) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$this->setQuery($sql);

		$this->execute(array($name,changeTitle($name),$cate_id,$sup_id,$price,$price_in,$quantity,$size,$image,$sub_image,$intro,$description,$status));
		return $this->getLastId();
	}



	public function update_product($name,$cate_id,$sup_id,$price,$quantity,$size,$image,$sub_image,$intro,$description,$id){
		$sql = "update products set name = ?,alias = ?,cate_id =?,sup_id=?, price = ?, quantity = ?, size = ?,image = ?,sub_image = ?,intro = ?,description = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($name,changeTitle($name),$cate_id,$sup_id,$price,$quantity,$size,$image,$sub_image,$intro,$description,$id));
	}
	public function update_sub_image($sub_image,$id) {
		$sql = "update products set sub_image = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($sub_image,$id));
	}

	public function update_size($id,$quantity , $size ) {
		$sql = "update products set size = ?, quantity = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($size,$quantity,$id));
	}

	public function update_quantity($id,$quantity) {
		$sql = "update products set quantity = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($quantity,$id));
	}

	public function delete_product($id) {
		$sql = "update products set status = 1 where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($id));
	}

	public function delete_group($arrId = array()) {
		$str = implode(",",$arrId);
		$sql = "update products set status = 1 where id IN ($str)";
		$this->setQuery($sql);
		return $this->execute();
	}

	


	public function search_product($name,$price_from,$price_to,$cate) {
		$sql = "select * from products where status = 0  ";
		$check = false;
		if($name != '') {
			$sql .= " and name like '%".$name."%' ";
			$check = true;
		}
		if($price_from != '' && $price_to == '') {
			
			$sql .= " and price >= ".$price_from;
		} else if($price_from == '' && $price_to != '') {
			
			$sql .= " and price <= ".$price_to;
		} else if($price_from != '' && $price_to != '') {
			
			$sql .= " and price between ".$price_from." and ".$price_to;
		}
		if($cate != 'all') {
			$this->setQuery("select * from categories where id =".$cate."");
			$category = $this->loadRow();
			if($category->parent_id == 0) { //neu cate la thang  cao nhat thi xuat du lieu cua tat ca cac con cua no
				$this->setQuery("select id from categories where parent_id =".$cate);
				$cates = $this->loadAllRows();
				if(count($cates) != 0) { //neu co con
					$arrId = [];
					$arrId[] = $cate;
					foreach($cates as $c) {
						$arrId[] = $c->id;
					}
					$str = implode(",",$arrId);
					$sql .= " and cate_id IN ($str)";
				} else {
					$sql .= " and cate_id = ".$cate;
				}
			} else {
				$sql .= " and cate_id = ".$cate;
			}			
			
		}

		$sql .= " order by id desc";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	public function update_product_order($quantity,$size,$id) {
		
		$sql = "update products set quantity = ?, size = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($quantity,$size,$id));
	}

	public function update_product_stock($quantity,$size,$price,$price_in,$id) {
		$sql = "update products set quantity = ?, size = ?, price = ?, price_in = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($quantity,$size,$price,$price_in,$id));
	}

	public function update_status($status,$id) {
		$sql = "update products set status = ? where id = ?";
		$this->setQuery($sql);
		return $this->execute(array($status,$id));
	}

	public function insert_destroy_product($user_id,$pro_id,$size,$quantity) {
		$sql = "insert into destroy_product (user_id,pro_id,size,quantity) values(?,?,?,?)";
		$this->setQuery($sql);
		return $this->execute(array($user_id,$pro_id,$size,$quantity));
	}
}