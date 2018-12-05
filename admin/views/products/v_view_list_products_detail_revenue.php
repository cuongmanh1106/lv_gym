					<table class="table table-striped table_load_view_detail_revenue">
						<thead>
							<tr>
								<th>#</th>
								<th>Date</th>
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
							foreach($products as $key=>$tp): 
								$total_quantity += $tp->quantity;
								$total_revenue += ($tp->price_sale-$tp->price_in)*$tp->quantity;
								?>
								<tr>
									<td><?php echo $key + 1 ?></td>
									<td><?php echo $tp->created_at?></td>
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
								<th colspan="6">Total</th>
								<th><?php echo $total_quantity?></th>
								<th>$<?php echo number_format($total_revenue,2) ?></th>
							</tr>
						</tfoot>
					</table>


					