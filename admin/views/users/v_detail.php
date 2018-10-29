
<div class="card">
    <div class="card-header">
        Featured
    </div>

    <div class="error_user">

    </div>

    <?php include("include/report.php") ;
    ?>
    <div class="card-body">
        <form id="form" method="POST" enctype="multipart/form-data" action="">
            <div class="container">
                
                <div class="row form-group">
                    <div class="col-md-6" style="text-align: right">
                        <img src="public/images/<?php echo (isset($_SESSION["user"]) && $_SESSION["user"]->image !='')?$_SESSION["user"]->image:'us.png' ?>" width="150px" height="150px">
                    </div>
                    <div class="col-md-6">
                        <?php
                        $result = $m_user->read_permission_by_id($user->permission_id);
                        $per_name = '';
                        if($result!=null) {
                            $per_name = $result->name;
                        }
                        ?>
                        <p><b>Name:</b> <?php echo $user->first_name ?> <?php echo $user->last_name ?></p>
                        <p><b>Role:</b> <?php echo $per_name ?></p>
                        <p><b>Email:</b> <?php echo $user->email ?></p>
                        <p><b>Password:</b>  <u><a data-toggle="modal" href="#change_password" style="color:blue">Change password</a></u></p>
                        <p><b>Phone:</b> <?php echo $user->phone_number ?></p>
                        <p><b>Address:</b> <?php echo $user->address ?></p>
                    </div>
                </div>
                <div class="form-group" style="text-align: center;">
                    <a class="btn btn-info" data-toggle="modal" href="#edit_profile" style="text-align: center;"><i class="fa fa-edit"></i> Edit</a>   
                      
                </div>
                
                

            </form>
            <?php include('v_edit.php') ?>
            <?php include('v_change_password.php') ?>
        </div>
    </div>
