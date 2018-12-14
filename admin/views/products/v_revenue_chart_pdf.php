<DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chart Revenue</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div id="chart-container">
		<div id="graphCanvas"></div>
	</div>

	<script>
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

	</script>
</body>
</html>