<?php include("v_add.php"); ?>
<?php include("include/report.php"); ?>


<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header badge-info">
                        <strong class="card-title"><i class="fa fa-list"></i> Permissions</strong>
                        
                        <!--  <Button disabled class="btn btn-success" data-toggle="modal" data-target="#insert_per"><i class="fa fa-plus-circle"></i> Insert</Button> -->
                        <?php if($m_per->check_permission('insert_permission') == 1) { ?>
                        <Button class="btn btn-success" data-toggle="modal" data-target="#insert_per"><i class="fa fa-plus-circle"></i></Button>
                        <?php } else {?>
                        <Button class="btn btn-success" disabled data-toggle="modal" data-target="#insert_per"><i class="fa fa-plus-circle"></i></Button>
                        <?php }?>
                        
                    </div>
                    
                    <div class="card-body">
                     
                      <table id="bootstrap-data-table" class="table table-striped table-bordered search_cate">
                        <thead>

                          <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php foreach($per as $key=>$p): ?>
                          <tr id="">
                             
                            <td><?php echo  $key + 1 ?></td>
                            <td><?php echo  $p->name ?></td>
                            
                            <td>
                           <!--  @if(check_permission('edit_permission') != 1)
                            <button disabled=""  class="badge badge-default"><i class="fa fa-eye"></i> List permisson</button>
                            @else  -->
                            <?php if($m_per->check_permission('edit_permission') == 1) { ?>
                            <a href="permission_group.php?id=<?php echo $p->id?>" class="badge badge-info"><i class="fa fa-eye"></i> List permisson</a>
                            <?php } else {?>
                            <button  class="badge badge-info " disabled><i class="fa fa-eye"></i> List permisson</button>
                            <?php }?>
                            <!-- @endif -->
                            
                        	<!-- <div class="dropdown">
							    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
							      Action
							    </button>
							    <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
							      <a class="dropdown-item badge badge-danger"  id="delete" onclick  href="javascript::void(0)"><i class="fa fa-trash-o"></i> Xóa</a>
							    </div>
                           </div> -->
                       </div>
                   </td>
               </tr>
           <?php endforeach ?>
       </tbody>
   </table>
</div>
</div>
</div>


</div>
</div><!-- .animated -->
</div><!-- .content -->


</div><!-- /#right-panel -->
<script type="text/javascript">

    function delete_cate(id) {

        if(confirm('Are you are? Data wont backup again')) {
            $.ajax({
                url: "ajax.php",
                type: 'GET',
                cache:false,
                data:{'id':id},
                success: function(data,status) {
                    if(data == "success") {
                        $('#row-'+id).remove();
                    } else if(data == "parent_error"){
                        alert('this cate has sub-cate!!! please delete sub-cate first');
                    } else {
                        alert('fail');
                    }
                }
            })
        }    
    }

    $('select[name=parent_search]').on('change',function(){
        var name = $('input[name=name_search]').val();
        var parent = $('select[name=parent_search]').val();
        $.ajax({
            url: "ajax.php",
            type: 'GET',
            cache: false,
            data: {'name':name, 'parent':parent},
            success: function(data,status) {
                // alert(data);
                document.getElementsByClassName('search_cate')[0].innerHTML = data;
            }
        })
    })
    $('input[name=name_search').on('keyup',function(){
        var name = $('input[name=name_search]').val();
        var parent = $('select[name=parent_search]').val();
        $.ajax({
            url: "ajax.php",
            type: 'GET',
            cache: false,
            data: {'name':name, 'parent':parent},
            success: function(data,status) {
                // alert(data);
                document.getElementsByClassName('search_cate')[0].innerHTML = data;
            }
        })
    });

    // $('#delete').on('click',function(){
    //     var id = $(this).attr('data-index');
    //     alert(id);
    // })
</script>