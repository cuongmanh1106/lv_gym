					<table class="table table-striped table_load_view_detail_revenue">
						<thead>
							<tr>
								<th>#</th>
								<th>Status</th>
								<th>Quantity</th>
								
							</tr>

						</thead>
						<tbody>
							<?php
							
							foreach($products as $key=>$tp): 
								$status = $m_pro->read_status_by_id($tp->status);
								?>
								<tr>
									<td><?php echo $key + 1 ?></td>
									<td><?php echo $status->name?></td>
									<td><?php echo $tp->quantity?></td>
									

								</tr>
							<?php endforeach ?>
						</tbody>
						
						
					</table>


					