<?php
include("include/report.php");
?>

<div class="container">
	<?php
	$year = date("Y");

	?>
	<div class="card">
		<div class="card-header badge-info"  style="text-align: center;">
			<h4><i class="fa fa-bar-chart-o"></i> Chart Revenue</h4>
		</div>
		<div class="card-body">
			<select name="year" class="form-control">
				<?php for($i = $year; $i > $year - 5; $i--) {?>
				<option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php } ?>
			</select>
			<div id="chart-container">
				<canvas id="graphCanvas"></canvas>
			</div>

		</div>
		<div class="card">
			<div class="card-header badge-info"  style="text-align: center;">
				<h4><i class="fa fa-search"></i> Filter Revenue By Day</h4>
			</div>
			<div class="card-body">
				<h5 class="card-title">Search Revenue:</h5>
				<div class="row">
					<div class="col-md-4"><input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" name="date"></div>
				</div>
				<br>
				<div id="load_revenue_by_day">
					<?php if(count($products_day) > 0) {?>
					<table class="table table-striped table_load_revenue">
						<thead>
							<tr>
								<th>STT</th>
								<th>Image</th>
								<th>Name</th>
								<th>Price In</th>
								<th>Price Sale</th>
								<th>Quantity</th>
								<th>Revenue</th>
							</tr>

						</thead>
						<tbody>
							<?php
							$total_quantity = 0;
							$total_revenue = 0;
							foreach($products_day as $key=>$tp): 
								$total_quantity += $tp->quantity;
								$total_revenue += ($tp->price_sale-$tp->price_in)*$tp->quantity;
								?>
								<tr>
									<td><?php echo $key + 1 ?></td>
									<td><img src="public/images/<?php echo $tp->image ?>" width="60px"></td>
									<td><?php echo $tp->name ?></td>
									<td>$ <?php echo number_format($tp->price_in,2)?></td>
									<td>$ <?php echo number_format($tp->price_sale,2)?></td>
									<td><?php echo $tp->quantity ?></td>
									<td>$ <?php echo number_format( ($tp->price_sale-$tp->price_in)*$tp->quantity,2) ?></td>

								</tr>
							<?php endforeach ?>
						</tbody>
						
						<tfoot>
							<tr>
								<th colspan="5">Total</th>
								<th><?php echo $total_quantity,2?></th>
								<th>$<?php echo number_format($total_revenue,2) ?></th>
							</tr>
						</tfoot>
					</table>
					<?php } else {?>
					<div class="col-md-8"><b>Revenue:</b>$ 0.00</div>
					<?php }?>
					
				</div>
				
			</div>
		</div>

		<div class="card">
			<div class="card-header badge-info"  style="text-align: center;">
				<h4><i class="fa fa-search"></i> Filter Revenue By Month/Year</h4>
			</div>
			<div class="card-body">
				<h5 class="card-title">Search Revenue:</h5>
				<div class="row">
					<div class="col-md-6">
						<select name="month_search" class="form-control">
							<option value="0">All</option>
							<option value="1">January </option>
							<option value="2">February</option>
							<option value="3">March </option>
							<option value="4">April</option>
							<option value="5">May</option>
							<option value="6">June</option>
							<option value="7">July</option>
							<option value="8">August</option>
							<option value="9">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
						</select>
					</div>

					<div class="col-md-6">
						<select name="year_search" class="form-control">
							<?php for($i = $year; $i > $year - 5; $i--) {?>
							<option value="<?php echo $i ?>"><?php echo $i ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<br>
				<div id="load_revenue_by_month_year">
					<table class="table table-striped table_load_revenue">
						<thead>
							<tr>
								<th>STT</th>
								<th>Image</th>
								<th>Name</th>
								<th>Price In</th>
								<th>Price Sale</th>
								<th>Quantity</th>
								<th>Revenue</th>
							</tr>

						</thead>
						<tbody>
							<?php
							$total_quantity = 0;
							$total_revenue = 0;
							foreach($products_year_month as $key=>$tp): 
								$total_quantity += $tp->quantity;
								$total_revenue += ($tp->price_sale-$tp->price_in)*$tp->quantity;
								?>
								<tr>
									<td><?php echo $key + 1 ?></td>
									<td><img src="public/images/<?php echo $tp->image ?>" width="60px"></td>
									<td><?php echo $tp->name ?></td>
									<td>$ <?php echo number_format($tp->price_in,2)?></td>
									<td>$ <?php echo number_format($tp->price_sale,2)?></td>
									<td><?php echo $tp->quantity ?></td>
									<td>$ <?php echo number_format( ($tp->price_sale-$tp->price_in)*$tp->quantity,2) ?></td>

								</tr>
							<?php endforeach ?>
						</tbody>
						
						<tfoot>
							<tr>
								<th colspan="5">Total</th>
								<th><?php echo $total_quantity,2?></th>
								<th>$<?php echo number_format($total_revenue,2) ?></th>
							</tr>
						</tfoot>
					</table>


					
				</div>
				
			</div>
		</div>



		<div class="card">
			<div class="card-header badge-info"  style="text-align: center;">
				<h4><i class="fa fa-list-ol"></i> Top products</h4>
			</div>
			<div class="card-body">
				<table class="table table-striped table_top_product">
					<thead>
						<tr>
							<th>STT</th>
							<th>Image</th>
							<th>Name</th>
							<th>Price In</th>
							<th>Price Sale</th>
							<th>Times order</th>
							<th>Revenue</th>
						</tr>

					</thead>
					<tbody>
						<?php foreach($top_product as $key=>$tp): ?>
							<tr>
								<td><?php echo $key + 1 ?></td>
								<td><img src="public/images/<?php echo $tp->image ?>" width="60px"></td>
								<td><?php echo $tp->name ?></td>
								<td>$ <?php echo number_format($tp->price_in,2)?></td>
								<td>$ <?php echo number_format($tp->price_sale,2)?></td>
								<td><?php echo $tp->quantity ?></td>
								<td>$ <?php echo number_format($tp->total,2) ?></td>

							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function(){
		$('.table_load_revenue').DataTable({
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		})

	})
</script>
<script type="text/javascript">

	$(document).ready(function(){
		$('.table_top_product').DataTable({
            // "aaSorting":[[2,"asc"]]
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        })



	})
	
	$(document).ready(function(){

		var chart = {"1":0,"2":0,"3":0,"4":0,"5":0,"6":0,"7":0,"8":0,"9":0,"10":0,"11":0,"12":0};
		var month = [];
		var total = [];
		$.ajax({
			type:'POST',
			url:'ajax.php',
			data:{'chart':'OK'},
			dataType:'json',
			success:function(data){
				console.log(data);
				
				$.each(chart,function(k,v){
					check = true;
					$.each(data,function(kdata,vdata){
						if(vdata.month == k) {
							month.push(parseInt(k));
							total.push(vdata.total)
							check = false;
						}
					}) 
					if(check) {
						month.push(parseInt(k));
						total.push(0);
					}
				})

				var chardata = {
					labels :month,
					datasets :[
					{
						label: 'Avenue',
						backgroundColor: '#49e2ff',
						borderColor: '#46d5f1',
						hoverBackgroundColor: '#CCCCCC',
						hoverBorderColor: '#666666',
						data: total
					}]
				};
				var ctx = $("#graphCanvas");
				var barGraph = new Chart(ctx,{
					type:'bar',
					data:chardata
				})
				
			}
		})



	})


	$('input[name=date]').on('change',function(){
		date = $('input[name=date]').val();

		$.ajax({
			type:'POST',
			url :'ajax.php',
			data:{'date':date,'filter_revenue':'OK'},
			success:function(data){
				if(data.trim() == '') {
					$('#load_revenue_by_day').html('<div class="col-md-8"><b>Revenue:</b>$ 0.00</div>');

				} else {
					$('#load_revenue_by_day').html(data);
				}
			}
		})
	})

	$('select[name=month_search], select[name=year_search]').on('change',function(){
		month = $('select[name=month_search]').val();
		year = $('select[name=year_search]').val();
		$.ajax({
			type:'POST',
			url:'ajax.php',
			data:{'month':month,'year':year,'load_revenue_by_month_year':'OK'},
			success:function(data) {
				if(data.trim() == "") {
					$('#load_revenue_by_month_year').html('<div class="col-md-8"><b>Revenue:</b>$ 0.00</div>');

				} else {
					$('#load_revenue_by_month_year').html(data);
				}
			}
		})
	})

	$('select[name=year]').on('change',function(){
		var chart = {"1":0,"2":0,"3":0,"4":0,"5":0,"6":0,"7":0,"8":0,"9":0,"10":0,"11":0,"12":0};
		var month = [];
		var total = [];
		year = $('select[name=year]').val();
		$.ajax({
			type:'POST',
			url:'ajax.php',
			data:{'year':year,'chart':'OK'},
			dataType:'json',
			success:function(data){
				console.log(data);
				$.each(chart,function(k,v){
					check = true;
					$.each(data,function(kdata,vdata){
						if(vdata.month == k) {
							month.push(parseInt(k));
							total.push(vdata.total)
							check = false;
						}
					}) 
					if(check) {
						month.push(parseInt(k));
						total.push(0);
					}
				})

				var chardata = {
					labels :month,
					datasets :[
					{
						label: 'Player Score',
						backgroundColor: '#49e2ff',
						borderColor: '#46d5f1',
						hoverBackgroundColor: '#CCCCCC',
						hoverBorderColor: '#666666',
						data: total
					}]
				};
				var ctx = $("#graphCanvas");
				var barGraph = new Chart(ctx,{
					type:'bar',
					data:chardata
				})
				
			}
		})
	})
</script>