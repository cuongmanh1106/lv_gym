


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
				<h4><i class="fa fa-search"></i> Filter Revenue</h4>
			</div>
			<div class="card-body">
				<h5 class="card-title">Search Revenue:</h5>
				<div class="row">
					<div class="col-md-4"><input class="form-control" type="date" name="date"></div>
					<div class="col-md-8"><b>Revenue:</b> <span id="revenue"></span></div>
				</div>
			</div>
		</div>



		<div class="card">
			<div class="card-header badge-info"  style="text-align: center;">
				<h4><i class="fa fa-list-ol"></i> Top products</h4>
			</div>
			<div class="card-body">
				<h5 class="card-title" style="text-align: center;">Top 10</h5>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>STT</th>
							<th>Image</th>
							<th>Name</th>
							<th>Price</th>
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
								<td>$ <?php echo number_format($tp->price,2)?></td>
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



<script type="text/javascript">
	
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


	$('input[name=date]').on('change',function(){
		date = $('input[name=date]').val();

		$.ajax({
			type:'POST',
			url :'ajax.php',
			data:{'date':date,'filter_revenue':'OK'},
			success:function(data){
				if(data.trim() == '') {
					data = '0';
				}
				$('#revenue').html("$ "+data.trim());
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