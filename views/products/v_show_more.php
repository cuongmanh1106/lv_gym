<!--Danh sách comment-->
<?php
foreach($comments as $cmt) {
  $cus = $m_account->read_user_by_id($cmt->user_id);

                $count_like = count($m_comment->read_like($cmt->id)); //count(DB::table('like')->where('comment_id',$cmt->id)->get()); // số lượng lượt thích 

                ?>
                <!--Thuc hien nhung chuc nang khi dang nhap-->
                <?php
                if(isset($_SESSION["customer"])) {
                	$like = count($m_comment->read_like_by_user($_SESSION["customer"]->id,$cmt->id));
                	?>
                	<div class="row" style="margin-top: 40px">
                		<input type="hidden" name="id_cmt" value="<?php echo $cmt->id ?>">
                		<div class="col-md-1"><img src="admin/public/images/<?php echo ($cus->image!='')?$cus->image:'us.png' ?>" width="60px"></div>
                		<div class="col-md-11">
                			<h4><b><?php echo $cus->last_name ?></b></h4>
                			<p><?php echo $cmt->comment ?></p>
                			<div>
                				<?php if($like == 0) {?> <!--Chưa like-->
                				<a href="javascript:void(0)" class="like" data-index="<?php echo $cmt->id ?>" style="color:blue"> Like </a>-
                				<?php } else {?>
                				<a href="javascript:void(0)" class="dislike" data-index="<?php echo $cmt->id ?>" style="color:red"> Dislike </a>-
                				<?php } ?> <!--đã like-->
                				<a href="javascript:void(0)" class="rep" style="color:blue"> Reply </a>-
                				<span> <i style="color:blue" class="fa fa-thumbs-o-up"></i><span class="count_like" data-index="<?php echo $count_like ?>"> <?php echo ($count_like==0)?'':$count_like ?></span></span>-
                				<span> <?php ?> </span>
                			</div>
                		</div>

                		<div class="clearfix"></div>
                		<div class="sub-comment">
                			<?php
                			$sub_comment = $m_comment->read_sub_comment($cmt->id,$product->id);

                			?>
                			<!-- load sub comment -->
                			<?php
                			foreach($sub_comment as $s) {
                				$sub_cus = $m_account->read_user_by_id($s->user_id);
                        $count_sub_like = count($m_comment->read_like($s->id));  //Tổng like của sub_comment
                        $sub_like = count($m_comment->read_like_by_user($_SESSION["customer"]->id,$s->id));  // = 1 đã like | 0 chưa like
                        ?>
                        <div style="padding:  30px 0px 30px 60px" >
                        	<div class="col-md-1"><img src="admin/public/images/<?php echo ($sub_cus->image!='')?$sub_cus->image:'us.png' ?>" width="60px"></div>
                        	<div class="col-md-11">
                        		<h4><b><?php echo $sub_cus->last_name  ?></b></h4>
                        		<p><?php echo $s->comment?></p>
                        		<div>

                        			<?php if($sub_like == 0) {?>
                        			<a href="javascript:void(0)" class="like" data-index="<?php echo $s->id ?>" style="color:blue"> Like </a>-
                        			<?php } else {?>
                        			<a href="javascript:void(0)" class="dislike" data-index="<?php echo $s->id ?>" style="color:red"> Dislike </a>-
                        			<?php }?>

                        			<a href="javascript:void(0)" class="sub_rep" style="color:blue"> Reply </a>-
                        			<input type="hidden" value="<?php echo $sub_cus->last_name ?>" name="sub_user">
                        			<span> <i style="color:blue" class="fa fa-thumbs-o-up"></i> <span class="count_like" data-index="<?php echo $count_sub_like ?>"> <?php echo ($count_sub_like==0)?'':$count_sub_like ?></span></span>-
                        			<span> <?php ?></span>
                        		</div>
                        	</div>
                        </div>

                        <div class="clearfix"></div>
                        <?php } ?> <!--endforeach cua sub_comment-->
                        <div class="add_sub_comment hidden" style="padding:  30px 0px 30px 60px"> <!-- form cho add sub comment -->
                        	<div class="col-md-1"><img src="admin/public/images/<?php echo (isset($_SESSION["customer"]) && $_SESSION["customer"]->image!='')?$_SESSION["customer"]->image:'us.png' ?>" width="60px"></div>
                        	<div class="col-md-11">
                        		<textarea name="sub_cmt" class="form-control" placeholder=" Your Comment..."></textarea>
                        		<div style="width: 100%; text-align: right; background: #fff; border-radius: 4px">
                        			<a href="javascript:void()" style="text-align: right;" class="add_sub_cmt btn btn-success  <?php echo (!isset($_SESSION["customer"]))?'disabled':''?>">Post</a>
                        		</div>
                        	</div>
                        </div>
                    </div>

                </div>
                
                <div class="clearfix"></div>
                <?php } else {?> <!--Thuc hien nhung chuc nang khi chua dang nhap-->
                <div class="row" style="margin-top: 40px">
                	<input type="hidden" name="id_cmt" value="<?php echo $cmt->id ?>">
                	<div class="col-md-1"><img src="admin/public/images/<?php echo ($cus->image!='')?$cus->image:'us.png' ?>" width="60px"></div>
                	<div class="col-md-11">
                		<h4><b><?php echo $cus->last_name ?></b></h4>
                		<p><?php echo $cmt->comment ?></p>
                		<div>

                			<a href="javascript:void(0)" class="like" data-index="<?php echo $cmt->id ?>" style="color:blue"> Like </a>-
                			<a href="javascript:void(0)" class="rep" style="color:blue"> Reply </a>-
                			<span> <i style="color:blue" class="fa fa-thumbs-o-up"></i> <?php echo ($count_like==0)?'':$count_like ?></span>-
                			<span> <?php  ?> </span>
                		</div>
                	</div>

                	<div class="clearfix"></div>
                	<div class="sub-comment">
                		<?php
                		$sub_comment = $m_comment->read_sub_comment($cmt->id,$product->id);
                		?>
                		<?php
                		foreach($sub_comment as $s) {
                			$sub_cus = $m_account->read_user_by_id($s->user_id);
                        $count_sub_like = count($m_comment->read_like($s->id));  //Tổng like của sub_comment

                        ?>
                        <div style="padding:  30px 0px 30px 60px" >
                        	<div class="col-md-1"><img src="admin/public/images/<?php echo ($sub_cus->image!='')?$sub_cus->image:'us.png' ?>" width="60px"></div>
                        	<div class="col-md-11">
                        		<h4><b><?php echo $sub_cus->last_name   ?></b></h4>
                        		<p><?php echo $s->comment ?></p>
                        		<div>
                        			<a href="javascript:void(0)" class="like" style="color:blue"> Like </a>-
                        			<a href="javascript:void(0)" class="sub_rep" style="color:blue"> Reply </a>-
                        			<input type="hidden" value="<?php echo $sub_cus->last_name ?>" name="sub_user">
                        			<span> <i style="color:blue" class="fa fa-thumbs-o-up"></i>  <?php echo ($count_like==0)?'':$count_like ?></span>-
                        			<span> <?php ?> </span>
                        		</div>
                        	</div>
                        </div>

                        <div class="clearfix"></div>
                        <?php } ?> <!--endforeach sub comment-->
                        <div class="add_sub_comment hidden" style="padding:  30px 0px 30px 60px"> <!-- Form reply -->
                        	<div class="col-md-1"><img src="admin/public/images/<?php echo ( isset($_SESSION["customer"]) && $_SESSION["customer"]->image!='')?$_SESSION["customer"]->image:'us.png' ?>" width="60px"></div>
                        	<div class="col-md-11">
                        		<textarea name="sub_cmt" class="form-control" placeholder=" Your Comment..."></textarea>
                        		<div style="width: 100%; text-align: right; background: #fff; border-radius: 4px">
                        			<a href="javascript:void()" style="text-align: right;" class="add_sub_cmt btn btn-success  <?php echo (!isset($_SESSION["customer"]))?'disabled':''?>">Post</a>
                        		</div>
                        	</div>
                        </div>
                    </div>

                </div>
                
                <div class="clearfix"></div>
                <?php } ?>

                <?php } ?> <!--endforeach-->
                
                <input type="hidden" name="show_more" value="<?php echo count($comments) ?>">