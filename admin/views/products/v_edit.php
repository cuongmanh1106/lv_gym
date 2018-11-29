<?php
include("include/report.php");
$sizes = array();
$sub_img = array();
if($product->size != '') {
	$sizes = json_decode($product->size);
} 
if($product->sub_image != '') {
	$sub_img =json_decode($product->sub_image);
}

?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="products_list.php" style="color: blue">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit a product</li>
</ol>
</nav>

<form style="margin-left: 15px; margin-right: 15px"  method="POST" enctype="multipart/form-data" action="products_update.php">
    <input type="hidden" name="id" value="<?php echo $id?>">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header badge-info">
                    <h4><i class="fa fa-edit"></i> Edit A PRODUCT</h4>
                </div>
                <div class="card-body">
                    <div class="error_tmp">

                    </div>
                    <div class="default-tab">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Infomation</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Images</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Sizes</a>
                            </div>
                        </nav>
                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="row form-group">
                                    <div class="col-md-1"><label for="text-input" class=" form-control-label">Name:</label></div>
                                    <div class="col-md-10"><input type="text" value="<?php echo $product->name ?>" required="required" id="id_name" name="name" class="form-control"></div>
                                    <div class="col-md-1">(<span style="color:red">*</span>)</div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-1"><label for="select" class=" form-control-label">Category:</label></div>
                                    <div class="col-12 col-md-10">
                                      <select name="cate_id" required="required" id="select" class="form-control">
                                        <?php cate_parent_edit($cates,0,"--",$product->cate_id); ?>
                                    </select>
                                </div>
                                <div class="col-md-1">(<span style="color:red">*</span>)</div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-1"><label for="select" class=" form-control-label">Suplier:</label></div>
                                <div class="col-12 col-md-10">
                                  <select name="sup_id" required="required" id="" class="form-control selected2">
                                    <?php foreach($supliers as $sup): ?>
                                        <option <?php echo ($product->sup_id == $sup->id)?'selected':'' ?>  value="<?php echo $sup->id?>"><?php echo $sup->name?></option>
                                    <?php endforeach?>
                                </select>
                            </div>
                            <div class="col-md-1">(<span style="color:red">*</span>)</div>
                        </div>


                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Price:</label></div>
                            <div class="col-md-10"><input type="text" value="<?php echo $product->price?>" required="required" onkeyup="formatNumBerKeyUp(this)" id="text-input" name="price" class="form-control"></div>
                            <div class="col-md-1">(<span style="color:red">*</span>)</div>
                        </div>

                        

                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Introduce:</label></div>
                            <div class="col-md-10"><input type="text" value="<?php echo $product->intro; ?>" required="required" id="text-input" name="intro" class="form-control"></div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-1"><label for="textarea-input" class=" form-control-label">Description</label></div>
                            <div class="col-12 col-md-10"><textarea  name="description" id="editor2" required="required" rows="9" placeholder="Content..." class="form-control"><?php echo $product->description?></textarea>
                            </div>
                            <div class="col-md-1">(<span style="color:red">*</span>)</div>
                        </div>




                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Image:</label></div>
                            <div class="col-md-10"><img src="public/images/<?php echo $product->image?>" width="150px" ><input type="file" value="public/images/<?php echo $product->image?>" id="image" name="image" class="form-control"></div>
                            <div class="col-md-1">(<span style="color:red">*</span>)</div>
                        </div>
                        <?php 
                        if($sub_img != null) {
                            foreach($sub_img as $s){
                                ?>
                                <div class="form-group">
                                   <div class="col-md-1"><label for="text-input" class=" form-control-label">Sub-Image:</label></div>
                                   <div class="col-md-11" style="margin-top: 15px; margin-bottom: 15px"><img src="public/images/<?php echo $s?>" class="" width="130px"><a style="width: 30px; height: 30px; padding:6px 0; border-radius: 15px; text-align: center;font-size: 12px; line-height: 1.42857; position: absolute; left: 131px; top: 0" class="btn btn-danger btn-circle icon_del del_sub_image"><i class="fa fa-times"></i></a></div>
                                   <input type="hidden" value="<?php echo $s?>" name="old_sub_image[]">

                               </div>
                               <?php
                           }
                       }

                       ?>
                       <div class="clearfix"></div>
                       <a href="javascript::void(0)" class="btn btn-secondary" id="add-sub-image"><i class="fa fa-plus"></i> Add sub-image</a>
                       <hr>
                       <div class="sub-image">


                       </div>


                   </div>
                   <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="col-md-6">Total quantity<input class="form-control" type="text" name="total_quantity" value="<?php echo $product->quantity ?>" onkeypress="return isNumberKey(event)" ></div>

                    <div class="clearfix"></div>
                    <hr>
                    <div id="add-size">
                        <?php 
                        if(count($sizes) != 0) {
                            foreach($sizes as $key=>$value){
                                ?>

                                <div class="row form-group">
                                    <div class="col-md-1"><label for="text-input" class=" form-control-label">Size:</label></div>
                                    <div class="col-md-4">
                                        <select name="size[]" class="form-control" id="select">
                                            <option <?php echo  ($key=="XS")?'selected':'' ?> value="XS">XS</option>
                                            <option <?php echo ($key=="S")?'selected':''  ?> value="S">S</option>
                                            <option <?php echo ($key=="M")?'selected':''  ?> value="M">M</option>
                                            <option <?php echo ($key=="L")?'selected':''  ?> value="L">L</option>
                                            <option <?php echo ($key=="XL")?'selected':''  ?> value="XL">XL</option>
                                            <option <?php echo ($key=="2XL")?'selected':''  ?> value="2XL">2XL</option>
                                            <option <?php echo ($key=="3XL")?'selected':''  ?> value="3XL">3XL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1"><label for="text-input" class=" form-control-label">Quantity:</label></div>
                                    <div class="col-md-4"><input type="text" value="<?php echo  $value ?>" required="required" onkeypress="return isNumberKey(event)" id="text-input" name="quantity[]" class="form-control"></div>
                                    <button type="button" class="close close-add-size" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php }}?>


                            </div>
                            <a href="javascript::void(0)" class="btn btn-secondary" id="add-sub-size"><i class="fa fa-plus"></i> Add sub size</a>

                        </div>
                    </div>

                </div>

            </div>
            <div style="text-align: center;">
                <button class="btn btn-info" name="update_pro" type="button" id="insert"><i class="fa fa-thumbs-o-up"></i> Update</button>
                <button class="btn btn-danger" onclick="window.location= 'products_list.php'" type="button" value="Cancel"><i class="fa fa-reply"></i> Back</button>
            </div>
        </div>

    </div>
    <!-- /# column -->

</div>
</form>
<script>
 $(document).ready(function(){
    var tmp_quantity = $('input[name="quantity[]"]');
    console.log(tmp_quantity.length);
    if(tmp_quantity.length == 0 ) {
        $('input[name=total_quantity').prop('disabled',false);
    } else {
        $('input[name=total_quantity').prop('disabled',true);
    }
})
</script>
<script type="text/javascript" >

    $('#add-sub-image').on('click',function(){
        var html = '';
        html += '<div class="row form-group">';
        html += '<div class="col-md-1"><label for="text-input" class=" form-control-label">Sub-Image:</label></div>';
        html += '<div class="col-md-10"><input type="file" id="text-input" name="sub_image[]" class="form-control"></div>';
        html += '<button type="button" class="close close-add-image" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        html += '</div>';
        $('.sub-image').append(html);
    });

    $('#discount').on('click',function(){
        if($('#discount').is(':checked')){
            $('input[name=reduce]').show();

        } else {
            $('input[name=reduce]').val('');
            $('input[name=reduce]').hide();
        }
    });

    $('#add-sub-size').on('click',function(){
        $('input[name=total_quantity]').prop('disabled',true);

        var html = '';
        html += ' <div class="row form-group">';
        html += '<div class="col-md-1"><label for="text-input" class=" form-control-label">Size:</label></div>';
        html += ' <div class="col-md-4">';
        html += ' <select name="size[]" class="form-control" id="select">';
        html += '<option value="XS">XS</option>';
        html += '<option value="S">S</option>';
        html += '<option value="M">M</option>';
        html += '<option value="L">L</option>';
        html += '<option value="XL">XL</option>';
        html += '<option value="2XL">2XL</option>';
        html += '<option value="3XL">3XL</option>';
        html += '</select>';
        html += ' </div>';
        html += '<div class="col-md-1"><label for="text-input" class=" form-control-label">Quantity:</label></div>';
        html += '<div class="col-md-4"><input type="text" required="required" id="text-input" onkeypress="return isNumberKey(event)" name="quantity[]" class="form-control"></div>';
        html += ' <button type="button" class="close close-add-size" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        html += ' </div>';
        $('#add-size').append(html);
    })

    $(document).on('click', '.close-add-size', function () {

        $(this).parent().remove();
        total_quantity = 0;
        $('input[name="quantity[]"]').each(function(i,n){
            total_quantity += parseInt($(n).val());
        })

        var tmp_quantity = $('input[name="quantity[]"]');
        if(tmp_quantity.length == 0) {
            $('input[name=total_quantity]').prop('disabled',false);
        }
        $('input[name=total_quantity]').val(total_quantity);
    })
    $(document).on('click', '.close-add-image', function () {
        $(this).parent().remove();
    })

    $(document).on('click', '.del_sub_image', function () {
        $(this).parent().parent().remove();
    })
    //kiểm tra dữ liệu
    $(document).on('click','#insert',function(){
        var html = '';
        var flag = true;
        html += ' <ul  id="error" class="alert alert-danger">';

        if($('#id_name').val() == "") {
            html += '<li>Name is required</li>';
            flag = false;
        }
        if($('input[name=price]').val() == ""){
            html += '<li>Price is required</li>';
            flag = false;
        }
        if($('input[name=reduce]').val() == "" && $('#discount').is(':checked')){
            html += '<li>Discount price is required</li>';
            flag = false;
        }
        if(parseFloat($('input[name=reduce]').val()) > parseFloat($('input[name=price]').val()) && $('#discount').is(':checked')){
            html += '<li>Discount price must be smaller than price </li>';
            flag = false;
        }
        if($('input[name=intro]').val() == ""){
            html += '<li>Intro is required</li>';
            flag = false;
        }

        var quantity = 0;
        $('input[name="quantity[]"]').each(function(i,n){
           if($(n).val() == "") {
            html += '<li>Please fill all quantity</li>';
            flag = false;
            return false;

        }
    })
        var check ;
        var len = $('select[name="size[]"').length;
        $('select[name="size[]"').each(function(i,n){
            $('select[name="size[]"').each(function(j,m){
                if($(n).val() == $(m).val() && len > 1 && i != j) {
                    html += '<li>Size is unique</li>';
                    flag = false;
                    check = false; 
                }
                if(check == false)
                {
                    return check;
                }
            });
            if(check == false) {
                return check;
            }

        }) ;

        html += '</ul>';
        if(flag) {
            console.log(flag);  
            $('button[name="update_pro"]').attr("type", "submit");
        } else {
            $('.error_tmp').html(html);
        }
    })
    $(document).on('keyup','input[name="quantity[]"]',function(){

        console.log(1);
        total_quantity = 0;
        $('input[name="quantity[]"]').each(function(i,n){
            total_quantity += parseInt($(n).val());
        })
        
        
        $('input[name=total_quantity]').val(total_quantity);
    })



</script>
<script> CKEDITOR.replace( 'editor2', {
    filebrowserBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html') }}',
    filebrowserImageBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html?type=Images') }}',
    filebrowserFlashBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html?type=Flash') }}',
    filebrowserUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
    filebrowserImageUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
    filebrowserFlashUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
} ); </script>

