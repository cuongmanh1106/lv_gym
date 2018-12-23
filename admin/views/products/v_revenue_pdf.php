<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>asda</title>
	<link rel="stylesheet" href="">
</head>

<style type="text/css">

    .detail {
        width: 100%;
        border: 1px solid red;
    } 
    .tb-col {
        margin-right: 100px;
        padding-right: 70px;
    }   
</style>
<body>
	<?php 
	$date = $month = $year = "";
	include("models/m_products.php");
	$m_pro = new M_products();
	if(isset($_POST["date"])) {
		$date = $_POST["date"];
		$products = $m_pro->filter_detail_revenue($date);
	} else if (isset($_POST["month_search"])) {
		$month = $_POST["month_search"];
		$year = $_POST["year_search"];
		$products = $m_pro->filter_revenue_by_month_year($month,$year);
	} else {
		$products = $m_pro->read_top_product();
	}
	
	?>
	<?php if(isset($_POST["date"])) {?>
	<h3 style="text-align: center;color:red">Report revenue for <?php echo $date?></h3>
	<?php } else if(isset($_POST["month_search"])) {?>
	<h3 style="text-align: center;color:red">Report revenue for <?php echo ($month != 0)?$month."/":"" ?><?php echo $year?></h3>
	<?php } else {?>
	<h3 style="text-align: center;color:red">Report top revenue</h3>
	<?php }?>
	<hr style="border:0.5px solid #000">
	<table  border="0" width="100%"  style="width: 100px;" id="table_detail" class="detail" >
		<thead>
			<tr>
				<th class="tb-col">#</th>
				<th class="tb-col">Image</th>
				<th class="tb-col">Name</th>
				<th class="tb-col">Quantity</th>
				<th class="tb-col">Revenue</th>
				<th class="tb-col"></th>
			</tr>

		</thead>
		<tbody>
			<?php
			$total_quantity = 0;
			$total_revenue = 0;
			foreach($products as $key=>$tp): 
				$total_quantity += $tp->quantity;
				$total_revenue += $tp->total;
				?>
				<tr>
					<td><?php echo $key + 1 ?></td>
					<td><img src="public/images/<?php echo $tp->image?>" style="width: 70px;" /></td>
					<td><?php echo $tp->name ?></td>
					<td><?php echo $tp->quantity ?></td>
					<td>$ <?php echo number_format( $tp->total,2) ?></td>
					
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<hr>
	<h4> <b style="color:red">Total Quantity:</b> <?php echo $total_quantity ?></h4>
	<h4> <b style="color:red">Total Revenue:</b>$ <?php echo number_format($total_revenue,2) ?></h4>
</body>
</html>