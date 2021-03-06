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
				<form method="POST" action="products_chart_pdf.php">
				<span style = "font-weight: 500; font-size:1.1rem"><i class="fa fa-search"></i> Filter Revenue By Day <span><button type="submit" style="float:right" class="btn btn-success">Export PDF</button></span></span>
				
			</div>
			<div class="card-body">
				<h5 class="card-title">Search Revenue:</h5>
				<div class="row">
					<div class="col-md-4"><input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" name="date"></div>
				</div>
				<br>
				</form>
				<div id="load_revenue_by_day">
					<?php if(count($products_day) > 0) {?>
					<table class="table table-striped table_load_revenue">
						<thead>
							<tr>
								<th>#</th>
								<th>Image</th>
								<th>Name</th>
								<th>Quantity</th>
								<th>Revenue</th>
								<th></th>
							</tr>

						</thead>
						<tbody>
							<?php
							$total_quantity = 0;
							$total_revenue = 0;
							foreach($products_day as $key=>$tp): 
								$total_quantity += $tp->quantity;
								$total_revenue += $tp->total;
								?>
								<tr>
									<td><?php echo $key + 1 ?></td>
									<td><img src="public/images/<?php echo $tp->image ?>" width="60px"></td>
									<td><?php echo $tp->name ?></td>
									<td><?php echo $tp->quantity ?></td>
									<td>$ <?php echo number_format( $tp->total,2) ?></td>
									<td> <a href="#view_detail" data-type="d" data-toggle="modal" data-proid="<?php echo $tp->id?>" class="btn btn-warning"> <i class="fa fa-eye"></i> View detail</a> </td>
								</tr>
							<?php endforeach ?>
						</tbody>
						
						<tfoot>
							<tr>
								<th colspan="3">Total</th>
								<th><?php echo $total_quantity?></th>
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
				<form method="POST" action="products_chart_pdf.php">
				<span style = "font-weight: 500; font-size:1.1rem"><i class="fa fa-search"></i> Filter Revenue By Day <span><button type="submit" style="float:right" class="btn btn-success">Export PDF</button></span></span>
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
				</form>
				<div id="load_revenue_by_month_year">
					<table class="table table-striped table_load_revenue">
						<thead>
							<tr>
								<th>#</th>
								<th>Image</th>
								<th>Name</th>
								<th>Quantity</th>
								<th>Revenue</th>
								<th></th>
							</tr>

						</thead>
						<tbody>
							<?php
							$total_quantity = 0;
							$total_revenue = 0;
							foreach($products_year_month as $key=>$tp): 
								$total_quantity += $tp->quantity;
								$total_revenue += $tp->total;
								?>
								<tr>
									<td><?php echo $key + 1 ?></td>
									<td><img src="public/images/<?php echo $tp->image ?>" width="60px"></td>
									<td><?php echo $tp->name ?></td>
									<td><?php echo $tp->quantity ?></td>
									<td>$ <?php echo number_format( $tp->total,2) ?></td>
									<td> <a href="#view_detail" data-type="my" data-toggle="modal" data-proid="<?php echo $tp->id?>" class="btn btn-warning"> <i class="fa fa-eye"></i> View detail</a> </td>
								</tr>
							<?php endforeach ?>
						</tbody>
						
						<tfoot>
							<tr>
								<th colspan="3">Total</th>
								<th><?php echo $total_quantity?></th>
								<th>$<?php echo number_format($total_revenue,2) ?></th>
								<th></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>



		<div class="card">
			<div class="card-header badge-info"  style="text-align: center;">
				<form method="POST" action="products_chart_pdf.php">
				<span style = "font-weight: 500; font-size:1.1rem"><i class="fa fa-search"></i> Top Revenue <span><button  type="submit" style="float:right" class="btn btn-success">Export PDF</button></span></span>
				</form>
			</div>
			<div class="card-body">
				<table class="table table-striped table_top_product">
					<thead>
						<tr>
							<th>#</th>
							<th>Image</th>
							<th>Name</th>
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
								<td><?php echo $tp->quantity ?></td>
								<td>$ <?php echo number_format($tp->total,2) ?></td>

							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="card">
			<div class="card-header badge-info"  style="text-align: center;">
				<form method="POST" action="products_chart_pdf.php">
				<span style = "font-weight: 500; font-size:1.1rem"><i class="fa fa-search"></i> Inventory Report <span><button  type="submit" style="float:right" class="btn btn-success">Export PDF</button></span></span>
				</form>
			</div>
			<div class="card-body">
				<table class="table table-striped table_top_product">
					<thead>
						<tr>
							<th>#</th>
							<th>Image</th>
							<th>Name</th>
							<th>Input</th>
							<th>Output</th>
							<th>Destroy</th>
							<th>Inventory</th>
							<th>Action</th>
						</tr>

					</thead>
					<tbody>
						<?php foreach($inventory as $key=>$tp): 

						$output = $m_pro->get_output_quantity($tp->id);
						$destroy = $m_pro->get_destroy_quantity($tp->id);

						?>
							<tr>
								<td><?php echo $key + 1 ?></td>
								<td><img src="public/images/<?php echo $tp->image ?>" width="60px"></td>
								<td><?php echo $tp->name ?></td>
								<td><?php echo $tp->input ?></td>
								<td><?php echo $output ?></td>
								<td><?php echo $destroy?></td>
								<td><?php echo $tp->inventory?></td>
								<td><a href="#view_detail" data-type="inventory" data-toggle="modal" data-proid="<?php echo $tp->id?>" class="btn btn-warning"> <i class="fa fa-eye"> View Detail Output</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="view_detail" class="modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header  badge-info">
				<h4 class="modal-title custom_align" id="Heading" style="text-align: left">
					<i class="fa fa-plus MarginRight-10"></i>
				View Detail Revenue</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">

				<div id="content_view_detail">

				</div>

			</div>
			<div class="modal-footer ">
				<button type="button" class="btn btn-danger" data-dismiss="modal">
					<i class="fa fa-reply icon"></i> Close</button>
				</div>
			</form>
		</div>

	</div>
</div>
<script type="text/javascript">
	$('button[name=reset]').on('click',function(){
		$('input[name=name]').val('');
		$('#editor1').val('');

	})
</script>


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
					$('.table_load_revenue').DataTable();
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
					$('.table_load_revenue').DataTable();
				}
			}
		})
	})

	$(document).on('show.bs.modal','#view_detail',function(e){
		pro_id = $(e.relatedTarget).data('proid');
		date = $('input[name=date]').val();
		type = $(e.relatedTarget).data('type');
		month = $('select[name=month_search]').val();
		year = $('select[name=year_search]').val();
		$.ajax({
			type:'POST',
			url:'ajax.php',
			data:{'pro_id':pro_id,'date':date,'month':month,'year':year,'type':type,'view_detail_date':'OK'},
			success:function(data) {
				$(e.currentTarget).find('#content_view_detail').html(data);
				$('.table_load_view_detail_revenue').DataTable();
				
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
</script>