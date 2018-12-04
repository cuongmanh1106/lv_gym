<div class="footer">
    <div class="col-md-3 footer-left">
        <h4>Categories</h4>
        <div class="run-top">
            <ul class="run-grid">
                <?php
                $cates = $m_category->read_rand_categories();
                foreach($cates as $c) :
                $parent_name = '';
                $parent = $m_category->read_cate_by_id($c->parent_id); 
                if($parent!= null) {
                    $parent_name = $parent->name;
                }
                ?>
                <li><a href="products.php?id=<?php echo $c->id?>"><?php echo $parent_name.' - ' ?> <?php echo $c->name ?></a></li>
                <?php endforeach ?>
                
            </ul>
            <!-- <ul class="run-grid">
                <li><a href="product.html">STYLE</a></li>
                <li><a href="product.html">SPECIAL</a></li>
                <li><a href="product.html">BRAND EVENTS</a></li>
            </ul> -->
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="col-md-3 footer-left left-footer">
        <h4>Address</h4>
        <div class="run-top top-run">
            <ul class="run-grid">
                <li><a href="#">cuongmanh1106@gmail.com</a></li>
                <li><a href="#">42 Man Thien Street, District 9</a></li>
                <li><a href="#">Phone:+1688868553</a></li>
                <li><a href="#">Harrik Shop</a></li>
                <li><a href="#">TAG:Gym Wear</a></li>
                
            </ul>
            
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="col-md-2 footer-left left-footer">
        <h4>Your Account</h4>
        <ul class="run-grid-in">
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Sign up</a></li>
        </ul>
    </div>
    <div class="col-md-4 footer-left left-footer">
        <ul class="social-in">
            <li><a href="#"><i> </i></a></li>
            <li><a href="#"><i class="youtube"> </i></a></li>
            <li><a href="#"><i class="facebook"> </i></a></li>
            <li><a href="#"><i class="twitter"> </i></a></li>
        </ul>
        <div class="letter">
            <h5>Message us</h5>
            <form method="post" action="">
                <span >Message</span>
                <textarea  name="content"  class="editor2" style="width: 100%;color:black" id= required="required" rows="5" placeholder="Content..." class="form-control"></textarea>           
                            

            <div class="send-in">
                <?php if(isset($_SESSION["customer"])) { ?>
                <button type="submit" class="btn btn-danger" value="Send" >Send</button>
                <?php } else { ?> 
                <button disabled="" class="btn btn-danger" type="submit" value="Send" title="You must login to send message" >Send</button>
                <?php } ?>

            </div>
        </form>
            <!-- <span>in the next article</span>
            <h6>NRL: five things we learned this weekend</h6>
            <p>In support of suburban games; Warriors rip</p>
            <a href="register.html" class="sign">SIGN UP AND GET MORE</a>
            <p class="footer-class"> © 2015 Sport All Rights Reserved | Template by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p> -->
        </div>

    </div>
    <div class="clearfix"> </div>
</div><script src="public/js/bootstrap.min.js"></script>
<script src="admin/public/assets/js/lib/data-table/datatables.min.js"></script>
</body>
</html>


<script>
    $(document).ready(function(){
        $(document).on('click','.add-cart',function(){
            var id = $(this).attr('data-index');
            var count = $('#checkout').attr('data-index');
            var price = $(this).parent().find('#price_'+id).data('price');
            var size = '';

            $.ajax({
                type:'POST',
                url:'ajax.php',
                data:{'pro_id':id,'count':count,'size':size,'price':parseFloat(price),'add-to-cart':'OK'},
                success:function(data){
                    data = data.trim();
                    // console.log(data);
                    if(data == "overlimit") {
                        alert("This product's quantity don't enough");
                    } else {
                        total_data = data.split('---');
                        total = data.split('-');
                        vt = data.indexOf('---');//tìm vị trí chuỗi ---
                        data = data.substring(vt,data.length);
                        $('#cart_quantity').html(total[1]);//html số của giỏ hàng
                        $('#checkout').attr('data-index',total[1]);//attr hiển thị của giỏ hàng
                        $('button[name=process]').attr('data-index',total[1]); // attribute của nút process to buy trong checkout
                        if(parseInt(count) == parseInt(total[1])) /*Khi thêm 2 sản phẩm đã tồn tại thì xóa cái củ đi thêm cái mới vô với số lượng tăng lên 1*/
                        {
                            $('#'+total[2]).remove();
                            alert('This product existed in  your cart');
                        } 
                        $('#cart_show').append(data);
                        $('.total').html(total[0]);
                        $('button[name=process]').prop('disabled', false);
                    }
                }
            })
        })

        $(document).on('click','.add-single-cart',function(){
            id = $(this).attr('data-index');
            size = $(this).parent().find('select[name=size]').val();
            qty = $(this).parent().find('input[name=qty]').val();
            count = $('#checkout').attr('data-index');
            var price = $(this).parent().find('#price_'+id).html();
            var price = price.slice(1);
            $.ajax({
                type:'POST',
                url:'ajax.php',
                data:{'pro_id':id,'count':count,'size':size,'qty':qty,'price':price,'add-to-cart':'OK'},
                success:function(data){
                    data = data.trim();
                    // console.log(data);
                    if(data == "overlimit") {
                        alert("This product's quantity don't enough");
                    } else {
                        total_data = data.split('---');
                        total = data.split('-');
                        vt = data.indexOf('---');//tìm vị trí chuỗi ---
                        data = data.substring(vt,data.length);
                        $('#cart_quantity').html(total[1]);//html số của giỏ hàng
                        $('#checkout').attr('data-index',total[1]);//attr hiển thị của giỏ hàng
                        $('button[name=process]').attr('data-index',total[1]); // attribute của nút process to buy trong checkout
                        if(parseInt(count) == parseInt(total[1])) /*Khi thêm 2 sản phẩm đã tồn tại thì xóa cái củ đi thêm cái mới vô với số lượng tăng lên 1*/
                        {
                            $('#'+total[2]).remove();
                            alert('This product existed in  your cart');
                        } 
                        $('#cart_show').append(data);
                        $('.total').html(total[0]);
                        $('button[name=process]').prop('disabled', false);
                    }
                }
            })
        })

         $(document).on('click','.update_cart',function(){
            rowId = $(this).attr('data-index');
            qty = $(this).parent().parent().find('input[name=qty_checkout]').val();
            size = $(this).parent().parent().find('select[name=size_update]').val();
            pro_id = $(this).parent().find('input[name=pro_id]').val();
            $this1 = $(this);
            if(parseInt(qty) > 0 ) {
              $.ajax({
                type:'POST',
                url:'ajax.php',
                data: {'rowId':rowId,'qty':qty,'size':size,'pro_id':pro_id,'update_cart':'OK'},
                dataType: 'json',
                success:function(data) {
                    console.log(data);
                  if(data.cart == 'overlimit') {
                    alert("This product's quantity don't enough!!");
                    $this1.parent().parent().find('input[name=qty_checkout]').val(data.qty);
                    $this1.parent().parent().find('select[name=size_update]').val(data.size);
                  }else if(data.cart == 'exists') {
                    alert("This product existed in your cart! please check again");
                    $this1.parent().parent().find('select[name=size_update]').val(data.size);
                  } else {
                    $this1.parent().parent().find('.sub-total').html(data.cart.price*data.cart.qty);
                    $('.total').html(data.total);
                  }
                }
              })
            } else {
              alert('Quality must be at least one');
            }
          })

          $(document).on('click','.delete_cart',function(){
            rowId = $(this).attr('data-index');
            $this1 = $(this);
            $.ajax({
              type:'POST',
              url: 'ajax.php',
              data:{'rowId':rowId,'delete_cart':'OK'},
              dataType:'json',
              success:function(data){
                if(data != '') {
                  $this1.parent().parent().remove();
                  $('.total').html(data.total);
                  $('#cart_quantity').html(data.count);//html số của giỏ hàng
                  $('#checkout').attr('data-index',data.count);//trên header
                  $('input[name=process]').attr('data-index',data.count);// attr cuar process to buy
                  if(parseInt(data.count) == 0) {
                    $('button[name=process]').prop('disabled', true);
                    // $('button[name=process]').addClass('disabled');
                  }

                }
              }
            })
          })
    })

    $(document).on('change','select[name=change_language]',function(){
        lang = $('select[name=change_language').val();
        $.ajax({
            type:'POST',
            url:'ajax.php',
            data:{'lang':lang,'change_language':'OK'},
            success:function(data) {
                window.location.reload();
            }
        })
    })

    $(".alert").delay(3000).slideUp();
</script>