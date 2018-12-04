  <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <?php 
                        include("models/m_other.php");
                        $m_or = new M_other();
                        $count_new_order = count($m_or->read_new_order());
                        $count_new_feedback = count($m_or->read_new_feedback());
                        $promotion = "Without promotion today";
                        $date = date('Y-m-d');
                        $promotion_count = $m_or->read_current_promotion($date);
                        if(!empty($promotion)) {
                            $promotion = "Today have a promotion";
                        }

                        ?>  

                        <div class="dropdown for-notification">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-danger">3</span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="notification">
                            <a class="dropdown-item media bg-flat-color-4" href="orders_list.php">
                                <i class="fa fa-check"></i>
                                <p><b>You got <?php echo $count_new_order?> new order</p></b>
                            </a>
                            <a class="dropdown-item media bg-flat-color-4" href="feedback_list.php">
                                <i class="fa fa-info"></i>
                                <p><b>You got <?php echo $count_new_feedback?> new feedback</p></b>
                            </a>
                            <a class="dropdown-item media bg-flat-color-2" href="promotion_list.php">
                                <i class="fa fa-warning"></i>
                                <p><b><?php echo $promotion?></b></p>
                            </a>
                          </div>
                        </div>

                        <!-- <div class="dropdown for-message">
                          <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-email"></i>
                            <span class="count bg-primary">9</span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="message">
                            <p class="red">You have 4 Mails</p>
                            <a class="dropdown-item media bg-flat-color-1" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jonathan Smith</span>
                                    <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                            </a>
                            <a class="dropdown-item media bg-flat-color-4" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jack Sanders</span>
                                    <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </span>
                            </a>
                            <a class="dropdown-item media bg-flat-color-5" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Cheryl Wheeler</span>
                                    <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                            </a>
                            <a class="dropdown-item media bg-flat-color-3" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Rachel Santos</span>
                                    <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </span>
                            </a>
                          </div>
                        </div> -->
                    </div>
                </div>
                <?php
                $user = '';
                $img = 'us.png';
                if(isset($_SESSION["user"])) {
                    $user = $_SESSION["user"];
                    if($user->image != ''){
                        $img = $user->image;
                    } 

                }
                ?>
                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="public/images/<?php echo $img; ?>" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="user_detail.php"><i class="fa fa- user"></i>My Profile</a>

                                <a class="nav-link" id="logout" href="javacript:void(0)"><i class="fa fa- user"></i>Logout </a>

                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language" >
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->

        <script>
            $('#logout').on('click',function(){
                $.ajax({
                    url:'ajax.php',
                    type:'POST',
                    data:{'logout':'OK'},
                    success:function(data) {
                        if(data.trim() == "success") {
                            window.location = ".";
                        }
                    }
                })
            })
        </script>