<?php $promotion_price = 0;
$promotion = $m_promotion->get_promotion_price($product->id);
if($promotion != 0) {
  $promotion_price = $promotion->price;
}   

$front = "$";
$back = "";
$price = $product->price;
if(isset($_SESSION["vn"])) {
  $front = "";
  $back = " VND";
  $price = $product->price*$_SESSION["vn"];
  if($promotion != 0) {
    $promotion_price = $promotion->price*$_SESSION["vn"];
  }
}
?>
<div class="container" style="margin-top: 150px">
	<div class="single">
		<div class="col-md-9 top-in-single">
			<div class="col-md-5 single-top">	
				<ul id="etalage">
					<li>
						<a href="optionallink.html">
							<img class="etalage_thumb_image img-responsive" src="admin/public/images/<?php echo $product->image?>" alt="" >
							<img class="etalage_source_image img-responsive" src="admin/public/images/<?php echo $product->image?>" alt="" >
						</a>
					</li>
					<?php 

					$sub_image = json_decode($product->sub_image);
					if(count($sub_image) > 0) {
						foreach($sub_image as $s) {
							
							?>
							<li>
								<img class="etalage_thumb_image img-responsive" src="admin/public/images/<?php echo $s?>" alt="" >
								<img class="etalage_source_image img-responsive" src="admin/public/images/<?php echo $s?>" alt="" >
							</li>
             <?php } }?>

           </ul>

         </div>	
         <div class="col-md-7 single-top-in">
          <div class="single-para">
           <h4><?php echo $product->name?></h4>
           <p><?php echo $product->description?></p>
           <div class="star">
            <ul>
             <li><i> </i></li>
             <li><i> </i></li>
             <li><i> </i></li>
             <li><i> </i></li>
             <li><i> </i></li>
           </ul>
           <div class="review">
             <a href="#"> <?php echo $product->view?> reviews </a>/
             <a href="#">  Write a review</a>
           </div>
           <div class="clearfix"> </div>
         </div>

         <?php if($promotion_price == 0) {?>
         <h3  id="price_<?php echo $product->id?>" data-price="<?php echo $product->price?>" style="padding-bottom: 15px; padding-top: 15px"><?php echo $front?><?php echo number_format($price,2) ?><?php echo $back?></h3>
         <?php } else {?>
         <div class="row" style="padding-bottom: 15px; padding-top: 15px">
          <div class="col-md-12"><strike><?php echo $front?><?php echo number_format($price,2) ?><?php echo $back?></strike></div>
          <div class="col-md-12" style="color:#ff4d4d"><h3 id="price_<?php echo $product->id?>" data-price="<?php echo $promotion->price?>"><?php echo $front?><?php echo number_format($promotion_price,2)?><?php echo $back?></h3></div>
        </div>


        <?php }?>

        <div class="available">
          <h6>Available Options :</h6>

          <ul>
            <?php if(count(json_decode($product->size)) > 0) {?>
            <li>Size: <select name="size" class="form-group">
             <?php 
             $sizes = json_decode($product->size);
             $count = count($sizes);
             if($count > 0){
              foreach($sizes as $key=>$value){
               if($value != 0) {
                ?>
                <option value="<?php echo $key?>"><?php echo $key?></option>
                <?php } } }?>
              </select></li>
              <?php }?>

              <li>Quantity: <input type="text" class="form-group" onkeypress="return isNumberKey(event)" value="1" name="qty"></li>
            </ul>
          </div>

          <a href="javascript:void(0)" data-index="<?php echo $product->id ?>" class="cart add-single-cart "> <i class="fa fa-shopping-cart"></i> Add to cart</a>

        </div>
      </div>
      <div class="clearfix"> </div>

      <h5><b id="total_cmt"><?php echo count($all_comment) ?></b> comments</h5>
      <input type="hidden" name="total_comments" value="<?php echo count($all_comment) ?>">
      <hr style="border:1px solid #FFFFFF">

      <div class="row">
       <div class="col-md-1"><img src="admin/public/images/<?php echo (isset($_SESSION["customer"]) && $_SESSION["customer"]->image!='')?$_SESSION["customer"]->image:'us.png' ?>" width="60px"></div>
       <div class="col-md-11">
        <textarea name="cmt" class="form-control" placeholder=" Your Comment..."></textarea>
        <div style="width: 100%; text-align: right; background: #fff; border-radius: 4px">
         <a style="text-align: right;" id="add_cmt" class="btn btn-success  <?php echo ( !isset($_SESSION["customer"]))?'disabled':''?>">Post</a>
       </div>
     </div>
   </div>
   <div class="clearfix"></div>
   <div class="comment">
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
                  <span> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($cmt->created_at))->diffForHumans() ?> </span>
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
                         <span><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($s->created_at))->diffForHumans() ?></span>
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
                 <span> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($cmt->created_at))->diffForHumans() ?> </span>
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
                 <span> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($s->created_at))->diffForHumans() ?> </span>
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
   </div>
   <?php $count = count($all_comment);
   ?>
   <?php if($count>10) {?>
   <button class="row btn btn-info" style="width: 100%;  margin-top: 40px; margin-bottom: 40px" name="show_more" >
     <h5 style="text-align: center; line-height: 50px;color:#fff;font-weight: bold">Show more</h5>
     <input type="hidden" name="more" value="<?php echo count($comments) ?>">
   </button>
   <?php }?>
   <hr class="row" style="border:1px solid #FFFFFF"><br> 
 </div>
</div>
<div class="col-md-3">
 <div class="single-bottom">
  <h4>Relative Products </h4>
  <?php 
						// var_dump($relative_product);
  foreach($relative_product as $rp):
    $promotion_price = 0;
    $promotion = $m_promotion->get_promotion_price($p->id);
    if($promotion != 0) {
      $promotion_price = $promotion->price;
    }   
    $price = $rp->price;
    $front = "$";
    $back = "";
    if(isset($_SESSION["vn"])) {
      $front = "";
      $back = " VND"; 
      $price = $rp->price*$_SESSION["vn"];
      if($promotion != 0) {
        $promotion_price = $promotion->price*$_SESSION["vn"];
      }
    } 
    ?>
    <div class="product-go">
      <a href="single.php?id=<?php echo $rp->id?>"><img class="img-responsive fashion" src="admin/public/images/<?php echo $rp->image?>" alt=""></a>
      <div class="grid-product">
        <a href="single.php?id=<?php echo $rp->id?>" class="elit"><?php echo $rp->name?></a>
        <span class=" price-in"> <?php echo $front?><?php echo number_format($price,2)?><?php echo $back?></span>
      </div>
      <div class="clearfix"> </div>
    </div>
  <?php endforeach ?>

</div>
</div>
<div class="clearfix"> </div>		
</div>
</div>
<script type="text/javascript">
  <?php
    if(isset($_SESSION["customer"])){//nếu đăng nhập mới thực thị
      ?>
        $(document).on('click','#add_cmt',function(){ // Thêm  1 comment
          comment = $('textarea[name=cmt]').val();
          pro_id = '<?php echo $product->id ?>';
          user_id = '<?php echo $_SESSION["customer"]->id ?>';
          total = $('input[name=total_comments]').val();
          if(comment == "") {
            alert("Please enter your comment");
            return;
          }
          $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {'comment':comment,'pro_id':pro_id,'user_id':user_id,'add_comment':'OK'},
            dataType: 'json',
            success: function(data) {
              html = '';
                var a = data;//Parse ra array
                html += '<div class="row" style="margin-top: 40px">';
                html += '<input type="hidden" name="id_cmt" value="'+a.id+'">';
                html += '<div class="col-md-1"><img src="admin/public/images/<?php echo (isset($_SESSION["customer"]) && $_SESSION["customer"]->image!='')?$_SESSION["customer"]->image:'us.png' ?>" width="60px"></div>';
                html += '<div class="col-md-11">';
                html += '<h4><b>'+'<?php echo $_SESSION["customer"]->last_name?>'+'</b></h4>';
                html += '<p>'+a.comment+'</p>';
                html += '<div>';
                html += '<a href="javascript:void(0)" class="like" data-index="'+a.id+'" style="color:blue"> Like </a>-';
                html += '<a href="javascript:void(0)" class="rep" style="color:blue"> Reply </a>-';
                html += '<span> <i style="color:blue" class="fa fa-thumbs-o-up"></i> <span class="count_like" data-index="0"></span> </span>-';
                html += '1 second ago';
                html += '</div>';
                html += '</div>';
                html += '<div class="clearfix"></div>';
                html += '<div class="sub-comment">';
                html += '<div class="add_sub_comment hidden" style="padding:  30px 0px 30px 60px">';
                html += '<div class="col-md-1"><img src="admin/public/images/<?php echo (isset($_SESSION["customer"]) && $_SESSION["customer"]->image!='')?$_SESSION["customer"]->image:'us.png' ?>" width="60px"></div>';
                html += '<div class="col-md-11">';
                html += '<textarea name="sub_cmt" class="form-control" placeholder=" Your Comment..."></textarea>';
                html += '<div style="width: 100%; text-align: right; background: #fff; border-radius: 4px">';
                html += '<a href="javascript:void(0)" style="text-align: right;" class="add_sub_cmt btn btn-success  <?php echo ( !isset($_SESSION["customer"]))?'disabled':''?>">Post</a>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '<div class="clearfix"></div>';
                $('textarea[name=cmt]').val('');
                $('#total_cmt').html(parseInt(total)+1);// Tăng total lên 1 hiên ra ở trên
                $('input[name=total_comments]').val(parseInt(total) + 1);//tăng giá trị ẩn 
                $('.comment').prepend(html);


              }
            })
        })

        $(document).on('click','.rep',function(){ // hiện form add sub comment
          $(this).parent().parent().parent().find('textarea[name=sub_cmt]').val('');
          $(this).parent().parent().parent().find('.sub-comment').find('.add_sub_comment').removeClass('hidden');

        })

        $(document).on('click','.add_sub_cmt',function(){ // khi click button post trong form sub_comment
          id = $(this).parent().parent().parent().parent().parent().find('input[name=id_cmt]').val();
          comment = $(this).parent().parent().find('textarea[name=sub_cmt]').val();
        $this1 = $(this).parent().parent().find('textarea[name=sub_cmt]');//lay duong dan comment
        $this2 = $(this).parent().parent().parent();//lay duong dan <div add_sub_comment
        $this3 = $(this).parent().parent().parent().parent();
        user_id = '<?php echo $_SESSION["customer"]->id ?>';
        pro_id = '<?php echo $product->id ?>';
        if(comment == "") {
          alert("Please enter your comment");
          return;
        }
        $.ajax({
          type:'POST',
          url: 'ajax.php',
          data:{'id':id,'comment':comment,'user_id':user_id,'pro_id':pro_id,'add_sub_comment':'OK'},
          dataType:'json',
          success:function(data){
            console.log(data);
            html = '';
            html += '<div style="padding:  30px 0px 30px 60px" >';
            html += '<div class="col-md-1"><img src="admin/public/images/<?php echo (isset($_SESSION["customer"]) && $_SESSION["customer"]->image!='')?$_SESSION["customer"]->image:'us.png' ?>" width="60px"></div>';
            html += '<div class="col-md-11">';
            html += '<h4><b>'+'<?php echo $_SESSION["customer"]->last_name?>'+'</b></h4>';
            html += '<p>'+data.comment.comment+'</p>';
            html += '<div>';
            html += ' <a href="javascript:void(0)" class="like" data-index="'+data.comment.id+'" style="color:blue"> Like </a>-';
            html += '<a  href="javascript:void(0)" class="sub_rep"  style="color:blue"> Reply </a>-';
            html += '<input type="hidden" value="'+data.user_name.last_name+'" name="sub_user">';
            html += '<span> <i style="color:blue" class="fa fa-thumbs-o-up"></i> <span class="count_like" data-index="0"></span></span>-';
            html += '<span> 1 second ago </span>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="clearfix"></div>';
                $this1.val('');//cho textarea bang rong
                $this2.addClass('hidden');//ẩn form nhập bình luận
                console.log($this3);
                $this3.prepend(html);

              }
            })
      })

        $(document).on('click','.sub_rep',function(){// Rep sub comment
          sub_user = $(this).parent().find('input[name=sub_user]').val();
          console.log(sub_user);
          $(this).parent().parent().parent().parent().find('.add_sub_comment').removeClass('hidden');
            $(this).parent().parent().parent().parent().find('textarea[name=sub_cmt]').val(sub_user+' '); // Hiện tên user của sup_comment ở đâu dòng rồi thực hiện như event trên
          })

        $(document).on('click','.like',function(){ 
          cmt_id = $(this).attr('data-index');
          user_id = '<?php echo $_SESSION["customer"]->id ?>';
            count_like = $(this).parent().find('.count_like').attr('data-index'); //Số lượt thích của bình luận đó
            this1 = $(this);

            $.ajax({
              type:'POST',
              url: 'ajax.php',
              data:{'cmt_id':cmt_id,'user_id':user_id,'like':'OK'},
              success:function(data){
                if(data.trim() == 'success'){
                        this1.html('Dislike ');//chuyen like thanh dislike
                        this1.attr('class','dislike');
                        this1.css('color','red');
                        count_like = parseInt(count_like) + 1 
                        this1.parent().find('.count_like').attr('data-index',parseInt(count_like));
                        this1.parent().find('.count_like').html(' '+parseInt(count_like));//+ like lên 1
                      }
                      console.log(data);
                    }
                  })
          })

        $(document).on('click','.dislike',function(){
          comment_id = $(this).attr('data-index');
          user_id = '<?php echo $_SESSION["customer"]->id ?>';
          count_like = $(this).parent().find('.count_like').attr('data-index');
          this1 = $(this);
          console.log(count_like);

          $.ajax({
            type:'post',
            url: 'ajax.php',
            data: {'comment_id':comment_id,'user_id':user_id,'dislike':'OK'},
            success:function(data) {
              if(data.trim() == 'success') {
                this1.html(' Like ');
                this1.attr('class','like');
                this1.css('color','blue');
                count_like = parseInt(count_like) - 1 
                this1.parent().find('.count_like').attr('data-index',parseInt(count_like));
                this1.parent().find('.count_like').html(' '+parseInt(count_like));
              }
            }
          })

        })

        <?php }?> //Phải đăng nhập mới thực thi


        $('button[name=show_more]').on('click',function(){
            count = $('input[name=more]').val(); // lấy số comment đang hiện
            pro_id = '<?php echo $product->id ?>';

            $.ajax({
              type: 'POST',
              url: 'ajax.php',
            // dataType: 'json',
            data:{'count':count,'pro_id':pro_id,'show_more':'OK'},
            success:function(data) {
                // $.each(data,function(index,value){
                //     console.log(value.comment);
                // })
                $('.comment').append(data);
                show_more = parseInt($('input[name=show_more]').val()); // So comment vua dc show ra bên view show_more
                count = parseInt(count) + show_more;
                total_count = '<?php echo  count($all_comment) ?>';
                console.log(count);
                console.log(total_count);
                console.log(show_more);
                if(count >= total_count){ // nếu số comment đang hiện bằng tổng comment thì ẩn nút showmore
                  $('button[name=show_more]').addClass('hidden')
                }

                $('input[name=more]').val(count); //cấp nhật số lượng comment đang hiện
              }
            })

          })


        </script>