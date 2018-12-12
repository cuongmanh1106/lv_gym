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
							foreach($products as $key=>$tp): 
								$total_quantity += $tp->quantity;
								$total_revenue += $tp->total;
								?>
								<tr>
									<td><?php echo $key + 1 ?></td>
									<td><img src="public/images/<?php echo $tp->image ?>" width="60px"></td>
									<td><?php echo $tp->name ?></td>
									<td><?php echo $tp->quantity ?></td>
									<td>$ <?php echo number_format( $tp->total,2) ?></td>
									<td> <a href="#view_detail" data-type="<?php echo $type?>" data-toggle="modal" data-proid="<?php echo $tp->id?>" class="btn btn-warning"> <i class="fa fa-eye"></i> View detail</a> </td>
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